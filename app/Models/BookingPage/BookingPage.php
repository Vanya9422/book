<?php

namespace App\Models\BookingPage;

use App\Models\BookingType\BookingType;
use App\Models\User\User;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class BookingPage extends Model implements HasMedia
{
    use HasMediaTrait;
    
    // ---------------------------------------------------------------------- //
    
    public $attributes = [
        'welcome_message' => 'Welcome to my scheduling page. Please follow the instructions to add a booking to my calendar.',
        'use_user_name_as_title' => true,
        'use_user_avatar_as_user_avatar' => true,
    ];
    
    public $fillable = [
        'slug',
        'title',
        'use_user_name_as_title',
        'use_user_avatar_as_user_avatar',
    ];
    
    public $casts = [
        'use_user_name_as_title' => 'boolean',
        'use_user_avatar_as_user_avatar' => 'boolean',
    ];
    
    public $hidden = [//
    ];
    
    public $appends = [
        'computed_title',
        'user_avatar',
        'computed_user_avatar',
        'logo',
    ];
    
    // ---------------------------------------------------------------------- //
    
    public function registerMediaConversions(Media $media = null)
    {
        $conversion = $this->addMediaConversion('thumbnail');
        $conversion->fit('contain', 200, 200);
        $conversion->nonQueued();
        $conversion->performOnCollections('user_avatars');
        
        $conversion = $this->addMediaConversion('thumbnail');
        $conversion->fit('max', 450, 450);
        $conversion->nonQueued();
        $conversion->performOnCollections('logos');
    }
    
    // ---------------------------------------------------------------------- //
    
    public function getComputedTitleAttribute()
    {
        return $this->use_user_name_as_title ? $this->assigned_user->full_name : $this->title;
    }
    
    public function getUserAvatarAttribute()
    {
        $media = $this->getFirstMedia('user_avatars');
        
        return (object) [
            'id' => $media ? $media->id : null,
            'url' => $media ? $media->getFullUrl('thumbnail') : asset('img/avatar.png'),
        ];
    }
    
    public function getComputedUserAvatarAttribute()
    {
        return $this->use_user_avatar_as_user_avatar ? $this->assigned_user->avatar : $this->user_avatar;
    }
    
    public function getLogoAttribute()
    {
        $media = $this->getFirstMedia('logos');
        
        return (object) [
            'id' => $media ? $media->id : null,
            'url' => $media ? $media->getFullUrl('thumbnail') : null,
        ];
    }
    
    // ---------------------------------------------------------------------- //
    
    
    public function assigned_user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function parent_booking_page()
    {
        return $this->belongsTo(BookingPage::class);
    }
    
    public function child_booking_pages()
    {
        return $this->hasMany(BookingType::class, 'parent_booking_page_id');
    }
    
    public function booking_types()
    {
        return $this->hasMany(BookingType::class);
    }
    
    // ---------------------------------------------------------------------- //
    
    public static function suggestSlug($string, $exceptId = 0)
    {
        $string = strtolower($string);
        $string = explode('@', $string)[0];
        $originalSlug = preg_replace('/\s+/i', '.', trim($string));
        $originalSlug = preg_replace('/[^.0-9a-z_-]+/i', '', $originalSlug);
        $originalSlug = str_pad($originalSlug, 3, '1');
        $reservedSlugs = app('router')->getReservedSlugs();
        $slug = $originalSlug;
        
        for ($attempt = 1; true; $slug = $originalSlug . '-' . $attempt, ++$attempt) {
            if (in_array($slug, $reservedSlugs)) {
                continue;
            }
            
            $bookingPageQuery = BookingPage::query();
            $bookingPageQuery->where('slug', $slug);
            $bookingPageQuery->where('id', '!=', $exceptId);
            
            if ($bookingPageQuery->exists()) {
                continue;
            }
            
            break;
        }
        
        return $slug;
    }
    
    public static function create(array $data)
    {
        DB::beginTransaction();
        
        try {
            $bookingPage = new BookingPage;
            $bookingPage->owner_user_id = $data['owner_user_id'];
            $bookingPage->assigned_user_id = $data['assigned_user_id'];
            $bookingPage->fill($data);
            $bookingPage->save();
            
            $bookingPageMember = new BookingPageMember;
            $bookingPageMember->booking_page_id = $bookingPage->id;
            $bookingPageMember->user_id = $data['owner_user_id'];
            $bookingPageMember->role = BookingPageMember::ROLE_OWNER;
            $bookingPageMember->save();
            
            if (empty($data['event_types'])) {
                $inputBookingTypes = [
                    ['durations' => [15], 'color' => 'dfc12d'],
                    ['durations' => [30], 'color' => '8989fc'],
                    ['durations' => [60], 'color' => 'ee5353'],
                ];
                
                foreach ($inputBookingTypes as $inputBookingType) {
                    $bookingType = new BookingType;
                    $bookingType->booking_page_id = $bookingPage->id;
                    $bookingType->type = BookingType::TYPE_SOLO;
                    $bookingType->slug = $inputBookingType['duration'] . 'min';
                    $bookingType->name = $inputBookingType['duration'] . ' Minute Meeting';
                    $bookingType->locale = $data['locale'] ?? app()->getLocale();
                    $bookingType->spot_step = $inputBookingType['duration'];
                    $bookingType->fill($inputBookingType);
                    $bookingType->save();
                    $bookingType->setRelation('locations', collect());
                    $bookingType->setRelation('availability_rules', collect());
                    $bookingType->setRulesFromUserAvailability($data['user_availability']);
                }
            }
        } catch (Exception $exception) {
            DB::rollback();
            throw $exception;
        }
        
        DB::commit();
        
        return $bookingPage;
    }
    
    public static function validate($data, $extraRules = [], $context = [])
    {
        $parentBookingPage = $context['parent_booking_page'] ?? null;
        $bookingPage = $context['booking_page'] ?? null;
        
        return validate($data, [
            'slug' => [
                'string',
                'min:3',
                'regex:/^[.0-9a-z-_]+$/i',
                'not_in:' . implode(',', app('router')->getReservedSlugs()),
                
                Rule::unique('booking_pages', 'slug')->where(function ($where) use ($parentBookingPage, $bookingPage) {
                    if ($parentBookingPage) {
                        $where->where('parent_booking_page_id', $parentBookingPage->id);
                    }
                    
                    if ($bookingPage) {
                        $where->where('id', '!=', $bookingPage->id);
                    }
                }),
            ],
            
            'title' => 'string',
            'use_user_name_as_title' => 'boolean',
            'welcome_message' => 'string',
            'user_avatar_file' => 'image|nullable',
            'use_user_avatar_as_user_avatar' => 'boolean',
            'logo_file' => 'image|nullable',
        ], $extraRules, __('validation.custom.booking_page'));
    }
}
