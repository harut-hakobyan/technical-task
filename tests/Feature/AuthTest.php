<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AuthTest extends TestCase {

    use RefreshDatabase;

    #[Test]
    public function user_login() {
        $user = User::factory()->create([
            'password' => Hash::make('Asdasd123!'),
        ]);

        $response = $this->postJson('/api/v1/login', [
            'email' => $user->email,
            'password' => 'Asdasd123!',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'token',
            ]);

        $token = $response->json('token');
        $this->assertNotNull($token);
    }

    #[Test]
    public function user_register(){
        $data = [
            'name' => 'Test',
            'email' => 'test@test.com',
            'password' => 'Asdasd123!',
            'password_confirmation' => 'Asdasd123!',
        ];

        $response = $this->postJson('/api/v1/auth/register', $data);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'token',
            ]);

        $this->assertDatabaseHas('users', [
            'email' => $data['email'],
        ]);

        $user = User::query()->where('email', $data['email'])->first();
        $this->assertNotNull($user);
    }
}
