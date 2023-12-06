<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class DesparacitarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'dosis' => $this->faker->randomNumber(2), 
            'unidad' => $this->faker->randomElement(['mililitros', 'miligramos']),
            'unidad_desparasitante' => $this->faker->randomElement(['ml', 'mg', 'tabletas']),
            'fecha_aplicada' => $this->faker->date(), 
            'aplicada' => $this->faker->boolean, 
            'num_id' => $this->faker->randomNumber(9), 
            'medi_id' => $this->faker->randomNumber(9),
        ];
    }

  
}
