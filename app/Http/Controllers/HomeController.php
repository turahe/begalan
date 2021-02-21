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

//        $new_courses = Course::publish()
//            ->orderBy('created_at', 'desc')
//            ->take(12)
//            ->get();

//        $featured_courses = Course::publish()
//            ->whereIsFeatured(1)->orderBy('featured_at', 'desc')
//            ->take(6)
//            ->get();

//        $popular_courses = Course::publish()
//            ->whereIsPopular(1)
//            ->orderBy('popular_added_at', 'desc')
//            ->take(8)
//            ->get();

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

        if ($request->path() === 'featured-courses') {
            $title = __t('featured_courses');
            $courses = $courses->where('is_featured', 1);
        } elseif ($request->path() === 'popular-courses') {
            $title = __t('popular_courses');
            $courses = $courses->where('is_popular', 1);
        }

        if ($request->q) {
            $courses = $courses->where('title', 'LIKE', "%{$request->q}%");
        }
        if ($request->category) {
            $courses = $courses->where('second_category_id', $request->category);
        }
        if ($request->topic) {
            $courses = $courses->where('category_id', $request->topic);
        }
        if ($request->level && ! in_array(0, $request->level)) {
            $courses = $courses->whereIn('level', $request->level);
        }
        if ($request->price) {
            $courses = $courses->whereIn('price_plan', $request->price);
        }
        if ($request->rating) {
            $courses = $courses->where('rating_value', '>=', $request->rating);
        }

        /*
         * Find by Video Duration
         */
        if ($request->video_duration === '0_2') {
            $durationEnd = (60 * 60 * 3) - 1; //02:59:59
            $courses = $courses->where('total_video_time', '<=', $durationEnd);
        } elseif ($request->video_duration === '3_5') {
            $durationStart = (60 * 60 * 3);
            $durationEnd = (60 * 60 * 6) - 1;
            $courses = $courses->whereBetween('total_video_time', [$durationStart, $durationEnd]);
        } elseif ($request->video_duration === '6_10') {
            $durationStart = (60 * 60 * 6);
            $durationEnd = (60 * 60 * 11) - 1;
            $courses = $courses->whereBetween('total_video_time', [$durationStart, $durationEnd]);
        } elseif ($request->video_duration === '11_20') {
            $durationStart = (60 * 60 * 11);
            $durationEnd = (60 * 60 * 21) - 1;
            $courses = $courses->whereBetween('total_video_time', [$durationStart, $durationEnd]);
        } elseif ($request->video_duration === '21') {
            $durationStart = (60 * 60 * 21);
            $courses = $courses->where('total_video_time', '>=', $durationStart);
        }

//        switch ($request->sort) {
//            case 'most-reviewed':
//                $courses = $courses->orderBy('rating_count', 'desc');
//                break;
//            case 'highest-rated':
//                $courses = $courses->orderBy('rating_value', 'desc');
//                break;
//            case 'newest':
//                $courses = $courses->orderBy('published_at', 'desc');
//                break;
//            case 'price-low-to-high':
//                $courses = $courses->orderBy('price', 'asc');
//                break;
//            case 'price-high-to-low':
//                $courses = $courses->orderBy('price', 'desc');
//                break;
//            default:
//
//                if ($request->path() === 'featured-courses') {
//                    $courses = $courses->orderBy('featured_at', 'desc');
//                } elseif ($request->path() === 'popular-courses') {
//                    $courses = $courses->orderBy('popular_added_at', 'desc');
//                } else {
//                    $courses = $courses->orderBy('created_at', 'desc');
//                }
//        }

//        $per_page = $request->perpage ? $request->perpage : 9;
//        $courses = $courses->paginate($per_page);

        $courses = app(Pipeline::class)
            ->send($courses)
            ->through([
                \App\Http\Pipelines\QueryFilters\Duration::class,
                \App\Http\Pipelines\QueryFilters\Search::class,
                \App\Http\Pipelines\QueryFilters\Status::class,
                \App\Http\Pipelines\QueryFilters\Sort::class,
            ])
            ->thenReturn()
            ->paginate($request->input('limit', 9));

//        dd($courses);

        return view('theme::courses', compact('courses', 'categories', 'topics'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function clearCache()
    {
        Artisan::call('debugbar:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('optimize:clear');
        if (function_exists('exec')) {
            exec('rm '.storage_path('logs/*'));
        }
        $this->rrmdir(storage_path('logs/'));

        return redirect(route('home'));
    }

    /**
     * @param $dir
     */
    public function rrmdir($dir)
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != '.' && $object != '..') {
                    if (is_dir($dir.'/'.$object)) {
                        $this->rrmdir($dir.'/'.$object);
                    } else {
                        unlink($dir.'/'.$object);
                    }
                }
            }
            //rmdir($dir);
        }
    }
}
