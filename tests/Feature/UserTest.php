<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserTest extends TestCase
{
    use WithoutMiddleware;
    use RefreshDatabase;

    public function testCreate()
    {
        $this->demoAdminLoginIn();
        $user = [
            'name' => 'Kent',
            'email' => 'a@b.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ];

        $response = $this->json('get', '/user/create', $user);
        
        $response->assertStatus(302);
    }

    public function testUpdate()
    {

        User::factory()->create(
            [
                'id' => 999,
                'name' => 'apple',
                'email' => 'a@bc.com',
                'password' => Hash::make('password'),
                'role' => 'user'
            ]
        );
        $this->demoAdminLoginIn();

        $response = $this->put(
            '/user/999',
            ['name' => 'banana'],
        );

        $response->assertStatus(302);
    }

    public function testDelete()
    {

        User::factory()->create(
            [
                'id' => 999,
                'name' => 'apple',
                'email' => 'a@bc.com',
                'password' => Hash::make('password'),
                'role' => 'user'
            ]
        );
        $this->demoAdminLoginIn();

        $response = $this->delete(
            '/user/999'
        );

        $response->assertStatus(302);
    }
}
