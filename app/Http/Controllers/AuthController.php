<?php

namespace App\Http\Controllers;

use App\Mail\SendPasswordResetLink;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;

/**
 * Class AuthController
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{

    /**
     * @return string
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function login()
    {
        $title = __t('login');
        return view_template('login', compact('title'));
    }

    /**
     * @param Request $request
     * @throws \Illuminate\Validation\ValidationException
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function loginPost(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];

        $this->validate($request, $rules);

        $credential = [
            'email'     => $request->email,
            'password'     => $request->password
        ];

        if (Auth::attempt($credential, $request->remember_me)) {
            $auth = Auth::user();

            if ($request->_redirect_back_to) {
                return redirect($request->_redirect_back_to);
            }

            if ($auth->isAdmin()) {
                return redirect()->intended(route('admin'));
            }
            return redirect()->intended(route('dashboard'));
        }

        return redirect()->back()
            ->with('error', __('auth.failed'))
            ->withInput($request->input());
    }


    /**
     * @return string
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function register()
    {
        $title = __t('signup');
        return view_template('register', compact('title'));
    }

    /**
     * @param Request $request
     * @throws \Illuminate\Validation\ValidationException
     * @return \Illuminate\Http\RedirectResponse
     */
    public function registerPost(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ];

        $this->validate($request, $rules);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_type' => $request->user_as,
            'active_status' => 1
        ]);
        event(new Registered($user));

        if ($user) {
            $this->loginPost($request);
        }
        return back()->with('error', __t('failed_try_again'))->withInput($request->input());
    }

    public function userVerified(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
            ? redirect('/dashboard')
            : view(theme('auth.verify'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logoutPost()
    {
        Auth::logout();
        return redirect('login');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function forgotPassword()
    {
        $title = __t('forgot_password');
        return view(theme('auth.forgot_password'), compact('title'));
    }

    /**
     * @param Request $request
     * @throws \Illuminate\Validation\ValidationException
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetToken(Request $request)
    {
        $this->validate($request, ['email' => 'required']);

        $email = $request->email;

        $user = User::whereEmail($email)->first();
        if (! $user) {
            return back()->with('error', __t('email_not_found'));
        }

        $user->reset_token = str_random(32);
        $user->save();

        try {
            Mail::to($email)->send(new SendPasswordResetLink($user));
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function passwordResetForm()
    {
        $title = __t('reset_your_password');
        return view(theme('auth.reset_form'), compact('title'));
    }

    /**
     * @param Request $request
     * @param $token
     * @throws \Illuminate\Validation\ValidationException
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function passwordReset(Request $request, $token)
    {
        if (config('app.is_demo')) {
            return redirect()->back()->with('error', 'This feature has been disable for demo');
        }
        $rules = [
            'password'  => 'required|confirmed',
            'password_confirmation'  => 'required',
        ];
        $this->validate($request, $rules);

        $user = User::whereResetToken($token)->first();
        if (! $user) {
            return back()->with('error', __t('invalid_reset_token'));
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect(route('login'))->with('success', __t('password_reset_success'));
    }

    /**
     * Social Login Settings
     */

    public function redirectFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectTwitter()
    {
        return Socialite::driver('twitter')->redirect();
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectLinkedIn()
    {
        return Socialite::driver('linkedin')->redirect();
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function callbackFacebook()
    {
        try {
            $socialUser = Socialite::driver('facebook')->user();
            $user = $this->getSocialUser($socialUser, 'facebook');
            auth()->login($user);
            return redirect()->intended(route('dashboard'));
        } catch (\Exception $e) {
            return redirect(route('login'))->with('error', $e->getMessage());
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function callbackGoogle()
    {
        try {
            $socialUser = Socialite::driver('google')->user();
            $user = $this->getSocialUser($socialUser, 'google');
            auth()->login($user);
            return redirect()->intended(route('dashboard'));
        } catch (\Exception $e) {
            return redirect(route('login'))->with('error', $e->getMessage());
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function callbackTwitter()
    {
        try {
            $socialUser = Socialite::driver('twitter')->user();
            $user = $this->getSocialUser($socialUser, 'twitter');
            auth()->login($user);
            return redirect()->intended(route('dashboard'));
        } catch (\Exception $e) {
            return redirect(route('login'))->with('error', $e->getMessage());
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function callbackLinkedIn()
    {
        try {
            $socialUser = Socialite::driver('linkedin')->user();
            $user = $this->getSocialUser($socialUser, 'linkedin');
            auth()->login($user);
            return redirect()->intended(route('dashboard'));
        } catch (\Exception $e) {
            return redirect(route('login'))->with('error', $e->getMessage());
        }
    }

    /**
     * @param $providerUser
     * @param string $provider
     * @return mixed
     */
    public function getSocialUser($providerUser, $provider = '')
    {
        $user = User::whereProvider($provider)->whereProviderUserId($providerUser->getId())->first();

        if ($user) {
            return $user;
        }

        $user = User::whereEmail($providerUser->getEmail())->first();
        if ($user) {
            $user->provider_user_id = $providerUser->getId();
            $user->provider = $provider;
            $user->save();
        } else {
            $user = User::create([
                    'email'             => $providerUser->getEmail(),
                    'name'              => $providerUser->getName(),
                    'user_type'         => 'user',
                    'active_status'     => 1,
                    'provider_user_id'  => $providerUser->getId(),
                    'provider'          => $provider,
                ]);
        }

        return $user;
    }
}
