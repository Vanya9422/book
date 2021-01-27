<?php

namespace App\Models\BookingType;

use Illuminate\Database\Eloquent\Model;

class BookingTypeLocation extends Model
{
    const TYPE_IN_PERSON_MEETING = 'IN_PERSON_MEETING';
    const TYPE_PHONE_CALL = 'PHONE_CALL';
    const TYPE_CUSTOM = 'CUSTOM';
    const TYPE_ASK_INVITEE = 'ASK_INVITEE';
    
    public static $types = [
        self::TYPE_IN_PERSON_MEETING,
        self::TYPE_PHONE_CALL,
        self::TYPE_CUSTOM,
        self::TYPE_ASK_INVITEE,
    ];
    
    const CALL_TYPE_OUTBOUND = 'OUTBOUND';
    const CALL_TYPE_INBOUND = 'INBOUND';
    
    public static $callTypes = [
        self::CALL_TYPE_OUTBOUND,
        self::CALL_TYPE_INBOUND,
    ];
    
    // ---------------------------------------------------------------------- //
    
    public $attributes = [
        'call_type' => self::CALL_TYPE_OUTBOUND,
    ];
    
    public $fillable = [
        'type',
        'basic_information',
        'additional_information',
        'call_type',
        'is_hidden',
    ];
    
    public $casts = [
        'is_hidden' => 'boolean',
    ];
    
    public static function validate($data, $extraRules = [])
    {
        return validate($data, [
            'id' => 'integer|nullable',
            'type' => 'required|string|in:' . implode(',', BookingTypeLocation::$types),
            'basic_information' => 'string|nullable',
            'additional_information' => 'string|nullable',
            'call_type' => 'string|in:' . implode(',', BookingTypeLocation::$callTypes),
            'is_hidden' => 'boolean',
        ], $extraRules);
    }
}
