<?php

namespace App\Models\BookingType;

use Illuminate\Database\Eloquent\Model;

class BookingTypeCustomLink extends Model
{
    public $fillable = [
        'booking_type_id',
        'title',
        'url',
        'is_enabled',
    ];
    
    public static function validate($data, $extraRules = [])
    {
        return validate($data, [
            'id' => 'integer|nullable',
            'booking_type_id' => 'integer',
            'title' => 'string|required',
            'url' => 'string|required',
            'is_enabled' => 'boolean',
        ], $extraRules);
    }
    
}
