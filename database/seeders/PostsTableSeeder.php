<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
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
        $pages = collect($this->defaultPages)->map(function ($page) {
            return  [
                'user_id' => 1,
                'title' => $page['title'],
                'slug' => Str::slug($page['title']),
                'post_content' => $this->markdown(file_get_contents(storage_path("app/data/{$page['content']}"))),
                'feature_image' => null,
                'type' => 'page',
                'status' => 1,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ];
        });
        // generate page default
        Post::insert($pages->toArray());
        // generate random post
        Post::factory(30)->create();
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
     *
     * @param string $text
     * @return string
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
