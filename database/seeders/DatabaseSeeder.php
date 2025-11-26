<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat user admin
    User::create([
            'nama' => 'Verbatama',
            'email' => 'verbatama@example.com',
            'password' => Hash::make('romeo@1120'),
            'role' => 'admin'
        ]);

        // Buat user biasa
        User::create([
            'nama' => 'Tegek',
            'email' => 'tegek@example.com',
            'password' => Hash::make('romeo@1120'),
            'role' => 'user'
        ]);

       
    }
}
