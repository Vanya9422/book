<?php

namespace App\Models\BookingType;

use Illuminate\Database\Eloquent\Model;

class BookingTypeAvailabilityRule extends Model
{
    const TYPE_WEEK_DAY = 'WEEK_DAY';
    const TYPE_DATE = 'DATE';
    
    public static $types = [
        self::TYPE_WEEK_DAY,
        self::TYPE_DATE,
    ];
    
    const WEEK_DAY_MONDAY = 'MONDAY';
    const WEEK_DAY_TUESDAY = 'TUESDAY';
    const WEEK_DAY_WEDNESDAY = 'WEDNESDAY';
    const WEEK_DAY_THURSDAY = 'THURSDAY';
    const WEEK_DAY_FRIDAY = 'FRIDAY';
    const WEEK_DAY_SATURDAY = 'SATURDAY';
    const WEEK_DAY_SUNDAY = 'SUNDAY';
    
    public static $weekDays = [
        self::WEEK_DAY_MONDAY,
        self::WEEK_DAY_TUESDAY,
        self::WEEK_DAY_WEDNESDAY,
        self::WEEK_DAY_THURSDAY,
        self::WEEK_DAY_FRIDAY,
        self::WEEK_DAY_SATURDAY,
        self::WEEK_DAY_SUNDAY,
    ];
    
    // ---------------------------------------------------------------------- //
    
    public $attributes = [
        'intervals' => '[]',
    ];
    
    public $fillable = [
        'type',
        'week_day',
        'date',
        'intervals',
    ];
    
    public $casts = [
        'intervals' => 'array',
        'date' => 'date',
    ];
    
    // ---------------------------------------------------------------------- //
    
    public static function validate($data, $extraRules = [])
    {
        return validate($data, [
            'id' => 'integer|nullable',
            'type' => 'required|string|in:' . implode(',', BookingTypeAvailabilityRule::$types),
            
            'week_day' => [
                'required_if:type,' . BookingTypeAvailabilityRule::TYPE_WEEK_DAY,
                'string|nullable|in:' . implode(',', BookingTypeAvailabilityRule::$weekDays),
            ],
            
            'date' => [
                'required_if:type,' . BookingTypeAvailabilityRule::TYPE_DATE,
                'date|nullable',
            ],
            
            'intervals' => [
                'present|array',
                
                function ($data, $extraRules) {
                    return validate($data, [
                        '*' => [
                            'required|array',
                            
                            function ($data, $extraRules) {
                                return validate($data, [
                                    'from' => 'required|date_format:H:i',
                                    'to' => 'required|date_format:H:i',
                                ], $extraRules);
                            },
                        ],
                    ], $extraRules);
                },
            ],
        ], $extraRules);
    }
}
