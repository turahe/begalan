<?php

namespace Database\Seeders;

use App\Models\Master\City;
use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = base_path('vendor/turahe/master-data/resources/cities.json');
        $data = json_decode(file_get_contents($file), true);
        $cities = array_map(function ($arr) {
            return [
                'state_id' => $arr['state_id'],
                'name' => $arr['name'],
                'type' => isset($arr['type']) ? $arr['type'] : null,
                'postal_code' => $arr['postal_code'],
                'latitude' => $arr['latitude'],
                'longitude' => $arr['longitude'],
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ];
        }, $data);

        City::insert($cities);
    }
}
