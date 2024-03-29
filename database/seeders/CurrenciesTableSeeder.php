<?php

namespace Database\Seeders;

use App\Models\Master\Currency;
use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Get all of the currencies
        $file = base_path('vendor/turahe/master-data/resources/currencies.json');
        $data = json_decode(file_get_contents($file), true);

        $currencies = array_map(function ($currency) {
            return [
                'priority' => isset($currency['priority']) ? $currency['priority'] : 100,
                'iso_code' => isset($currency['iso_code']) ? $currency['iso_code'] : null,
                'name' => isset($currency['name']) ? $currency['name'] : null,
                'symbol' => isset($currency['symbol']) ? $currency['symbol'] : null,
                'disambiguate_symbol' => isset($currency['disambiguate_symbol']) ? $currency['disambiguate_symbol'] : null,
                'alternate_symbols' => isset($currency['alternate_symbols']) ? json_encode($currency['alternate_symbols'], true) : null,
                'subunit' => isset($currency['subunit']) ? $currency['subunit'] : null,
                'subunit_to_unit' => isset($currency['subunit_to_unit']) ? $currency['subunit_to_unit'] : 100,
                'symbol_first' => isset($currency['symbol_first']) ? $currency['symbol_first'] : 1,
                'html_entity' => isset($currency['html_entity']) ? $currency['html_entity'] : null,
                'decimal_mark' => isset($currency['decimal_mark']) ? $currency['decimal_mark'] : '.',
                'thousands_separator' => isset($currency['thousands_separator']) ? $currency['thousands_separator'] : ',',
                'iso_numeric' => isset($currency['iso_numeric']) ? $currency['iso_numeric'] : null,
                'smallest_denomination' => isset($currency['smallest_denomination']) ? $currency['smallest_denomination'] : 1,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),

            ];
        }, $data);

        Currency::insert($currencies);
    }
}
