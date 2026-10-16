<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat akun Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'admin'
        ]);

        // Membuat akun Karyawan
        User::create([
            'name' => 'Ghufran (Karyawan)',
            'email' => 'karyawan@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'karyawan'
        ]);
    }
}