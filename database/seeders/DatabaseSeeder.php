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
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'role' => 'admin',
            'password' => Hash::make('admin123'),
        ]);

        // Akun Dosen
        User::create([
            'name' => 'Nuru Aini, S.Kom., M.Kom.',
            'email' => 'nuru.aini@trunojoyo.ac.id',
            'role' => 'dosen',
            'password' => Hash::make('nuru1234'),
        ]);

        // Akun Mahasiswa
        User::create([
            'name' => 'Fadli Maghfirli',
            'email' => '230631100012@student.trunojoyo.ac.id',
            'role' => 'mahasiswa',
            'password' => Hash::make('fadli123'),
        ]);
    }
}
