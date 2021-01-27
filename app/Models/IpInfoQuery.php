<?php

namespace App\Models;

use App\Models\Geo\Locality;
use Exception;
use Illuminate\Database\Eloquent\Model;

class IpInfoQuery extends Model
{
    public function locality()
    {
        return $this->belongsTo(Locality::class);
    }
    
    // ---------------------------------------------------------------------- //
    
    public static function getOrMake($ip = null)
    {
        if (!env('GOOGLE_MAPS_API_KEY')) {
            throw new Exception('Google Maps API key is not set');
        }
        
        $ip = $ip ?: request()->server('HTTP_CF_CONNECTING_IP') ?: request()->server('REMOTE_ADDR');
        $ipInfoQuery = IpInfoQuery::with('locality')->where('ip', $ip)->first();
        
        if ($ipInfoQuery) {
            return $ipInfoQuery;
        }
        
        $ipInfo = self::getIpInfo($ip);
        $googlePlace = $ipInfo ? self::getGooglePlaceFromIpInfo($ipInfo) : null;
        $locality = $googlePlace ? Locality::getOrMakeByKey($googlePlace->id) : null;
        
        $ipInfoQuery = new IpInfoQuery;
        $ipInfoQuery->ip = $ip;
        $ipInfoQuery->country_code = $ipInfo->countryCode ?? null;
        $ipInfoQuery->region_name = $ipInfo->regionName ?? null;
        $ipInfoQuery->city_name = $ipInfo->cityName ?? null;
        $ipInfoQuery->latitude = $ipInfo->latitude ?? null;
        $ipInfoQuery->longitude = $ipInfo->longitude ?? null;
        $ipInfoQuery->postal_code = $ipInfo->postalCode ?? null;
        $ipInfoQuery->timezone = $ipInfo->timezone ?? null;
        $ipInfoQuery->locality_key = $locality->key ?? null;
        $ipInfoQuery->save();
        
        return $ipInfoQuery;
    }
    
    public static function getIpInfo($ip)
    {
        $client = new \GuzzleHttp\Client;
        
        $response = $client->get('http://ip-api.com/json/' . $ip, [
            'query' => [
                'fields' => 16510975,
                'lang' => app()->getLocale(),
            ],
            
            'timeout' => 0.500,
        ]);
        
        $body = json_decode($response->getBody());
        
        if (empty($body->status) || $body->status !== 'success') {
            return null;
        }
        
        return (object) [
            'ip' => $ip,
            'countryCode' => $body->countryCode ?? null,
            'regionName' => $body->regionName ?? null,
            'cityName' => $body->city ?? null,
            'latitude' => $body->lat ?? null,
            'longitude' => $body->lon ?? null,
            'postalCode' => $body->zip ?? null,
            'timezone' => $body->timezone ?? null,
        ];
    }
    
    public static function getGooglePlaceFromIpInfo($ipInfo, $resultTypes = [], $locale = null)
    {
        if (!$ipInfo || empty($ipInfo->latitude) || empty($ipInfo->longitude)) {
            return null;
        }
        
        if (!env('GOOGLE_MAPS_API_KEY')) {
            throw new Exception('Google Maps API key is not set');
        }
        
        $locale = $locale ?? app()->getLocale();
        $client = new \GuzzleHttp\Client;
        
        $response = $client->get('https://maps.googleapis.com/maps/api/geocode/json', [
            'query' => [
                'latlng' => $ipInfo->latitude . ',' . $ipInfo->longitude,
                'key' => env('GOOGLE_MAPS_API_KEY'),
                'language' => $locale,
                'result_type' => 'locality',
            ],
        ]);
        
        $body = json_decode($response->getBody());
        
        if ($body->status !== 'OK' || count($body->results) === 0) {
            return null;
        }
        
        return (object) [
            'id' => $body->results[0]->place_id,
            'address' => $body->results[0]->formatted_address,
        ];
    }
}
