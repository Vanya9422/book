<?php

namespace App\Models\BookingType;

use App\Models\BookingPage\BookingPage;
use App\Models\User\UserAvailability;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BookingType extends Model
{
    const TYPE_SOLO = 'SOLO';
    const TYPE_GROUP = 'GROUP';
    
    public static $types = [
        self::TYPE_SOLO,
        self::TYPE_GROUP,
    ];
    
    const PERIOD_TYPE_MOVING = 'MOVING';
    const PERIOD_TYPE_FIXED = 'FIXED';
    const PERIOD_TYPE_UNLIMITED = 'UNLIMITED';
    
    public static $periodTypes = [
        self::PERIOD_TYPE_MOVING,
        self::PERIOD_TYPE_FIXED,
        self::PERIOD_TYPE_UNLIMITED,
    ];
    
    const INVITEE_NAME_FORMAT_COMBINED = 'COMBINED';
    const INVITEE_NAME_FORMAT_SEPARATED = 'SEPARATED';
    
    public static $inviteeNameFormats = [
        self::INVITEE_NAME_FORMAT_COMBINED,
        self::INVITEE_NAME_FORMAT_SEPARATED,
    ];
    
    const TIMEZONE_TYPE_LOCAL = 'LOCAL';
    const TIMEZONE_TYPE_LOCKED = 'LOCKED';
    
    public static $timezoneTypes = [
        self::TIMEZONE_TYPE_LOCAL,
        self::TIMEZONE_TYPE_LOCKED,
    ];
    
    public static $spotSteps = [5, 10, 15, 20, 30, 45, 60];
    public static $buffers = [0, 5, 10, 15, 30, 45, 60, 90, 120, 150, 180];
    
    const NOTIFICATION_TYPE_CALENDAR_INVITATION = 'CALENDAR_INVITATION';
    const NOTIFICATION_TYPE_EMAIL_CONFIRMATION = 'EMAIL_CONFIRMATION';
    
    public static $notificationTypes = [
        self::NOTIFICATION_TYPE_CALENDAR_INVITATION,
        self::NOTIFICATION_TYPE_EMAIL_CONFIRMATION,
    ];
    
    const PAYMENT_TYPE_FREE = 'FREE';
    const PAYMENT_TYPE_PRE_PAID = 'PRE_PAID';
    const PAYMENT_TYPE_TRACKED = 'TRACKED';
    
    public static $paymentTypes = [
        self::PAYMENT_TYPE_FREE,
        self::PAYMENT_TYPE_PRE_PAID,
        self::PAYMENT_TYPE_TRACKED,
    ];
    
    // ---------------------------------------------------------------------- //
    
    public $attributes = [
        'color' => 'ffffff', // in hex
        'min_booking_time' => 4 * 60 * 60, // in seconds
        'max_booking_time' => 60 * (24 * 60 * 60), // in seconds
        'start_date' => null,
        'end_date' => null,
        'period_type' => self::PERIOD_TYPE_MOVING,
        'timezone_code' => null,
        'timezone_type' => self::TIMEZONE_TYPE_LOCAL,
        'spot_step' => 10, // in minutes
        'max_bookings_per_day' => null,
        'buffer_before' => 0, // in minutes
        'buffer_after' => 0, // in minutes
        'is_active' => true,
        'is_public' => true,
    ];
    
    public $fillable = [
        'slug',
        'name',
        'description',
        'durations',
        'color',
        'max_invitees',
        'period_type',
        'timezone_code',
        'timezone_type',
        'min_booking_time',
        'max_booking_time',
        'start_date',
        'end_date',
        'spot_step',
        'max_bookings_per_day',
        'buffer_before',
        'buffer_after',
        'is_cancellation_allowed',
        'is_public',
        'is_active',
        'cancellation_policy_text',
        'is_invitee_reminder_enabled',
        'is_invitee_sms_reminder_enabled',
        'is_invitee_email_follow_up_enabled',
        'is_payment_required',
        'rate_value',
        'rate_currency_code',
        'is_discount_enabled',
        'discount_value',
        'discount_has_expiration',
        'discount_expiration_date',
        'is_portfolio_enabled',
        'is_file_upload_enabled',
        'confirmation_action_type',
        'schedule_another_event_button_text',
        'is_schedule_another_event_button_shown',
        'external_website_redirect_url',
        'pass_event_details_to_redirected_url',
    ];
    
    public $casts = [
        'start_date' => 'date:Y-m-d',
        'end_date' => 'date:Y-m-d',
        'is_cancellation_allowed' => 'boolean',
        'is_public' => 'boolean',
        'is_active' => 'boolean',
        'is_invitee_reminder_enabled' => 'boolean',
        'is_invitee_sms_reminder_enabled' => 'boolean',
        'is_invitee_email_follow_up_enabled' => 'boolean',
        'is_payment_required' => 'boolean',
        'is_discount_enabled' => 'boolean',
        'discount_has_expiration' => 'boolean',
        'is_portfolio_enabled' => 'boolean',
        'is_file_upload_enabled' => 'boolean',
        'is_schedule_another_event_button_shown' => 'boolean',
        'pass_event_details_to_redirected_url' => 'boolean',
        'durations' => 'array',
    ];
    
    // ---------------------------------------------------------------------- //
    
    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = Carbon::parse($value)->format('Y-m-d');
    }
    
    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = Carbon::parse($value)->format('Y-m-d');
    }
    
    // ---------------------------------------------------------------------- //
    
    public function booking_page()
    {
        return $this->belongsTo(BookingPage::class);
    }
    
    public function locations()
    {
        return $this->hasMany(BookingTypeLocation::class);
    }
    
    public function questions()
    {
        return $this->hasMany(BookingTypeQuestion::class);
    }
    
    public function availability_rules()
    {
        return $this->hasMany(BookingTypeAvailabilityRule::class)->orderByRaw('FIELD(type, ?, ?)', [
            BookingTypeAvailabilityRule::TYPE_WEEK_DAY,
            BookingTypeAvailabilityRule::TYPE_DATE,
        ]);
    }
    
    public function coupons()
    {
        return $this->hasMany(BookingTypeCoupon::class);
    }
    
    public function portfolios()
    {
        return $this->hasMany(BookingTypePortfolio::class)->with('photos');
    }
    
    public function uploads()
    {
        return $this->hasMany(BookingTypeUpload::class);
    }
    
    public function appearances()
    {
        return $this->hasMany(BookingTypeAppearance::class);
    }
    
    public function links()
    {
        return $this->hasMany(BookingTypeCustomLink::class);
    }
    
    // ---------------------------------------------------------------------- //
    
    public function setRulesFromUserAvailability(UserAvailability $userAvailability)
    {
        DB::beginTransaction();
        
        try {
            $this->availability_rules->each(function ($bookingTypeAvailabilityRule) {
                $bookingTypeAvailabilityRule->delete();
            });
            
            $this->setRelation('availability_rules', collect());
            
            collect(BookingTypeAvailabilityRule::$weekDays)->filter(function ($weekDay) use ($userAvailability) {
                return $userAvailability->{strtolower($weekDay)};
            })->each(function ($weekDay) use ($userAvailability) {
                $bookingTypeAvailabilityRule = new BookingTypeAvailabilityRule;
                $bookingTypeAvailabilityRule->booking_type_id = $this->id;
                $bookingTypeAvailabilityRule->type = BookingTypeAvailabilityRule::TYPE_WEEK_DAY;
                $bookingTypeAvailabilityRule->week_day = $weekDay;
                
                $bookingTypeAvailabilityRule->intervals = [
                    [
                        'from' => sprintf('%02d:00', $userAvailability->hour_from),
                        'to' => sprintf('%02d:00', $userAvailability->hour_to),
                    ],
                ];
                
                $bookingTypeAvailabilityRule->save();
                $this->availability_rules->push($bookingTypeAvailabilityRule);
            });
        } catch (\Exception $exception) {
            DB::rollback();
            throw $exception;
        }
        
        DB::commit();
        
        return $this;
    }
    
    // ---------------------------------------------------------------------- //
    
    public static function suggestSlug($parent, $string, $exceptId = 0)
    {
        $string = explode('@', $string)[0];
        $originalSlug = Str::slug($string);
        $originalSlug = str_pad($originalSlug, 3, '1');
        $slug = $originalSlug;
        
        for ($attempt = 1; true; $slug = $originalSlug . '-' . $attempt, ++$attempt) {
            if ($parent && in_array($parent['type'], ['BookingPage'])) {
                $bookingTypeQuery = BookingType::query();
                $bookingTypeQuery->where('parent_type', $parent['type']);
                $bookingTypeQuery->where('parent_id', $parent['id']);
                $bookingTypeQuery->where('slug', $slug);
                $bookingTypeQuery->where('id', '!=', $exceptId);
                
                if ($bookingTypeQuery->exists()) {
                    continue;
                }
            }
            
            break;
        }
        
        return $slug;
    }
    
    public static function validate($data, $extraRules = [], $context = [])
    {
        $bookingPage = $context['booking_page'] ?? null;
        $bookingType = $context['booking_type'] ?? null;
        
        return validate($data, [
            'slug' => [
                'string|regex:/^[.0-9a-z-_]+$/i',
                
                Rule::unique('booking_types', 'slug')->where(function (Builder $where) use ($bookingType, $bookingPage) {
                    if ($bookingType) {
                        $where->where('booking_page_id', $bookingType->booking_page_id);
                    } elseif ($bookingPage) {
                        $where->where('booking_page_id', $bookingPage->id);
                    }
                })->whereNot('id', $bookingType->id ?? null),
            ],
            
            'name' => 'string',
            'description' => 'string|nullable',
            'color' => 'string|regex:/^[0-9a-f]{6}$/i',
            'durations' => 'array',
            'timezone_code' => 'string|nullable|timezone',
            'timezone_type' => 'string|in:' . implode(',', BookingType::$timezoneTypes),
            'spot_step' => 'integer|nullable|in:' . implode(',', BookingType::$spotSteps),
            'max_bookings_per_day' => 'integer|nullable|gt:0',
            'max_booking_time' => 'integer|nullable|gt:0',
            'min_booking_time' => 'integer|nullable|gt:0',
            'buffer_before' => 'integer|in:' . implode(',', BookingType::$buffers),
            'buffer_after' => 'integer|in:' . implode(',', BookingType::$buffers),
            'notification_type' => 'string|in:' . implode(',', BookingType::$notificationTypes),
            'is_cancellation_allowed' => 'boolean',
            'cancellation_policy_text' => 'string|nullable',
            'is_invitee_reminder_enabled' => 'boolean',
            'is_invitee_sms_reminder_enabled' => 'boolean',
            'is_invitee_email_follow_up_enabled' => 'boolean',
            'payment_type' => 'string',
            'hourly_rate_value' => 'integer',
            'hourly_rate_currency_code' => 'string|nullable',
            'is_discount_enabled' => 'boolean',
            'discount_value' => 'between:0,99.99',
            'discount_has_expiration' => 'boolean',
            'discount_expiration_date' => 'date|nullable',
            'is_portfolio_enabled' => 'boolean',
            'is_file_upload_enabled' => 'boolean',
            'confirmation_action_type' => 'string',
            'schedule_another_event_button_text' => 'string|nullable',
            'is_schedule_another_event_button_shown' => 'boolean',
            'external_website_redirect_url' => 'string|nullable',
            'pass_event_details_to_redirected_url' => 'boolean',
            
            'locations' => [
                'array',
                
                function ($data, $extraRules) {
                    return validate($data, [
                        '*' => [
                            'array',
                            
                            function ($data, $extraRules) {
                                return BookingTypeLocation::validate($data, $extraRules);
                            },
                        ],
                    ], $extraRules);
                },
            ],
            
            'availability_rules' => [
                'array',
                
                function ($data, $extraRules) {
                    return validate($data, [
                        '*' => [
                            'array',
                            
                            function ($data, $extraRules) {
                                return BookingTypeAvailabilityRule::validate($data, $extraRules);
                            },
                        ],
                    ], $extraRules);
                },
            ],
            
            'questions' => [
                'array',
                
                function ($data, $extraRules) {
                    return validate($data, [
                        '*' => [
                            'array',
                            
                            function ($data, $extraRules) {
                                return BookingTypeQuestion::validate($data, $extraRules);
                            },
                        ],
                    ], $extraRules);
                },
            ],
            
            'coupons' => [
                'array',
                
                function ($data, $extraRules) {
                    return validate($data, [
                        '*' => [
                            'array',
                            
                            function ($data, $extraRules) {
                                return BookingTypeCoupon::validate($data, $extraRules);
                            },
                        ],
                    ], $extraRules);
                },
            ],

            'portfolios' => [
                'array',
                
                function ($data, $extraRules) {
                    return validate($data, [
                        '*' => [
                            'array',
                            
                            function ($data, $extraRules) {
                                return BookingTypePortfolio::validate($data, $extraRules);
                            },
                        ],
                    ], $extraRules);
                },
            ],
            
            'uploads' => [
                'array',
                
                function ($data, $extraRules) {
                    return validate($data, [
                        '*' => [
                            'array',
                            
                            function ($data, $extraRules) {
                                return BookingTypeUpload::validate($data, $extraRules);
                            },
                        ],
                    ], $extraRules);
                },
            ],
            
            'appearances' => [
                'array',
                
                function ($data, $extraRules) {
                    return validate($data, [
                        '*' => [
                            'array',
                            
                            function ($data, $extraRules) {
                                return BookingTypeAppearance::validate($data, $extraRules);
                            },
                        ],
                    ], $extraRules);
                },
            ],
            
            'links' => [
                'array',
                
                function ($data, $extraRules) {
                    return validate($data, [
                        '*' => [
                            'array',
                            
                            function ($data, $extraRules) {
                                return BookingTypeCustomLink::validate($data, $extraRules);
                            },
                        ],
                    ], $extraRules);
                },
            ],
            
        ], $extraRules, __('validation.custom.booking_type'));
    }
}
