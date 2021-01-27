<?php

namespace App\Models\BookingType;

use Illuminate\Database\Eloquent\Model;

class BookingTypeCoupon extends Model
{
    public $fillable = [
        'booking_type_id',
        'is_enable',
        'name',
        'code',
        'discount_value',
        'has_expiration',
        'expiration_date',
    ];
    
    public static function validate($data, $extraRules = [])
    {
        return validate($data, [
            'id' => 'integer|nullable',
            'is_enable' => 'required|boolean',
            'name' => 'required|string',
            'code' => 'required|string',
            'discount_value' => 'required|numeric|min:0.01',
            'has_expiration' => 'required|boolean',
            'expiration_date' => 'date|nullable',
        ], $extraRules);
    }
}
