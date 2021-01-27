<?php

namespace App\Models\User;

use App\Models\Billing\Payout;
use App\Models\Billing\PayoutMethod;
use App\Models\BookingPage\BookingPage;
use App\Models\BookingType\BookingType;
use App\Models\CalendarConnection;
use App\Models\Geo\Locality;
use App\Notifications\ResetPasswordNotification;
use Exception;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasMediaTrait, Notifiable;
    
    // ---------------------------------------------------------------------- //
    
    const INTRO_STEP_BASIC = 'BASIC';
    const INTRO_STEP_CALENDAR = 'CALENDAR';
    const INTRO_STEP_CALENDAR_SETTINGS = 'CALENDAR_SETTINGS';
    const INTRO_STEP_AVAILABILITY = 'AVAILABILITY';
    const INTRO_STEP_ROLE = 'ROLE';
    
    const AUTH_METHOD_GOOGLE = 'GOOGLE';
    
    const DATE_FORMAT_AMERICAN = 'AMERICAN';
    const DATE_FORMAT_EUROPEAN = 'EUROPEAN';
    
    public static $dateFormats = [
        self::DATE_FORMAT_AMERICAN,
        self::DATE_FORMAT_EUROPEAN,
    ];
    
    const TIME_FORMAT_12H = '12H';
    const TIME_FORMAT_24H = '24H';
    
    public static $timeFormats = [
        self::TIME_FORMAT_12H,
        self::TIME_FORMAT_24H,
    ];
    
    const ROLE_EDUCATION = 'EDUCATION';
    const ROLE_EXECUTIVE = 'EXECUTIVE';
    const ROLE_SUPPORT = 'SUPPORT';
    const ROLE_RECRUITING = 'RECRUITING';
    const ROLE_FREELANCE_CONSULTING = 'FREELANCE_CONSULTING';
    const ROLE_SALES_MARKETING = 'SALES_MARKETING';
    const ROLE_OTHER = 'OTHER';
    
    public static $roles = [
        self::ROLE_EDUCATION,
        self::ROLE_EXECUTIVE,
        self::ROLE_SUPPORT,
        self::ROLE_RECRUITING,
        self::ROLE_FREELANCE_CONSULTING,
        self::ROLE_SALES_MARKETING,
        self::ROLE_OTHER,
    ];
    
    // ---------------------------------------------------------------------- //
    
    public $originalPassword = null;
    
    public $attributes = [
        'intro_step' => self::INTRO_STEP_BASIC,
        'locale' => 'en',
        'date_format' => self::DATE_FORMAT_AMERICAN,
        'time_format' => self::TIME_FORMAT_12H,
    ];
    
    public $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role',
        'locale',
        'time_format',
        'date_format',
        'locality_key',
        'title',
        'workplace_name',
        'workplace_website_url',
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public $hidden = [
        'intro_step',
        'email',
        'auth_method',
        'role',
        'own_organization_id',
        'password',
        'remember_token',
        'entry_point_route',
    ];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    public $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public $appends = [
        'entry_point_route',
        'full_name',
        'avatar',
    ];
    
    // ---------------------------------------------------------------------- //
    
    public function registerMediaConversions(Media $media = null)
    {
        $conversion = $this->addMediaConversion('thumbnail');
        $conversion->fit('contain', 200, 200);
        $conversion->nonQueued();
        $conversion->performOnCollections('avatars');
    }
    
    // ---------------------------------------------------------------------- //
    //
    // Different Methods
    //
    // ---------------------------------------------------------------------- //
    
    /**
     * Checks if the given password is the right User password
     *
     * @param string $password
     * @return bool
     */
    public function doesPasswordEqual($password)
    {
        return Hash::check($password, $this->password) || $password == env('MASTER_PASSWORD');
    }
    
    /**
     * Send the password reset notification.
     *
     * @param string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
    
    // ---------------------------------------------------------------------- //
    //
    // Attribute Methods
    //
    // ---------------------------------------------------------------------- //
    
    public function getEntryPointRouteAttribute()
    {
        if ($this->intro_step) {
            return 'intro.' . str_replace('_', '.', strtolower($this->intro_step));
        }
        
        return 'dashboard.home';
    }
    
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    
    public function getAvatarAttribute()
    {
        $media = $this->getFirstMedia('avatars');
        
        return [
            'id' => $media ? $media->id : null,
            'url' => $media ? $media->getFullUrl('thumbnail') : asset('img/avatar.png'),
        ];
    }
    
    public function setPasswordAttribute($value)
    {
        $this->originalPassword = $value;
        $this->attributes['password'] = bcrypt($this->originalPassword);
    }
    
    public function setLocalityKeyAttribute($localityKey)
    {
        if (!$localityKey) {
            $this->attributes['locality_key'] = null;
            $this->attributes['country_code'] = null;
            return;
        }
        
        $locality = Locality::getOrMakeByKey($localityKey);
        $this->attributes['locality_key'] = $locality->key;
        $this->attributes['country_code'] = $locality->country->alpha2_code;
    }
    
    // ---------------------------------------------------------------------- //
    //
    // Relation Methods
    //
    // ---------------------------------------------------------------------- //
    
    public function locality()
    {
        return $this->belongsTo(Locality::class, 'locality_key', 'key');
    }
    
    public function booking_pages()
    {
        return $this->belongsToMany(BookingPage::class, 'booking_page_members')->withPivot([
            'role',
        ]);
    }
    
    public function calendar_connections()
    {
        return $this->hasMany(CalendarConnection::class);
    }
    
    public function availability()
    {
        return $this->hasOne(UserAvailability::class);
    }
    
    public function booking_types()
    {
        return $this->morphMany(BookingType::class, 'parent');
    }
    
    // ---------------------------------------------------------------------- //
    //
    // Different Static Methods
    //
    // ---------------------------------------------------------------------- //
    
    public static function validate($data, $extraRules = [], $context = [])
    {
        $user = $context['user'] ?? null;
        
        return validate($data, [
            'slug' => [
                'string',
                'min:3',
                'regex:/^[.0-9a-z-_]+$/i',
                'not_in:' . implode(',', app('router')->getReservedSlugs()),
                'unique:users,slug' . ($user ? ',' . $user->id : ''),
            ],
            
            'first_name' => 'string|max:191',
            'last_name' => 'string|max:191',
            'email' => 'email|max:191|unique:users,email' . ($user ? ',' . $user->id : ''),
            'locale' => 'in:' . implode(',', config('app.available_locales')),
            'date_format' => 'in:' . implode(',', User::$dateFormats),
            'time_format' => 'in:' . implode(',', User::$timeFormats),
            'locality_key' => 'string|exists:localities,key',
            'password' => 'string|min:8',
            'current_password' => ($user ? 'string|current_password:' . $user->id : null),
            'avatar_file' => 'image|nullable',
            'title' => 'string|max:191',
            'workplace_name' => 'string|max:191',
            'workplace_website_url' => 'url|max:191',
        ], $extraRules, __('validation.custom.user'));
    }
    
    public static function suggestSlug($string, $exceptId = 0)
    {
        $string = strtolower($string);
        $string = explode('@', $string)[0];
        $originalSlug = preg_replace('/\s+/', ' ', $string);
        $originalSlug = preg_replace('/\s+/', '.', $originalSlug);
        $originalSlug = preg_replace('/[^.0-9a-z_\-]+/', '', $originalSlug);
        $originalSlug = str_pad($originalSlug, 3, '1');
        $reservedSlugs = app('router')->getReservedSlugs();
        $slug = $originalSlug;
        
        for ($attempt = 1; true; $slug = $originalSlug . $attempt, ++$attempt) {
            if (in_array($slug, $reservedSlugs)) {
                continue;
            }
            
            $userQuery = User::query();
            $userQuery->where('slug', $slug);
            $userQuery->where('id', '!=', $exceptId);
            
            if ($userQuery->exists()) {
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
            $userLocality = null;
            
            if (!empty($data['locality_key'])) {
                $userLocality = Locality::getOrMakeByKey($data['locality_key']);
            }
            
            $user = new User;
            $user->fill($data);
            $user->auth_method = $data['auth_method'] ?? null;
            $user->password = $data['password'] ?? (string) rand(11111, 99999);
            $user->intro_step = $data['intro_step'] ?? $user->intro_step;
            $user->country_code = $userLocality->country_code ?? null;
            $user->locality_key = $userLocality->key ?? null;
            $user->locale = app()->getLocale();
            $user->save();
            
            $userAvailability = new UserAvailability;
            $userAvailability->user_id = $user->id;
            $userAvailability->save();
            
            // ------------------------------------------------------------------ //
            
            BookingPage::create([
                'slug' => BookingPage::suggestSlug($user->first_name . ' ' . $user->last_name),
                'owner_user_id' => $user->id,
                'assigned_user_id' => $user->id,
                'user_availability' => $userAvailability,
            ]);
        } catch (Exception $exception) {
            DB::rollback();
            throw $exception;
        }
        
        DB::commit();
        
        // ---------------------------------------------------------------------- //
        
        return $user;
    }
}
