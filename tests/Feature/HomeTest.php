<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Carbon\Carbon;

class HomeTest extends TestCase
{
    //use DatabaseTransactions;
    use RefreshDatabase;
    
    public function setUp(): void
    {
        # code...
        Carbon::setTestNow('2021-03-23 14:00:00');
        parent::setUp();
    }

    public function testLoggedInIndex()
    {
        $this->demoAdminLoginIn();

        $response = $this->get('/home');

        $response->assertSee('You are logged in!');
    }

    public function testNotLoggedInIndex()
    {
        $response = $this->get('/home');

        $response->assertRedirect('login');
    }
}
