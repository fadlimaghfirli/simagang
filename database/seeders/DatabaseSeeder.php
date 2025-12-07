<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Admin
        User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@test.com',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        // Akun Dosen
        User::create([
            'name' => 'Pak Dosen',
            'email' => 'dosen@test.com',
            'role' => 'dosen',
            'password' => Hash::make('password'),
        ]);

        // Akun Mahasiswa
        User::create([
            'name' => 'Mahasiswa 1',
            'email' => 'mhs@test.com',
            'role' => 'mahasiswa',
            'password' => Hash::make('password'),
        ]);
    }
}
