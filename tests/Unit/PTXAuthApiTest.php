<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\TestCase;
use App\ApiRequest\PTXApiAuth;
use ReflectionClass;
use Carbon\Carbon;

class PTXAuthApiTest extends TestCase
{
    public function setUp(): void
    {
        Carbon::setTestNow('2017-10-23 12:00:00');
        parent::setUp();
    }
    public function testGetTime()
    {
        $time = new PTXApiAuth();
        $reflection = new ReflectionClass($time);
        $result = $reflection->getMethod('getTime');
        $result->setAccessible(true);
        $result = $result->invoke($time);

        $this->assertEquals('Mon, 23 Oct 2017 12:00:00 GMT', $result);
    }

    public function testGetAuthHeaders()
    {
        $auth = new PTXApiAuth();

        $actual = $auth->getAuthHeaders()['http']['header'];
        $expect = "Authorization:hmac username=\"78c70050ed204b35bfb169173f58d555\", algorithm=\"hmac-sha1\", headers=\"x-date\", signature=\"yzkK3eH72IJa0n0SpiLyD7rT8Do=\"\nx-date: Mon, 23 Oct 2017 12:00:00 GMT\n";
        $this->assertEquals($expect, $actual);
    }
}
