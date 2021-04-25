<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class LoginFailedTest extends DuskTestCase
{
    use DatabaseMigrations;
    // use RefreshDatabase;
    //use DatabaseTransactions;
    /**
     * Test login function
     *
     * @return void
     */
    private $user;
    public function setUp(): void
    {

        parent::setUp();
        //$this->artisan('migrate:refresh');
        $this->user = User::factory()->create(
            [
                'email' => 'taylo101@laravel.com',
                'password' => Hash::make('password')
            ]
        );
    }
    

    public function testLoginFailed()
    {
        $user = $this->user;
        $this->browse(
            function ($browser) use ($user) {
                $browser->visit('/login')
                    ->type('email', $user->email)
                    ->type('password', 'password1')
                    ->press('Login')
                    ->assertSee('These credentials do not match our records.');
            }
        );
    }
}
