<?php

namespace Tests\Feature;

use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class StatusControllerTest extends TestCase
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
        Status::factory(3)->create();

        $response = $this->getJson('/api/statuses');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    public function test_a_status_can_be_retrieved()
    {
        $status = Status::factory()->create();

        $response = $this->getJson("/api/statuses/{$status->id}");
        $response->assertStatus(200)
            ->assertJson([
                "id" => $status->id,
                "name" => $status->name,
            ]);
    }


    public function test_a_status_can_be_created()
    {
        $response = $this->postJson('/api/statuses', [
            "name" => $this->faker->name(),
        ]);

        $response->assertStatus(201)
            ->assertJsonFragment(['message' => 'Successfully created status!']);
    }

    public function test_a_status_can_be_updated()
    {
        $status = Status::factory()->create();
        $response = $this->putJson("/api/statuses/{$status->id}", [
            "name" => $this->faker->name(),
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Successfully updated status!']);
    }

    public function test_a_status_can_be_deleted()
    {
        $status = Status::factory()->create();
        $response = $this->deleteJson("/api/statuses/{$status->id}");
        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Successfully deleted status!']);
    }
}
