<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Carbon\Carbon;

class AdminTest extends TestCase
{
    //use DatabaseMigrations;
    use RefreshDatabase;
    
    public function setUp(): void
    {
        # code...
        Carbon::setTestNow('2021-03-23 14:00:00');
        parent::setUp();
    }

    public function testShowAllTickets()
    {
        $users = User::factory(10)->create();
        $tickets = Ticket::factory(10)->create();
        $this->demoAdminLoginIn();
        $response = $this->get('/admin/tickets');

        $response->assertViewHas('tickets');
    }

    public function testShowAllUsers()
    {
        $this->demoAdminLoginIn();
        $users = User::factory(10)->create();
        
        $response = $this->get('/admin/users');

        $response->assertViewHas('users');
    }
}
