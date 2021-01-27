<?php

namespace App\Models\BookingType;

use Illuminate\Database\Eloquent\Model;

class BookingTypeUpload extends Model
{
    public $fillable = [
        'booking_type_id',
        'upload_box_text',
        'upload_box_description',
        'title',
        'description',
        'is_enabled',
        'is_required',
        'position',
    ];
    
    public static function validate($data, $extraRules = [])
    {
        return validate($data, [
            'id' => 'integer|nullable',
            'booking_type_id' => 'integer',
            'upload_box_text' => 'string|required',
            'upload_box_description' => 'string|required',
            'title' => 'string|required',
            'description' => 'string|required',
            'is_enabled' => 'boolean',
            'is_required' => 'boolean',
            'position' => 'nullable|integer',
        ], $extraRules);
    }
    
}
