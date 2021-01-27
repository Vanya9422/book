<?php

namespace App\Http\Controllers\Api\V1;

use App\Auth\SessionGuard;
use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookingResource;
use App\Http\Resources\BookingTypeResource;
use App\Models\Booking\Booking;
use App\Models\BookingType\BookingType;
use App\Models\BookingType\BookingTypeAppearance;
use App\Models\BookingType\BookingTypeAvailabilityRule;
use App\Models\BookingType\BookingTypeCoupon;
use App\Models\BookingType\BookingTypeCustomLink;
use App\Models\BookingType\BookingTypeLocation;
use App\Models\BookingType\BookingTypePortfolio;
use App\Models\BookingType\BookingTypePortfolioPhoto;
use App\Models\BookingType\BookingTypeQuestion;
use App\Models\BookingType\BookingTypeUpload;
use App\Models\Geo\Locality;
use App\Models\User\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

/**
 * @group BookingTypes
 */
class BookingTypeController extends Controller
{
    /**
     * Get
     * Get BookingType by ID
     *
     * @urlParam booking_type_id required BookingType ID Example: 34
     * @apiResource App\Http\Resources\BookingTypeResource
     * @apiResourceModel App\Models\BookingType\BookingType
     *
     * @param Request $request
     * @param $bookingTypeId
     * @return |null
     */
    public function get(Request $request, $bookingTypeId)
    {
        $bookingType = BookingType::findOrFail($bookingTypeId);
        
        if (!auth()->check() && $bookingType->parent_type == 'Organization') {
            abort(403);
        }
        
        $bookingType->load([
            'locations',
            'availability_rules',
            'coupons',
            'appearances',
            'links',
            
            'questions' => function ($query) {
                $query->orderBy('position', 'asc');
            },
            
            'portfolios' => function ($query) {
                $query->orderBy('position', 'asc');
            },
            
            'uploads' => function ($query) {
                $query->orderBy('position', 'asc');
            },
        ]);
        
        return response()->resource($bookingType);
    }
    
