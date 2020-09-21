<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Course::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'parent_category_id'  => 1,
        'second_category_id'  => 1,
        'category_id'  => 1,
        'title'  => $faker->sentence,
        'slug'  => str_slug($faker->sentence),
        'short_description'  => $faker->paragraph,
        'description'  => $faker->paragraph(3),
        'benefits'  => 1,
        'requirements'  => 1,
        'price_plan'  => 1,
        'price'  => mt_rand(60,100) * 1000,
        'sale_price'  => mt_rand(60,100) * 1000,
        'level'  => 1,
        'status'  => 1,
        'is_presale'  => 1,
        'launch_at'  => 1,
        'thumbnail_id'  => 1,
        'video_src'  => 1,
        'total_video_time'  => 1,
        'require_enroll'  => 1,
        'require_login'  => 1,
        'total_lectures'  => 1,
        'total_assignments'  => 1,
        'total_quiz'  => 1,
        'rating_value'  => 1,
        'rating_count'  => 1,
        'five_star_count'  => 1,
        'four_star_count'  => 1,
        'three_star_count'  => 1,
        'two_star_count'  => 1,
        'one_star_count'  => 1,
        'is_featured'  => 1,
        'featured_at'  => 1,
        'is_popular'  => 1,
    ];
});
