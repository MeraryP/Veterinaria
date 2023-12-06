<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Clinico;
use App\Models\User;


class ExamenClinicoUpdateTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->actingAs($this->user);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_examen_clinico_se_actualiza_correctamente()
    {
        $clinico = Clinico::factory()->create();
        $nuevosDatos = [
            'num_id' => $clinico->num_id,
            'sintomas' => 'Nuevos sintomas',
            'enfermedad' => 'Nueva enfermedad',
            'tratamiento' => 'Nuevo tratamiento',
        ];

        $response = $this->put("/clinico/{$clinico->id}", $nuevosDatos);

        $response->assertRedirect("/clinico/{$clinico->num_id}");
        $response->assertSessionHas('mensaje', 'El registro fue modificado exitosamente.');
        $this->assertDatabaseHas('clinicos', $nuevosDatos);
    }

    public function test_examen_clinico_no_se_actualiza_con_datos_invalidos()
    {
        $clinico = Clinico::factory()->create();
        $datosInvalidos = [
            'num_id' => 'invalido',
            'sintomas' => '',
            'enfermedad' => '',
            'tratamiento' => '',
        ];

        $response = $this->put("/clinico/{$clinico->id}", $datosInvalidos);

        $response->assertSessionHasErrors(['num_id', 'sintomas', 'enfermedad', 'tratamiento']);
        $this->assertDatabaseMissing('clinicos', $datosInvalidos);
    }

    public function test_examen_clinico_no_se_actualiza_con_num_id_inexistente()
    {
        $clinico = Clinico::factory()->create();
        $datosInvalidos = [
            'num_id' => 99999, // ID inexistente
            'sintomas' => 'Nuevos sintomas',
            'enfermedad' => 'Nueva enfermedad',
            'tratamiento' => 'Nuevo tratamiento',
        ];

        $response = $this->put("/clinico/{$clinico->id}", $datosInvalidos);

        $response->assertSessionHasErrors(['num_id']);
        $this->assertDatabaseMissing('clinicos', $datosInvalidos);
    }

    public function test_examen_clinico_no_se_actualiza_con_num_id_no_numerico()
    {
        $clinico = Clinico::factory()->create();
        $datosInvalidos = [
            'num_id' => 'invalido', // No numérico
            'sintomas' => 'Nuevos sintomas',
            'enfermedad' => 'Nueva enfermedad',
            'tratamiento' => 'Nuevo tratamiento',
        ];

        $response = $this->put("/clinico/{$clinico->id}", $datosInvalidos);

        $response->assertSessionHasErrors(['num_id']);
        $this->assertDatabaseMissing('clinicos', $datosInvalidos);
    }

    public function test_examen_clinico_no_se_actualiza_con_num_id_vacio()
    {
        $clinico = Clinico::factory()->create();
        $datosInvalidos = [
            'num_id' => '', // Vacío
            'sintomas' => 'Nuevos sintomas',
            'enfermedad' => 'Nueva enfermedad',
            'tratamiento' => 'Nuevo tratamiento',
        ];

        $response = $this->put("/clinico/{$clinico->id}", $datosInvalidos);

        $response->assertSessionHasErrors(['num_id']);
        $this->assertDatabaseMissing('clinicos', $datosInvalidos);
    }

    public function test_examen_clinico_no_se_actualiza_con_num_id_duplicado()
    {
        $clinico1 = Clinico::factory()->create();
        $clinico2 = Clinico::factory()->create();
        $datosInvalidos = [
            'num_id' => $clinico1->num_id, // Duplicado
            'sintomas' => 'Nuevos sintomas',
            'enfermedad' => 'Nueva enfermedad',
            'tratamiento' => 'Nuevo tratamiento',
        ];

        $response = $this->put("/clinico/{$clinico2->id}", $datosInvalidos);

        $response->assertSessionHasErrors(['num_id']);
        $this->assertDatabaseMissing('clinicos', $datosInvalidos);
    }

    public function test_examen_clinico_no_se_actualiza_con_num_id_que_no_corresponde_a_paciente()
    {
        $clinico = Clinico::factory()->create();
        $pacienteInexistenteId = 99999; // Asegúrate de que este ID no exista en tu base de datos
        $datosInvalidos = [
            'num_id' => $pacienteInexistenteId,
            'sintomas' => 'Nuevos sintomas',
            'enfermedad' => 'Nueva enfermedad',
            'tratamiento' => 'Nuevo tratamiento',
        ];

        $response = $this->put("/clinico/{$clinico->id}", $datosInvalidos);

        $response->assertSessionHasErrors(['num_id']);
        $this->assertDatabaseMissing('clinicos', $datosInvalidos);
    }

    public function test_examen_clinico_no_se_actualiza_con_num_id_negativo_o_cero()
    {
        $clinico = Clinico::factory()->create();
        $datosInvalidosNegativo = [
            'num_id' => -1, // Negativo
            'sintomas' => 'Nuevos sintomas',
            'enfermedad' => 'Nueva enfermedad',
            'tratamiento' => 'Nuevo tratamiento',
        ];
        $datosInvalidosCero = [
            'num_id' => 0, // Cero
            'sintomas' => 'Nuevos sintomas',
            'enfermedad' => 'Nueva enfermedad',
            'tratamiento' => 'Nuevo tratamiento',
        ];

        $responseNegativo = $this->put("/clinico/{$clinico->id}", $datosInvalidosNegativo);
        $responseCero = $this->put("/clinico/{$clinico->id}", $datosInvalidosCero);

        $responseNegativo->assertSessionHasErrors(['num_id']);
        $this->assertDatabaseMissing('clinicos', $datosInvalidosNegativo);
        $responseCero->assertSessionHasErrors(['num_id']);
        $this->assertDatabaseMissing('clinicos', $datosInvalidosCero);
    }

    public function test_examen_clinico_no_se_actualiza_con_num_id_como_cadena()
    {
        $clinico = Clinico::factory()->create();
        $datosInvalidos = [
            'num_id' => 'cadena', // Cadena de texto
            'sintomas' => 'Nuevos sintomas',
            'enfermedad' => 'Nueva enfermedad',
            'tratamiento' => 'Nuevo tratamiento',
        ];

        $response = $this->put("/clinico/{$clinico->id}", $datosInvalidos);

        $response->assertSessionHasErrors(['num_id']);
        $this->assertDatabaseMissing('clinicos', $datosInvalidos);
    }

    public function test_examen_clinico_no_se_actualiza_con_sintomas_vacio()
    {
        $clinico = Clinico::factory()->create();
        $datosInvalidos = [
            'num_id' => $clinico->num_id,
            'sintomas' => '', // Vacío
            'enfermedad' => 'Nueva enfermedad',
            'tratamiento' => 'Nuevo tratamiento',
        ];

        $response = $this->put("/clinico/{$clinico->id}", $datosInvalidos);

        $response->assertSessionHasErrors(['sintomas']);
        $this->assertDatabaseMissing('clinicos', $datosInvalidos);
    }

    public function test_examen_clinico_no_se_actualiza_con_sintomas_demasiado_largos()
    {
        $clinico = Clinico::factory()->create();
        $sintomasLargos = str_repeat('a', 256);
        $datosInvalidos = [
            'num_id' => $clinico->num_id,
            'sintomas' => $sintomasLargos,
            'enfermedad' => 'Nueva enfermedad',
            'tratamiento' => 'Nuevo tratamiento',
        ];

        $response = $this->put("/clinico/{$clinico->id}", $datosInvalidos);

        $response->assertSessionHasErrors(['sintomas']);
        $this->assertDatabaseMissing('clinicos', $datosInvalidos);
    }

    public function test_examen_clinico_no_se_actualiza_con_enfermedad_vacio()
    {
        $clinico = Clinico::factory()->create();
        $datosInvalidos = [
            'num_id' => $clinico->num_id,
            'sintomas' => 'Nuevos sintomas',
            'enfermedad' => '', // Vacío
            'tratamiento' => 'Nuevo tratamiento',
        ];

        $response = $this->put("/clinico/{$clinico->id}", $datosInvalidos);

        $response->assertSessionHasErrors(['enfermedad']);
        $this->assertDatabaseMissing('clinicos', $datosInvalidos);
    }

    public function test_examen_clinico_no_se_actualiza_con_enfermedad_demasiado_largos()
    {
        $clinico = Clinico::factory()->create();
        $enfermedadLargos = str_repeat('a', 256);
        $datosInvalidos = [
            'num_id' => $clinico->num_id,
            'sintomas' => 'Nuevos sintomas',
            'enfermedad' => $enfermedadLargos,
            'tratamiento' => 'Nuevo tratamiento',
        ];

        $response = $this->put("/clinico/{$clinico->id}", $datosInvalidos);

        $response->assertSessionHasErrors(['enfermedad']);
        $this->assertDatabaseMissing('clinicos', $datosInvalidos);
    }

    public function test_examen_clinico_no_se_actualiza_con_enfermedad_no_cadena()
    {
        $clinico = Clinico::factory()->create();
        $datosInvalidos = [
            'num_id' => $clinico->num_id,
            'sintomas' => 'Nuevos sintomas',
            'enfermedad' => 123, // No es una cadena de texto
            'tratamiento' => 'Nuevo tratamiento',
        ];

        $response = $this->put("/clinico/{$clinico->id}", $datosInvalidos);

        $response->assertSessionHasErrors(['enfermedad']);
        $this->assertDatabaseMissing('clinicos', $datosInvalidos);
    }

    public function test_examen_clinico_no_se_actualiza_con_tratamiento_vacio()
    {
        $clinico = Clinico::factory()->create();
        $datosInvalidos = [
            'num_id' => $clinico->num_id,
            'sintomas' => 'Nuevos sintomas',
            'enfermedad' => 'Nueva enfermedad',
            'tratamiento' => '', // Vacío
        ];

        $response = $this->put("/clinico/{$clinico->id}", $datosInvalidos);

        $response->assertSessionHasErrors(['tratamiento']);
        $this->assertDatabaseMissing('clinicos', $datosInvalidos);
    }

    public function test_examen_clinico_no_se_actualiza_con_tratamiento_demasiado_largos()
    {
        $clinico = Clinico::factory()->create();
        $tratamientoLargos = str_repeat('a', 256);
        $datosInvalidos = [
            'num_id' => $clinico->num_id,
            'sintomas' => 'Nuevos sintomas',
            'enfermedad' => 'Nueva enfermedad',
            'tratamiento' => $tratamientoLargos,
        ];

        $response = $this->put("/clinico/{$clinico->id}", $datosInvalidos);

        $response->assertSessionHasErrors(['tratamiento']);
        $this->assertDatabaseMissing('clinicos', $datosInvalidos);
    }

    public function test_examen_clinico_no_se_actualiza_con_tratamiento_no_cadena()
    {
        $clinico = Clinico::factory()->create();
        $datosInvalidos = [
            'num_id' => $clinico->num_id,
            'sintomas' => 'Nuevos sintomas',
            'enfermedad' => 'Nueva enfermedad',
            'tratamiento' => 123, // No es una cadena de texto
        ];

        $response = $this->put("/clinico/{$clinico->id}", $datosInvalidos);

        $response->assertSessionHasErrors(['tratamiento']);
        $this->assertDatabaseMissing('clinicos', $datosInvalidos);
    }
}
