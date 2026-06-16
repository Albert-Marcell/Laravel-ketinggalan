<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * Urutan penting: Fakultas dulu, baru Prodi (karena Prodi berelasi ke Fakultas)
     */
    public function run(): void
    {
        // Seed Fakultas (harus sebelum Prodi)
        $this->call(FakultasSeeder::class);

        // Seed Prodi (berelasi ke Fakultas)
        $this->call(ProdiSeeder::class);

        // Seed User default untuk login
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name'     => 'Administrator',
                'password' => bcrypt('password'),
            ]
        );
    }
}
