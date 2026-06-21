<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $role = Role::where('nama_role', 'admin')->first();

        $user = User::where('email', 'legam@gmail.com')->first();

        if ($user) {
            $user->update(['id_role' => $role->id_role]);
            $this->command->info("User '{$user->name}' ({$user->email}) is now an admin.");
        } else {
            User::create([
                'name' => 'Kipliii',
                'email' => 'legam@gmail.com',
                'password' => bcrypt('password'),
                'id_role' => $role->id_role,
            ]);
            $this->command->info('Admin user created: legam@gmail.com / password');
        }
    }
}
