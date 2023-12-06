<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Clinico;
use App\Models\User;

class ExamenClinicoStoreTest extends TestCase
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
    public function test_examen_clinico_se_guarda_correctamente()
    {
        $clinico = Clinico::factory()->make();
        $nuevosDatos = [
            'num_id' => $clinico->num_id,
            'sintomas' => 'Nuevos sintomas',
            'enfermedad' => 'Nueva enfermedad',
            'tratamiento' => 'Nuevo tratamiento',
        ];

        $response = $this->post("/clinico", $nuevosDatos);

        $response->assertRedirect("/clinico/{$clinico->num_id}");
        $response->assertSessionHas('mensaje', 'El registro fue creado exitosamente.');
        $this->assertDatabaseHas('clinicos', $nuevosDatos);
    }

    public function test_examen_clinico_no_se_guarda_con_datos_invalidos()
    {
        $datosInvalidos = [
            'num_id' => 'invalido',
            'sintomas' => '',
            'enfermedad' => '',
            'tratamiento' => '',
        ];

        $response = $this->post("/clinico", $datosInvalidos);

        $response->assertSessionHasErrors(['num_id', 'sintomas', 'enfermedad', 'tratamiento']);
        $this->assertDatabaseMissing('clinicos', $datosInvalidos);
    }

    public function test_examen_clinico_no_se_guarda_con_num_id_no_numerico()
    {
        $datosInvalidos = [
            'num_id' => 'invalido', // No numérico
            'sintomas' => 'Nuevos sintomas',
            'enfermedad' => 'Nueva enfermedad',
            'tratamiento' => 'Nuevo tratamiento',
        ];

        $response = $this->post("/clinico", $datosInvalidos);

        $response->assertSessionHasErrors(['num_id']);
        $this->assertDatabaseMissing('clinicos', $datosInvalidos);
    }

    public function test_examen_clinico_no_se_guarda_con_num_id_vacio()
    {
        $datosInvalidos = [
            'num_id' => '', // Vacío
            'sintomas' => 'Nuevos sintomas',
            'enfermedad' => 'Nueva enfermedad',
            'tratamiento' => 'Nuevo tratamiento',
        ];

        $response = $this->post("/clinico", $datosInvalidos);

        $response->assertSessionHasErrors(['num_id']);
        $this->assertDatabaseMissing('clinicos', $datosInvalidos);
    }

    public function test_examen_clinico_no_se_guarda_con_num_id_duplicado()
    {
        $clinico1 = Clinico::factory()->create();
        $datosInvalidos = [
            'num_id' => $clinico1->num_id, // Duplicado
            'sintomas' => 'Nuevos sintomas',
            'enfermedad' => 'Nueva enfermedad',
            'tratamiento' => 'Nuevo tratamiento',
        ];

        $response = $this->post("/clinico", $datosInvalidos);

        $response->assertSessionHasErrors(['num_id']);
        $this->assertDatabaseMissing('clinicos', $datosInvalidos);
    }

    public function test_examen_clinico_no_se_guarda_con_num_id_que_no_corresponde_a_paciente()
    {
        $pacienteInexistenteId = 99999; // Asegúrate de que este ID no exista en tu base de datos
        $datosInvalidos = [
            'num_id' => $pacienteInexistenteId,
            'sintomas' => 'Nuevos sintomas',
            'enfermedad' => 'Nueva enfermedad',
            'tratamiento' => 'Nuevo tratamiento',
        ];

        $response = $this->post("/clinico", $datosInvalidos);

        $response->assertSessionHasErrors(['num_id']);
        $this->assertDatabaseMissing('clinicos', $datosInvalidos);
    }

    public function test_examen_clinico_no_se_guarda_con_num_id_negativo_o_cero()
    {
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

        $responseNegativo = $this->post("/clinico", $datosInvalidosNegativo);
        $responseCero = $this->post("/clinico", $datosInvalidosCero);

        $responseNegativo->assertSessionHasErrors(['num_id']);
        $this->assertDatabaseMissing('clinicos', $datosInvalidosNegativo);
        $responseCero->assertSessionHasErrors(['num_id']);
        $this->assertDatabaseMissing('clinicos', $datosInvalidosCero);
    }

    public function test_examen_clinico_no_se_guarda_con_num_id_como_cadena()
    {
        $datosInvalidos = [
            'num_id' => 'cadena', // Cadena de texto
            'sintomas' => 'Nuevos sintomas',
            'enfermedad' => 'Nueva enfermedad',
            'tratamiento' => 'Nuevo tratamiento',
        ];

        $response = $this->post("/clinico", $datosInvalidos);

        $response->assertSessionHasErrors(['num_id']);
        $this->assertDatabaseMissing('clinicos', $datosInvalidos);
    }

    public function test_examen_clinico_no_se_guarda_con_sintomas_vacio()
    {
        $clinico = Clinico::factory()->make();
        $datosInvalidos = [
            'num_id' => $clinico->num_id,
            'sintomas' => '', // Vacío
            'enfermedad' => 'Nueva enfermedad',
            'tratamiento' => 'Nuevo tratamiento',
        ];

        $response = $this->post("/clinico", $datosInvalidos);

        $response->assertSessionHasErrors(['sintomas']);
        $this->assertDatabaseMissing('clinicos', $datosInvalidos);
    }

    public function test_examen_clinico_no_se_guarda_con_sintomas_demasiado_largos()
    {
        $clinico = Clinico::factory()->make();
        $sintomasLargos = str_repeat('a', 256);
        $datosInvalidos = [
            'num_id' => $clinico->num_id,
            'sintomas' => $sintomasLargos,
            'enfermedad' => 'Nueva enfermedad',
            'tratamiento' => 'Nuevo tratamiento',
        ];

        $response = $this->post("/clinico", $datosInvalidos);

        $response->assertSessionHasErrors(['sintomas']);
        $this->assertDatabaseMissing('clinicos', $datosInvalidos);
    }

    public function test_examen_clinico_no_se_guarda_con_enfermedad_vacio()
    {
        $clinico = Clinico::factory()->make();
        $datosInvalidos = [
            'num_id' => $clinico->num_id,
            'sintomas' => 'Nuevos sintomas',
            'enfermedad' => '', // Vacío
            'tratamiento' => 'Nuevo tratamiento',
        ];

        $response = $this->post("/clinico", $datosInvalidos);

        $response->assertSessionHasErrors(['enfermedad']);
        $this->assertDatabaseMissing('clinicos', $datosInvalidos);
    }

    public function test_examen_clinico_no_se_guarda_con_enfermedad_demasiado_largos()
    {
        $clinico = Clinico::factory()->make();
        $enfermedadLargos = str_repeat('a', 256);
        $datosInvalidos = [
            'num_id' => $clinico->num_id,
            'sintomas' => 'Nuevos sintomas',
            'enfermedad' => $enfermedadLargos,
            'tratamiento' => 'Nuevo tratamiento',
        ];

        $response = $this->post("/clinico", $datosInvalidos);

        $response->assertSessionHasErrors(['enfermedad']);
        $this->assertDatabaseMissing('clinicos', $datosInvalidos);
    }

    public function test_examen_clinico_no_se_guarda_con_enfermedad_no_cadena()
    {
        $clinico = Clinico::factory()->make();
        $datosInvalidos = [
            'num_id' => $clinico->num_id,
            'sintomas' => 'Nuevos sintomas',
            'enfermedad' => 123, // No es una cadena de texto
            'tratamiento' => 'Nuevo tratamiento',
        ];

        $response = $this->post("/clinico", $datosInvalidos);

        $response->assertSessionHasErrors(['enfermedad']);
        $this->assertDatabaseMissing('clinicos', $datosInvalidos);
    }

    public function test_examen_clinico_no_se_guarda_con_tratamiento_vacio()
    {
        $clinico = Clinico::factory()->make();
        $datosInvalidos = [
            'num_id' => $clinico->num_id,
            'sintomas' => 'Nuevos sintomas',
            'enfermedad' => 'Nueva enfermedad',
            'tratamiento' => '', // Vacío
        ];

        $response = $this->post("/clinico", $datosInvalidos);

        $response->assertSessionHasErrors(['tratamiento']);
        $this->assertDatabaseMissing('clinicos', $datosInvalidos);
    }

    public function test_examen_clinico_no_se_guarda_con_tratamiento_demasiado_largos()
    {
        $clinico = Clinico::factory()->make();
        $tratamientoLargos = str_repeat('a', 256);
        $datosInvalidos = [
            'num_id' => $clinico->num_id,
            'sintomas' => 'Nuevos sintomas',
            'enfermedad' => 'Nueva enfermedad',
            'tratamiento' => $tratamientoLargos,
        ];

        $response = $this->post("/clinico", $datosInvalidos);

        $response->assertSessionHasErrors(['tratamiento']);
        $this->assertDatabaseMissing('clinicos', $datosInvalidos);
    }

    public function test_examen_clinico_no_se_guarda_con_tratamiento_no_cadena()
    {
        $clinico = Clinico::factory()->make();
        $datosInvalidos = [
            'num_id' => $clinico->num_id,
            'sintomas' => 'Nuevos sintomas',
            'enfermedad' => 'Nueva enfermedad',
            'tratamiento' => 123, // No es una cadena de texto
        ];

        $response = $this->post("/clinico", $datosInvalidos);

        $response->assertSessionHasErrors(['tratamiento']);
        $this->assertDatabaseMissing('clinicos', $datosInvalidos);
    }
}
