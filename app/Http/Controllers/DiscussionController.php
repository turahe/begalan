<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class DiscussionController.
 */
class DiscussionController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $title = __t('discussions');

        return view('theme::dashboard.discussions.index', compact('title'));
    }

    /**
     * @param $discussion_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function reply($discussion_id)
    {
        $title = __t('discussions');
        $discussion = Discussion::find($discussion_id);

        return view('theme::dashboard.discussions.reply', compact('title', 'discussion'));
    }

    /**
     * @param Request $request
     * @param $discussion_id
     * @throws \Illuminate\Validation\ValidationException
     * @return \Illuminate\Http\RedirectResponse
     */
    public function replyPost(Request $request, $discussion_id)
    {
        $this->validate($request, ['message' => 'required']);

        $discussion = Discussion::find($discussion_id);

        $user = Auth::user();
        $title = clean_html($request->title);
        $message = linkify(clean_html($request->message));

        $data = [
            'course_id' => $discussion->course_id,
            'content_id' => $discussion->content_id,
            'user_id' => $user->id,
            'discussion_id' => $discussion_id,
            'title' => $title,
            'message' => $message,
        ];

        Discussion::create($data);

        $discussion->update(['replied' => 1]);

        return back()->with('success', 'Discussion replied');
    }

    /**
     * @param Request $request
     * @throws \Illuminate\Validation\ValidationException
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function askQuestion(Request $request)
    {
        $rules = [
            'title'     => 'required|max:220',
            'message'   => 'required',
        ];

        $this->validate($request, $rules);

        $content_id = $request->content_id;
        $content = Content::find($content_id);

        $user = Auth::user();
        $title = clean_html($request->title);
        $message = linkify(clean_html($request->message));

        $data = [
            'course_id' => $content->course_id,
            'content_id' => $content_id,
            'user_id' => $user->id,
            'title' => $title,
            'message' => $message,
            'replied' => 0,
        ];

        Discussion::create($data);

        return redirect(url()->previous().'#course-discussion-wrap');
    }
}
