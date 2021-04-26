<?php

namespace Tests\Feature;

use App\ApiRequest\PTXRequest;
use App\Http\Requests\UpdateTicketRequest;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Carbon\Carbon;
use App\Models\Ticket;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class TicketTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        Carbon::setTestNow();
    }

    public function testIndex()
    {
        $this->demoAdminLoginIn();

        $response = $this->get('/ticket');

        $response->assertStatus(200);
    }
    public function testCreate()
    {
        $this->demoAdminLoginIn();

        $ticket = [
            'trainNo' => '1234',
            'originStationName' => '台北',
            'destinationStationName' => '台南',
            'departureTime' => '5:00:00',
            'arrivalTime' => '7:00:00',
            'fare' => '1350',
            'amount' => 1,
            'user_id' => 2,
            'trainDate' => '2021-04-21',
            'paid' => 1
        ];

        $response = $this->json('get', '/ticket/create', $ticket);

        $response->assertRedirect('/admin/tickets');
    }

    public function testStore()
    {
        $this->demoAdminLoginIn();
        $mockUser = Mockery::mock(Auth::class);
        $mockUser->shouldReceive('user')
            ->once()
            ->andReturn(2);
        $user = $mockUser->user();
        $ticket = [
            'trainNo' => '1234',
            'originStationName' => '台北',
            'originStationId' => '1000',
            'destinationStationName' => '台南',
            'destinationStationId' => '1070',
            'departureTime' => '5:00:00',
            'arrivalTime' => '7:00:00',
            'fare' => 1350,
            'user_id' => $user,
            'date' => '2021-04-21',

            'amount' => 1,
            'type' => 'business'
        ];
        $response = $this->json(
            'post',
            '/ticket',
            $ticket
        );
        $count = Ticket::count();
        $this->assertEquals(1, $count);
        $response->assertRedirect('/pay');
    }

    public function testUpdate()
    {
        $this->demoAdminLoginIn();
        Ticket::create(
            [
                'id' => '999',
                'trainNo' => '1234',
                'originStationName' => '台北',
                'originStationId' => '1000',
                'destinationStationName' => '台南',
                'destinationStationId' => '1070',
                'departureTime' => '5:00:00',
                'arrivalTime' => '7:00:00',
                'fare' => 1490,
                'amount' => 1,
                'user_id' => 2,
                'trainDate' => '2021-04-21',
                'paid' => 1
            ]
        );
        
        $response = $this->put(
            'ticket/999',
            ['user_id' => 4],
        );

        $response->assertRedirect('/');
    }

    public function testDestroy()
    {
        $this->demoAdminLoginIn();
        Ticket::create(
            [
                'id' => '999',
                'trainNo' => '1234',
                'originStationName' => '台北',
                'originStationId' => '1000',
                'destinationStationName' => '台南',
                'destinationStationId' => '1070',
                'departureTime' => '5:00:00',
                'arrivalTime' => '7:00:00',
                'fare' => 1490,
                'amount' => 1,
                'user_id' => 2,
                'trainDate' => '2021-04-21',
                'paid' => 1
            ]
        );
        $response = $this->delete(
            'ticket/999',
        );
        $response->assertRedirect('/');
    }
}
