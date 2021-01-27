<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookingPageResource;
use App\Http\Resources\BookingTypeResource;
use App\Http\Resources\PayoutMethodResource;
use App\Models\Billing\PayoutMethod;
use App\Models\BookingPage\BookingPage;
use App\Models\BookingType\BookingType;
use App\Models\BookingType\BookingTypeLocation;
use App\Rules\PayoutMethodType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

/**
 * @group BookingPages
 */
class BookingPageController extends Controller
{
    public function create(Request $request)
    {
        $this->middleware('logged_in_only');
        
        $input = validate($request->all(), [
            'booking_page' => [
                'required|array',
                
                function ($data) {
                    return BookingPage::validate($data, [
                        'title' => 'required',
                        'slug' => 'required',
                        'use_user_name_as_title',
                        'user_avatar_file',
                        'use_user_avatar_as_user_avatar',
                        'logo_file',
                    ]);
                },
            ],
        ]);
        
        $user = auth()->user();
        
        $bookingPage = BookingPage::create(array_merge($input['booking_page'], [
            'owner_user_id' => $user->id,
            'assigned_user_id' => $user->id,
            'user_availability' => $user->availability,
        ]));
        
        if (Arr::has($input, 'booking_page.user_avatar_file')) {
            $bookingPage->clearMediaCollection('user_avatars');
            $inputBookingPageUserAvatarFile = Arr::get($input, 'booking_page.user_avatar_file');
            
            if ($inputBookingPageUserAvatarFile && $inputBookingPageUserAvatarFile->isValid()) {
                $bookingPage->addMedia($inputBookingPageUserAvatarFile)->toMediaCollection('user_avatars');
            }
        }
        
        if (Arr::has($input, 'booking_page.logo_file')) {
            $bookingPage->clearMediaCollection('logos');
            
            if (Arr::get($input, 'booking_page.logo_file') && Arr::get($input, 'booking_page.logo_file')->isValid()) {
                $bookingPage->addMedia($input['booking_page']['logo_file'])->toMediaCollection('logos');
            }
        }
        
        return new BookingPageResource($bookingPage);
    }
    
    /**
     * Get
     * Get BookingPage by ID (or Slug using prefix `slug:` and string)
     *
     * @urlParam booking_page_id required BookingPage ID or slug:Slug Example: slug:abc
     * @apiResource App\Http\Resources\BookingPageResource
     * @apiResourceModel App\Models\BookingPage
     *
     * @param Request $request
     * @param $bookingPageId
     * @return BookingPageResource
     */
    public function get(Request $request, $bookingPageId)
    {
        if (preg_match('/^slug:(.+)$/i', $bookingPageId, $bookingPageSlugMatch)) {
            $bookingPage = BookingPage::where('slug', $bookingPageSlugMatch[1])->firstOrFail();
        } else {
            $bookingPage = BookingPage::findOrFail($bookingPageId);
        }
        
        $bookingPage->load($request->included([
            'assigned_user',
            
            'booking_types' => function ($query) {
                $query->where('is_active', true);
            },
        ]));
        
        return new BookingPageResource($bookingPage);
    }
    
    /**
     * Update
     * Update BookingPage by ID
     *
     * @authenticated
     * @urlParam booking_page_id required BookingPage ID Example: 7
     * @bodyParam booking_page object required BookingPage
     * @apiResource App\Http\Resources\BookingPageResource
     * @apiResourceModel App\Models\BookingPage
     *
     * @param Request $request
     * @param $bookingPageId
     * @return null
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     */
    public function update(Request $request, $bookingPageId)
    {
        $this->middleware('logged_in_only');
        $bookingPage = BookingPage::findOrFail($bookingPageId);
        auth()->user()->can('edit', $bookingPage) or abort(403);
        
        $input = validate($request->all(), [
            'booking_page' => [
                'required|array',
                
                function ($data) use ($bookingPage) {
                    return BookingPage::validate($data, null, [
                        'booking_page' => $bookingPage,
                    ]);
                },
            ],
        ]);
        
        $bookingPage->fill($input['booking_page']);
        $bookingPage->save();
        
        if (Arr::has($input, 'booking_page.user_avatar_file')) {
            $bookingPage->clearMediaCollection('user_avatars');
            $inputBookingPageUserAvatarFile = Arr::get($input, 'booking_page.user_avatar_file');
            
            if ($inputBookingPageUserAvatarFile && $inputBookingPageUserAvatarFile->isValid()) {
                $bookingPage->addMedia($inputBookingPageUserAvatarFile)->toMediaCollection('user_avatars');
            }
        }
        
        if (Arr::has($input, 'booking_page.logo_file')) {
            $bookingPage->clearMediaCollection('logos');
            $inputBookingPageLogoFile = Arr::get($input, 'booking_page.logo_file');
            
            if ($inputBookingPageLogoFile && $inputBookingPageLogoFile->isValid()) {
                $bookingPage->addMedia($inputBookingPageLogoFile)->toMediaCollection('logos');
            }
        }
        
        return new BookingPageResource($bookingPage);
    }
    
