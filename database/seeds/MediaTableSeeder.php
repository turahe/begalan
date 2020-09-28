<?php

use Illuminate\Database\Seeder;

class MediaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        factory(\App\Media::class, 100)->create();
        \App\Media::truncate();

        $files = File::files(public_path('uploads/images/'));
        $data = array_map(function ($file) {
            $mime_type = null;
            if ($file->getExtension() == 'jpeg' || $file->getExtension() == 'png' || $file->getExtension() == 'jpg') {
                $mime_type =  'image/' .$file->getExtension();
            } else {
                $mime_type = 'video/' .$file->getExtension();
            }
            return [
                'user_id' => 1,
                'name' => $file->getFilename(),
                'title' => $file->getFilename(),
                'alt_text' => $file->getFilename(),
                'slug' => $file->getFilename(),
                'slug_ext' =>$file->getFilename(),
                'file_size' =>$file->getSize(),
                'mime_type' => $mime_type,
                'metadata' => '',
                'sort_order' => 0,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ];
        }, $files);

        \App\Media::insert($data);
    }
}
