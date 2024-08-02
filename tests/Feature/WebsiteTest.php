<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Website;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class WebsiteTest extends TestCase{

    #[Test]
    public function website_create() {
        $user = User::factory()->create([
            'password' => Hash::make('Asdasd123!'),
        ]);

        $response = $this->postJson('/api/v1/login', [
            'email' => $user->email,
            'password' => 'Asdasd123!',
        ]);

        $responseData = $response->collect()->toArray();
        $token = $responseData['token'];
        $data = [
            'url' => 'https://www.google.com',
        ];

        $response = $this->postJson('/api/v1/websites', $data, ['Authorization' => 'Bearer ' . $token,]);

        $response->assertStatus(201)
            ->assertJson([
                'result' => true
            ]);

        $this->assertDatabaseHas('websites', [
            'url' => $data['url'],
        ]);

        $website = Website::query()->where('url', $data['url'])->first();
        $this->assertNotNull($website);
        $this->assertNotNull($website->created_at);
        $this->assertNotNull($website->updated_at);
    }
}
