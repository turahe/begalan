<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users  = collect($this->defaultUsers)->map(function ($user) {
            return [
                'name'      => $user['name'],
                'email'     => $user['email'],
                'password'  => bcrypt('secret'),
                'user_type' => $user['user_type'],
                'email_verified_at' => now()->toDateTimeString(),
                'active_status' => 1,
                'company_name' => 'Circle Creative (PT. Lingkar Kreasi)',
                'country_id' => 104,
                'address' => 'Jalan Cibaduyut Raya No.142 Komplek Komersial Mekarwangi Square Bojongloa Kidul',
                'city' => 'Bandung',
                'zip_code' => '40236',
                'postcode' => '40236',
                'website' => 'https://circlecreative.id',
                'gender' => $user['gender'],
                'created_at'  => now()->toDateTimeString(),
                'updated_at'  => now()->toDateTimeString(),
            ];
        });
        \App\User::insert($users->toArray());
    }

    /**
     * @var string[][]
     */
    protected  $defaultUsers = [
        [
            'name'      => 'Circle Creative',
            'email'     => 'developer@circlecreative.id',
            'user_type' => 'admin',
            'gender' => 'female',
        ],
        [
            'name'      => 'Nur Wachid',
            'email'     => 'nur.wachid@circlecreative.id',
            'user_type' => 'instructor',
            'gender' => 'male',
        ],
        [
            'name'      => 'Steeve Adrian Salim',
            'email'     => 'steeven@circlecreative.id',
            'user_type' => 'instructor',
            'gender' => 'male',
        ],
        [
            'name'      => 'Angie Thea',
            'email'     => 'angie@circlecreative.id',
            'user_type' => 'instructor',
            'gender' => 'female',
        ],
        [
            'name'      => 'Clever Student',
            'email'     => 'student@circlecreative.id',
            'user_type' => 'student',
            'gender' => 'male',
        ],
    ];
}
