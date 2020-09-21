<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Section::class, function (Faker $faker) {
    $user_id = $faker->randomElement(\App\User::where('user_type', 'instructor')->pluck('id')->toArray());
    return [
        'user_id' => $user_id,
    ];
});
