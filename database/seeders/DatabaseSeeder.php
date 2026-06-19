<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call(RoleSeeder::class);

        $user1 = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);
        $user1->assignRole('user');

        $user2 = User::factory()->create([
            'name' => 'Kipliii',
            'email' => 'legam@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $user2->assignRole('admin');

        $this->call(ArticleSeeder::class);
        $this->call(AdminUserSeeder::class);
        $this->call(SdgSeeder::class);
        $this->call(QuizQuestionSeeder::class);
        $this->call(AchievementSeeder::class);
    }
}
