<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call(RoleSeeder::class);

        $roleUser = Role::where('nama_role', 'user')->first();
        $roleAdmin = Role::where('nama_role', 'admin')->first();

        $user1 = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'id_role' => $roleUser->id_role,
        ]);

        User::factory()->create([
            'name' => 'Kipliii',
            'email' => 'legam@gmail.com',
            'password' => bcrypt('password'),
            'id_role' => $roleAdmin->id_role,
        ]);

        $this->call(ArticleSeeder::class);
        $this->call(AdminUserSeeder::class);
        $this->call(SdgSeeder::class);
        $this->call(QuizQuestionSeeder::class);
        $this->call(AchievementSeeder::class);
    }
}
