<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic test example.
     */
    use RefreshDatabase;

    public function test_register_users(): void
    {
        $data = [
            'name' => "Neymar",
            'email' => "neymarzinho10@gmail.com",
            'password' => '12345678',
            'password_confirmation' => '12345678'
        ];

        $response = $this->postJson('/api/register', $data);

        $response->assertStatus(200);
        $response->assertJson([
            'user' => [
                'name' => 'Neymar',
                'email' => 'neymarzinho10@gmail.com',
            ],
        ]);    
    }

    public function test_login() {
        User::create([
            'name' => "Neymar",
            'email' => "neymarzinho10@gmail.com",
            'password' => '12345678',
            'password_confirmation' => '12345678'
        ]);

        $data = [
            'email' => "neymarzinho10@gmail.com",
            'password' => '12345678',
        ];

        $response = $this->postJson('/api/login', $data);

        $response->assertStatus(200)
            ->assertJsonStructure(['token'])
                ->assertJson(['token' => true]);
        
    }
}
