<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker->addProvider(new \App\Libraries\Youtube($this->faker));
        $thumbnail_id = $this->faker->randomElement(\App\Models\Media::pluck('id')->toArray());
        $parent_category_id = $this->faker->randomElement(\App\Models\Category::where('category_id', 0)->pluck('id')->toArray());
        $second_category_id = $this->faker->randomElement(\App\Models\Category::where('category_id', $parent_category_id)->pluck('id')->toArray());
        $category_id = $this->faker->randomElement(\App\Models\Category::where('category_id', $second_category_id)->pluck('id')->toArray());
        $user_id = $this->faker->randomElement(\App\Models\User::where('user_type', 'instructor')->pluck('id')->toArray());
        $price = mt_rand(60, 100) * 1000;

        $video = [
            'source' => 'youtube',
            'html5_video_id' => null,
            'html5_video_poster_id' => null,
            'source_external_url' => null,
            'source_youtube' => 'https://www.youtube.com/watch?v=VJNwRPLq3z8',
            'source_vimeo' => null,
            'source_embedded' => null,
            'runtime' => [
                    'hours' => mt_rand(1, 24),
                    'mins' => mt_rand(6, 10),
                    'secs' => mt_rand(1, 60),
                ],
        ];

        return [
            'user_id' => $user_id,
            'parent_category_id'  => $parent_category_id,
            'second_category_id'  => $second_category_id,
            'category_id'  => $category_id,
            'title'  => $this->faker->sentence,
            'short_description'  => $this->faker->paragraph,
            'description'  => $this->faker->paragraph(3),
            'benefits'  => implode("\n\n", $this->faker->paragraphs(mt_rand(3, 6))),
            'requirements'  => implode("\n\n", $this->faker->paragraphs(mt_rand(3, 6))),
            'price_plan'  => $this->faker->randomElement(['paid', 'free']),
            'price'  => $price,
            'sale_price'  => $price - ($price * (20 / 100)),
            'level'  => mt_rand(1, 3), //$this->faker->randomElement(['beginner', 'intermediate', 'expert']),
            'status'  => 1,
            'is_presale'  => 1,
            'launch_at'  => 1,
            'thumbnail_id'  => $thumbnail_id,
            'video_src'  => json_encode($video),
            'total_video_time'  => mt_rand(1, 5),
            'require_enroll'  => 1,
            'require_login'  => 1,
            'total_lectures'  => mt_rand(10, 20),
            'total_assignments'  => 1,
            'total_quiz'  => null,
            'rating_value'  => mt_rand(1, 5),
            'rating_count'  => mt_rand(1, 5),
            'five_star_count'  => mt_rand(1, 10),
            'four_star_count'  => mt_rand(1, 10),
            'three_star_count'  => mt_rand(1, 10),
            'two_star_count'  => mt_rand(1, 10),
            'one_star_count'  => mt_rand(1, 10),
            'is_featured'  => 1,
            'featured_at'  => $this->faker->dateTimeBetween('-3 month', 'now'),
            'is_popular'  => 1,
            'popular_added_at'  => $this->faker->dateTimeBetween('-3 month', 'now'),
            'last_updated_at'  => $this->faker->dateTimeBetween('-3 month', 'now'),
            'published_at'  => $this->faker->dateTimeBetween('-3 month', 'now'),
        ];
    }
}
