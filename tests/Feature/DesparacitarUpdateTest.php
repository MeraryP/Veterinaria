<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Desparacitar;
use App\Models\Paciente;
use App\Models\Medicamento;
use App\Models\User;

class DesparacitarUpdateTest extends TestCase
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
    public function testUpdateNumId()
    {
        $desparacitar = Desparacitar::factory()->create();

        $updatedData = [
            'num_id' => 123,
            'medi_id' => $desparacitar->medi_id,
            'dosis' => $desparacitar->dosis,
            'unidad_desparasitante' => $desparacitar->unidad_desparasitante,
            'fecha_aplicada' => $desparacitar->fecha_aplicada,
            'aplicada' => $desparacitar->aplicada,
        ];

        $response = $this->put('/desparacitar/' . $desparacitar->id, $updatedData);

        $response->assertStatus(302);

        $this->assertDatabaseHas('aplicados', [
            'id' => $desparacitar->id,
            'num_id' => 123,
        ]);
    }

    public function testUpdateNumIdConValorInválido()
    {
        $desparacitar = Desparacitar::factory()->create();

        $updatedData = [
            'num_id' => 'valorInvalido', // Valor inválido para num_id
            'medi_id' => $desparacitar->medi_id,
            'dosis' => $desparacitar->dosis,
            'unidad_desparasitante' => $desparacitar->unidad_desparasitante,
            'fecha_aplicada' => $desparacitar->fecha_aplicada,
            'aplicada' => $desparacitar->aplicada,
        ];

        $response = $this->put('/desparacitar/' . $desparacitar->id, $updatedData);

        $response->assertStatus(422);

        $this->assertDatabaseMissing('aplicados', [
            'id' => $desparacitar->id,
            'num_id' => 'valorInvalido',
        ]);
    }

    public function testUpdateNumIdConValorInexistente()
    {
        $desparacitar = Desparacitar::factory()->create();

        $updatedData = [
            'num_id' => 9999, // Valor inexistente para num_id
            'medi_id' => $desparacitar->medi_id,
            'dosis' => $desparacitar->dosis,
            'unidad_desparasitante' => $desparacitar->unidad_desparasitante,
            'fecha_aplicada' => $desparacitar->fecha_aplicada,
            'aplicada' => $desparacitar->aplicada,
        ];

        $response = $this->put('/desparacitar/' . $desparacitar->id, $updatedData);

        $response->assertStatus(422);

        $this->assertDatabaseMissing('aplicados', [
            'id' => $desparacitar->id,
            'num_id' => 9999,
        ]);
    }

    public function testUpdateNumIdConPacienteInexistente()
    {
        $desparacitar = Desparacitar::factory()->create();

        $nonexistentNumId = Paciente::max('id') + 1;

        $updatedData = [
            'num_id' => $nonexistentNumId,
            'medi_id' => $desparacitar->medi_id,
            'dosis' => $desparacitar->dosis,
            'unidad_desparasitante' => $desparacitar->unidad_desparasitante,
            'fecha_aplicada' => $desparacitar->fecha_aplicada,
            'aplicada' => $desparacitar->aplicada,
        ];

        $response = $this->put('/desparacitar/' . $desparacitar->id, $updatedData);

        $response->assertStatus(422);

        $this->assertDatabaseMissing('aplicados', [
            'id' => $desparacitar->id,
            'num_id' => $nonexistentNumId,
        ]);
    }

    public function testUpdateMediIdConMedicamentoInexistente()
    {
        $desparacitar = Desparacitar::factory()->create();

        $nonexistentMediId = Medicamento::max('id') + 1;

        $updatedData = [
            'num_id' => $desparacitar->num_id,
            'medi_id' => $nonexistentMediId,
            'dosis' => $desparacitar->dosis,
            'unidad_desparasitante' => $desparacitar->unidad_desparasitante,
            'fecha_aplicada' => $desparacitar->fecha_aplicada,
            'aplicada' => $desparacitar->aplicada,
        ];

        $response = $this->put('/desparacitar/' . $desparacitar->id, $updatedData);

        $response->assertStatus(422);

        $this->assertDatabaseMissing('aplicados', [
            'id' => $desparacitar->id,
            'medi_id' => $nonexistentMediId,
        ]);
    }

    public function testUpdateDosisConValorNoVálido()
    {
        $desparacitar = Desparacitar::factory()->create();

        $updatedData = [
            'num_id' => $desparacitar->num_id,
            'medi_id' => $desparacitar->medi_id,
            'dosis' => 'valorInvalido', // Valor inválido para dosis
            'unidad_desparasitante' => $desparacitar->unidad_desparasitante,
            'fecha_aplicada' => $desparacitar->fecha_aplicada,
            'aplicada' => $desparacitar->aplicada,
        ];

        $response = $this->put('/desparacitar/' . $desparacitar->id, $updatedData);

        $response->assertStatus(422);

        $this->assertDatabaseMissing('aplicados', [
            'id' => $desparacitar->id,
            'dosis' => 'valorInvalido',
        ]);
    }

    public function testUpdateDosisConValorVacio()
    {
        $desparacitar = Desparacitar::factory()->create();

        $updatedData = [
            'num_id' => $desparacitar->num_id,
            'medi_id' => $desparacitar->medi_id,
            'dosis' => '', // Valor vacío para dosis
            'unidad_desparasitante' => $desparacitar->unidad_desparasitante,
            'fecha_aplicada' => $desparacitar->fecha_aplicada,
            'aplicada' => $desparacitar->aplicada,
        ];

        $response = $this->put('/desparacitar/' . $desparacitar->id, $updatedData);

        $response->assertStatus(422);

        $this->assertDatabaseMissing('aplicados', [
            'id' => $desparacitar->id,
            'dosis' => '',
        ]);
    }

    public function testUpdateDosisConValorNegativo()
    {
        $desparacitar = Desparacitar::factory()->create();

        $updatedData = [
            'num_id' => $desparacitar->num_id,
            'medi_id' => $desparacitar->medi_id,
            'dosis' => -1, // Valor negativo para dosis
            'unidad_desparasitante' => $desparacitar->unidad_desparasitante,
            'fecha_aplicada' => $desparacitar->fecha_aplicada,
            'aplicada' => $desparacitar->aplicada,
        ];

        $response = $this->put('/desparacitar/' . $desparacitar->id, $updatedData);

        $response->assertStatus(422);

        $this->assertDatabaseMissing('aplicados', [
            'id' => $desparacitar->id,
            'dosis' => -1,
        ]);
    }

    public function testActualizarDosisConValorVacio()
    {
        $desparacitar = Desparacitar::factory()->create();

        $updatedData = [
            'num_id' => $desparacitar->num_id,
            'medi_id' => $desparacitar->medi_id,
            'dosis' => '',
            'unidad_desparasitante' => $desparacitar->unidad_desparasitante,
            'fecha_aplicada' => $desparacitar->fecha_aplicada,
            'aplicada' => $desparacitar->aplicada,
        ];

        $response = $this->put('/desparacitar/' . $desparacitar->id, $updatedData);

        $response->assertStatus(422);

        $this->assertDatabaseMissing('aplicados', [
            'id' => $desparacitar->id,
            'dosis' => '',
        ]);
    }

    public function testActualizarDosisConValorNegativo()
    {
        $desparacitar = Desparacitar::factory()->create();

        $updatedData = [
            'num_id' => $desparacitar->num_id,
            'medi_id' => $desparacitar->medi_id,
            'dosis' => -1,
            'unidad_desparasitante' => $desparacitar->unidad_desparasitante,
            'fecha_aplicada' => $desparacitar->fecha_aplicada,
            'aplicada' => $desparacitar->aplicada,
        ];

        $response = $this->put('/desparacitar/' . $desparacitar->id, $updatedData);

        $response->assertStatus(422);

        $this->assertDatabaseMissing('aplicados', [
            'id' => $desparacitar->id,
            'dosis' => -1,
        ]);
    }

    public function testActualizarDosisConValorString()
    {
        $desparacitar = Desparacitar::factory()->create();

        $updatedData = [
            'num_id' => $desparacitar->num_id,
            'medi_id' => $desparacitar->medi_id,
            'dosis' => 'valorString',
            'unidad_desparasitante' => $desparacitar->unidad_desparasitante,
            'fecha_aplicada' => $desparacitar->fecha_aplicada,
            'aplicada' => $desparacitar->aplicada,
        ];

        $response = $this->put('/desparacitar/' . $desparacitar->id, $updatedData);

        $response->assertStatus(422);

        $this->assertDatabaseMissing('aplicados', [
            'id' => $desparacitar->id,
            'dosis' => 'valorString',
        ]);
    }

    public function testActualizarDosisConValorValido()
    {
        $desparacitar = Desparacitar::factory()->create();

        $updatedData = [
            'num_id' => $desparacitar->num_id,
            'medi_id' => $desparacitar->medi_id,
            'dosis' => 10,
            'unidad_desparasitante' => $desparacitar->unidad_desparasitante,
            'fecha_aplicada' => $desparacitar->fecha_aplicada,
            'aplicada' => $desparacitar->aplicada,
        ];

        $response = $this->put('/desparacitar/' . $desparacitar->id, $updatedData);

        $response->assertStatus(302);

        $this->assertDatabaseHas('aplicados', [
            'id' => $desparacitar->id,
            'dosis' => 10,
        ]);
    }

    public function testActualizarDosisConValorNull()
    {
        $desparacitar = Desparacitar::factory()->create();

        $updatedData = [
            'num_id' => $desparacitar->num_id,
            'medi_id' => $desparacitar->medi_id,
            'dosis' => null,
            'unidad_desparasitante' => $desparacitar->unidad_desparasitante,
            'fecha_aplicada' => $desparacitar->fecha_aplicada,
            'aplicada' => $desparacitar->aplicada,
        ];

        $response = $this->put('/desparacitar/' . $desparacitar->id, $updatedData);

        $response->assertStatus(422);
    }

    public function testActualizarUnidadDesparasitanteConValorNumerico()
    {
        $desparacitar = Desparacitar::factory()->create();

        $updatedData = [
            'num_id' => $desparacitar->num_id,
            'medi_id' => $desparacitar->medi_id,
            'dosis' => $desparacitar->dosis,
            'unidad_desparasitante' => 123,
            'fecha_aplicada' => $desparacitar->fecha_aplicada,
            'aplicada' => $desparacitar->aplicada,
        ];

        $response = $this->put('/desparacitar/' . $desparacitar->id, $updatedData);

        $response->assertStatus(422);
    }

    public function testActualizarUnidadDesparasitanteConValorNull()
    {
        $desparacitar = Desparacitar::factory()->create();

        $updatedData = [
            'num_id' => $desparacitar->num_id,
            'medi_id' => $desparacitar->medi_id,
            'dosis' => $desparacitar->dosis,
            'unidad_desparasitante' => null,
            'fecha_aplicada' => $desparacitar->fecha_aplicada,
            'aplicada' => $desparacitar->aplicada,
        ];

        $response = $this->put('/desparacitar/' . $desparacitar->id, $updatedData);

        $response->assertStatus(422);
    }

    public function testActualizarUnidadDesparasitanteConValorStringVacio()
    {
        $desparacitar = Desparacitar::factory()->create();

        $updatedData = [
            'num_id' => $desparacitar->num_id,
            'medi_id' => $desparacitar->medi_id,
            'dosis' => $desparacitar->dosis,
            'unidad_desparasitante' => '',
            'fecha_aplicada' => $desparacitar->fecha_aplicada,
            'aplicada' => $desparacitar->aplicada,
        ];

        $response = $this->put('/desparacitar/' . $desparacitar->id, $updatedData);

        $response->assertStatus(422);
    }

    public function testActualizarUnidadDesparasitanteConValorStringLargo()
    {
        $desparacitar = Desparacitar::factory()->create();

        $updatedData = [
            'num_id' => $desparacitar->num_id,
            'medi_id' => $desparacitar->medi_id,
            'dosis' => $desparacitar->dosis,
            'unidad_desparasitante' => str_repeat('a', 256), // Excede la longitud máxima permitida
            'fecha_aplicada' => $desparacitar->fecha_aplicada,
            'aplicada' => $desparacitar->aplicada,
        ];

        $response = $this->put('/desparacitar/' . $desparacitar->id, $updatedData);

        $response->assertStatus(422);
    }

    public function testActualizarUnidadDesparasitanteConValorStringCaracteresEspeciales()
    {
        $desparacitar = Desparacitar::factory()->create();

        $updatedData = [
            'num_id' => $desparacitar->num_id,
            'medi_id' => $desparacitar->medi_id,
            'dosis' => $desparacitar->dosis,
            'unidad_desparasitante' => '@#$$%%^&*',
            'fecha_aplicada' => $desparacitar->fecha_aplicada,
            'aplicada' => $desparacitar->aplicada,
        ];

        $response = $this->put('/desparacitar/' . $desparacitar->id, $updatedData);

        $response->assertStatus(422);
    }

    public function testActualizarUnidadDesparasitanteConValorStringNumeros()
    {
        $desparacitar = Desparacitar::factory()->create();

        $updatedData = [
            'num_id' => $desparacitar->num_id,
            'medi_id' => $desparacitar->medi_id,
            'dosis' => $desparacitar->dosis,
            'unidad_desparasitante' => '123456',
            'fecha_aplicada' => $desparacitar->fecha_aplicada,
            'aplicada' => $desparacitar->aplicada,
        ];

        $response = $this->put('/desparacitar/' . $desparacitar->id, $updatedData);

        $response->assertStatus(422);
    }

    public function testActualizarUnidadDesparasitanteConValorStringEspacios()
    {
        $desparacitar = Desparacitar::factory()->create();

        $updatedData = [
            'num_id' => $desparacitar->num_id,
            'medi_id' => $desparacitar->medi_id,
            'dosis' => $desparacitar->dosis,
            'unidad_desparasitante' => '   ',
            'fecha_aplicada' => $desparacitar->fecha_aplicada,
            'aplicada' => $desparacitar->aplicada,
        ];

        $response = $this->put('/desparacitar/' . $desparacitar->id, $updatedData);

        $response->assertStatus(422);
    }

    public function testActualizarUnidadDesparasitanteConValorStringValido()
    {
        $desparacitar = Desparacitar::factory()->create();

        $updatedData = [
            'num_id' => $desparacitar->num_id,
            'medi_id' => $desparacitar->medi_id,
            'dosis' => $desparacitar->dosis,
            'unidad_desparasitante' => 'ml',
            'fecha_aplicada' => $desparacitar->fecha_aplicada,
            'aplicada' => $desparacitar->aplicada,
        ];

        $response = $this->put('/desparacitar/' . $desparacitar->id, $updatedData);

        $response->assertStatus(302);

        $this->assertDatabaseHas('aplicados', [
            'id' => $desparacitar->id,
            'unidad_desparasitante' => 'ml',
        ]);
    }

    public function testActualizarUnidadDesparasitanteConValorStringNoAlfabetico()
    {
        $desparacitar = Desparacitar::factory()->create();

        $updatedData = [
            'num_id' => $desparacitar->num_id,
            'medi_id' => $desparacitar->medi_id,
            'dosis' => $desparacitar->dosis,
            'unidad_desparasitante' => '123abc',
            'fecha_aplicada' => $desparacitar->fecha_aplicada,
            'aplicada' => $desparacitar->aplicada,
        ];

        $response = $this->put('/desparacitar/' . $desparacitar->id, $updatedData);

        $response->assertStatus(422);
    }

    public function testActualizarUnidadDesparasitanteConValorStringMayusculas()
    {
        $desparacitar = Desparacitar::factory()->create();

        $updatedData = [
            'num_id' => $desparacitar->num_id,
            'medi_id' => $desparacitar->medi_id,
            'dosis' => $desparacitar->dosis,
            'unidad_desparasitante' => 'ML',
            'fecha_aplicada' => $desparacitar->fecha_aplicada,
            'aplicada' => $desparacitar->aplicada,
        ];

        $response = $this->put('/desparacitar/' . $desparacitar->id, $updatedData);

        $response->assertStatus(422);
    }

    public function testActualizarUnidadDesparasitanteConValorStringCaracteresNoPermitidos()
    {
        $desparacitar = Desparacitar::factory()->create();

        $updatedData = [
            'num_id' => $desparacitar->num_id,
            'medi_id' => $desparacitar->medi_id,
            'dosis' => $desparacitar->dosis,
            'unidad_desparasitante' => 'ml/kg',
            'fecha_aplicada' => $desparacitar->fecha_aplicada,
            'aplicada' => $desparacitar->aplicada,
        ];

        $response = $this->put('/desparacitar/' . $desparacitar->id, $updatedData);

        $response->assertStatus(422);
    }

    public function testActualizarFechaAplicadaConFormatoInvalido()
    {
        $desparacitar = Desparacitar::factory()->create();

        $updatedData = [
            'num_id' => $desparacitar->num_id,
            'medi_id' => $desparacitar->medi_id,
            'dosis' => $desparacitar->dosis,
            'unidad_desparasitante' => $desparacitar->unidad_desparasitante,
            'fecha_aplicada' => '2021-13-01', // Mes inválido
            'aplicada' => $desparacitar->aplicada,
        ];

        $response = $this->put('/desparacitar/' . $desparacitar->id, $updatedData);

        $response->assertStatus(422);
    }

    public function testActualizarFechaAplicadaConFormatoValido()
    {
        $desparacitar = Desparacitar::factory()->create();

        $updatedData = [
            'num_id' => $desparacitar->num_id,
            'medi_id' => $desparacitar->medi_id,
            'dosis' => $desparacitar->dosis,
            'unidad_desparasitante' => $desparacitar->unidad_desparasitante,
            'fecha_aplicada' => '2022-01-01',
            'aplicada' => $desparacitar->aplicada,
        ];

        $response = $this->put('/desparacitar/' . $desparacitar->id, $updatedData);

        $response->assertStatus(302);

        $this->assertDatabaseHas('aplicados', [
            'id' => $desparacitar->id,
            'fecha_aplicada' => '2022-01-01',
        ]);
    }

    public function testActualizarFechaAplicadaConValorStringNoFecha()
    {
        $desparacitar = Desparacitar::factory()->create();

        $updatedData = [
            'num_id' => $desparacitar->num_id,
            'medi_id' => $desparacitar->medi_id,
            'dosis' => $desparacitar->dosis,
            'unidad_desparasitante' => $desparacitar->unidad_desparasitante,
            'fecha_aplicada' => 'no es una fecha',
            'aplicada' => $desparacitar->aplicada,
        ];

        $response = $this->put('/desparacitar/' . $desparacitar->id, $updatedData);

        $response->assertStatus(422);
    }

    public function testActualizarFechaAplicadaConValorStringFechaFutura()
    {
        $desparacitar = Desparacitar::factory()->create();

        $updatedData = [
            'num_id' => $desparacitar->num_id,
            'medi_id' => $desparacitar->medi_id,
            'dosis' => $desparacitar->dosis,
            'unidad_desparasitante' => $desparacitar->unidad_desparasitante,
            'fecha_aplicada' => '2030-01-01', // Fecha futura
            'aplicada' => $desparacitar->aplicada,
        ];

        $response = $this->put('/desparacitar/' . $desparacitar->id, $updatedData);

        $response->assertStatus(422);
    }

    public function testActualizarFechaAplicadaConValorStringFechaPasada()
    {
        $desparacitar = Desparacitar::factory()->create();

        $updatedData = [
            'num_id' => $desparacitar->num_id,
            'medi_id' => $desparacitar->medi_id,
            'dosis' => $desparacitar->dosis,
            'unidad_desparasitante' => $desparacitar->unidad_desparasitante,
            'fecha_aplicada' => '2000-01-01', // Fecha pasada
            'aplicada' => $desparacitar->aplicada,
        ];

        $response = $this->put('/desparacitar/' . $desparacitar->id, $updatedData);

        $response->assertStatus(422);
    }

    public function testActualizarFechaAplicadaConValorStringFechaActual()
    {
        $desparacitar = Desparacitar::factory()->create();

        $updatedData = [
            'num_id' => $desparacitar->num_id,
            'medi_id' => $desparacitar->medi_id,
            'dosis' => $desparacitar->dosis,
            'unidad_desparasitante' => $desparacitar->unidad_desparasitante,
            'fecha_aplicada' => date('Y-m-d'), // Fecha actual
            'aplicada' => $desparacitar->aplicada,
        ];

        $response = $this->put('/desparacitar/' . $desparacitar->id, $updatedData);

        $response->assertStatus(302);

        $this->assertDatabaseHas('aplicados', [
            'id' => $desparacitar->id,
            'fecha_aplicada' => date('Y-m-d'),
        ]);
    }

    public function testActualizarFechaAplicadaConValorStringFormatoNoEstandar()
    {
        $desparacitar = Desparacitar::factory()->create();

        $updatedData = [
            'num_id' => $desparacitar->num_id,
            'medi_id' => $desparacitar->medi_id,
            'dosis' => $desparacitar->dosis,
            'unidad_desparasitante' => $desparacitar->unidad_desparasitante,
            'fecha_aplicada' => '01/01/2022', // Formato no estándar
            'aplicada' => $desparacitar->aplicada,
        ];

        $response = $this->put('/desparacitar/' . $desparacitar->id, $updatedData);

        $response->assertStatus(422);
    }

    public function testActualizarFechaAplicadaConValorStringFormatoEstandar()
    {
        $desparacitar = Desparacitar::factory()->create();

        $updatedData = [
            'num_id' => $desparacitar->num_id,
            'medi_id' => $desparacitar->medi_id,
            'dosis' => $desparacitar->dosis,
            'unidad_desparasitante' => $desparacitar->unidad_desparasitante,
            'fecha_aplicada' => '2022-01-01', // Formato estándar
            'aplicada' => $desparacitar->aplicada,
        ];

        $response = $this->put('/desparacitar/' . $desparacitar->id, $updatedData);

        $response->assertStatus(302);

        $this->assertDatabaseHas('aplicados', [
            'id' => $desparacitar->id,
            'fecha_aplicada' => '2022-01-01',
        ]);
    }

    public function testActualizarFechaAplicadaConValorStringFormatoAnoCorto()
    {
        $desparacitar = Desparacitar::factory()->create();

        $updatedData = [
            'num_id' => $desparacitar->num_id,
            'medi_id' => $desparacitar->medi_id,
            'dosis' => $desparacitar->dosis,
            'unidad_desparasitante' => $desparacitar->unidad_desparasitante,
            'fecha_aplicada' => '22-01-01', // Formato de año corto
            'aplicada' => $desparacitar->aplicada,
        ];

        $response = $this->put('/desparacitar/' . $desparacitar->id, $updatedData);

        $response->assertStatus(422);
    }

    public function testActualizarFechaAplicadaConValorStringFormatoAñoLargo()
    {
        $desparacitar = Desparacitar::factory()->create();

        $updatedData = [
            'num_id' => $desparacitar->num_id,
            'medi_id' => $desparacitar->medi_id,
            'dosis' => $desparacitar->dosis,
            'unidad_desparasitante' => $desparacitar->unidad_desparasitante,
            'fecha_aplicada' => '2022-01-01', // Formato de año largo
            'aplicada' => $desparacitar->aplicada,
        ];

        $response = $this->put('/desparacitar/' . $desparacitar->id, $updatedData);

        $response->assertStatus(302);

        $this->assertDatabaseHas('aplicados', [
            'id' => $desparacitar->id,
            'fecha_aplicada' => '2022-01-01',
        ]);
    }

    public function testActualizarFechaAplicadaConValorStringFormatoDiaCorto()
    {
        $desparacitar = Desparacitar::factory()->create();

        $updatedData = [
            'num_id' => $desparacitar->num_id,
            'medi_id' => $desparacitar->medi_id,
            'dosis' => $desparacitar->dosis,
            'unidad_desparasitante' => $desparacitar->unidad_desparasitante,
            'fecha_aplicada' => '2022-1-1', // Formato de día corto
            'aplicada' => $desparacitar->aplicada,
        ];

        $response = $this->put('/desparacitar/' . $desparacitar->id, $updatedData);

        $response->assertStatus(422);
    }

    public function testActualizarFechaAplicadaConValorStringFormatoDiaLargo()
    {
        $desparacitar = Desparacitar::factory()->create();

        $updatedData = [
            'num_id' => $desparacitar->num_id,
            'medi_id' => $desparacitar->medi_id,
            'dosis' => $desparacitar->dosis,
            'unidad_desparasitante' => $desparacitar->unidad_desparasitante,
            'fecha_aplicada' => '2022-01-01', // Formato de día largo
            'aplicada' => $desparacitar->aplicada,
        ];

        $response = $this->put('/desparacitar/' . $desparacitar->id, $updatedData);

        $response->assertStatus(302);

        $this->assertDatabaseHas('aplicados', [
            'id' => $desparacitar->id,
            'fecha_aplicada' => '2022-01-01',
        ]);
    }

    public function testActualizarAplicadaConValorNoValido()
    {
        $desparacitar = Desparacitar::factory()->create();

        $updatedData = [
            'num_id' => $desparacitar->num_id,
            'medi_id' => $desparacitar->medi_id,
            'dosis' => $desparacitar->dosis,
            'unidad_desparasitante' => $desparacitar->unidad_desparasitante,
            'fecha_aplicada' => $desparacitar->fecha_aplicada,
            'aplicada' => 2, // Valor no válido
        ];

        $response = $this->put('/desparacitar/' . $desparacitar->id, $updatedData);

        $response->assertStatus(422);
    }

    public function testActualizarAplicadaConValorValido()
    {
        $desparacitar = Desparacitar::factory()->create();

        $updatedData = [
            'num_id' => $desparacitar->num_id,
            'medi_id' => $desparacitar->medi_id,
            'dosis' => $desparacitar->dosis,
            'unidad_desparasitante' => $desparacitar->unidad_desparasitante,
            'fecha_aplicada' => $desparacitar->fecha_aplicada,
            'aplicada' => 1, // Valor válido
        ];

        $response = $this->put('/desparacitar/' . $desparacitar->id, $updatedData);

        $response->assertStatus(302);

        $this->assertDatabaseHas('aplicados', [
            'id' => $desparacitar->id,
            'aplicada' => 1,
        ]);
    }

    public function testActualizarAplicadaConValorString()
    {
        $desparacitar = Desparacitar::factory()->create();

        $updatedData = [
            'num_id' => $desparacitar->num_id,
            'medi_id' => $desparacitar->medi_id,
            'dosis' => $desparacitar->dosis,
            'unidad_desparasitante' => $desparacitar->unidad_desparasitante,
            'fecha_aplicada' => $desparacitar->fecha_aplicada,
            'aplicada' => 'string', // Valor string
        ];

        $response = $this->put('/desparacitar/' . $desparacitar->id, $updatedData);

        $response->assertStatus(422);
    }

    public function testActualizarAplicadaConValorNegativo()
    {
        $desparacitar = Desparacitar::factory()->create();

        $updatedData = [
            'num_id' => $desparacitar->num_id,
            'medi_id' => $desparacitar->medi_id,
            'dosis' => $desparacitar->dosis,
            'unidad_desparasitante' => $desparacitar->unidad_desparasitante,
            'fecha_aplicada' => $desparacitar->fecha_aplicada,
            'aplicada' => -1, // Valor negativo
        ];

        $response = $this->put('/desparacitar/' . $desparacitar->id, $updatedData);

        $response->assertStatus(422);
    }

    public function testActualizarAplicadaSinValor()
    {
        $desparacitar = Desparacitar::factory()->create();

        $updatedData = [
            'num_id' => $desparacitar->num_id,
            'medi_id' => $desparacitar->medi_id,
            'dosis' => $desparacitar->dosis,
            'unidad_desparasitante' => $desparacitar->unidad_desparasitante,
            'fecha_aplicada' => $desparacitar->fecha_aplicada,
            // 'aplicada' no se proporciona
        ];

        $response = $this->put('/desparacitar/' . $desparacitar->id, $updatedData);

        $response->assertStatus(422);
    }
}