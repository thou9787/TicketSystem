<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class NavBarButtonNotLoginTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * Test Nav bar button Index
     *
     * @return void
     */
    public function testIndexButtonNotLogin()
    {
        $this->browse(
            function ($browser) {
                $browser->visit('/login')
                        ->click('@index-button')
                        ->assertPathIs('/login');
            }
        );
    }

    /**
     * Test Nav bar button History
     *
     * @return void
     */
    public function testHistoryButtonNotLogin()
    {
        $this->browse(
            function ($browser) {
                $browser->visit('/login')
                        ->click('@history-button')
                        ->assertPathIs('/login');
            }
        );
    }
    
    /**
     * Test Nav bar button Login
     *
     * @return void
     */
    public function testLoginButtonNotLogin()
    {
        $this->browse(
            function ($browser) {
                $browser->visit('/login')
                        ->click('@login-button')
                        ->assertPathIs('/login');
            }
        );
    }

    /**
     * Test Nav bar button Register
     *
     * @return void
     */
    public function testRegisterButtonNotLogin()
    {
        $this->browse(
            function ($browser) {
                $browser->visit('/login')
                        ->click('@register-button')
                        ->assertPathIs('/register');
            }
        );
    }
}
