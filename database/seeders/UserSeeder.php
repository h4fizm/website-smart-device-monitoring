<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Tambahkan ini
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'role' => 'super-admin', // Ubah peran ke 'super-admin'
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Gunakan Hash::make untuk mengenkripsi kata sandi
        ]);
        User::create([
            'name' => 'Guest',
            'role' => 'guest', 
            'email' => 'guest@guest.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Gunakan Hash::make untuk mengenkripsi kata sandi
        ]);
    }
}
