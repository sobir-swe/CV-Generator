<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProjectControllerTest extends TestCase
{
    use RefreshDatabase, InteractsWithDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $user = User::factory()->create();
        Sanctum::actingAs($user);
    }

    public function test_all_projects_can_be_listed()
    {
        Project::factory(4)->create();

        $response = $this->getJson('/api/projects');

        $response->assertStatus(200)
            ->assertJsonCount(4);
    }

    public function test_a_project_can_be_retrieved()
    {
        $project = Project::factory()->create();

        $response = $this->getJson("/api/projects/{$project->id}");
        $response->assertStatus(200)
            ->assertJson([
                'id' => $project->id,
                'user_id' => $project->user_id,
                'name' => $project->name,
                'description' => $project->description,
                'source_link' => $project->source_link,
                'demo_link' => $project->demo_link,
                "created_at" => $project->created_at->toISOString(),
                "updated_at" => $project->updated_at->toISOString(),
            ]);
    }

    public function test_a_project_can_be_created()
    {
        $response = $this->postJson('/api/projects', [
            'name' => $this->faker->word,
            'description' => $this->faker->text,
            'source_link' => $this->faker->url,
            'demo_link' => $this->faker->url,
        ]);

        $response->assertStatus(201)
            ->assertJsonFragment(['message' => 'Project created successfully']);
    }

    public function test_a_project_can_be_updated()
    {
        $project = Project::factory()->create();
        $response = $this->putJson("/api/projects/{$project->id}", [
            'name' => $this->faker->word,
            'description' => $this->faker->text,
            'source_link' => $this->faker->url,
            'demo_link' => $this->faker->url,
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Project updated successfully']);
    }

    public function test_a_project_can_be_deleted()
    {
        $project = Project::factory()->create();
        $response = $this->deleteJson("/api/projects/{$project->id}");
        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Project deleted successfully']);
    }
}
