<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ClinicoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'sintomas' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
        'enfermedad' => $this->faker->word, 
        'tratamiento' => $this->faker->sentence, 
        'num_id' => $this->faker->unique()->randomNumber(9),
        ];
    }

   
}
