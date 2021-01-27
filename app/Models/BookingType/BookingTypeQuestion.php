<?php

namespace App\Models\BookingType;

use Illuminate\Database\Eloquent\Model;

class BookingTypeQuestion extends Model
{
    const ANSWER_TYPE_ONE_LINE = 'ONE_LINE';
    const ANSWER_TYPE_MULTIPLE_LINES = 'MULTIPLE_LINES';
    const ANSWER_TYPE_RADIO_BUTTONS = 'RADIO_BUTTONS';
    const ANSWER_TYPE_CHECKBOXES = 'CHECKBOXES';
    const ANSWER_TYPE_PHONE_NUMBER = 'PHONE_NUMBER';
    
    public static $answerTypes = [
        self::ANSWER_TYPE_ONE_LINE,
        self::ANSWER_TYPE_MULTIPLE_LINES,
        self::ANSWER_TYPE_RADIO_BUTTONS,
        self::ANSWER_TYPE_CHECKBOXES,
        self::ANSWER_TYPE_PHONE_NUMBER,
    ];
    
    public $fillable = [
        'booking_type_id',
        'title',
        'answer_type',
        'answer_options',
        'other_option_allowed',
        'position',
        'is_required',
        'is_enabled',
    ];
    
    public $casts = [
        'answer_options' => 'array',
        'position' => 'float',
    ];
    
    public static function validate($data, $extraRules = [])
    {
        return validate($data, [
            'id' => 'integer|nullable',
            'title' => 'required|string',
            'answer_type' => 'required|string|in:' . implode(',', BookingTypeQuestion::$answerTypes),
            'answer_options' => 'array|nullable',
            'other_option_allowed' => 'nullable',
            'position' => 'required|integer',
            'is_required' => 'nullable',
            'is_enabled' => 'nullable',
        ], $extraRules);
    }
}
