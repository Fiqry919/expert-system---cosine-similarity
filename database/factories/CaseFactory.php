<?php

namespace Database\Factories;

use App\Models\admin\Aturan;
use App\Models\admin\Gejala;
use App\Models\admin\Penyakit;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use OutOfBoundsException;

class CaseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Aturan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kode' => $this->faker->numerify('G##'),
            'penyakit' => Penyakit::all()->random()->kode,
            'aturan' => Gejala::all()->random()->kode
        ];
    }
}
