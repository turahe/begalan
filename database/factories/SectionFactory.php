<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Section::class, function (Faker $faker) {
    return [
        'section_name' => $faker->sentence
    ];
});
