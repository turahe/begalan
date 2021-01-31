<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->defaultUsers as $user) {
            User::updateOrCreate([
                'name'      => $user['name'],
                'email'     => $user['email'],
                'password'  => bcrypt('secret'),
            ])->assignRole($user['user_type']);
        }

        User::factory(100)->create()->each(function ($user) {
            $user->assignRole('student');
        });
    }

    /**
     * @var string[][]
     */
    protected $defaultUsers = [
        [
            'name'      => 'Admin',
            'email'     => 'developer@turahe.id',
            'user_type' => 'admin',
            'gender' => 'female',
        ],
        [
            'name'      => 'Instructor',
            'email'     => 'instructor@turahe.id',
            'user_type' => 'instructor',
            'gender' => 'male',
        ],
        [
            'name'      => 'Nur Wachid',
            'email'     => 'nur.wachid@turahe.id',
            'user_type' => 'instructor',
            'gender' => 'male',
        ],
        [
            'name'      => 'Clever Student',
            'email'     => 'student@turahe.id',
            'user_type' => 'student',
            'gender' => 'male',
        ],
    ];
}
