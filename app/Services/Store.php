<?php

namespace App\Services;

use App\Models\Language;
use App\Models\User\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;

class Store
{
    public $meta;
    public $state;
    
    public function __construct()
    {
        $this->meta = [
            'title' => config('app.name', 'Laravel'),
            'description' => null,
            'canonical' => null,
        ];
        
        $this->state = [
            'auth' => auth()->toArray(),
            'languages' => null,
            'translations' => null,
            'detected_locality' => null,
            'ip' => request()->server('HTTP_CF_CONNECTING_IP') ?: request()->server('REMOTE_ADDR'),
            'locale' => app()->getLocale(),
            'booking_type' => null,
            'time_formats' => null,
            'date_formats' => null,
        ];
        
        $this->getLanguages();
        $this->getTranslations();
        $this->getTimeFormats();
        $this->getDateFormats();
    }
    
    /*
     * Get available languages
     */
    public function getLanguages()
    {
        $this->state['languages'] = Language::whereIn('code', config('app.available_locales'))->get()->sortBy(function ($language) {
            return array_search($language->code, config('app.available_locales'));
        })->values();
    }
    
    /*
     * Gets combined translations pack
     */
    public function getTranslations()
    {
        $locale = app()->getLocale();
        $data = [];
        $defaultPath = resource_path('lang/en');
        $extraPath = null;
        $excludedPaths = ['auth', 'passwords', 'pagination', 'validation'];
        
        if ($locale != 'en') {
            $extraPath = resource_path('lang/' . $locale);
        }
        
        foreach (\File::allFiles($defaultPath) as $file) {
            $relativePath = substr($file->getPath(), strlen($defaultPath));
            $relativePathParts = collect(preg_split('/[\/\\\]/', $relativePath))->slice(1)->toArray();
            $dataPlace = &$data;
            
            foreach ($relativePathParts as $relativePathPart) {
                $dataPlace[$relativePathPart] = $dataPlace[$relativePathPart] ?? [];
                $dataPlace = &$dataPlace[$relativePathPart];
            }
            
            $fileName = basename($file->getBasename(), '.php');
            
            if (in_array($fileName, $excludedPaths)) {
                continue;
            }
            
            $dataPlace[$fileName] = $dataPlace[$fileName] ?? [];
            $dataPlace = &$dataPlace[$fileName];
            $dataPlace = array_merge($dataPlace, include($file->getRealPath()));
            
            if (!$extraPath) {
                continue;
            }
            
            if (!File::exists($extraPath . '/' . $relativePath . '/' . $file->getBasename())) {
                continue;
            }
            
            $merge = function (&$a, $b) use (&$merge) {
                foreach ($b as $child => $value) {
                    if (isset($a[$child]) && is_array($a[$child]) && is_array($value)) {
                        $merge($a[$child], $value);
                        continue;
                    }
                    
                    $a[$child] = $value;
                }
            };
            
            $merge($dataPlace, include($extraPath . '/' . $relativePath . '/' . $file->getBasename()));
        }
        
        $this->state['translations'] = $data;
    }
    
    /*
     * Get time formats
     */
    public function getTimeFormats()
    {
        $this->state['time_formats'] = [
            User::TIME_FORMAT_12H => 'h:mm:ss a',
            User::TIME_FORMAT_24H => 'HH:mm:ss',
        ];
    }
    
    /*
     * Get date formats
     */
    public function getDateFormats()
    {
        $this->state['date_formats'] = [
            User::DATE_FORMAT_AMERICAN => '...',
            User::DATE_FORMAT_EUROPEAN => '...',
        ];
    }
    
    /*
     * Get BookingPage by ID
     */
    public function getBookingPageBySlug($bookingPageSlug)
    {
        try {
            $bookingPage = request()->api('booking_page', [
                'booking_page_id' => 'slug:' . $bookingPageSlug,
            ], [
                'include' => ['booking_types'],
            ]);
            
            $this->state['booking_page'] = $bookingPage;
        } catch (ModelNotFoundException $exception) {
            $this->state['booking_page'] = [
                'id' => 0,
                'slug' => $bookingPageSlug,
            ];
            
            throw $exception;
        }
    }
    
    /*
     * Get BookingPage BookingType by BookingPage ID and BookingType Slug
     */
    public function getBookingPageBookingType($params)
    {
        $bookingPageId = $params['booking_page_id'];
        $bookingTypeSlug = $params['booking_type_slug'];
        
        try {
            $bookingType = request()->api('booking_page.booking_type', [
                'booking_page_id' => $bookingPageId,
                'booking_type_id' => 'slug:' . $bookingTypeSlug,
            ]);
            
            $this->state['booking_type'] = $bookingType;
        } catch (ModelNotFoundException $exception) {
            $this->state['booking_type'] = [
                'id' => 0,
                'slug' => $bookingTypeSlug,
            ];
            
            throw $exception;
        }
    }
}
