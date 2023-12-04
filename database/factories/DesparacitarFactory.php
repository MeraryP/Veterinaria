<?php

namespace Database\Factories;

use App\Models\Desparacitar;
use App\Models\Paciente;
use App\Models\Medicamento;
use Illuminate\Database\Eloquent\Factories\Factory;

class DesparacitarFactory extends Factory
{
    protected $model = Desparacitar::class;

    public function definition()
    {
        return [
            'num_id' => function () {
                return Paciente::inRandomOrder()->first()->id;
            },
            'medi_id' => function () {
                return  Medicamento::inRandomOrder()->first()->id;
            },
            'dosis' => $this->faker->randomNumber(2), // Genera un número aleatorio de dos cifras como dosis
            'unidad_desparasitante' => $this->faker->randomElement(['ml', 'mg', 'tabletas', 'cucharaditas']),
            'fecha_aplicada' => $this->faker->date,
            'aplicada' => $this->faker->boolean,
        ];
    }
}
