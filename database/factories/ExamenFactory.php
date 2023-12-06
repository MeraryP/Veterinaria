<?php

namespace Database\Factories;

use App\Models\Genero;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ExamenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'temperatura' => $this->faker->numberBetween(35, 42), // rango de temperatura en grados Celsius
            'frecuencia_cardiaca' => $this->faker->numberBetween(60, 120), // rango de pulsaciones por minuto
            'frecuencia_respiratoria' => $this->faker->numberBetween(12, 30), // respiraciones por minuto
            'peso' => $this->faker->randomFloat(2, 1, 100), // peso en kilogramos con 2 decimales
            'pulso' => $this->faker->numberBetween(60, 120), // igual al rango de la frecuencia cardiaca
            'num_id' => $this->faker->unique()->numberBetween(1, 2),
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
