<?php

namespace Tests;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    protected function demoAdminLoginIn()
    {
        $admin = User::create(
            [
                'name' => 'admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email' => 'admin@admin.com',
            ]
        );

        $this->be($admin);
    }

    protected function demoUserLoginIn()
    {
        $user = User::create(
            [
                'name' => 'user',
                'password' => Hash::make('password'),
                'role' => 'user',
                'email' => '123@123.com'
            ]
        );

        $this->be($user);
    }

    protected function initMock($class)
    {
        $mock = \Mockery::mock($class);
        $this->app->instance($class, $mock);

        return $mock;
    }
}
