<?php

namespace Database\Factories;

use App\Models\GeneroMascota;
use Illuminate\Database\Eloquent\Factories\Factory;

class GeneroMascotaFactory extends Factory
{
    protected $model = Genero::class;

    public function definition()
    {

        return [
            'name' => $this->faker->name,
        ];
    }

}