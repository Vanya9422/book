<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserAvailability extends Model
{
    public $attributes = [
        'hour_from' => 9,
        'hour_to' => 21,
        'monday' => true,
        'tuesday' => true,
        'wednesday' => true,
        'thursday' => true,
        'friday' => true,
        'saturday' => false,
        'sunday' => false,
    ];
    
    public $fillable = [
        'hour_from',
        'hour_to',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday',
    ];
    
    public $hidden = [
        'id',
        'user_id',
        'created_at',
        'updated_at',
    ];
    
    public $casts = [
        'monday' => 'boolean',
        'tuesday' => 'boolean',
        'wednesday' => 'boolean',
        'thursday' => 'boolean',
        'friday' => 'boolean',
        'saturday' => 'boolean',
        'sunday' => 'boolean',
    ];
    
    // ---------------------------------------------------------------------- //
    
    public function setHourFromAttribute($value)
    {
        $this->attributes['hour_from'] = $value;
        
        if ($this->hour_from >= $this->hour_to) {
            if ($this->hour_from === 23) {
                $this->hour_to = 0;
            } else {
                $this->hour_to = ($this->hour_from + 1);
            }
        }
    }
    
    public function setHourToAttribute($value)
    {
        $this->attributes['hour_to'] = $value;
        
        if ($this->hour_to <= $this->hour_from) {
            if ($this->hour_to === 0) {
                $this->hour_from = 23;
            } else {
                $this->hour_from = ($this->hour_to - 1);
            }
        }
    }
    
    // ---------------------------------------------------------------------- //
    
    public static function validate($data, $extraRules = [])
    {
        return validate($data, [
            'hour_from' => 'integer|min:0|max:23',
            'hour_to' => 'integer|min:0|max:23',
            'monday' => 'boolean',
            'tuesday' => 'boolean',
            'wednesday' => 'boolean',
            'thursday' => 'boolean',
            'friday' => 'boolean',
            'saturday' => 'boolean',
            'sunday' => 'boolean',
        ], $extraRules, __('validation.custom.user_availability'));
    }
}
