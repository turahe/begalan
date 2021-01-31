<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Show the notifications for the current user.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        Auth::user()->unreadNotifications;

        return view('admin.notification.index');
    }

    /**
     * @param  string  $id  Notification ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show(string $id)
    {
        $notification = Auth::user()->notifications()->where('id', $id)->firstOrFail();

        if ($notification) {
            $notification->markAsRead();

            return redirect()->route($notification->data['route'], $notification->data['id']);
        }
    }

    /**
     * Mark all Notifications As Read.
     */
    public function markAllNotificationsAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();

        return response('success', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $notification
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($notification)
    {
        Auth::user()->notifications()->find($notification)->delete();

        return redirect()
            ->back()
            ->with('success', trans('messages.deleted', ['model' => 'app.model.notification']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyAll()
    {
        Auth::user()->notifications()->delete();

        return redirect()
            ->back()
            ->with('success', trans('messages.deleted'));
    }
}
