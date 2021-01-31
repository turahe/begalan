<?php

namespace Database\Factories;

use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;

class MediaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Media::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user_id = $this->faker->randomElement(\App\Models\User::pluck('id')->toArray());
        $file = $this->faker->randomElement(File::files(public_path('uploads/images/')));

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
    }
}
