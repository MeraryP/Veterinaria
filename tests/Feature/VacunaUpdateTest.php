<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Vacuna;

class VacunaUpdateTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_vacuna_se_actualiza_correctamente()
    {
        $vacuna = Vacuna::factory()->create();
        $datosActualizados = [
            'num_id' => $vacuna->num_id,
            'medi_id' => $vacuna->medi_id,
            'dosis' => 10,
            'unidad' => 'mililitros',
            'fecha_aplicada' => '2022-01-01',
            'aplicada' => 1,
        ];

        $response = $this->put("/vacuna/{$vacuna->id}", $datosActualizados);

        $response->assertRedirect(route('vacunaMascota', ['id' => $vacuna->num_id]));
        $response->assertSessionHas('mensaje', 'El registro fue modificado exitosamente.');
        $this->assertDatabaseHas('vacunas', $datosActualizados);
    }

    public function test_vacuna_no_se_actualiza_si_no_existe()
    {
        $datosActualizados = [
            'num_id' => 1,
            'medi_id' => 1,
            'dosis' => 10,
            'unidad' => 'mililitros',
            'fecha_aplicada' => '2022-01-01',
            'aplicada' => 1,
        ];

        $response = $this->put("/vacuna/99999", $datosActualizados);

        $response->assertStatus(404);
    }

    public function test_vacuna_no_se_actualiza_con_datos_invalidos()
    {
        $vacuna = Vacuna::factory()->create();
        $datosInvalidos = [
            'num_id' => null,
            'medi_id' => null,
            'dosis' => -1,
            'unidad' => 'litros',
            'fecha_aplicada' => 'fecha invalida',
            'aplicada' => null,
        ];

        $response = $this->put("/vacuna/{$vacuna->id}", $datosInvalidos);

        $response->assertSessionHasErrors([
            'num_id',
            'medi_id',
            'dosis',
            'unidad',
            'fecha_aplicada',
            'aplicada',
        ]);
    }

    public function test_vacuna_no_se_actualiza_con_num_id_inexistente()
    {
        $vacuna = Vacuna::factory()->create();
        $datosActualizados = [
            'num_id' => 99999,
            'medi_id' => $vacuna->medi_id,
            'dosis' => 10,
            'unidad' => 'mililitros',
            'fecha_aplicada' => '2022-01-01',
            'aplicada' => 1,
        ];

        $response = $this->put("/vacuna/{$vacuna->id}", $datosActualizados);

        $response->assertSessionHasErrors(['num_id']);
    }

    public function test_vacuna_no_se_actualiza_sin_num_id()
    {
        $vacuna = Vacuna::factory()->create();
        $datosActualizados = [
            'num_id' => null,
            'medi_id' => $vacuna->medi_id,
            'dosis' => 10,
            'unidad' => 'mililitros',
            'fecha_aplicada' => '2022-01-01',
            'aplicada' => 1,
        ];

        $response = $this->put("/vacuna/{$vacuna->id}", $datosActualizados);

        $response->assertSessionHasErrors(['num_id']);
    }

    public function test_vacuna_no_se_actualiza_con_num_id_no_numerico()
    {
        $vacuna = Vacuna::factory()->create();
        $datosActualizados = [
            'num_id' => 'abc', // num_id no es un número
            'medi_id' => $vacuna->medi_id,
            'dosis' => 10,
            'unidad' => 'mililitros',
            'fecha_aplicada' => '2022-01-01',
            'aplicada' => 1,
        ];

        $response = $this->put("/vacuna/{$vacuna->id}", $datosActualizados);

        $response->assertSessionHasErrors(['num_id']);
    }

    public function test_vacuna_no_se_actualiza_con_medi_id_inexistente()
    {
        $vacuna = Vacuna::factory()->create();
        $datosActualizados = [
            'num_id' => $vacuna->num_id,
            'medi_id' => 99999,
            'dosis' => 10,
            'unidad' => 'mililitros',
            'fecha_aplicada' => '2022-01-01',
            'aplicada' => 1,
        ];

        $response = $this->put("/vacuna/{$vacuna->id}", $datosActualizados);

        $response->assertSessionHasErrors(['medi_id']);
    }

    public function test_vacuna_no_se_actualiza_sin_medi_id()
    {
        $vacuna = Vacuna::factory()->create();
        $datosActualizados = [
            'num_id' => $vacuna->num_id,
            'medi_id' => null,
            'dosis' => 10,
            'unidad' => 'mililitros',
            'fecha_aplicada' => '2022-01-01',
            'aplicada' => 1,
        ];

        $response = $this->put("/vacuna/{$vacuna->id}", $datosActualizados);

        $response->assertSessionHasErrors(['medi_id']);
    }

    public function test_vacuna_no_se_actualiza_con_medi_id_no_numerico()
    {
        $vacuna = Vacuna::factory()->create();
        $datosActualizados = [
            'num_id' => $vacuna->num_id,
            'medi_id' => 'abc', // medi_id no es un número
            'dosis' => 10,
            'unidad' => 'mililitros',
            'fecha_aplicada' => '2022-01-01',
            'aplicada' => 1,
        ];

        $response = $this->put("/vacuna/{$vacuna->id}", $datosActualizados);

        $response->assertSessionHasErrors(['medi_id']);
    }

    public function test_vacuna_no_se_actualiza_sin_dosis()
    {
        $vacuna = Vacuna::factory()->create();
        $datosActualizados = [
            'num_id' => $vacuna->num_id,
            'medi_id' => $vacuna->medi_id,
            'dosis' => null, // dosis no proporcionada
            'unidad' => 'mililitros',
            'fecha_aplicada' => '2022-01-01',
            'aplicada' => 1,
        ];

        $response = $this->put("/vacuna/{$vacuna->id}", $datosActualizados);

        $response->assertSessionHasErrors(['dosis']);
    }

    public function test_vacuna_no_se_actualiza_con_dosis_no_numerica()
    {
        $vacuna = Vacuna::factory()->create();
        $datosActualizados = [
            'num_id' => $vacuna->num_id,
            'medi_id' => $vacuna->medi_id,
            'dosis' => 'abc', // dosis no es un número
            'unidad' => 'mililitros',
            'fecha_aplicada' => '2022-01-01',
            'aplicada' => 1,
        ];

        $response = $this->put("/vacuna/{$vacuna->id}", $datosActualizados);

        $response->assertSessionHasErrors(['dosis']);
    }

    public function test_vacuna_no_se_actualiza_con_dosis_cero()
    {
        $vacuna = Vacuna::factory()->create();
        $datosActualizados = [
            'num_id' => $vacuna->num_id,
            'medi_id' => $vacuna->medi_id,
            'dosis' => 0, // dosis es cero
            'unidad' => 'mililitros',
            'fecha_aplicada' => '2022-01-01',
            'aplicada' => 1,
        ];

        $response = $this->put("/vacuna/{$vacuna->id}", $datosActualizados);

        $response->assertSessionHasErrors(['dosis']);
    }

    public function test_vacuna_no_se_actualiza_con_dosis_con_demasiados_decimales()
    {
        $vacuna = Vacuna::factory()->create();
        $datosActualizados = [
            'num_id' => $vacuna->num_id,
            'medi_id' => $vacuna->medi_id,
            'dosis' => 10.1234, // dosis con más de dos decimales
            'unidad' => 'mililitros',
            'fecha_aplicada' => '2022-01-01',
            'aplicada' => 1,
        ];

        $response = $this->put("/vacuna/{$vacuna->id}", $datosActualizados);

        $response->assertSessionHasErrors(['dosis']);
    }

    public function test_vacuna_no_se_actualiza_sin_unidad()
    {
        $vacuna = Vacuna::factory()->create();
        $datosActualizados = [
            'num_id' => $vacuna->num_id,
            'medi_id' => $vacuna->medi_id,
            'dosis' => 10,
            'unidad' => null, // unidad no proporcionada
            'fecha_aplicada' => '2022-01-01',
            'aplicada' => 1,
        ];

        $response = $this->put("/vacuna/{$vacuna->id}", $datosActualizados);

        $response->assertSessionHasErrors(['unidad']);
    }

    public function test_vacuna_no_se_actualiza_con_unidad_vacia()
    {
        $vacuna = Vacuna::factory()->create();
        $datosActualizados = [
            'num_id' => $vacuna->num_id,
            'medi_id' => $vacuna->medi_id,
            'dosis' => 10,
            'unidad' => '', // unidad es una cadena vacía
            'fecha_aplicada' => '2022-01-01',
            'aplicada' => 1,
        ];

        $response = $this->put("/vacuna/{$vacuna->id}", $datosActualizados);

        $response->assertSessionHasErrors(['unidad']);
    }

    public function test_vacuna_no_se_actualiza_con_unidad_demasiado_larga()
    {
        $vacuna = Vacuna::factory()->create();
        $datosActualizados = [
            'num_id' => $vacuna->num_id,
            'medi_id' => $vacuna->medi_id,
            'dosis' => 10,
            'unidad' => 'unidad con más de veinte caracteres',
            'fecha_aplicada' => '2022-01-01',
            'aplicada' => 1,
        ];

        $response = $this->put("/vacuna/{$vacuna->id}", $datosActualizados);

        $response->assertSessionHasErrors(['unidad']);
    }

    public function test_vacuna_no_se_actualiza_con_unidad_no_alfabetica()
    {
        $vacuna = Vacuna::factory()->create();
        $datosActualizados = [
            'num_id' => $vacuna->num_id,
            'medi_id' => $vacuna->medi_id,
            'dosis' => 10,
            'unidad' => '1234', // unidad contiene caracteres no alfabéticos
            'fecha_aplicada' => '2022-01-01',
            'aplicada' => 1,
        ];

        $response = $this->put("/vacuna/{$vacuna->id}", $datosActualizados);

        $response->assertSessionHasErrors(['unidad']);
    }

    public function test_vacuna_se_actualiza_con_unidad_alfabetica()
    {
        $vacuna = Vacuna::factory()->create();
        $datosActualizados = [
            'num_id' => $vacuna->num_id,
            'medi_id' => $vacuna->medi_id,
            'dosis' => 10,
            'unidad' => 'mililitros', // unidad es una cadena alfabética válida
            'fecha_aplicada' => '2022-01-01',
            'aplicada' => 1,
        ];

        $response = $this->put("/vacuna/{$vacuna->id}", $datosActualizados);

        $response->assertSessionDoesNotHaveErrors(['unidad']);
    }

    public function test_vacuna_no_se_actualiza_con_unidad_con_espacios()
    {
        $vacuna = Vacuna::factory()->create();
        $datosActualizados = [
            'num_id' => $vacuna->num_id,
            'medi_id' => $vacuna->medi_id,
            'dosis' => 10,
            'unidad' => 'mililitros con espacios', // unidad es una cadena alfabética con espacios
            'fecha_aplicada' => '2022-01-01',
            'aplicada' => 1,
        ];

        $response = $this->put("/vacuna/{$vacuna->id}", $datosActualizados);

        $response->assertSessionHasErrors(['unidad']);
    }

    public function test_vacuna_no_se_actualiza_con_unidad_con_caracteres_especiales()
    {
        $vacuna = Vacuna::factory()->create();
        $datosActualizados = [
            'num_id' => $vacuna->num_id,
            'medi_id' => $vacuna->medi_id,
            'dosis' => 10,
            'unidad' => 'mililitros@#$', // unidad es una cadena alfabética con caracteres especiales
            'fecha_aplicada' => '2022-01-01',
            'aplicada' => 1,
        ];

        $response = $this->put("/vacuna/{$vacuna->id}", $datosActualizados);

        $response->assertSessionHasErrors(['unidad']);
    }

    public function test_vacuna_no_se_actualiza_sin_fecha_aplicada()
    {
        $vacuna = Vacuna::factory()->create();
        $datosActualizados = [
            'num_id' => $vacuna->num_id,
            'medi_id' => $vacuna->medi_id,
            'dosis' => 10,
            'unidad' => 'mililitros',
            'fecha_aplicada' => null, // fecha_aplicada no proporcionada
            'aplicada' => 1,
        ];

        $response = $this->put("/vacuna/{$vacuna->id}", $datosActualizados);

        $response->assertSessionHasErrors(['fecha_aplicada']);
    }

    public function test_vacuna_no_se_actualiza_con_fecha_aplicada_invalida()
    {
        $vacuna = Vacuna::factory()->create();
        $datosActualizados = [
            'num_id' => $vacuna->num_id,
            'medi_id' => $vacuna->medi_id,
            'dosis' => 10,
            'unidad' => 'mililitros',
            'fecha_aplicada' => 'fecha_invalida', // fecha_aplicada no es una fecha válida
            'aplicada' => 1,
        ];

        $response = $this->put("/vacuna/{$vacuna->id}", $datosActualizados);

        $response->assertSessionHasErrors(['fecha_aplicada']);
    }

    public function test_vacuna_no_se_actualiza_con_fecha_aplicada_en_el_futuro()
    {
        $vacuna = Vacuna::factory()->create();
        $datosActualizados = [
            'num_id' => $vacuna->num_id,
            'medi_id' => $vacuna->medi_id,
            'dosis' => 10,
            'unidad' => 'mililitros',
            'fecha_aplicada' => '2030-01-01', // fecha_aplicada es una fecha en el futuro
            'aplicada' => 1,
        ];

        $response = $this->put("/vacuna/{$vacuna->id}", $datosActualizados);

        $response->assertSessionHasErrors(['fecha_aplicada']);
    }

    public function test_vacuna_se_actualiza_con_fecha_aplicada_valida()
    {
        $vacuna = Vacuna::factory()->create();
        $datosActualizados = [
            'num_id' => $vacuna->num_id,
            'medi_id' => $vacuna->medi_id,
            'dosis' => 10,
            'unidad' => 'mililitros',
            'fecha_aplicada' => '2020-01-01', // fecha_aplicada es una fecha válida en el pasado
            'aplicada' => 1,
        ];

        $response = $this->put("/vacuna/{$vacuna->id}", $datosActualizados);

        $response->assertSessionDoesNotHaveErrors(['fecha_aplicada']);
    }

    public function test_vacuna_no_se_actualiza_con_fecha_aplicada_formato_incorrecto()
    {
        $vacuna = Vacuna::factory()->create();
        $datosActualizados = [
            'num_id' => $vacuna->num_id,
            'medi_id' => $vacuna->medi_id,
            'dosis' => 10,
            'unidad' => 'mililitros',
            'fecha_aplicada' => '01/01/2020', // fecha_aplicada con formato incorrecto
            'aplicada' => 1,
        ];

        $response = $this->put("/vacuna/{$vacuna->id}", $datosActualizados);

        $response->assertSessionHasErrors(['fecha_aplicada']);
    }

    public function test_vacuna_no_se_actualiza_con_fecha_aplicada_valores_invalidos()
    {
        $vacuna = Vacuna::factory()->create();
        $datosActualizados = [
            'num_id' => $vacuna->num_id,
            'medi_id' => $vacuna->medi_id,
            'dosis' => 10,
            'unidad' => 'mililitros',
            'fecha_aplicada' => '2020-13-32', // fecha_aplicada con formato correcto pero valores inválidos
            'aplicada' => 1,
        ];

        $response = $this->put("/vacuna/{$vacuna->id}", $datosActualizados);

        $response->assertSessionHasErrors(['fecha_aplicada']);
    }
}