    /**
     * Create new BookingType
     * Create a new BookingType inside this BookingPage
     *
     * @authenticated
     * @urlParam booking_page_id required BookingPage ID you want create BookingType for Example: 7
     * @bodyParam booking_type object required BookingType
     * @apiResource App\Http\Resources\BookingTypeResource
     * @apiResourceModel App\Models\BookingType\BookingType
     *
     * @param Request $request
     * @param $bookingPageId
     * @return null
     * @throws \Exception
     */
    public function createBookingType(Request $request, $bookingPageId)
    {
        $this->middleware('logged_in_only');
        $bookingPage = BookingPage::findOrFail($bookingPageId);
        auth()->user()->can('createBookingType', $bookingPage) or abort(403);
        
        $input = $request->validate([
            'booking_type' => [
                'required|array',
                
                function ($data) use ($bookingPage) {
                    return BookingType::validate($data, [
                        'name' => 'required',
                        'slug' => 'required',
                        'color' => 'required',
                    ], [
                        'booking_page' => $bookingPage,
                    ]);
                },
            ],
        ]);
        
        DB::beginTransaction();
        
        try {
            $bookingType = new BookingType;
            $bookingType->parent_type = 'BookingPage';
            $bookingType->parent_id = $bookingPage->id;
            $bookingType->type = BookingType::TYPE_SOLO;
            $bookingType->fill($input['booking_type']);
            $bookingType->save();
            
            // ------------------------------------------------------------------ //
            
            $bookingType->setRelation('locations', collect());
            
            if (isset($input['booking_type.locations'])) {
                $inputBookingTypeLocations = collect($input['booking_type.locations']);
                
                $inputBookingTypeLocations->each(function ($inputBookingTypeLocation) use ($bookingType) {
                    $bookingTypeLocation = new BookingTypeLocation;
                    $bookingTypeLocation->booking_type_id = $bookingType->id;
                    $bookingTypeLocation->fill($inputBookingTypeLocation);
                    $bookingTypeLocation->save();
                    $bookingType->locations->push($bookingTypeLocation);
                });
            }
            
            // ------------------------------------------------------------------ //
            
            $bookingType->setRelation('availability_rules', collect());
            $bookingType->setRulesFromUserAvailability(auth()->user()->availability);
        } catch (\Exception $exception) {
            DB::rollback();
            throw $exception;
        }
        
        DB::commit();
        
        return new BookingTypeResource($bookingType);
    }
    
    /**
     * Get BookingType
     * Get the BookingType inside this BookingPage by Slug using prefix `slug:` with string
     *
     * @urlParam booking_page_id required BookingPage ID Example: 7
     * @urlParam booking_type_id required BookingType ID (or Slug) Example: slug:abc
     * @apiResource App\Http\Resources\BookingTypeResource
     * @apiResourceModel App\Models\BookingType\BookingType
     *
     * @param Request $request
     * @param $bookingPageId
     * @param $bookingTypeId
     * @return |null
     */
    public function bookingType(Request $request, $bookingPageId, $bookingTypeId)
    {
        $bookingPage = BookingPage::findOrFail($bookingPageId);
        
        if (preg_match('/^slug:(.+)$/i', $bookingTypeId, $bookingTypeSlugMatch)) {
            $bookingType = $bookingPage->booking_types()->where('slug', $bookingTypeSlugMatch[1])->firstOrFail();
        } else {
            $bookingType = $bookingPage->booking_types()->findOrFail($bookingTypeId);
        }
        
        return new BookingTypeResource($bookingType);
    }
    
    /**
     * Suggest slug for new BookingType
     * Suggest slug for a new BookingType when text provided
     *
     * @authenticated
     * @urlParam booking_page_id required BookingPage ID Example: 7
     * @queryParam string required Text to generate slug from Example: Interview Meeting
     *
     * @response {
     *    "data": "interview-meeting"
     * }
     *
     * @param Request $request
     * @param $bookingPageId
     * @return null
     */
    public function suggestBookingTypeSlug(Request $request, $bookingPageId)
    {
        $this->middleware('logged_in_only');
        $bookingPage = BookingPage::findOrFail($bookingPageId);
        auth()->user()->can('createBookingType', $bookingPage) or abort(403);
        
        $input = $request->validate([
            'string' => 'required|string',
        ]);
        
        $suggestedSlug = BookingType::suggestSlug([
            'type' => 'BookingPage',
            'id' => $bookingPage->id,
        ], $input['string']);
        
        return new JsonResource($suggestedSlug);
    }
    
    /**
     * @param Request $request
     * @return PayoutMethodResource
     */
    public function createPayoutMethod(Request $request)
    {
        $this->middleware('logged_in_only');
        $id = $request->payout_method['id'] ?? null;
        $paymentMethod = $id ? PayoutMethod::findOrFail($id) : new PayoutMethod();
        
        if ($request->type !== $paymentMethod::PAYOUT_BANK_ACCOUNT) {
            $input = $request->validate([
                'payout_method.payment_email' => 'required|string|max:255',
                'payout_method.type' => ['required|string', new PayoutMethodType($paymentMethod::$payoutMethodTypes)],
                'payout_method.booking_page_id' => 'required|exists:booking_pages,id',
                'account_details_confirm' => 'required|boolean',
            ]);
        } else {
            $input = $paymentMethod::validate($request->payout_method);
        }
        
        $paymentMethod->fill($input['payout_method'] ?? $input);
        $paymentMethod->save();
        return new PayoutMethodResource($paymentMethod);
    }
    
    /**
     * @param $bookingPageId
     * @return PayoutMethodResource
     */
    public function getPayoutMethods($bookingPageId)
    {
        $payoutMethods = PayoutMethod::whereBookingPageId($bookingPageId)->get();
        return new PayoutMethodResource($payoutMethods);
    }
    
    /**
     * @param Request $request
     * @return PayoutMethodResource
     */
    public function deletePayoutMethod(Request $request)
    {
        $paymentMethods = PayoutMethod::findOrFail($request->payout_id)->delete();
        return new PayoutMethodResource(['status' => $paymentMethods]);
    }
}
