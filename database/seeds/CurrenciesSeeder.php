<?php

use App\Models\Money\Currency;
use Illuminate\Database\Seeder;

class CurrenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
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
        
        Currency::truncate();
        $responseCurrencies = [];
        
        foreach ($responseCountries as $responseCountry) {
            foreach ($responseCountry->currencies as $responseCurrency) {
                if (isset($responseCurrencies[$responseCurrency->code])) {
                    continue;
                }
                
                $responseCurrencies[$responseCurrency->code] = $responseCurrency;
            }
        }
        
        ksort($responseCurrencies);
        
        foreach ($responseCurrencies as $responseCurrency) {
            if (!$responseCurrency->code || $responseCurrency->code === '(none)') {
                continue;
            }
            
            if (!$currency = Currency::where('code', $responseCurrency->code)->first()) {
                $currency = new Currency;
            }
            
            $currency->code = $responseCurrency->code;
            $currency->name = $responseCurrency->name;
            $currency->symbol = $responseCurrency->symbol;
            $currency->save();
        }
        
        echo "The `currencies` table were seeded successfully.\n";
    }
}
