<?php

use App\Models\Geo\Country;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    public function run()
    {
        try {
            $responseCountries = json_decode(File::get(storage_path('app/geo/countries.json')));
        } catch (FileNotFoundException $exception) {
            $client = new GuzzleHttp\Client;
            $response = $client->request('GET', 'https://restcountries.eu/rest/v2/');
            $responseCountries = json_decode($response->getBody()->getContents());
            File::put(storage_path('app/geo/countries.json'), json_encode($responseCountries, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
        
        foreach ($responseCountries as $responseCountry) {
            if (!$country = Country::where('alpha2_code', $responseCountry->alpha2Code)->first()) {
                $country = new Country;
            }
            
            $country->name = $responseCountry->name;
            $country->top_level_domains = $responseCountry->topLevelDomain;
            $country->alpha2_code = $responseCountry->alpha2Code;
            $country->alpha3_code = $responseCountry->alpha3Code;
            
            $country->calling_codes = array_filter($responseCountry->callingCodes, function ($calling_code) {
                return $calling_code;
            });
            
            $country->capital = $responseCountry->capital;
            $country->alt_spellings = $responseCountry->altSpellings;
            $country->region = $responseCountry->region;
            $country->subregion = $responseCountry->subregion;
            $country->population = $responseCountry->population;
            $country->latitude = $responseCountry->latlng[0] ?? null;
            $country->longitude = $responseCountry->latlng[1] ?? null;
            $country->demonym = $responseCountry->demonym;
            $country->area = $responseCountry->area;
            $country->gini = $responseCountry->gini;
            $country->timezones = $responseCountry->timezones;
            $country->borders = $responseCountry->borders;
            $country->native_name = $responseCountry->nativeName;
            $country->numeric_code = $responseCountry->numericCode;
            
            $country->currency_codes = array_map(function ($currency) {
                return $currency->code;
            }, $responseCountry->currencies);
            
            $country->language_codes = array_map(function ($language) {
                return $language->iso639_1;
            }, $responseCountry->languages);
            
            $country->cioc = $responseCountry->cioc;
            $country->save();
        }
        
        // ---------------------------------------------------------------------- //
        
        $countryPhoneNumberDetails = json_decode(File::get(storage_path('app/geo/country-phone-masks.json')), true);
        
        foreach ($countryPhoneNumberDetails as $country_code => $countryPhoneNumberDetail) {
            Country::where('alpha2_code', $country_code)->update([
                'phone_code' => $countryPhoneNumberDetail['phone_code'],
                'phone_number_mask' => $countryPhoneNumberDetail['phone_number_mask'],
            ]);
        }
        
        echo "The `countries` table were seeded successfully.\n";
    }
}
