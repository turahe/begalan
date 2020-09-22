<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Facades\File;

$factory->define(\App\Media::class, function (Faker $faker) {
    $user_id = $faker->randomElement(\App\User::pluck('id')->toArray());
    $file = $faker->randomElement(File::files(public_path('uploads/images/')));
    return [
        'user_id' => $user_id,
        'name' => $file->getFilename(),
        'title' => $file->getFilename(),
        'alt_text' => null,
        'slug' => $file->getFilename(),
        'slug_ext' => $file->getFilename(),
        'file_size' => $file->getSize(),
        'mime_type' => $file->getExtension(),
        'metadata' => null,
    ];
});
