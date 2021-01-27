<?php

use App\Models\Language;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Seeder;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
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
        
        Language::truncate();
        $responseLanguages = [];
        
        foreach ($responseCountries as $responseCountry) {
            foreach ($responseCountry->languages as $responseLanguage) {
                if (isset($responseLanguages[$responseLanguage->iso639_2])) {
                    continue;
                }
                
                $responseLanguages[$responseLanguage->iso639_2] = $responseLanguage;
            }
        }
        
        ksort($responseLanguages);
        
        foreach ($responseLanguages as $responseLanguage) {
            if (!$responseLanguage->iso639_1) {
                continue;
            }
            
            if (!$language = Language::where('code', $responseLanguage->iso639_2)->first()) {
                $language = new Language();
            }
            
            $language->name = $responseLanguage->name;
            $language->native_name = $responseLanguage->nativeName;
            $language->code = $responseLanguage->iso639_1;
            $language->save();
        }
        
        echo "The `languages` table were seeded successfully.\n";
    }
}
