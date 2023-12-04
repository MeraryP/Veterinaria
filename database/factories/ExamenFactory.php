<?php

namespace Database\Factories;

use App\Models\Examen;
use App\Models\Paciente;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExamenFactory extends Factory
{
    protected $model = Examen::class;

    public function definition()
    {
        return [
            'num_id' => function () {
                return Paciente::inRandomOrder()->first()->id;
            },
            'temperatura' => $this->faker->numberBetween(36, 39), // Genera una temperatura aleatoria entre 36 y 39 grados Celsius
            'frecuencia_cardiaca' => $this->faker->numberBetween(60, 100), // Genera una frecuencia cardíaca aleatoria entre 60 y 100 latidos por minuto
            'frecuencia_respiratoria' => $this->faker->numberBetween(12, 20), // Genera una frecuencia respiratoria aleatoria entre 12 y 20 respiraciones por minuto
            'peso' => $this->faker->numberBetween(1, 30), // Genera un peso aleatorio entre 1 y 30 kilogramos
            'pulso' => $this->faker->numberBetween(60, 100), // Genera un pulso aleatorio entre 60 y 100 pulsos por minuto
        ];
    }
}

