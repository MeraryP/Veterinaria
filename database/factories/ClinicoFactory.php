<?php

namespace Database\Factories;

use App\Models\Clinico;
use App\Models\Paciente;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClinicoFactory extends Factory
{
    protected $model = Clinico::class;

    public function definition()
    {
        return [
            'num_id' => function () {
                return Paciente::inRandomOrder()->first()->id;
            },
            'sintomas' => $this->faker->sentence,
            'enfermedad' => $this->faker->word,
            'tratamiento' => $this->faker->sentence,
        ];
    }
}

