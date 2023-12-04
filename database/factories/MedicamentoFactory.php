<?php

namespace Database\Factories;

use App\Models\Medicamento;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicamentoFactory extends Factory
{
    protected $model = Medicamento::class;

    public function definition()
    {
        return [
            'nombre_medicamento' => $this->faker->word, // Genera una palabra aleatoria como nombre de medicamento
            'cate_id' => function () {
                return  Categoria::inRandomOrder()->first()->id;
            },
        ];
    }
}

