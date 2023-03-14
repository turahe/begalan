<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     *
     * @throws \Throwable
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->clickLink('Login')
                ->assertSee('E-Mail Address')
                ->type('email', 'developer@circlecreative.id')
                ->type('password', 'secret')
                ->press('Login')
                ->assertSee('You are logged in!');
        });
    }
}
