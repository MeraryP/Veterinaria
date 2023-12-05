<?php

namespace Database\Factories;

use App\Models\Paciente;
use App\Models\Propietario;
use App\Models\GeneroMascota;
use App\Models\Especie;
use Illuminate\Database\Eloquent\Factories\Factory;

class PacienteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Paciente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'filename' => $this->faker->word . '.jpg', 
            'nombre_mascota' => $this->faker->name,
            'pro_id' => function () {
                return Propietario::inRandomOrder()->first()->id;
            },
            'especie_id' => function () {
                return  Especie::inRandomOrder()->first()->id;
            },
            'genero_id' => function () {
                return GeneroMascota::inRandomOrder()->first()->id;
            },
            'raza' => $this->faker->word,
            'fecha_nacimiento' => $this->faker->date,
        ];
    }
}
