<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks temporarily
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Clear the users table safely
        User::query()->delete();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Get role IDs
        $adminRoleId = DB::table('roles')->where('name', 'admin')->first()->id;
        $ownerRoleId = DB::table('roles')->where('name', 'owner')->first()->id;
        $marketingRoleId = DB::table('roles')->where('name', 'marketing')->first()->id;

        // Create admin user
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role_id' => $adminRoleId,
            'email_verified_at' => now(),
        ]);

        // Create owner user
        User::create([
            'name' => 'Business Owner',
            'email' => 'owner@example.com',
            'password' => Hash::make('password123'),
            'role_id' => $ownerRoleId,
            'email_verified_at' => now(),
        ]);

        // Create marketing user
        User::create([
            'name' => 'Marketing Staff',
            'email' => 'marketing@example.com',
            'password' => Hash::make('password123'),
            'role_id' => $marketingRoleId,
            'email_verified_at' => now(),
        ]);

        // Optional: Create additional marketing users
        User::create([
            'name' => 'Marketing Team Lead',
            'email' => 'marketing2@example.com',
            'password' => Hash::make('password123'),
            'role_id' => $marketingRoleId,
            'email_verified_at' => now(),
        ]);
    }
}
