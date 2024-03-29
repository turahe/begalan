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

        return [
            'user_id' => 1,
            'category_id' => 1,
            'title' => $title,
            'content' => implode("\n\n", $this->faker->paragraphs(mt_rand(3, 6))),
            'type' => $this->faker->randomElement(['post', 'page']),
            'status' => $this->faker->boolean,
        ];
    }
}
