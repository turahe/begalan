<?php

namespace Database\Seeders;

use App\Models\Master\Bank;
use Illuminate\Database\Seeder;

class BanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = base_path('vendor/turahe/master-data/resources/banks.json');
        $data = json_decode(file_get_contents($file), true);
        $banks = array_map(function ($arr) {
            return [
                'name' => $arr['name'],
                'alias' => $arr['alias'],
                'company' => $arr['company'],
                'code' => $arr['code'],
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ];
        }, $data);

        Bank::insert($banks);
    }
}
