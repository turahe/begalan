<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Content::class, function (Faker $faker) {
    $title = $faker->unique()->sentence;
    $video = [
        'source' => 'youtube',
        'html5_video_id' => NULL,
        'html5_video_poster_id' => NULL,
        'source_external_url' => NULL,
        'source_youtube' => 'https://www.youtube.com/watch?v=VJNwRPLq3z8',
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
        'title' => $title,
        'slug' => str_slug($title),
        'text' => join("\n\n", $faker->paragraphs(mt_rand(3, 6))),
        'video_src' => json_encode($video),
        'video_time' => mt_rand(6,10),
        'item_type' => $faker->randomElement(['lecture', 'assignment', 'quiz']),
        'is_preview' => $faker->boolean,
        'status' => $faker->boolean,
//        'sort_order' => '',
//        'options' => '',
//        'quiz_gradable' => '',
//        'unlock_date' => '',
//        'unlock_days' => '',

    ];
});
