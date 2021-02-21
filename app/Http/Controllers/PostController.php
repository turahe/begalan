<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Auth;

/**
 * Class PostController.
 */
class PostController extends Controller
{
    /**
     * @param $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPage($slug)
    {
        $page = Post::whereSlug($slug)->first();

        if (! $page) {
            return view('theme.error_404');
        }
        $title = $page->title;

        return view('theme.single_page', compact('title', 'page'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function blog()
    {
        $title = __t('blog');
        $posts = Post::post()->publish()->paginate(20);

        return view('theme::blog', compact('title', 'posts'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function authorPosts($id)
    {
        $posts = Post::whereType('post')->whereUserId($id)->paginate(20);
        $user = User::find($id);
        $title = $user->name."'s ".trans('app.blog');

        return view('theme.blog', compact('title', 'posts'));
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function postSingle($slug)
    {
        $post = Post::whereSlug($slug)->first();
        if (! $post) {
            abort(404);
        }
        $title = $post->title;

        if ($post->type === 'post') {
            return view('theme::single_post', compact('title', 'post'));
        }

        return view('theme::single_page', compact('title', 'post'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postProxy($id)
    {
        $post = Post::where('id', $id)->orWhere('slug', $id)->first();
        if (! $post) {
            abort(404);
        }

        return redirect(route('post', $post->slug));
    }
}
