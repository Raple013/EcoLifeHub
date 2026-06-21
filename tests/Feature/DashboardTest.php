<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_page_is_accessible()
    {
        $role = Role::create(['nama_role' => 'user']);
        $user = User::factory()->create(['id_role' => $role->id_role]);

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertStatus(200);
    }
}
