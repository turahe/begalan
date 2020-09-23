<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Course::class, function (Faker $faker) {
    $faker->addProvider(new \App\Libraries\Youtube($faker));
    $thumbnail_id = $faker->randomElement(\App\Media::pluck('id')->toArray());
    $category_id = $faker->randomElement(\App\Category::pluck('id')->toArray());
    $user_id = $faker->randomElement(\App\User::where('user_type', 'instructor')->pluck('id')->toArray());
    $price = mt_rand(60, 100) * 1000;
    $video = [
        'source' => 'youtube',
        'html5_video_id' => NULL,
        'html5_video_poster_id' => NULL,
        'source_external_url' => NULL,
        'source_youtube' => $faker->youtubeShortUri(),
        'source_vimeo' => NULL,
        'source_embedded' => NULL,
        'runtime' =>
            [
                'hours' => '00',
                'mins' => mt_rand(6,10),
                'secs' => '00',
            ],
    ];

    return [
        'user_id' => $user_id,
        'parent_category_id'  => 1,
        'second_category_id'  => 1,
        'category_id'  => $category_id,
        'title'  => $faker->sentence,
        'slug'  => str_slug($faker->sentence),
        'short_description'  => $faker->paragraph,
        'description'  => $faker->paragraph(3),
        'benefits'  => join("\n\n", $faker->paragraphs(mt_rand(3, 6))),
        'requirements'  => join("\n\n", $faker->paragraphs(mt_rand(3, 6))),
        'price_plan'  => $faker->randomElement(['paid', 'free']),
        'price'  => $price,
        'sale_price'  => $price - ($price * (20 / 100)),
        'level'  => mt_rand(1,3),//$faker->randomElement(['beginner', 'intermediate', 'expert']),
        'status'  => 1,
        'is_presale'  => 1,
        'launch_at'  => 1,
        'thumbnail_id'  => $thumbnail_id,
        'video_src'  => json_encode($video),
        'total_video_time'  => mt_rand(1,5),
        'require_enroll'  => 1,
        'require_login'  => 1,
        'total_lectures'  => mt_rand(10,20),
        'total_assignments'  => 1,
        'total_quiz'  => null,
        'rating_value'  => mt_rand(1,5),
        'rating_count'  => mt_rand(1,5),
        'five_star_count'  => mt_rand(1,10),
        'four_star_count'  => mt_rand(1,10),
        'three_star_count'  => mt_rand(1,10),
        'two_star_count'  => mt_rand(1,10),
        'one_star_count'  => mt_rand(1,10),
        'is_featured'  => 1,
        'featured_at'  => $faker->dateTimeBetween('-3 month', 'now'),
        'is_popular'  => 1,
        'popular_added_at'  => $faker->dateTimeBetween('-3 month', 'now'),
        'last_updated_at'  => $faker->dateTimeBetween('-3 month', 'now'),
        'published_at'  => $faker->dateTimeBetween('-3 month', 'now'),
    ];
});
