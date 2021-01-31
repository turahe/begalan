<?php

namespace Database\Seeders;

use App\Models\Master\Timezone;
use Illuminate\Database\Seeder;

class TimeZoneTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Timezone::truncate();

        $file = base_path('vendor/turahe/master-data/resources/timezones.json');
        $data = json_decode(file_get_contents($file), true);

        $colors = array_map(function ($color) {
            return [
                'value' => $color['value'],
                'abbr' => $color['abbr'],
                'offset' => $color['offset'],
                'isdst' => $color['isdst'],
                'text' => $color['text'],
                'utc' => $color['utc'],
                'status' => true,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ];
        }, $data);
        Timezone::insert($colors);
    }
}
