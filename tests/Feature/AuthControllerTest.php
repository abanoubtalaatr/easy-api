<?php

namespace Tests\Feature\Admin\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use DatabaseMigrations;
    use WithFaker;

    public function test_login_success()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);

        $payload = [
            'email' => $user->email,
            'password' => 'password123',
        ];

        $response = $this->postJson('/api/admin/auth/login', $payload);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'user' => [
                    'id',
                    'name',
                    'email',
                    // Add other user properties you want to test
                ],
                'token',
            ]);
    }

    public function test_login_failure()
    {
        $payload = [
            'email' => $this->faker->email,
            'password' => $this->faker->password,
        ];

        $response = $this->postJson('/api/admin/auth/login', $payload);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email' => 'The provided credentials are incorrect.']);
    }
}
