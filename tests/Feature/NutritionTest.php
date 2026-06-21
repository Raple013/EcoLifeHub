<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NutritionTest extends TestCase
{
    use RefreshDatabase;

    private function createUser(): User
    {
        $role = Role::create(['nama_role' => 'user']);
        return User::factory()->create(['id_role' => $role->id_role]);
    }

    public function test_user_can_log_food_manually()
    {
        $user = $this->createUser();

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

        $this->assertDatabaseHas('meal_logs', [
            'user_id' => $user->id,
            'food_name' => 'Nasi Goreng',
            'calories' => 500,
        ]);
    }

    public function test_nutrition_history_page_is_accessible()
    {
        $user = $this->createUser();

        $response = $this->actingAs($user)->get(route('nutrition.history'));

        $response->assertStatus(200);
    }

    public function test_nutrition_index_page_shows_summary()
    {
        $user = $this->createUser();

        $response = $this->actingAs($user)->get(route('nutrition.index'));

        $response->assertStatus(200);
    }
}
