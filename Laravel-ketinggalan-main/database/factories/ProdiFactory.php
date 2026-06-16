<?php

namespace Database\Factories;

use App\Models\Fakultas;
use App\Models\Prodi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prodi>
 */
class ProdiFactory extends Factory
{
    protected $model = Prodi::class;

    /**
     * Define the model's default state.
     * Otomatis berelasi ke Fakultas yang ada atau membuat baru.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $namaProdi = [
            'Teknik Informatika',
            'Sistem Informasi',
            'Teknik Elektro',
            'Teknik Mesin',
            'Teknik Sipil',
            'Manajemen',
            'Akuntansi',
            'Ilmu Komunikasi',
            'Hukum',
            'Kedokteran',
            'Agroteknologi',
            'Pendidikan Matematika',
            'Biologi',
            'Psikologi',
            'Sastra Inggris',
            'Desain Komunikasi Visual',
            'Arsitektur',
            'Kimia',
            'Fisika',
            'Statistika',
        ];

        return [
            'fakultas_id'  => Fakultas::inRandomOrder()->first()?->id ?? Fakultas::factory(),
            'nama_prodi'   => $this->faker->unique()->randomElement($namaProdi),
            'nama_kaprodi' => 'Dr. ' . $this->faker->name() . ', M.Kom.',
            // Gunakan placeholder gambar (karena tidak bisa upload file nyata via factory)
            'foto_kaprodi' => null,
        ];
    }
}
