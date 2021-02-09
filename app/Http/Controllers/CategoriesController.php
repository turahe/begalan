<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Auth;

/**
 * Class CategoriesController.
 */
class CategoriesController extends Controller
{


    /**
     * @param Request $request
     * @return array
     */
    public function getTopicOptions(Request $request)
    {
        $topics = Category::whereCategoryId($request->category_id)->get();

        $options_html = "<option value=''>".__t('select_topic').'</option>';
        foreach ($topics as $topic) {
            $options_html .= "<option value='{$topic->id}'>{$topic->category_name}</option>";
        }

        return ['success' => 1, 'options_html' => $options_html];
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Show categories view
     */
    public function show($slug)
    {
        $category = Category::whereSlug($slug)->orWhere('id', $slug)->first();
        if (! $category) {
            abort(404);
        }

        $title = $category->category_name;

        return view('theme::single-category', compact('title', 'category'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        $title = __t('topics');

        return view('theme::categories', compact('title'));
    }
}
