<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class RegisterTest extends DuskTestCase
{
    use DatabaseMigrations;
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:refresh');
        $this->withoutExceptionHandling();
    }

    public function testRegister()
    {
        $this->browse(
            function ($browser) {
                $browser->visit('/register')
                    ->type('name', 'Kent')
                    ->type('email', 'a@b.com')
                    ->type('password', '1234qwer')
                    ->type('password_confirmation', '1234qwer')
                    ->press('Register');
            }
        );

        $this->assertDatabaseHas(
            'users',
            [
                'name' => 'Kent',
                'email' => 'a@b.com',
            ]
        );
    }
}
