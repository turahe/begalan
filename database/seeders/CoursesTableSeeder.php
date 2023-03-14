<?php

namespace Database\Seeders;

use App\Models\Content;
use App\Models\Course;
use App\Models\Section;
use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     *
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function run()
    {
        Course::factory(15)->create()->each(function (Course $course) {
            $course->addMedia(storage_path('app/seeds/images/'.mt_rand(1, 20).'.jpg'))
                ->preservingOriginal()
                ->withResponsiveImages()
                ->toMediaCollection();

            Section::factory(10)->make()->each(function (Section $section) use ($course) {
                $course->sections()->save($section);

                $section->items()->saveMany(Content::factory(mt_rand(10, 30))->make([
                    'user_id' => $course->user_id,
                    'course_id' => $course->id,
                    'section_id' => $section->id,
                ]));
            });
        });
    }
}
