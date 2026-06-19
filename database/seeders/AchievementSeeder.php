<?php

namespace Database\Seeders;

use App\Models\Achievement;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
    public function run(): void
    {
        $achievements = [
            ['name' => 'Eco Starter',  'description' => 'Joined the EcoLife Hub community',                  'level' => 1],
            ['name' => 'Green Advocate','description' => 'Accumulated 50 minutes of physical activity',       'level' => 2],
            ['name' => 'Earth Guardian','description' => 'Accumulated 200 minutes of activity or scored 80+', 'level' => 3],
            ['name' => 'SDG Scholar',   'description' => 'Scored 90 or higher on the SDG quiz',              'level' => 4],
            ['name' => 'Planet Champion','description' => '500+ activity minutes and quiz score 90+',         'level' => 5],
        ];

        foreach ($achievements as $a) {
            Achievement::firstOrCreate(['level' => $a['level']], $a);
        }
    }
}
