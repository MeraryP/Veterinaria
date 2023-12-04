<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Vacuna;

class VacunaStoreTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_vacuna_se_guarda_correctamente()
    {
        $vacuna = Vacuna::factory()->make();
        $datos = [
            'num_id' => $vacuna->num_id,
            'medi_id' => $vacuna->medi_id,
            'dosis' => 10,
            'unidad' => 'mililitros',
            'fecha_aplicada' => '2022-01-01',
            'aplicada' => 1,
        ];

        $response = $this->post("/vacuna", $datos);

        $response->assertRedirect(route('vacunaMascota', ['id' => $vacuna->num_id]));
        $response->assertSessionHas('mensaje', 'El registro fue creado exitosamente.');
        $this->assertDatabaseHas('vacunas', $datos);
    }

    public function test_vacuna_no_se_guarda_con_datos_invalidos()
    {
        $datosInvalidos = [
            'num_id' => null,
            'medi_id' => null,
            'dosis' => -1,
            'unidad' => 'litros',
            'fecha_aplicada' => 'fecha invalida',
            'aplicada' => null,
        ];

        $response = $this->post("/vacuna", $datosInvalidos);

        $response->assertSessionHasErrors([
            'num_id',
            'medi_id',
            'dosis',
            'unidad',
            'fecha_aplicada',
            'aplicada',
        ]);
    }

    public function test_vacuna_no_se_guarda_con_num_id_inexistente()
    {
        $vacuna = Vacuna::factory()->make();
        $datos = [
            'num_id' => 99999,
            'medi_id' => $vacuna->medi_id,
            'dosis' => 10,
            'unidad' => 'mililitros',
            'fecha_aplicada' => '2022-01-01',
            'aplicada' => 1,
        ];

        $response = $this->post("/vacuna", $datos);

        $response->assertSessionHasErrors(['num_id']);
    }

    public function test_vacuna_no_se_guarda_sin_num_id()
    {
        $vacuna = Vacuna::factory()->make();
        $datos = [
            'num_id' => null,
            'medi_id' => $vacuna->medi_id,
            'dosis' => 10,
            'unidad' => 'mililitros',
            'fecha_aplicada' => '2022-01-01',
            'aplicada' => 1,
        ];

        $response = $this->post("/vacuna", $datos);

        $response->assertSessionHasErrors(['num_id']);
    }

    public function test_vacuna_no_se_guarda_con_num_id_no_numerico()
    {
        $vacuna = Vacuna::factory()->make();
        $datos = [
            'num_id' => 'abc', // num_id no es un número
            'medi_id' => $vacuna->medi_id,
            'dosis' => 10,
            'unidad' => 'mililitros',
            'fecha_aplicada' => '2022-01-01',
            'aplicada' => 1,
        ];

        $response = $this->post("/vacuna", $datos);

        $response->assertSessionHasErrors(['num_id']);
    }

    public function test_vacuna_no_se_guarda_con_medi_id_inexistente()
    {
        $vacuna = Vacuna::factory()->make();
        $datos = [
            'num_id' => $vacuna->num_id,
            'medi_id' => 99999,
            'dosis' => 10,
            'unidad' => 'mililitros',
            'fecha_aplicada' => '2022-01-01',
            'aplicada' => 1,
        ];

        $response = $this->post("/vacuna", $datos);

        $response->assertSessionHasErrors(['medi_id']);
    }

    public function test_vacuna_no_se_guarda_sin_medi_id()
    {
        $vacuna = Vacuna::factory()->make();
        $datos = [
            'num_id' => $vacuna->num_id,
            'medi_id' => null,
            'dosis' => 10,
            'unidad' => 'mililitros',
            'fecha_aplicada' => '2022-01-01',
            'aplicada' => 1,
        ];

        $response = $this->post("/vacuna", $datos);

        $response->assertSessionHasErrors(['medi_id']);
    }

    public function test_vacuna_no_se_guarda_con_medi_id_no_numerico()
    {
        $vacuna = Vacuna::factory()->make();
        $datos = [
            'num_id' => $vacuna->num_id,
            'medi_id' => 'abc', // medi_id no es un número
            'dosis' => 10,
            'unidad' => 'mililitros',
            'fecha_aplicada' => '2022-01-01',
            'aplicada' => 1,
        ];

        $response = $this->post("/vacuna", $datos);

        $response->assertSessionHasErrors(['medi_id']);
    }

    public function test_vacuna_no_se_guarda_sin_dosis()
    {
        $vacuna = Vacuna::factory()->make();
        $datos = [
            'num_id' => $vacuna->num_id,
            'medi_id' => $vacuna->medi_id,
            'dosis' => null, // dosis no proporcionada
            'unidad' => 'mililitros',
            'fecha_aplicada' => '2022-01-01',
            'aplicada' => 1,
        ];

        $response = $this->post("/vacuna", $datos);

        $response->assertSessionHasErrors(['dosis']);
    }

    public function test_vacuna_no_se_guarda_con_dosis_no_numerica()
    {
        $vacuna = Vacuna::factory()->make();
        $datos = [
            'num_id' => $vacuna->num_id,
            'medi_id' => $vacuna->medi_id,
            'dosis' => 'abc', // dosis no es un número
            'unidad' => 'mililitros',
            'fecha_aplicada' => '2022-01-01',
            'aplicada' => 1,
        ];

        $response = $this->post("/vacuna", $datos);

        $response->assertSessionHasErrors(['dosis']);
    }

    public function test_vacuna_no_se_guarda_con_dosis_cero()
    {
        $vacuna = Vacuna::factory()->make();
        $datos = [
            'num_id' => $vacuna->num_id,
            'medi_id' => $vacuna->medi_id,
            'dosis' => 0, // dosis es cero
            'unidad' => 'mililitros',
            'fecha_aplicada' => '2022-01-01',
            'aplicada' => 1,
        ];

        $response = $this->post("/vacuna", $datos);

        $response->assertSessionHasErrors(['dosis']);
    }

    public function test_vacuna_no_se_guarda_con_dosis_con_demasiados_decimales()
    {
        $vacuna = Vacuna::factory()->make();
        $datos = [
            'num_id' => $vacuna->num_id,
            'medi_id' => $vacuna->medi_id,
            'dosis' => 10.1234, // dosis con más de dos decimales
            'unidad' => 'mililitros',
            'fecha_aplicada' => '2022-01-01',
            'aplicada' => 1,
        ];

        $response = $this->post("/vacuna", $datos);

        $response->assertSessionHasErrors(['dosis']);
    }

    public function test_vacuna_no_se_guarda_sin_unidad()
    {
        $vacuna = Vacuna::factory()->make();
        $datos = [
            'num_id' => $vacuna->num_id,
            'medi_id' => $vacuna->medi_id,
            'dosis' => 10,
            'unidad' => null, // unidad no proporcionada
            'fecha_aplicada' => '2022-01-01',
            'aplicada' => 1,
        ];

        $response = $this->post("/vacuna", $datos);

        $response->assertSessionHasErrors(['unidad']);
    }

    public function test_vacuna_no_se_guarda_con_unidad_vacia()
    {
        $vacuna = Vacuna::factory()->make();
        $datos = [
            'num_id' => $vacuna->num_id,
            'medi_id' => $vacuna->medi_id,
            'dosis' => 10,
            'unidad' => '', // unidad es una cadena vacía
            'fecha_aplicada' => '2022-01-01',
            'aplicada' => 1,
        ];

        $response = $this->post("/vacuna", $datos);

        $response->assertSessionHasErrors(['unidad']);
    }

    public function test_vacuna_no_se_guarda_con_unidad_demasiado_larga()
    {
        $vacuna = Vacuna::factory()->make();
        $datos = [
            'num_id' => $vacuna->num_id,
            'medi_id' => $vacuna->medi_id,
            'dosis' => 10,
            'unidad' => 'unidad con más de veinte caracteres',
            'fecha_aplicada' => '2022-01-01',
            'aplicada' => 1,
        ];

        $response = $this->post("/vacuna", $datos);

        $response->assertSessionHasErrors(['unidad']);
    }

    public function test_vacuna_no_se_guarda_con_unidad_no_alfabetica()
    {
        $vacuna = Vacuna::factory()->make();
        $datos = [
            'num_id' => $vacuna->num_id,
            'medi_id' => $vacuna->medi_id,
            'dosis' => 10,
            'unidad' => '1234', // unidad contiene caracteres no alfabéticos
            'fecha_aplicada' => '2022-01-01',
            'aplicada' => 1,
        ];

        $response = $this->post("/vacuna", $datos);

        $response->assertSessionHasErrors(['unidad']);
    }

    public function test_vacuna_se_guarda_con_unidad_alfabetica()
    {
        $vacuna = Vacuna::factory()->make();
        $datos = [
            'num_id' => $vacuna->num_id,
            'medi_id' => $vacuna->medi_id,
            'dosis' => 10,
            'unidad' => 'mililitros', // unidad es una cadena alfabética válida
            'fecha_aplicada' => '2022-01-01',
            'aplicada' => 1,
        ];

        $response = $this->post("/vacuna", $datos);

        $response->assertSessionDoesNotHaveErrors(['unidad']);
    }

    public function test_vacuna_no_se_guarda_con_unidad_con_espacios()
    {
        $vacuna = Vacuna::factory()->make();
        $datos = [
            'num_id' => $vacuna->num_id,
            'medi_id' => $vacuna->medi_id,
            'dosis' => 10,
            'unidad' => 'mililitros con espacios', // unidad es una cadena alfabética con espacios
            'fecha_aplicada' => '2022-01-01',
            'aplicada' => 1,
        ];

        $response = $this->post("/vacuna", $datos);

        $response->assertSessionHasErrors(['unidad']);
    }

    public function test_vacuna_no_se_guarda_con_unidad_con_caracteres_especiales()
    {
        $vacuna = Vacuna::factory()->make();
        $datos = [
            'num_id' => $vacuna->num_id,
            'medi_id' => $vacuna->medi_id,
            'dosis' => 10,
            'unidad' => 'mililitros@#$', // unidad es una cadena alfabética con caracteres especiales
            'fecha_aplicada' => '2022-01-01',
            'aplicada' => 1,
        ];

        $response = $this->post("/vacuna", $datos);

        $response->assertSessionHasErrors(['unidad']);
    }

    public function test_vacuna_no_se_guarda_sin_fecha_aplicada()
    {
        $vacuna = Vacuna::factory()->make();
        $datos = [
            'num_id' => $vacuna->num_id,
            'medi_id' => $vacuna->medi_id,
            'dosis' => 10,
            'unidad' => 'mililitros',
            'fecha_aplicada' => null, // fecha_aplicada no proporcionada
            'aplicada' => 1,
        ];

        $response = $this->post("/vacuna", $datos);

        $response->assertSessionHasErrors(['fecha_aplicada']);
    }

    public function test_vacuna_no_se_guarda_con_fecha_aplicada_invalida()
    {
        $vacuna = Vacuna::factory()->make();
        $datos = [
            'num_id' => $vacuna->num_id,
            'medi_id' => $vacuna->medi_id,
            'dosis' => 10,
            'unidad' => 'mililitros',
            'fecha_aplicada' => 'fecha_invalida', // fecha_aplicada no es una fecha válida
            'aplicada' => 1,
        ];

        $response = $this->post("/vacuna", $datos);

        $response->assertSessionHasErrors(['fecha_aplicada']);
    }

    public function test_vacuna_no_se_guarda_con_fecha_aplicada_en_el_futuro()
    {
        $vacuna = Vacuna::factory()->make();
        $datos = [
            'num_id' => $vacuna->num_id,
            'medi_id' => $vacuna->medi_id,
            'dosis' => 10,
            'unidad' => 'mililitros',
            'fecha_aplicada' => '2030-01-01', // fecha_aplicada es una fecha en el futuro
            'aplicada' => 1,
        ];

        $response = $this->post("/vacuna", $datos);

        $response->assertSessionHasErrors(['fecha_aplicada']);
    }

    public function test_vacuna_se_guarda_con_fecha_aplicada_valida()
    {
        $vacuna = Vacuna::factory()->make();
        $datos = [
            'num_id' => $vacuna->num_id,
            'medi_id' => $vacuna->medi_id,
            'dosis' => 10,
            'unidad' => 'mililitros',
            'fecha_aplicada' => '2020-01-01', // fecha_aplicada es una fecha válida en el pasado
            'aplicada' => 1,
        ];

        $response = $this->post("/vacuna", $datos);

        $response->assertSessionDoesNotHaveErrors(['fecha_aplicada']);
    }

    public function test_vacuna_no_se_guarda_con_fecha_aplicada_formato_incorrecto()
    {
        $vacuna = Vacuna::factory()->make();
        $datos = [
            'num_id' => $vacuna->num_id,
            'medi_id' => $vacuna->medi_id,
            'dosis' => 10,
            'unidad' => 'mililitros',
            'fecha_aplicada' => '01/01/2020', // fecha_aplicada con formato incorrecto
            'aplicada' => 1,
        ];

        $response = $this->post("/vacuna", $datos);

        $response->assertSessionHasErrors(['fecha_aplicada']);
    }

    public function test_vacuna_no_se_guarda_con_fecha_aplicada_valores_invalidos()
    {
        $vacuna = Vacuna::factory()->make();
        $datos = [
            'num_id' => $vacuna->num_id,
            'medi_id' => $vacuna->medi_id,
            'dosis' => 10,
            'unidad' => 'mililitros',
            'fecha_aplicada' => '2020-13-32', // fecha_aplicada con formato correcto pero valores inválidos
            'aplicada' => 1,
        ];

        $response = $this->post("/vacuna", $datos);

        $response->assertSessionHasErrors(['fecha_aplicada']);
    }
}
