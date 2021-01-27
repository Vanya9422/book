<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Geo\Country;
use App\Models\Geo\Locality;
use App\Models\GoogleAutocompleteQuery;
use App\Models\IpInfoQuery;
use Illuminate\Http\Request;

class LocalityController extends Controller
{
    public function get(Request $request, $localityKey)
    {
        $locality = Locality::getOrMakeByKey($localityKey);
        
        return response()->resource($locality);
    }
    
    public function detect(Request $request)
    {
        $ipInfo = IpInfoQuery::getOrMake();
        $locality = Locality::getOrMakeByKey($ipInfo->locality_key);
        
        return response()->resource($locality);
    }
    
    public function autocomplete(Request $request)
    {
        $input = $request->validate([
            'query' => 'present|nullable|string',
            'country_code' => 'nullable|string|exists:countries,alpha2_code',
            'with_country' => 'boolean',
        ]);
        
        if (!$input['query']) {
            return response()->resource([]);
        }
        
        $country = Country::where('alpha2_code', $input['country_code'] ?? null)->first();
        
        $googleAutocompleteQuery = GoogleAutocompleteQuery::getOrMake([
            'input' => $input['query'],
            'types' => '(cities)',
            'components' => ($country ? 'country:' . $country->alpha2_code : null),
            'language' => app()->getLocale(),
        ]);
        
        $localityPredictions = array_values(array_filter($googleAutocompleteQuery->predictions, function ($prediction) {
            return $prediction['type'] === 'locality';
        }));
        
        $countryShortNames = array_values(array_unique(array_map(function ($prediction) {
            $fullAddressParts = explode(',', $prediction['full_address']);
            
            return trim($fullAddressParts[count($fullAddressParts) - 1]);
        }, $localityPredictions)));
        
        $countryQuery = Country::query();
        
        if (app()->getLocale() === 'en') {
            $countryQuery->selectRaw('countries.*, countries.short_name AS short_name');
            $countryQuery->whereIn('countries.short_name', $countryShortNames);
        } else {
            $countryQuery->selectRaw('countries.*, country_translations.short_name AS short_name');
            $countryQuery->join('country_translations', 'countries.alpha2_code', '=', 'country_translations.country_code');
            $countryQuery->where('country_translations.locale', app()->getLocale());
            $countryQuery->whereIn('country_translations.short_name', $countryShortNames);
        }
        
        $countries = $countryQuery->get();
        
        $localities = array_map(function ($prediction) use ($countries, $request) {
            $fullAddressParts = explode(',', $prediction['full_address']);
            $predictionCountryShortName = trim($fullAddressParts[count($fullAddressParts) - 1]);
            
            if ($country = $countries->where('short_name', $predictionCountryShortName)->first()) {
                $prediction['country_code'] = $country->alpha2_code;
                
                if (!empty($input['with_country'])) {
                    $prediction['country'] = $country;
                }
            } else {
                if (!$locality = Locality::getOrMakeByKey($prediction['place_id'])) {
                    return null;
                }
                
                $prediction['country_code'] = $locality->country_code;
                
                if (!empty($input['with_country'])) {
                    $locality->load('country');
                    $prediction['country'] = $locality->country;
                }
            }
            
            $prediction['key'] = $prediction['place_id'];
            unset($prediction['place_id']);
            
            return $prediction;
        }, $localityPredictions);
        
        $localities = array_values(array_filter($localities, function ($locality) {
            return $locality;
        }));
        
        return response()->resource($localities);
    }
}
