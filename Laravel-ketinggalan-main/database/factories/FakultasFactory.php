<?php

namespace Database\Factories;

use App\Models\Fakultas;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fakultas>
 */
class FakultasFactory extends Factory
{
    protected $model = Fakultas::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fakFakultas = [
            'Fakultas Teknik',
            'Fakultas Ilmu Komputer',
            'Fakultas Ekonomi dan Bisnis',
            'Fakultas Hukum',
            'Fakultas Kedokteran',
            'Fakultas Pertanian',
            'Fakultas Ilmu Sosial dan Politik',
            'Fakultas Keguruan dan Ilmu Pendidikan',
            'Fakultas Matematika dan IPA',
            'Fakultas Psikologi',
        ];

        return [
            'name'  => $this->faker->unique()->randomElement($fakFakultas),
            'dekan' => 'Prof. Dr. ' . $this->faker->name('male') . ', M.T.',
        ];
    }
}
