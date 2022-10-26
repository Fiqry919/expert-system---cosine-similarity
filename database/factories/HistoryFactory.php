<?php

namespace Database\Factories;

use App\Models\admin\History;
use App\Models\admin\Penyakit;
use Illuminate\Database\Eloquent\Factories\Factory;

class HistoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = History::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->uuid,
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'penyakit' => Penyakit::all()->random()->nama_penyakit,
        ];
    }
}
