<?php

namespace Database\Seeders;

use App\Models\Fakultas;
use App\Models\Prodi;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Mengisi data Prodi yang realistis berelasi ke Fakultas.
     */
    public function run(): void
    {
        // Ambil atau buat Fakultas jika belum ada
        $teknik  = Fakultas::firstOrCreate(
            ['name' => 'Fakultas Teknik'],
            ['dekan' => 'Prof. Dr. Ir. Budi Santoso, M.T.']
        );
        $ilkom   = Fakultas::firstOrCreate(
            ['name' => 'Fakultas Ilmu Komputer'],
            ['dekan' => 'Prof. Dr. Andi Wijaya, M.Kom.']
        );
        $ekonomi = Fakultas::firstOrCreate(
            ['name' => 'Fakultas Ekonomi dan Bisnis'],
            ['dekan' => 'Dr. Siti Rahayu, M.M.']
        );
        $hukum   = Fakultas::firstOrCreate(
            ['name' => 'Fakultas Hukum'],
            ['dekan' => 'Prof. Dr. H. Ahmad Fauzi, S.H., M.H.']
        );
        $kip     = Fakultas::firstOrCreate(
            ['name' => 'Fakultas Keguruan dan Ilmu Pendidikan'],
            ['dekan' => 'Dr. Rina Wulandari, M.Pd.']
        );

        $prodiData = [
            // Teknik
            ['fakultas_id' => $teknik->id,  'nama_prodi' => 'Teknik Elektro',  'nama_kaprodi' => 'Dr. Hendra Kurniawan, M.T.'],
            ['fakultas_id' => $teknik->id,  'nama_prodi' => 'Teknik Mesin',    'nama_kaprodi' => 'Dr. Ir. Suryadi, M.T.'],
            ['fakultas_id' => $teknik->id,  'nama_prodi' => 'Teknik Sipil',    'nama_kaprodi' => 'Dr. Bambang Purnomo, M.T.'],

            // Ilkom
            ['fakultas_id' => $ilkom->id,   'nama_prodi' => 'Teknik Informatika', 'nama_kaprodi' => 'Dr. Dian Permata, M.Kom.'],
            ['fakultas_id' => $ilkom->id,   'nama_prodi' => 'Sistem Informasi',   'nama_kaprodi' => 'Dr. Agus Pratama, M.Kom.'],
            ['fakultas_id' => $ilkom->id,   'nama_prodi' => 'Ilmu Komputer',      'nama_kaprodi' => 'Dr. Fitri Handayani, M.Cs.'],

            // Ekonomi
            ['fakultas_id' => $ekonomi->id, 'nama_prodi' => 'Manajemen',    'nama_kaprodi' => 'Dr. Indah Kusuma, M.M.'],
            ['fakultas_id' => $ekonomi->id, 'nama_prodi' => 'Akuntansi',    'nama_kaprodi' => 'Dr. Reza Nugroho, M.Ak.'],
            ['fakultas_id' => $ekonomi->id, 'nama_prodi' => 'Ekonomi Pembangunan', 'nama_kaprodi' => 'Dr. Maya Susanti, M.E.'],

            // Hukum
            ['fakultas_id' => $hukum->id,   'nama_prodi' => 'Ilmu Hukum',   'nama_kaprodi' => 'Dr. Wahyu Prasetyo, S.H., M.H.'],

            // KIP
            ['fakultas_id' => $kip->id,     'nama_prodi' => 'Pendidikan Matematika', 'nama_kaprodi' => 'Dr. Lestari Dewi, M.Pd.'],
            ['fakultas_id' => $kip->id,     'nama_prodi' => 'Pendidikan Bahasa Inggris', 'nama_kaprodi' => 'Dr. Yuni Astuti, M.Pd.'],
        ];

        foreach ($prodiData as $data) {
            Prodi::firstOrCreate(
                ['nama_prodi' => $data['nama_prodi'], 'fakultas_id' => $data['fakultas_id']],
                array_merge($data, ['foto_kaprodi' => null])
            );
        }
    }
}