    /**
     * Update
     * Update BookingType by ID
     *
     * @authenticated
     * @urlParam booking_type_id required BookingType ID Example: 7
     * @bodyParam booking_type object required BookingType
     * @bodyParam booking_type.name string Name
     * @bodyParam booking_type.description string Description
     * @bodyParam booking_type.color string Color (HEX) Example: ff00ff
     * @bodyParam booking_type.duration integer Duration
     * @bodyParam booking_type.timezone_code string Timezone Code
     * @bodyParam booking_type.timezone_type string Timezone Type
     * @bodyParam booking_type.spot_step integer Spot Step
     * @bodyParam booking_type.max_bookings_per_day integer Max Bookings per Day
     * @bodyParam booking_type.max_booking_time integer Max Booking Time
     * @bodyParam booking_type.min_booking_time integer Min Booking Time
     * @bodyParam booking_type.buffer_before integer Buffer Before
     * @bodyParam booking_type.buffer_after integer Buffer After
     * @bodyParam booking_type.notification_type string Notification Type
     * @bodyParam booking_type.is_cancellation_allowed boolean Is Cancelation allowed?
     * @bodyParam booking_type.cancellation_policy_text string Concelation Policy Text
     * @bodyParam booking_type.is_invitee_reminder_enabled boolean Is Invitee Reminder enabled?
     * @bodyParam booking_type.is_invitee_sms_reminder_enabled boolean Is Invitee SMS Reminder enabled?
     * @bodyParam booking_type.is_invitee_email_follow_up_enabled boolean Is Invitee Email Follow Up enabled?
     * @bodyParam booking_type.is_payment_required boolean Is Payment required?
     * @bodyParam booking_type.rate_value float Rate Value
     * @bodyParam booking_type.rate_currency_code string Rate Currency Code
     * @bodyParam booking_type.is_discount_enabled boolean Is Discount enabled?
     * @bodyParam booking_type.discount_value float Discount value
     * @bodyParam booking_type.discount_has_expiration boolean Discount has expiration?
     * @bodyParam booking_type.discount_expiration_date date Discount Expiration Date
     * @bodyParam booking_type.locations array Locations
     * @bodyParam booking_type.availability_rules array Availability Rules
     * @bodyParam booking_type.questions array Questions
     * @bodyParam booking_type.coupons array Coupons
     * @bodyParam booking_type.portfolios array Portfolios
     * @apiResource App\Http\Resources\BookingTypeResource
     * @apiResourceModel App\Models\BookingType\BookingType
     *
     * @param Request $request
     * @param $bookingTypeId
     * @return |null
     */
    public function update(Request $request, $bookingTypeId)
    {
        $this->middleware('logged_in_only');
        $bookingType = BookingType::findOrFail($bookingTypeId);
        auth()->user()->can('edit', $bookingType) or abort(403);
        
        $input = $request->validate([
            'booking_type' => [
                'required|array',
                
                function ($data) use ($bookingType) {
                    return BookingType::validate($data, null, [
                        'booking_type' => $bookingType,
                    ]);
                },
            ],
        ]);
        
        $bookingType->fill($input['booking_type']);
        $bookingType->save();
        
        // ---------------------------------------------------------------------- //
        
        if (isset($input['booking_type']['locations'])) {
            $bookingType->setRelation('locations', $bookingType->locations->filter(function (BookingTypeLocation $bookingTypeLocation) use ($input) {
                if (collect($input['booking_type']['locations'])->where('id', $bookingTypeLocation->id)->first()) {
                    return true;
                }
                
                $bookingTypeLocation->delete();
                return false;
            })->values());
            
            collect($input['booking_type']['locations'])->each(function ($inputBookingTypeLocation) use ($bookingType) {
                $bookingTypeLocation = $bookingType->locations->where('id', $inputBookingTypeLocation['id'] ?? null)->first();
                
                if (!$bookingTypeLocation) {
                    $bookingTypeLocation = new BookingTypeLocation();
                    $bookingTypeLocation->booking_type_id = $bookingType->id;
                }
                
                $bookingTypeLocation->fill($inputBookingTypeLocation);
                $bookingTypeLocation->save();
                
                if ($bookingTypeLocation->wasRecentlyCreated) {
                    $bookingType->locations->push($bookingTypeLocation);
                }
            });
        }
        
        if (isset($input['booking_type']['coupons'])) {
            $bookingType->setRelation('coupons', $bookingType->coupons->filter(function (BookingTypeCoupon $bookingTypeCoupon) use ($input) {
                if (collect($input['booking_type']['coupons'])->where('id', $bookingTypeCoupon->id)->first()) {
                    return true;
                }
                
                $bookingTypeCoupon->delete();
                
                return false;
            })->values());
            
            collect($input['booking_type']['coupons'])->each(function ($inputBookingTypeCoupon) use ($bookingType) {
                $bookingTypeCoupon = $bookingType->coupons->where('id', $inputBookingTypeCoupon['id'] ?? null)->first();
                
                if (!$bookingTypeCoupon) {
                    $bookingTypeCoupon = new BookingTypeCoupon();
                    $bookingTypeCoupon->booking_type_id = $bookingType->id;
                }
                
                $bookingTypeCoupon->fill($inputBookingTypeCoupon);
                $bookingTypeCoupon->save();
                
                if ($bookingTypeCoupon->wasRecentlyCreated) {
                    $bookingType->coupons->push($bookingTypeCoupon);
                }
            });
        }
        
        if (isset($input['booking_type']['questions'])) {
            $bookingType->setRelation('questions', $bookingType->questions->filter(function (BookingTypeQuestion $bookingTypeQuestion) use ($input) {
                if (collect($input['booking_type']['questions'])->where('id', $bookingTypeQuestion->id)->first()) {
                    return true;
                }
                
                $bookingTypeQuestion->delete();
                
                return false;
            })->values());
            
            collect($input['booking_type']['questions'])->each(function ($inputBookingTypeQuestion) use ($bookingType) {
                $bookingTypeQuestion = $bookingType->questions->where('id', $inputBookingTypeQuestion['id'] ?? null)->first();
                
                if (!$bookingTypeQuestion) {
                    $bookingTypeQuestion = new BookingTypeQuestion();
                    $bookingTypeQuestion->booking_type_id = $bookingType->id;
                }
                
                $bookingTypeQuestion->fill($inputBookingTypeQuestion);
                $bookingTypeQuestion->save();
                
                if ($bookingTypeQuestion->wasRecentlyCreated) {
                    $bookingType->questions->push($bookingTypeQuestion);
                }
            });
        }
        
        if (isset($input['booking_type']['availability_rules'])) {
            $bookingType->setRelation(
                'availability_rules',
                
                $bookingType->availability_rules->filter(function (BookingTypeAvailabilityRule $bookingTypeAvailabilityRule) use ($input) {
                    if (collect($input['booking_type']['availability_rules'])->where('id', $bookingTypeAvailabilityRule->id)->first()) {
                        return true;
                    }
                    
                    $bookingTypeAvailabilityRule->delete();
                    
                    return false;
                })->values()
            );
            
            collect($input['booking_type']['availability_rules'])->each(function ($inputBookingTypeAvailabilityRule) use ($bookingType) {
                $bookingTypeAvailabilityRule = $bookingType->availability_rules
                    ->where('id', $inputBookingTypeAvailabilityRule['id'] ?? null)
                    ->first();
                
                if (!$bookingTypeAvailabilityRule) {
                    $bookingTypeAvailabilityRule = new BookingTypeAvailabilityRule;
                    $bookingTypeAvailabilityRule->booking_type_id = $bookingType->id;
                }
                
                $bookingTypeAvailabilityRule->fill($inputBookingTypeAvailabilityRule);
                $bookingTypeAvailabilityRule->save();
                
                if ($bookingTypeAvailabilityRule->wasRecentlyCreated) {
                    $bookingType->availability_rules->push($bookingTypeAvailabilityRule);
                }
            });
        }
        
        if (isset($input['booking_type']['portfolios'])) {
            $bookingType->setRelation(
                'portfolios',
                
                $bookingType->portfolios->filter(function (BookingTypePortfolio $bookingTypePortfolio) use ($input) {
                    if (collect($input['booking_type']['portfolios'])->where('id', $bookingTypePortfolio->id)->first()) {
                        return true;
                    }
                    
                    $bookingTypePortfolio->delete();
                    
                    return false;
                })->values()
            );
            
            collect($input['booking_type']['portfolios'])->each(function ($inputBookingTypePortfolio) use ($bookingType) {
                $bookingTypePortfolio = $bookingType->portfolios
                    ->where('id', $inputBookingTypePortfolio['id'] ?? null)
                    ->first();
                
                if (!$bookingTypePortfolio) {
                    $bookingTypePortfolio = new BookingTypePortfolio();
                    $bookingTypePortfolio->booking_type_id = $bookingType->id;
                }
                
                $bookingTypePortfolio->fill($inputBookingTypePortfolio);
                $bookingTypePortfolio->save();
                
                if ($bookingTypePortfolio->wasRecentlyCreated) {
                    $bookingType->portfolios->push($bookingTypePortfolio);
                }
            });
        }
        
        if (isset($input['booking_type']['uploads'])) {
            $bookingType->setRelation(
                'uploads',
                
                $bookingType->uploads->filter(function (BookingTypeUpload $bookingTypeUpload) use ($input) {
                    if (collect($input['booking_type']['uploads'])->where('id', $bookingTypeUpload->id)->first()) {
                        return true;
                    }
                    
                    $bookingTypeUpload->delete();
                    
                    return false;
                })->values()
            );
            
            collect($input['booking_type']['uploads'])->each(function ($inputBookingTypeUpload) use ($bookingType) {
                $bookingTypeUpload = $bookingType->uploads
                    ->where('id', $inputBookingTypeUpload['id'] ?? null)
                    ->first();
                
                if (!$bookingTypeUpload) {
                    $bookingTypeUpload = new BookingTypeUpload();
                    $bookingTypeUpload->booking_type_id = $bookingType->id;
                }
                
                $bookingTypeUpload->fill($inputBookingTypeUpload);
                $bookingTypeUpload->save();
                
                if ($bookingTypeUpload->wasRecentlyCreated) {
                    $bookingType->uploads->push($bookingTypeUpload);
                }
            });
        }
        
        if (isset($input['booking_type']['appearances'])) {
            // TODO: refactor this to make BookingPage have only one appearance
            
            $bookingType->setRelation(
                'appearances',
                
                $bookingType->appearances->filter(function (BookingTypeAppearance $bookingTypeAppearance) use ($input) {
                    if (collect($input['booking_type']['appearances'])->where('id', $bookingTypeAppearance->id)->first()) {
                        return true;
                    }
                    
                    $bookingTypeAppearance->delete();
                    
                    return false;
                })->values()
            );
            
            collect($input['booking_type']['appearances'])->each(function ($inputBookingTypeAppearance) use ($bookingType, $input) {
                $bookingTypeAppearance = $bookingType->appearances
                    ->where('id', $inputBookingTypeAppearance['id'] ?? null)
                    ->first();
                
                if (!$bookingTypeAppearance) {
                    $bookingTypeAppearance = new BookingTypeAppearance();
                    $bookingTypeAppearance->booking_type_id = $bookingType->id;
                }
                
                $bookingTypeAppearance->fill($inputBookingTypeAppearance);
                $bookingTypeAppearance->save();
                
                
                if ($bookingTypeAppearance->wasRecentlyCreated) {
                    $bookingType->appearances->push($bookingTypeAppearance);
                }
                
                if (Arr::has($input['booking_type']['appearances'][0], 'image') && $input['booking_type']['appearances'][0]['image'] != null) {
                    $bookingTypeAppearance->clearMediaCollection('page_photo');
                    
                    if (Arr::get($input['booking_type']['appearances'][0], 'image') && Arr::get($input['booking_type']['appearances'][0], 'image')->isValid()) {
                        $bookingTypeAppearance->addMedia($input['booking_type']['appearances'][0]['image'])->toMediaCollection('page_photo');
                    }
                }
            });
        }
        
        if (isset($input['booking_type']['links'])) {
            $bookingType->setRelation(
                'links',
                
                $bookingType->links->filter(function (BookingTypeCustomLink $bookingTypeCustomLink) use ($input) {
                    if (collect($input['booking_type']['links'])->where('id', $bookingTypeCustomLink->id)->first()) {
                        return true;
                    }
                    
                    $bookingTypeCustomLink->delete();
                    
                    return false;
                })->values()
            );
            
            collect($input['booking_type']['links'])->each(function ($inputBookingTypeCustomLink) use ($bookingType) {
                $bookingTypeCustomLink = $bookingType->links
                    ->where('id', $inputBookingTypeCustomLink['id'] ?? null)
                    ->first();
                
                if (!$bookingTypeCustomLink) {
                    $bookingTypeCustomLink = new BookingTypeCustomLink();
                    $bookingTypeCustomLink->booking_type_id = $bookingType->id;
                }
                
                $bookingTypeCustomLink->fill($inputBookingTypeCustomLink);
                $bookingTypeCustomLink->save();
                
                if ($bookingTypeCustomLink->wasRecentlyCreated) {
                    $bookingType->links->push($bookingTypeCustomLink);
                }
            });
        }
        
        return new BookingTypeResource($bookingType);
    }
    
