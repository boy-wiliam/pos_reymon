<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ambil role yang sudah dibuat oleh RoleSeeder
        $adminRole = Role::where('name', 'admin')->first();
        $kasirRole = Role::where('name', 'kasir')->first();

        // User Admin
        User::create([
            'role_id' => $adminRole->id,
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
        ]);

        // User Kasir
        User::create([
            'role_id' => $kasirRole->id,
            'name' => 'Kasir',
            'email' => 'kasir@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}