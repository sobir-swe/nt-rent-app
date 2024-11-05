<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class RoleControllerTest extends TestCase
{
    use RefreshDatabase, InteractsWithDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $user = User::factory()->create();
        Sanctum::actingAs($user);
    }

    public function test_all_status_can_be_listed()
    {
        Role::factory(3)->create();

        $response = $this->getJson('/api/roles');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    public function test_a_status_can_be_retrieved()
    {
        $role = Role::factory()->create();

        $response = $this->getJson("/api/roles/{$role->id}");
        $response->assertStatus(200)
            ->assertJson([
                "id" => $role->id,
                "name" => $role->name,
            ]);
    }


    public function test_a_status_can_be_created()
    {
        $response = $this->postJson('/api/roles', [
            "name" => $this->faker->name(),
        ]);

        $response->assertStatus(201)
            ->assertJsonFragment(['message' => 'Successfully created status!']);
    }

    public function test_a_status_can_be_updated()
    {
        $role = Role::factory()->create();
        $response = $this->putJson("/api/roles/{$role->id}", [
            "name" => $this->faker->name(),
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Successfully updated status!']);
    }

    public function test_a_status_can_be_deleted()
    {
        $role = Role::factory()->create();
        $response = $this->deleteJson("/api/roles/{$role->id}");
        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Successfully deleted status!']);
    }
}