    public function updatePortfolioPhotos(Request $request)
    {
        if ($request['id']) {
            $bookingTypePortfolioPhoto = BookingTypePortfolioPhoto::where('id', $request['id'])->update([
                'booking_type_portfolio_id' => $request['bookingTypePortfolioId'],
                'title' => $request['title'],
                'description' => $request['description'],
                'position' => $request['position'],
                'is_enabled' => $request['isEnabled'],
            ]);
        } elseif ($request['id'] == null && !isset($request->type)) {
            $bookingTypePortfolioPhoto = BookingTypePortfolioPhoto::create([
                'booking_type_portfolio_id' => $request['bookingTypePortfolioId'],
                'title' => $request['title'],
                'description' => $request['description'],
                'position' => $request['position'],
                'is_enabled' => $request['isEnabled'],
            ]);
        } elseif (isset($request['type'])) {
            BookingTypePortfolioPhoto::whereIn('id', $request['delete_photos'])->delete();
        }
        
        if ($request->hasFile('image')) {
            if ($request['id']) {
                $bookingTypePortfolioPhoto = BookingTypePortfolioPhoto::findOrFail($request['id']);
            }
            
            $bookingTypePortfolioPhoto->clearMediaCollection('photos');
            
            if ($request->hasFile('image')) {
                $bookingTypePortfolioPhoto->addMedia($request['image'])->toMediaCollection('photos');
            }
        }
    }
    
