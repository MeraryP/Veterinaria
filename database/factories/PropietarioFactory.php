<?php

namespace Database\Factories;

use App\Models\Propietario;
use App\Models\Genero;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropietarioFactory extends Factory
{
    protected $model = Propietario::class;

    public function definition()
    {
        return [
            'identidad' => $this->faker->unique()->numerify('########'), // Genera un número de identidad aleatorio
            'nombre' => $this->faker->name,
            'direccion' => $this->faker->address,
            'gene_id' => function () {
                return Genero::inRandomOrder()->first()->id;
            },
            'telefono' => $this->faker->phoneNumber,
            'correo' => $this->faker->unique()->safeEmail,
        ];
    }
}

