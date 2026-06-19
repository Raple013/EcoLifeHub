<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $role = Role::firstOrCreate(['name' => 'admin']);

        $user = User::where('email', 'legam@gmail.com')->first();

        if ($user) {
            $user->assignRole('admin');
            $this->command->info("User '{$user->name}' ({$user->email}) is now an admin.");
        } else {
            $user = User::create([
                'name' => 'Kipliii',
                'email' => 'legam@gmail.com',
                'password' => bcrypt('password'),
            ]);
            $user->assignRole('admin');
            $this->command->info('Admin user created: legam@gmail.com / password');
        }
    }
}
