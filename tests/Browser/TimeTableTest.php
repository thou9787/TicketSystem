<?php

namespace Tests\Browser;

use App\Models\User;
use App\Models\TimeTable;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Support\Facades\Hash;

class TimeTableTest extends DuskTestCase
{
    use WithoutMiddleware;
    use DatabaseMigrations;

    public function testTimeTableButton()
    {
        $user = User::factory()->create(
            [
                'email' => 'aaa@bbb.com',
                'password' => Hash::make('password')
            ]
        );
        $timetable = TimeTable::create(
            [
                'trainDate' => '2021-04-21',
                'trainNo' => '0803',
                'originStationId' => '1000',
                'originStationName' => '台北',
                'destinationStationId' => '1020',
                'destinationStationName' => '桃園',
                'departureTime' => '06:26',
                'arrivalTime' => '06:47',
                'duration' => '00:21',
                'type' => 'business',
                'amount' => 6,
            ]
        );

        $this->browse(
            function ($browser) use ($user) {
                $browser->visit('/login')
                    ->type('email', $user->email)
                    ->type('password', 'password')
                    ->press('Login')
                    ->visit('/timetable')
                    ->press('確認訂票')
                    ->assertPathIs('/pay');
            }
        );
    }
}
