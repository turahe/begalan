<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = collect($this->defaultCourses)->map(function ($course) {
            return [
                'user_id' => 1,
                'parent_category_id'  => 1,
                'second_category_id'  => 1,
                'category_id'  => 1,
                'title'  => 1,
                'slug'  => 1,
                'short_description'  => 1,
                'description'  => 1,
                'benefits'  => 1,
                'requirements'  => 1,
                'price_plan'  => 1,
                'price'  => 1,
                'sale_price'  => 1,
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
                'popular_added_at'  => now()->toDateTimeString(),
                'last_updated_at'  => now()->toDateTimeString(),
                'published_at'  => now()->toDateTimeString(),
                'created_at'  => now()->toDateTimeString(),
                'updated_at'  => now()->toDateTimeString(),
            ];
        });

        \App\Course::insert($courses->toArray());

    }

    protected array $defaultCourses = [
        [
            'user_id' => 1,
            'parent_category_id'  => 1,
            'second_category_id'  => 1,
            'category_id'  => 1,
            'title'  => 1,
            'slug'  => 1,
            'short_description'  => 1,
            'description'  => 1,
            'benefits'  => 1,
            'requirements'  => 1,
            'price_plan'  => 1,
            'price'  => 1,
            'sale_price'  => 1,
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
        ],

    ];
}
