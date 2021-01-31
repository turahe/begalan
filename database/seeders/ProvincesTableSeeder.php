<?php

namespace Database\Seeders;

use App\Models\Master\State;
use Illuminate\Database\Seeder;

class ProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = base_path('vendor/turahe/master-data/resources/states.json');
        $data = json_decode(file_get_contents($file), true);
        $provinces = array_map(function ($province) {
            return [
                'country_id' => 104,
                'name' => $province['name'],
                'region' => $province['region'],
                'iso_3166_2' => $province['iso_3166_2'],
                'region_code' => $province['region_code'],
                'calling_code' => $province['calling_code'],
                'latitude' => $province['latitude'],
                'longitude' => $province['longitude'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, $data);

        State::insert($provinces);
    }
}
