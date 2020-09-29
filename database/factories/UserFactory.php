<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),

        'gender' => $faker->randomElement(['male', 'female']),
        'company_name' => $faker->company,
        'country_id' => 104,
        'address' => $faker->address,
        'address_2' => $faker->address,
        'city' => $faker->city,
        'zip_code' => $faker->postcode,
        'postcode' => $faker->postcode,
        'phone' => $faker->phoneNumber,
        'about_me' => $faker->paragraph(5),
        'date_of_birth' => $faker->dateTimeBetween('-30 years', '-13 years'),
        'photo' => 1,
        'job_title' => $faker->jobTitle
    ];
});
