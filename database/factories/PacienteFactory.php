<?php

namespace Database\Factories;

use App\Models\Especie;
use App\Models\Genero;
use App\Models\Propietario;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class PacienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'filename' => $this->faker->imageUrl(),
            'nombre_mascota' => $this->faker->firstName(),
            'raza' => $this->faker->word,
            'fecha_nacimiento' => $this->faker->date(),
            'genero_id' => $this->faker->numberBetween(1,2),
            'pro_id' => $this->faker->numberBetween(1,10),
            'especie_id' => $this->faker->numberBetween(1,2),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
