<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Language
 *
 * @property int $id
 * @property string|null $code
 * @property string $name
 * @property string|null $native_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereNativeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Language extends Model
{
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];
    
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    }
    
    public function setNativeNameAttribute($value)
    {
        $this->attributes['native_name'] = mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    }
    
    public function getCurrentUrlWithIt()
    {
        $redirectUrl = request()->getPathInfo() . (request()->getQueryString() ? ('?' . request()->getQueryString()) : '');
        $redirectUrl = substr($redirectUrl, 3);
        
        return '/' . $this->code . $redirectUrl;
    }
    
    public static function available($exceptLocale = null)
    {
        $availableLocales = array_filter(config('app.available_locales'), function ($availableLocale) use ($exceptLocale) {
            return $availableLocale != $exceptLocale;
        });
        
        return Language::whereIn('code', $availableLocales)->orderBy('name');
    }
}