    /**
     * Activate
     * Activate BookingType
     *
     * @authenticated
     * @urlParam booking_type_id required BookingType ID Example: 39
     * @apiResource App\Http\Resources\BookingTypeResource
     * @apiResourceModel App\Models\BookingType\BookingType
     *
     * @param $bookingTypeId
     * @return |null
     */
    public function activate($bookingTypeId)
    {
        $this->middleware('logged_in_only');
        $bookingType = BookingType::findOrFail($bookingTypeId);
        auth()->user()->can('edit', $bookingType) or abort(403);
        $bookingType->is_active = true;
        $bookingType->save();
        
        return response()->resource($bookingType);
    }
    
    /**
     * Deactivate
     * Deactivate BookingType
     *
     * @authenticated
     * @urlParam booking_type_id required BookingType ID Example: 39
     * @apiResource App\Http\Resources\BookingTypeResource
     * @apiResourceModel App\Models\BookingType\BookingType
     *
     * @param $bookingTypeId
     * @return |null
     */
    public function deactivate($bookingTypeId)
    {
        $this->middleware('logged_in_only');
        $bookingType = BookingType::findOrFail($bookingTypeId);
        auth()->user()->can('edit', $bookingType) or abort(403);
        $bookingType->is_active = false;
        $bookingType->save();
        
        return response()->resource($bookingType);
    }
    
