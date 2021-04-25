<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\TimeTable;

class PageTest extends TestCase
{
    //use DatabaseTransactions;
    use RefreshDatabase;
    use WithoutMiddleware;

    public function setUp(): void
    {
        Carbon::setTestNow('2021-03-23 14:00:00');
        parent::setUp();
    }

    public function testLoggedInForm()
    {
        $this->demoAdminLoginIn();

        $response = $this->get('/form');

        $response->assertSee('Date');
    }

    public function testNotLoggedInForm()
    {
        
        $response = $this->get('/form');
        
        $response->assertStatus(302)
            ->assertRedirect('/login');
    }

    public function testLoggedInSuccess()
    {
        $this->demoAdminLoginIn();

        TimeTable::factory(1)->create();

        $response = $this->get('/success');
        
        $this->artisan('migrate:refresh');

        $count = TimeTable::count();
        $this->assertEquals(0, $count);
        $response->assertSee('You are finish the booking!!!');
    }

    public function testNotLoggedInSuccess()
    {
        $response = $this->get('/success');

        $response->assertRedirect('/login');
    }

    public function testLoggedInPay()
    {
        $this->demoAdminLoginIn();

        $response = $this->get('/pay');

        $response->assertSee('訂票明細');
    }

    public function testNotLoggedInPay()
    {
        $response = $this->get('/pay');

        $response->assertRedirect('/login');
    }

    public function testLoggedInHistory()
    {
        $this->demoAdminLoginIn();

        $response = $this->get('/history');

        $response->assertSee('車次');
    }

    public function testNotLoggedInHistory()
    {
        $response = $this->get('/history');

        $response->assertRedirect('/login');
    }
}
