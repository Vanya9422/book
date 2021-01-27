<?php

namespace App\Models\BookingType;

use Illuminate\Database\Eloquent\Model;

class BookingTypePortfolio extends Model
{
    public $fillable = [
        'booking_type_id',
        'name',
        'position',
        'is_enabled',
    ];
    
    public static function validate($data, $extraRules = [])
    {
        return validate($data, [
            'id' => 'integer|nullable',
            'name' => 'required|string',
            'position' => 'nullable|integer',
            'is_enabled' => 'boolean',
        ], $extraRules);
    }
    
    public function photos()
    {
        return $this->hasMany(BookingTypePortfolioPhoto::class)->orderBy('position', 'asc');
    }
}
