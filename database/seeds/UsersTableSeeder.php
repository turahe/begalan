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
        \Illuminate\Support\Facades\DB::table('users')->insert(
            [
                0 => [
                    'name'      => 'Circle Creative',
                    'email'     => 'developer@circlecreative.id',
                    'password'  => bcrypt('123456'),
                    'user_type' => 'admin',
                    'active_status' => 1,
                    'gender' => 'female',
                ],
                1 => [
                    'name'      => 'Bessie M. Artz',
                    'email'     => 'instructor@circlecreative.id',
                    'password'  => bcrypt('123456'),
                    'user_type' => 'instructor',
                    'active_status' => 1,
                    'gender' => 'female',
                ],
                2 => [
                    'name'      => 'Sean J. McAlister',
                    'email'     => 'student@circlecreative.id',
                    'password'  => bcrypt('123456'),
                    'user_type' => 'student',
                    'active_status' => 1,
                    'gender' => 'male',
                ],
            ]
        );
    }
}
