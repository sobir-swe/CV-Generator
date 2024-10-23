<?php

namespace Tests\Feature;

use App\Models\Experience;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ExperienceControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $user = User::factory()->create();
        Sanctum::actingAs($user);
    }

    public function test_all_can_be_listed()
    {
        Experience::factory(4)->create();
        $response = $this->getJson('/api/experiences');

        $response->assertStatus(200)
            ->assertJsonCount(4);
    }

    public function test_a_experience_can_be_retrieved()
    {
        $experience = Experience::factory()->create();
        $response = $this->getJson("/api/experiences/{$experience->id}");
        $response->assertStatus(200)
            ->assertJson([
                'id' => $experience->id,
                'user_id' => $experience->user_id,
                'name' => $experience->name,
                'description' => $experience->description,
                'position' => $experience->position,
                'start_date' => $experience->start_date,
                'end_date' => $experience->end_date,
                'created_at' => $experience->created_at->toISOString(),
                'updated_at' => $experience->updated_at->toISOString(),
            ]);
    }

    public function test_a_experience_can_be_created()
    {
        $response = $this->postJson('/api/experiences', [
            'name' => $this->faker->word,
            'description' => $this->faker->text,
            'position' => $this->faker->word,
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
        ]);
        $response->assertStatus(201)
            ->assertJson([
                'message' => 'Experience created successfully',
                'status' => 'success'
            ]);
    }

    public function test_a_experience_can_be_updated()
    {
        $experience = Experience::factory()->create();
        $response = $this->putJson("/api/experiences/{$experience->id}", [
            'name' => $this->faker->word,
            'description' => $this->faker->text,
            'position' => $this->faker->word,
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
        ]);
        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Experience updated successfully',
                'status' => 'success'
            ]);
    }

    public function test_a_experience_can_be_deleted()
    {
        $experience = Experience::factory()->create();
        $response = $this->deleteJson("/api/experiences/{$experience->id}");
        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Experience deleted successfully',
                'status' => 'success'
            ]);
    }
}