    /**
     * Suggest slug
     * Suggest slug for this BookingType
     *
     * @authenticated
     * @urlParam booking_type_id required BookingType ID Example: 283
     * @queryParam string string required Test you want to generate slug from
     *
     * @response {
     *  "data": "some-slug-here"
     * }
     *
     * @param Request $request
     * @param $bookingTypeId
     * @return |null
     */
    public function suggestSlug(Request $request, $bookingTypeId)
    {
        $this->middleware('logged_in_only');
        $bookingType = BookingType::findOrFail($bookingTypeId);
        auth()->user()->can('edit', $bookingType) or abort(403);
        
        $input = $request->validate([
            'string' => 'required|string',
        ]);
        
        $suggestedSlug = BookingType::suggestSlug([
            'type' => $bookingType->parent_type,
            'id' => $bookingType->parent_id,
        ], $input['string'], $bookingType->id);
        
        return new JsonResource($suggestedSlug);
    }
    
    /**
     * Get available dates
     * Get available dates & spots from date to date grouping by Timezone
     *
     * @urlParam booking_type_id required BookingType ID Example: 234
     * @queryParam date_from required Date & Time from Example: 2020-03-20T20:00:00-03:00
     * @queryParam date_to required Date & Time to Example: 2020-03-10T20:00:00-03:00
     * @queryParam timezone_code required Timezone Code to group available spots into dates Example: America/Toronto
     *
     * @response {
     *  "data": [
     *   {
     *    "value": "2020-03-20",
     *    "spots": ["2020-03-20T20:00:00-03:00", "2020-03-20T20:15:00-03:00", "2020-03-20T20:30:00-03:00"]
     *   }
     *  ]
     * }
     *
     * @param Request $request
     * @param $bookingTypeId
     * @return |null
     * @throws \Exception
     */
    public function availableDates(Request $request, $bookingTypeId)
    {
        $bookingType = BookingType::findOrFail($bookingTypeId);
        
        $input = $request->validate([
            'date_from' => 'required|date',
            'date_to' => 'required|date',
            'timezone_code' => 'required|timezone',
        ]);
        
        $bookingTypeTimezoneCode = $bookingType->parent->user->locality->timezone_code;
        $bookingTypeAvailabilityRules = $bookingType->availability_rules()->get();
        
        $periodFrom = (new Carbon)->setDateTimeFrom($input['date_from'])->setTimezone($bookingTypeTimezoneCode)->setTime(0, 0, 0);
        $periodTo = (new Carbon)->setDateTimeFrom($input['date_to'])->setTimezone($bookingTypeTimezoneCode)->setTime(0, 0, -1);
        $period = new CarbonPeriod($periodFrom, $periodTo);
        $currentTime = new Carbon;
        $availableSpots = collect();
        
        foreach ($period as $periodDate) {
            $bookingTypeAvailabilityRule = $bookingTypeAvailabilityRules
                ->where('type', BookingTypeAvailabilityRule::TYPE_DATE)
                ->where('date', $periodDate->format('Y-m-d'))
                ->first();
            
            if (!$bookingTypeAvailabilityRule) {
                $bookingTypeAvailabilityRule = $bookingTypeAvailabilityRules
                    ->where('type', BookingTypeAvailabilityRule::TYPE_WEEK_DAY)
                    ->where('week_day', BookingTypeAvailabilityRule::$weekDays[$periodDate->dayOfWeekIso - 1])
                    ->first();
            }
            
            if (!$bookingTypeAvailabilityRule) {
                continue;
            }
            
            foreach ($bookingTypeAvailabilityRule->intervals as $bookingTypeAvailabilityRuleInterval) {
                $bookingTypeAvailabilityRuleIntervalPeriodFrom = $periodDate->clone();
                $bookingTypeAvailabilityRuleIntervalPeriodFrom->modify($bookingTypeAvailabilityRuleInterval['from']);
                $bookingTypeAvailabilityRuleIntervalPeriodTo = $periodDate->clone();
                $bookingTypeAvailabilityRuleIntervalPeriodTo->modify($bookingTypeAvailabilityRuleInterval['to']);
                
                if ($bookingTypeAvailabilityRuleInterval['to'] === '00:00') {
                    $bookingTypeAvailabilityRuleIntervalPeriodTo->addDays(+1);
                }
                
                $bookingTypeAvailabilityRuleIntervalPeriodTo->addSeconds(-1);
                
                $bookingTypeAvailabilityRuleIntervalPeriod = new CarbonPeriod(
                    $bookingTypeAvailabilityRuleIntervalPeriodFrom,
                    $bookingType->spot_step . 'M',
                    $bookingTypeAvailabilityRuleIntervalPeriodTo
                );
                
                foreach ($bookingTypeAvailabilityRuleIntervalPeriod as $bookingTypeAvailabilityRuleIntervalPeriodTime) {
                    $availableSpots->push($bookingTypeAvailabilityRuleIntervalPeriodTime);
                }
            }
        }
        
        $availableSpots = $availableSpots->filter(function ($availableSpot) use ($input) {
            return $availableSpot >= new Carbon($input['date_from']) && $availableSpot < new Carbon($input['date_to']);
        })->filter(function ($availableSpot) use ($currentTime) {
            return $availableSpot >= $currentTime;
        });
        
        $availableDates = $availableSpots->groupBy(function ($availableSpot) use ($input) {
            return $availableSpot->setTimezone($input['timezone_code'])->format('Y-m-d');
        });
        
        $availableDates = $availableDates->map(function ($availableSpots, $date) {
            return [
                'value' => $date,
                
                'spots' => $availableSpots->map(function ($availableSpot) {
                    return $availableSpot->toAtomString();
                }),
            ];
        })->values();
        
        return new JsonResource($availableDates);
    }
    
