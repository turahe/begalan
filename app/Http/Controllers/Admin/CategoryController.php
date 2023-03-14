<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = app(Pipeline::class)
            ->send(Category::whereStep(0))
            ->through([
                \App\Http\Pipelines\QueryFilters\Type::class,
                \App\Http\Pipelines\QueryFilters\Sort::class,
                \App\Http\Pipelines\QueryFilters\MaxCount::class,
            ])
            ->thenReturn()
            ->paginate($request->input('limit', 10));

        return view('admin.categories.categories', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = __a('category');
        $data['sub_title'] = __a('category_create');
        $data['categories'] = Category::whereStep(0)->with('sub_categories')->orderBy('category_name', 'asc')->get();

        return view('admin.categories.category_add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $is_create = Category::create($request->all());

        return back()->with('success', __a('category_created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);

        $data['title'] = __a('category_edit');
        $data['category'] = $category;
        $data['categories'] = Category::whereStep(0)->with('sub_categories')->orderBy('category_name', 'asc')->where('id', '!=', $id)->get();

        if (! $category) {
            abort(404);
        }

        return view('admin.categories.category_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Category $category)
    {
        $category->update($request->all());

        return back()->with('success', trans('admin.category_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->back()->with('success', 'success delete data');
    }
}
