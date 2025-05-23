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
        User::query()->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Get role IDs
        $adminRoleId = DB::table('roles')->where('name', 'admin')->first()->id;
        $ownerRoleId = DB::table('roles')->where('name', 'owner')->first()->id;
        $marketingRoleId = DB::table('roles')->where('name', 'marketing')->first()->id;
        $financeRoleId = DB::table('roles')->where('name', 'finance')->first()->id;
        $teknisiRoleId = DB::table('roles')->where('name', 'teknisi')->first()->id;

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

        // Create marketing users
        User::create([
            'name' => 'Marketing Staff',
            'email' => 'marketing@example.com',
            'password' => Hash::make('password123'),
            'role_id' => $marketingRoleId,
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Marketing Team Lead',
            'email' => 'marketing2@example.com',
            'password' => Hash::make('password123'),
            'role_id' => $marketingRoleId,
            'email_verified_at' => now(),
        ]);

        // Create finance user
        User::create([
            'name' => 'Finance Staff',
            'email' => 'finance@example.com',
            'password' => Hash::make('password123'),
            'role_id' => $financeRoleId,
            'email_verified_at' => now(),
        ]);

        // Create teknisi user
        User::create([
            'name' => 'Teknisi Lapangan',
            'email' => 'teknisi@example.com',
            'password' => Hash::make('password123'),
            'role_id' => $teknisiRoleId,
            'email_verified_at' => now(),
        ]);
    }
}
