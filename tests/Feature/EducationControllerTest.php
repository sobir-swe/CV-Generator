<?php

namespace Tests\Feature;

use App\Models\Education;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class EducationControllerTest extends TestCase
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
        Education::factory(4)->create();
        $response = $this->getJson('/api/educations');

        $response->assertStatus(200)
            ->assertJsonCount(4);
    }

    public function test_a_experience_can_be_retrieved()
    {
        $education = Education::factory()->create();
        $response = $this->getJson("/api/educations/{$education->id}");
        $response->assertStatus(200)
            ->assertJson([
                'id' => $education->id,
                'user_id' => $education->user_id,
                'name' => $education->name,
                'description' => $education->description,
                'start_date' => $education->start_date,
                'end_date' => $education->end_date,
                'created_at' => $education->created_at->toISOString(),
                'updated_at' => $education->updated_at->toISOString(),
            ]);
    }

    public function test_a_experience_can_be_created()
    {
        $response = $this->postJson('/api/educations', [
            'name' => $this->faker->word,
            'description' => $this->faker->text,
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
        ]);
        $response->assertStatus(201)
            ->assertJson([
                'message' => 'Education created successfully',
                'status' => 'success'
            ]);
    }

    public function test_a_experience_can_be_updated()
    {
        $education = Education::factory()->create();
        $response = $this->putJson("/api/educations/{$education->id}", [
            'name' => $this->faker->word,
            'description' => $this->faker->text,
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
        ]);
        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Education updated successfully',
                'status' => 'success'
            ]);
    }

    public function test_a_experience_can_be_deleted()
    {
        $education = Education::factory()->create();
        $response = $this->deleteJson("/api/educations/{$education->id}");
        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Education deleted successfully',
                'status' => 'success'
            ]);
    }
}
