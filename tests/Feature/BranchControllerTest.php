<?php

namespace Tests\Feature;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class BranchControllerTest extends TestCase
{
    use RefreshDatabase, InteractsWithDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $user = User::factory()->create();
        Sanctum::actingAs($user);
    }

    public function test_all_branch_can_be_listed()
    {
        Branch::factory(3)->create();

        $response = $this->getJson('/api/branches');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    public function test_a_branch_can_be_retrieved()
    {
        $branch = Branch::factory()->create();

        $response = $this->getJson("/api/branches/{$branch->id}");
        $response->assertStatus(200)
            ->assertJson([
                "id" => $branch->id,
                "name" => $branch->name,
                "address" => $branch->address,
            ]);
    }


    public function test_a_branch_can_be_created()
    {
        $response = $this->postJson('/api/branches', [
            "name" => $this->faker->name(),
            "address" => $this->faker->address(),
        ]);

        $response->assertStatus(201)
            ->assertJsonFragment(['message' => 'Created successfully']);
    }

    public function test_a_branch_can_be_updated()
    {
        $branch = Branch::factory()->create();
        $response = $this->putJson("/api/branches/{$branch->id}", [
            "name" => $this->faker->name(),
            "address" => $this->faker->address(),
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Updated successfully']);
    }

    public function test_a_branch_can_be_deleted()
    {
        $branch = Branch::factory()->create();
        $response = $this->deleteJson("/api/branches/{$branch->id}");
        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Deleted successfully']);
    }
}
