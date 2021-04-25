<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Carbon\Carbon;
use App\Models\TimeTable;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Mockery;

class TimeTableTest extends TestCase
{

    use RefreshDatabase;

    public function setUp(): void
    {
        Carbon::setTestNow('2021-04-23 14:00:00');
        parent::setUp();
    }

    public function testIndex()
    {
        $this->demoAdminLoginIn();
        $response = $this->get('/timetable');
        $response->assertSee('車次');
    }
    
    public function testCreateFailed()
    {
        $this->demoAdminLoginIn();
        $mockTimeTable = Mockery::mock(TimeTable::class);
        $mockTimeTable->shouldReceive('getAvailableTimeTable')
            ->once()
            ->andReturn(false);
        $timeTable = $mockTimeTable->getAvailableTimeTable();

        $this->assertFalse($timeTable);
    }
}
