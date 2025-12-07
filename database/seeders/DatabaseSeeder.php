<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat satu akun admin tetap (jika belum ada -> create, jika ada -> update)
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'), // ganti sesuai kebutuhan
                'role' => 'admin',
            ]
        );

        // Buat akun test (jika belum ada)
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
                'role' => 'customer',
            ]
        );

        // Tambah beberapa user random (factory)
        User::factory()->count(8)->create();
    }
}
