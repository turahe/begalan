<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->unique()->sentence;
        $image = $this->faker->randomElement(\App\Models\Media::pluck('id')->toArray());
        return [
            'user_id' => 1,
            'title' => $title,
            'post_content' => join("\n\n", $this->faker->paragraphs(mt_rand(3, 6))),
            'feature_image' => $image,
            'type' => $this->faker->randomElement(['post', 'page']),
            'status' => $this->faker->boolean
        ];
    }
}
