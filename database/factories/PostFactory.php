<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Post::class, function (Faker $faker) {
    $title = $faker->unique()->sentence;
    $image = $faker->randomElement(\App\Media::pluck('id')->toArray());
    return [
        'user_id' => 1,
        'title' => $title,
        'slug' => unique_slug($title),
        'post_content' => join("\n\n", $faker->paragraphs(mt_rand(3, 6))),
        'feature_image' => $image,
        'type' => $faker->randomElement(['post', 'page']),
        'status' => $faker->boolean
    ];
});
