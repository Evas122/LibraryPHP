<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $adminExists = User::where('role', 'admin')->exists();

        if (!$adminExists)
        {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('adminpassword'),
                'role' => 'admin',
                'verified' => true,
                'created_at' => Carbon::now(),
            ]);
            $this->command->info("Admin account was created");
        } else {
            $this->command->info("Admin account is already existed");
        }
    }
}
