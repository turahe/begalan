<?php

namespace Database\Seeders;

use App\Models\Master\Color;
use Illuminate\Database\Seeder;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Color::truncate();

        $file = base_path('vendor/turahe/master-data/resources/colors.json');
        $data = json_decode(file_get_contents($file), true);

        $colors = array_map(function ($color) {
            return [
                'name' => $color['name'],
                'code' => $color['code'],
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ];
        }, $data);
        Color::insert($colors);
    }
}
