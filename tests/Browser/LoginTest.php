<?php

namespace Tests\Browser;

use App\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test for logging in.
     *
     * @return void
     * @throws Throwable
     */
    public function testGuestLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('LOGIN')
                    ->clickLink('Login')
                    ->type('email', 'test@gmail.com')
                    ->type('password', 'secret')
                    ->press('Login')
                    ->assertPathIs('/home');
        });
    }

    /** @test
     * @throws Throwable
     */
    public function testAuthentication()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::findOrFail(11))
                ->visit('/admin')
                ->assertSee('Dashboard');
        });
    }
}
