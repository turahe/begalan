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
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Show categories view
     */
    public function show(Category $category)
    {
        return view('theme::categories.show', compact('category'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        $categories = Category::where('parent_id', null)->get();

        return view('theme::categories.index', compact('categories'));
    }
}
