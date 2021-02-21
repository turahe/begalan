<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserController.
 */
class UserController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile($id)
    {
        $user = User::find($id);
        if (! $user) {
            abort(404);
        }

        $title = $user->name;

        return view('theme::profile', compact('user', 'title'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function review($id)
    {
        $review = Review::find($id);
        $title = 'Review by '.$review->user->name;

        return view('theme::review', compact('review', 'title'));
    }

    /**
     * @param Request $request
     * @return array
     */
    public function updateWishlist(Request $request)
    {
        $course_id = $request->course_id;

        $user = Auth::user();
        if (! $user->wishlist->contains($course_id)) {
            $user->wishlist()->attach($course_id);
            $response = ['success' => 1, 'state' => 'added'];
        } else {
            $user->wishlist()->detach($course_id);
            $response = ['success' => 1, 'state' => 'removed'];
        }

        $addedWishList = DB::table('wishlists')->where('user_id', $user->id)->pluck('course_id');

        $user->update_option('wishlists', $addedWishList);

        return $response;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function changePassword()
    {
        $title = __a('change_password');

        return view('admin.change_password', compact('title'));
    }

    /**
     * @param Request $request
     * @throws \Illuminate\Validation\ValidationException
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePasswordPost(Request $request)
    {
        if (config('app.is_demo')) {
            return redirect()->back()->with('error', 'This feature has been disable for demo');
        }
        $rules = [
            'old_password'  => 'required',
            'new_password'  => 'required|confirmed',
            'new_password_confirmation'  => 'required',
        ];
        $this->validate($request, $rules);

        $old_password = $request->old_password;
        $new_password = $request->new_password;

        if (Auth::check()) {
            $logged_user = Auth::user();

            if (Hash::check($old_password, $logged_user->password)) {
                $logged_user->password = Hash::make($new_password);
                $logged_user->save();

                return redirect()->back()->with('success', __a('password_changed_msg'));
            }

            return redirect()->back()->with('error', __a('wrong_old_password'));
        }
    }
}
