<?php

namespace App\Models\Booking;

use App\Models\BookingType\BookingType;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function booking_type()
    {
        $this->belongsTo(BookingType::class);
    }
    
    public static function validate($data, $extraRules = [], $context = [])
    {
        return validate($data, [
            'start_time' => 'date',
        ], $extraRules, __('validation.custom.booking'));
    }
}
