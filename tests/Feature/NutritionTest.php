<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NutritionTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_log_food_manually()
    {
        $user = User::factory()->create();
        $user->assignRole('user');

        $response = $this->actingAs($user)->post(route('nutrition.manual'), [
            'food_name' => 'Nasi Goreng',
            'meal_type' => 'makanan_berat',
            'calories' => 500,
            'protein_g' => 20,
            'carbs_g' => 60,
            'sugar_g' => 5,
            'fat_g' => 15,
        ]);

        $response->assertRedirect(route('nutrition.history'));

        $this->assertDatabaseHas('nutrition_logs', [
            'user_id' => $user->id,
            'food_name' => 'Nasi Goreng',
            'calories' => 500,
        ]);
    }

    public function test_nutrition_history_page_is_accessible()
    {
        $user = User::factory()->create();
        $user->assignRole('user');

        $response = $this->actingAs($user)->get(route('nutrition.history'));

        $response->assertStatus(200);
    }

    public function test_nutrition_index_page_shows_summary()
    {
        $user = User::factory()->create();
        $user->assignRole('user');

        $response = $this->actingAs($user)->get(route('nutrition.index'));

        $response->assertStatus(200);
    }
}
