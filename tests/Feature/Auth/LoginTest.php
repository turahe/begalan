<?php

namespace Tests\Feature\Auth;

use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /** @test
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function it_user_can_view_a_login_form()
    {
        $response = $this->get(route('login'));

        $response->assertSuccessful();
//        $response->assertViewIs(view_template('login'));
    }

    /** @test */
    public function it_user_cannot_view_a_login_form_when_authenticated()
    {
        $user = factory(User::class)->make();

        $response = $this->actingAs($user)->get(route('login'));

        $response->assertRedirect('dashboard');
    }

    /** @test */
    public function it_user_can_login_with_correct_credentials()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($password = 'secret'),
            'email_verified_at' => now(),
        ]);

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect('/admin');
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function it_user_cannot_login_with_invalid_user()
    {
        $user = factory(User::class)->create();

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'invalid',
        ]);
        $response->assertSessionHasErrors();

        $this->assertGuest();
    }

    /** @test */
    public function it_remember_me_functionality()
    {
        $user = factory(User::class)->create([
            'id' => random_int(1, 100),
            'password' => bcrypt($password = 'secret'),
        ]);

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => $password,
            'remember' => 'on',
        ]);

        $user = $user->fresh();

        $response->assertRedirect('dashboard');
        $response->assertCookie(Auth::guard()->getRecallerName(), vsprintf('%s|%s|%s', [
            $user->id,
            $user->getRememberToken(),
            $user->password,
        ]));
        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function it_user_cannot_login_with_email_that_does_not_exist()
    {
        $response = $this->from(route('login'))->post(route('login'), [
            'email' => 'nobody@example.com',
            'password' => 'invalid-password',
        ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    /**
     * @test
     */
    public function it_user_can_logout()
    {
        $this->be(factory(User::class)->create());

        $response = $this->post(route('logout'));

        $response->assertRedirect('/');
        $this->assertGuest();
    }

    /**
     * @test
     */
    public function it_user_cannot_logout_when_not_authenticated()
    {
        $response = $this->post(route('logout'));

        $response->assertRedirect('/');
        $this->assertGuest();
    }

    /**
     * A logged in user can be logged out.
     *
     * @test
     */
    public function it_logout_an_authenticated_user()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post(route('logout'));

        $response->assertStatus(302);

        $this->assertGuest();
    }

    /**
     * @test
     */
    public function it_user_cannot_make_more_than_five_attempts_in_one_minute()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($password = 'secret'),
        ]);

        foreach (range(0, 5) as $_) {
            $response = $this->from(route('login'))->post(route('login'), [
                'email' => $user->email,
                'password' => 'invalid-password',
            ]);
        }

        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors('email');

        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }
}
