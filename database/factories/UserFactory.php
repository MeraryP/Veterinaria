<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'imagen' => $this->faker->imageUrl(), 
            'name' => $this->faker->name,
            'correo' => $this->faker->unique()->safeEmail,
            'nacimiento' => $this->faker->date(),
            'username' => $this->faker->userName,
            'password' => bcrypt('password'), 
            'identidad' => $this->faker->uuid, 
            'telefono' => $this->faker->phoneNumber,
            'estado' => $this->faker->randomElement([0, 1]),
            'remember_token' => Str::random(10),
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
