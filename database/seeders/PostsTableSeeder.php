<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use League\CommonMark\GithubFlavoredMarkdownConverter;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        \Schema::disableForeignKeyConstraints();
        Post::truncate();

        $pages = collect($this->defaultPages)->map(function ($page) {
            return  [
                'user_id' => 1,
                'category_id' => 1,
                'title' => $page['title'],
                'content' => $page['content'],
                'type' => 'page',
                'status' => 1,
            ];
        });
        // generate page default
        foreach ($pages as $page) {
            Post::updateOrCreate($page);
        }
        // generate random post
        Post::factory(30)->create()->each(function (Post $post) {
            $post->addMedia(storage_path('app/seeds/images/'.mt_rand(1, 20).'.jpg'))
                ->preservingOriginal()
                ->withResponsiveImages()
                ->toMediaCollection();
        });
    }

    protected $defaultPages = [
        [
            'title' => 'Terms',
            'content' => 'terms.md',
        ],
        [
            'title' => 'Terms Cookies',
            'content' => 'terms-cookies.md',
        ],
        [
            'title' => 'Terms Instructor',
            'content' => 'terms-instructor.md',
        ],
        [
            'title' => 'Terms Privacy',
            'content' => 'terms-privacy.md',
        ],

    ];

    /**
     * Convert markdown to HTML.
     */
    protected function markdown(string $text): string
    {
        try {
            $markdown = new GithubFlavoredMarkdownConverter();

            return $markdown->convertToHtml($text);
        } catch (\Exception $exception) {
        }
    }
}
