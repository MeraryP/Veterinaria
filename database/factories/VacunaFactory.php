<?php

namespace Database\Factories;


use App\Models\Vacuna;
use App\Models\Paciente;
use App\Models\Medicamento;
use Illuminate\Database\Eloquent\Factories\Factory;

class VacunaFactory extends Factory
{

    protected $model = Vacuna::class;

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
            'unidad' => $this->faker->randomElement(['mililitros', 'miligramos']),
            'fecha_aplicada' => $this->faker->date,
            'aplicada' => $this->faker->boolean,
            
        ];
    }
}
