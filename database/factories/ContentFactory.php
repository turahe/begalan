<?php

namespace Database\Factories;

use App\Models\Content;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Content::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->unique()->sentence;
        $video = [
            'source' => 'youtube',
            'html5_video_id' => null,
            'html5_video_poster_id' => null,
            'source_external_url' => null,
            'source_youtube' => 'https://www.youtube.com/watch?v=VJNwRPLq3z8',
            'source_vimeo' => null,
            'source_embedded' => null,
            'runtime' => [
                'hours' => '00',
                'mins' => mt_rand(6, 10),
                'secs' => '00',
            ],
        ];

        return [
            'title' => $title,
            'text' => implode("\n\n", $this->faker->paragraphs(mt_rand(3, 6))),
            'video_src' => json_encode($video),
            'video_time' => mt_rand(6, 10),
            'item_type' => $this->faker->randomElement(['lecture', 'assignment', 'quiz']),
            'is_preview' => $this->faker->boolean,
            'status' => $this->faker->boolean,
            //        'sort_order' => '',
            //        'options' => '',
            //        'quiz_gradable' => '',
            //        'unlock_date' => '',
            //        'unlock_days' => '',

        ];
    }
}
