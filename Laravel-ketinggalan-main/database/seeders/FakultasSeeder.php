<?php

namespace Database\Seeders;

use App\Models\Fakultas;
use Illuminate\Database\Seeder;

class FakultasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Mengisi data Fakultas yang realistis untuk keperluan pengujian.
     */
    public function run(): void
    {
        $fakultasData = [
            ['name' => 'Fakultas Teknik',                        'dekan' => 'Prof. Dr. Ir. Budi Santoso, M.T.'],
            ['name' => 'Fakultas Ilmu Komputer',                 'dekan' => 'Prof. Dr. Andi Wijaya, M.Kom.'],
            ['name' => 'Fakultas Ekonomi dan Bisnis',            'dekan' => 'Dr. Siti Rahayu, M.M.'],
            ['name' => 'Fakultas Hukum',                         'dekan' => 'Prof. Dr. H. Ahmad Fauzi, S.H., M.H.'],
            ['name' => 'Fakultas Keguruan dan Ilmu Pendidikan',  'dekan' => 'Dr. Rina Wulandari, M.Pd.'],
        ];

        foreach ($fakultasData as $data) {
            Fakultas::firstOrCreate(['name' => $data['name']], $data);
        }
    }
}
