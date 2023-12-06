<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class GeneroMascotaFactory extends Factory
{
<<<<<<< HEAD
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
=======
    protected $model = GeneroMascota::class;

>>>>>>> 125a16ae94a73d7a2c1eace0bd5d71f82ed10f2f
    public function definition()
    {
        return [
            'name' =>$this->faker->randomElement(['hembra', 'macho']),
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
