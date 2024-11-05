<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase, InteractsWithDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $user = User::factory()->create();
        Sanctum::actingAs($user);
    }

    public function test_all_users_can_be_listed()
    {
        User::factory(3)->create();

        $response = $this->getJson('/api/users');

        $response->assertStatus(200)
            ->assertJsonCount(4);
    }

    public function test_a_user_can_be_retrieved()
    {
        $user = User::factory()->create();

        $response = $this->getJson("/api/users/{$user->id}");
        $response->assertStatus(200)
            ->assertJson([
                "id" => $user->id,
                "name" => $user->name,
                "email" => $user->email,
                "phone" => $user->phone,
                "gender" => $user->gender,
                "position" => $user->position,
                "created_at" => $user->created_at->toISOString(),
                "updated_at" => $user->updated_at->toISOString(),
            ]);
    }


    public function test_a_user_can_be_created()
    {
        $response = $this->postJson('/api/users', [
            "name" => $this->faker->name(),
            "email" => $this->faker->unique()->safeEmail(),
            "password" => $this->faker->password(),
            "phone" => $this->faker->phoneNumber(),
            "position" => $this->faker->jobTitle(),
            "gender" => $this->faker->randomElement(['male', 'female']),
        ]);

        $response->assertStatus(201)
            ->assertJsonFragment(['message' => 'User created successfully']);
    }

    public function test_a_user_can_be_updated()
    {
        $user = User::factory()->create();
        $response = $this->putJson("/api/users/{$user->id}", [
            "name" => $this->faker->name(),
            "email" => $this->faker->unique()->safeEmail(),
            "password" => $this->faker->password(),
            "phone" => $this->faker->phoneNumber(),
            "position" => $this->faker->jobTitle(),
            "gender" => $this->faker->randomElement(['male', 'female']),
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'User updated successfully']);
    }

    public function test_a_user_can_be_deleted()
    {
        $user = User::factory()->create();
        $response = $this->deleteJson("/api/users/{$user->id}");
        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'User deleted successfully']);
    }
}
