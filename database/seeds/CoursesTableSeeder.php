<?php

use App\Content;
use App\Course;
use App\Section;
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
        factory(Course::class, 35)->create()->each(function (Course $course) {
            factory(Section::class, 10)->make()->each(function (Section $section) use ($course) {
                $course->sections()->save($section);

                $section->items()->saveMany(factory(Content::class, mt_rand(10,30))->make([
                    'user_id' => $course->user_id,
                    'course_id' => $course->id,
                    'section_id' => $section->id,
                ]));
            });
        });

    }
}
