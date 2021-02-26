<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

/**
 * Class HomeController.
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $courses = Course::with(['media', 'category', 'author'])->get();
        $new_courses = $courses->sortBy('created_at')->sortDesc()->take(12);
        $featured_courses = $courses->where('featured', 1)->sortByDesc('featured_at')->take(6);
        $popular_courses = $courses->where('popular', 1)->sortByDesc('popular_added_at')->take(8);

        $posts = Post::post()->publish()->take(3)->get();

        return view('theme::index', compact('new_courses', 'featured_courses', 'popular_courses', 'posts'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function courses(Request $request)
    {
        $categories = Category::with('sub_categories')->where('parent_id', null)->get();
        $topics = Category::where('parent_id', $request->category)->get();

        $courses = Course::query();
        $courses = $courses->publish();

        $courses = app(Pipeline::class)
            ->send($courses)
            ->through([
                \App\Http\Pipelines\QueryFilters\Featured::class,
                \App\Http\Pipelines\QueryFilters\Popular::class,
                \App\Http\Pipelines\QueryFilters\Duration::class,
                \App\Http\Pipelines\QueryFilters\Search::class,
                \App\Http\Pipelines\QueryFilters\Status::class,
                \App\Http\Pipelines\QueryFilters\Topic::class,
                \App\Http\Pipelines\QueryFilters\Sort::class,
                \App\Http\Pipelines\QueryFilters\Price::class,
                \App\Http\Pipelines\QueryFilters\Rating::class,
            ])
            ->thenReturn()
            ->paginate($request->input('limit', 12));

        return view('theme::courses', compact('courses', 'categories', 'topics'));
    }
}
