<?php

namespace App\Models\BookingType;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class BookingTypeAppearance extends Model implements HasMedia
{
    use  HasMediaTrait;
    
    const PAGE_PROCEDURAL = 'PROCEDURAL';
    const PAGE_FULL_PAGE = 'FULL_PAGE';
    
    public static $pageTypes = [
        self::PAGE_PROCEDURAL,
        self::PAGE_FULL_PAGE,
    ];
    
    public $fillable = [
        'booking_type_id',
        'is_main_photo_enabled',
        'page_type',
        'page_title',
        'page_header',
        'body_text',
        'footer_text',
        'main_button_text',
        'main_button_color',
        'main_button_text_color',
        'main_text_color',
        'main_font',
    ];
    
	public $appends = [
		'photo',
	];
	
    public static function validate($data, $extraRules = [])
    {
        return validate($data, [
            'id' => 'integer|nullable',
            'booking_type_id' => 'integer',
            'is_main_photo_enabled' => 'boolean',
            'page_type' => 'required|string|in:' . implode(',', BookingTypeAppearance::$pageTypes),
            'page_title' => 'string|required',
            'page_header' => 'string|required',
            'body_text' => 'string|required',
            'footer_text' => 'string|required',
            'main_button_text' => 'string|required',
            'main_button_color' => 'string|required',
            'main_button_text_color' => 'string|required',
            'main_text_color' => 'string|required',
            'main_font' => 'string|required',
            'image' => 'nullable',
        ], $extraRules);
    }
    
	public function registerMediaConversions(Media $media = null)
	{
		$conversion = $this->addMediaConversion('thumbnail');
		$conversion->fit('contain', 200, 200);
		$conversion->nonQueued();
		$conversion->performOnCollections('page_photo');
	}
	
	public function getPhotoAttribute()
	{
		$media = $this->getFirstMedia('page_photo');
		
		return [
			'id' => $media ? $media->id : null,
			'url' => $media ? $media->getFullUrl() : asset('img/avatar.png'),
		];
	}
	
}
