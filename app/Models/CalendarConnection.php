<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalendarConnection extends Model
{
    const TYPE_GOOGLE = 'GOOGLE';
    const TYPE_OUTLOOK = 'OUTLOOK';
    
    public static $types = [
        self::TYPE_GOOGLE,
        self::TYPE_OUTLOOK,
    ];
    
    // ---------------------------------------------------------------------- //
    
    public $cachedCalendars = null;
    
    public $fillable = [
        'source_calendar_ids',
        'destination_calendar_id',
    ];
    
    public $hidden = [
        'access_token',
    ];
    
    public $casts = [
        'access_token' => 'array',
        'source_calendar_ids' => 'array',
    ];
    
    public $appends = [
        'calendars',
    ];
    
    // ---------------------------------------------------------------------- //
    
    public function getCalendarsAttribute()
    {
        if ($this->cachedCalendars) {
            return $this->cachedCalendars;
        }
        
        $googleClient = google_client('calendar');
        $googleClient->setAccessToken($this->access_token);
        $googleServiceCalendar = new \Google_Service_Calendar($googleClient);
        $calendarList = $googleServiceCalendar->calendarList->listCalendarList();
        
        $this->cachedCalendars = collect($calendarList->items)->whereIn('accessRole', [
            'owner',
            'writer',
        ])->values()->map(function ($calendarItem) {
            return [
                'id' => $calendarItem->id,
                'name' => $calendarItem->summary,
            ];
        });
        
        return $this->cachedCalendars;
    }
    
    // ---------------------------------------------------------------------- //
    
    public static function validate($data, $extraRules = [])
    {
        return validate($data, [
            'source_calendar_ids' => 'array',
            'source_calendar_ids.*' => 'string',
            'destination_calendar_id' => 'nullable|string',
        ], $extraRules, __('validation.custom.calendar_connection'));
    }
}
