<?php

namespace App\Models\BookingType;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class BookingTypePortfolioPhoto extends Model implements HasMedia
{
    use  HasMediaTrait;
    
    public $fillable = [
        'booking_type_portfolio_id',
        'title',
        'description',
        'position',
        'is_enabled',
    ];
    
    public $appends = [
        'photo',
    ];
    
    
    public static function validate($data, $extraRules = [])
    {
        return validate($data, [
            'id' => 'integer|nullable',
            'booking_type_portfolio_id' => 'integer|nullable',
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'position' => 'required|integer',
            'is_enabled' => 'nullable',
        ], $extraRules);
    }
    
    
    public function registerMediaConversions(Media $media = null)
    {
        $conversion = $this->addMediaConversion('thumbnail');
        $conversion->fit('contain', 200, 200);
        $conversion->nonQueued();
        $conversion->performOnCollections('avatars');
    }
    
    
    public function getPhotoAttribute()
    {
        $media = $this->getFirstMedia('photos');
        
        return [
            'id' => $media ? $media->id : null,
            'url' => $media ? $media->getFullUrl() : asset('img/avatar.png'),
        ];
    }
}