    /**
     * Book
     * Book this BookingType
     *
     * @urlParam booking_type_id required BookingType ID Example: 343
     * @bodyParam booking object required Booking
     * @bodyParam booking.start_time date required
     * @bodyParam user object User to register (if you are not authorized)
     * @bodyParam user.email email required Email
     * @bodyParam user.first_name string required First Name
     * @bodyParam user.last_name string required Last Name
     * @bodyParam user.locality_key string required Locality Key
     * @apiResource App\Http\Resources\BookingResource
     * @apiResourceModel App\Models\Booking
     *
     * @param Request $request
     * @param $bookingTypeId
     * @return |null
     * @throws ApiException
     * @throws \Exception
     */
    public function book(Request $request, $bookingTypeId)
    {
        $bookingType = BookingType::findOrFail($bookingTypeId);
        $user = auth()->user();
        
        $validationRules = [
            'booking' => [
                'required|array',
                
                function ($data) {
                    return Booking::validate($data, [
                        'start_time' => 'required',
                    ]);
                },
            ],
        ];
        
        if (!$user) {
            $validationRules['user'] = [
                'required|array',
                
                function ($data) {
                    return User::validate($data, [
                        'email' => 'required',
                        'first_name' => 'required',
                        'last_name' => 'required',
                        'locality_key' => 'required',
                    ]);
                },
            ];
        }
        
        Locality::getOrMakeByKey($request->input('user.locality_key'));
        $input = $request->validate($validationRules);
        $currentTime = new Carbon;
        $bookingTypeTimezoneCode = $bookingType->parent->user->locality->timezone_code;
        $bookingStartTime = (new Carbon($input['booking']['start_time']))->setTimezone($bookingTypeTimezoneCode);
        $bookingEndTime = $bookingStartTime->clone()->addMinutes($bookingType->duration);
        $bookingQuery = Booking::query();
        $bookingQuery->where('booking_type_id', $bookingType->id);
        $bookingQuery->where('start_time', '>=', $bookingStartTime->clone()->setTimezone(config('app.timezone')));
        $bookingQuery->where('end_time', '<=', $bookingEndTime->clone()->setTimezone(config('app.timezone')));
        $booking = $bookingQuery->first();
        
        if ($booking) {
            throw new ApiException('Start Time Is Unavailable', 400);
        }
        
        $bookingTypeAvailabilityRule = $bookingType->availability_rules()->where(function ($where) use ($bookingStartTime) {
            $where->orWhere(function ($where) use ($bookingStartTime) {
                $where->where('type', BookingTypeAvailabilityRule::TYPE_DATE);
                $where->where('date', $bookingStartTime->format('Y-m-d'));
            });
            
            $where->orWhere(function ($where) use ($bookingStartTime) {
                $where->where('type', BookingTypeAvailabilityRule::TYPE_WEEK_DAY);
                $where->where('week_day', BookingTypeAvailabilityRule::$weekDays[$bookingStartTime->dayOfWeekIso - 1]);
            });
        })->get()->sortBy(function ($bookingTypeAvailabilityRule) {
            return array_search($bookingTypeAvailabilityRule->type, [
                BookingTypeAvailabilityRule::TYPE_DATE,
                BookingTypeAvailabilityRule::TYPE_WEEK_DAY,
            ]);
        })->first();
        
        $availableSpots = collect();
        
        foreach ($bookingTypeAvailabilityRule->intervals as $bookingTypeAvailabilityRuleInterval) {
            $bookingTypeAvailabilityRuleIntervalPeriodFrom = $bookingStartTime->clone();
            $bookingTypeAvailabilityRuleIntervalPeriodFrom->modify($bookingTypeAvailabilityRuleInterval['from']);
            $bookingTypeAvailabilityRuleIntervalPeriodTo = $bookingStartTime->clone();
            $bookingTypeAvailabilityRuleIntervalPeriodTo->modify($bookingTypeAvailabilityRuleInterval['to']);
            
            if ($bookingTypeAvailabilityRuleInterval['to'] === '00:00') {
                $bookingTypeAvailabilityRuleIntervalPeriodTo->addDays(+1);
            }
            
            $bookingTypeAvailabilityRuleIntervalPeriodTo->addSeconds(-1);
            
            $bookingTypeAvailabilityRuleIntervalPeriod = new CarbonPeriod(
                $bookingTypeAvailabilityRuleIntervalPeriodFrom,
                $bookingType->spot_step . 'M',
                $bookingTypeAvailabilityRuleIntervalPeriodTo
            );
            
            foreach ($bookingTypeAvailabilityRuleIntervalPeriod as $bookingTypeAvailabilityRuleIntervalPeriodTime) {
                $availableSpots->push($bookingTypeAvailabilityRuleIntervalPeriodTime);
            }
        }
        
        $availableSpots = $availableSpots->filter(function ($availableSpot) use ($currentTime) {
            return $availableSpot >= $currentTime;
        });
        
        $isBookingStartTimeAvailable = $availableSpots->some(function ($availableSpot) use ($bookingStartTime) {
            return $availableSpot == $bookingStartTime;
        });
        
        if (!$isBookingStartTimeAvailable) {
            throw new ApiException('Start Time Is Unavailable', 400);
        }
        
        if (!$user) {
            $user = User::create($input['user']);
            event(new Registered($user));
            
            if (auth()->guard() instanceof SessionGuard) {
                auth()->login($user, true);
            } else {
                auth()->setUser($user);
            }
        }
        
        $booking = new Booking;
        $booking->name = $bookingType->name;
        $booking->booking_type_id = $bookingType->id;
        $booking->booker_user_id = $user->id;
        $booking->bookee_user_id = $bookingType->parent->user_id;
        $booking->duration = $bookingType->duration;
        $booking->start_time = $bookingStartTime;
        $booking->end_time = $bookingEndTime;
        $booking->save();
        
        $additional = [];
        
        if ($user->wasRecentlyCreated) {
            if (auth()->guard() instanceof SessionGuard) {
                $additional = array_merge($additional, [
                    'auth' => auth()->toArray(),
                ]);
            } else {
                $additional = array_merge($additional, [
                    'token' => auth()->user()->createToken(config('app.name'))->accessToken,
                ]);
            }
        }
        
        return (new BookingResource($booking))->additional($additional);
    }
}
