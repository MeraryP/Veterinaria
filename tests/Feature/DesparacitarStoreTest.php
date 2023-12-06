<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Paciente;
use App\Models\Medicamento;
use App\Models\User;

class DesparacitarStoreTest extends TestCase
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
    public function testStoreFallaSinDatosRequeridos()
    {
        $response = $this->post('/desparacitar', []);

        $response->assertStatus(422);
    }

    public function testStoreExitosoConTodosLosDatosRequeridos()
    {
        $paciente = Paciente::factory()->create();
        $medicamento = Medicamento::factory()->create();

        $newData = [
            'num_id' => $paciente->id,
            'medi_id' => $medicamento->id,
            'dosis' => 1,
            'unidad_desparasitante' => 'ml',
            'fecha_aplicada' => now()->format('Y-m-d'),
            'aplicada' => true,
        ];

        $response = $this->post('/desparacitar', $newData);

        $response->assertStatus(302);

        $this->assertDatabaseHas('aplicados', $newData);
    }

    public function testStoreFallaSinNumId()
    {
        $medicamento = Medicamento::factory()->create();

        $newData = [
            // 'num_id' no se proporciona
            'medi_id' => $medicamento->id,
            'dosis' => 1,
            'unidad_desparasitante' => 'ml',
            'fecha_aplicada' => now()->format('Y-m-d'),
            'aplicada' => true,
        ];

        $response = $this->post('/desparacitar', $newData);

        $response->assertStatus(422);
    }

    public function testStoreFallaConNumIdNoExistente()
    {
        $medicamento = Medicamento::factory()->create();

        $newData = [
            'num_id' => 9999, // ID que no existe
            'medi_id' => $medicamento->id,
            'dosis' => 1,
            'unidad_desparasitante' => 'ml',
            'fecha_aplicada' => now()->format('Y-m-d'),
            'aplicada' => true,
        ];

        $response = $this->post('/desparacitar', $newData);

        $response->assertStatus(422);
    }

    public function testStoreFallaConNumIdString()
    {
        $medicamento = Medicamento::factory()->create();

        $newData = [
            'num_id' => 'string', // num_id es un string
            'medi_id' => $medicamento->id,
            'dosis' => 1,
            'unidad_desparasitante' => 'ml',
            'fecha_aplicada' => now()->format('Y-m-d'),
            'aplicada' => true,
        ];

        $response = $this->post('/desparacitar', $newData);

        $response->assertStatus(422);
    }

    public function testStoreFallaConNumIdNegativo()
    {
        $medicamento = Medicamento::factory()->create();

        $newData = [
            'num_id' => -1, // num_id es un número negativo
            'medi_id' => $medicamento->id,
            'dosis' => 1,
            'unidad_desparasitante' => 'ml',
            'fecha_aplicada' => now()->format('Y-m-d'),
            'aplicada' => true,
        ];

        $response = $this->post('/desparacitar', $newData);

        $response->assertStatus(422);
    }

    public function testStoreFallaSinMediId()
    {
        $paciente = Paciente::factory()->create();

        $newData = [
            'num_id' => $paciente->id,
            // 'medi_id' no se proporciona
            'dosis' => 1,
            'unidad_desparasitante' => 'ml',
            'fecha_aplicada' => now()->format('Y-m-d'),
            'aplicada' => true,
        ];

        $response = $this->post('/desparacitar', $newData);

        $response->assertStatus(422);
    }

    public function testStoreFallaConMediIdNoExistente()
    {
        $paciente = Paciente::factory()->create();

        $newData = [
            'num_id' => $paciente->id,
            'medi_id' => 9999, // ID que no existe
            'dosis' => 1,
            'unidad_desparasitante' => 'ml',
            'fecha_aplicada' => now()->format('Y-m-d'),
            'aplicada' => true,
        ];

        $response = $this->post('/desparacitar', $newData);

        $response->assertStatus(422);
    }

    public function testStoreFallaConMediIdString()
    {
        $paciente = Paciente::factory()->create();

        $newData = [
            'num_id' => $paciente->id,
            'medi_id' => 'string', // medi_id es un string
            'dosis' => 1,
            'unidad_desparasitante' => 'ml',
            'fecha_aplicada' => now()->format('Y-m-d'),
            'aplicada' => true,
        ];

        $response = $this->post('/desparacitar', $newData);

        $response->assertStatus(422);
    }

    public function testStoreFallaConMediIdNegativo()
    {
        $paciente = Paciente::factory()->create();

        $newData = [
            'num_id' => $paciente->id,
            'medi_id' => -1, // medi_id es un número negativo
            'dosis' => 1,
            'unidad_desparasitante' => 'ml',
            'fecha_aplicada' => now()->format('Y-m-d'),
            'aplicada' => true,
        ];

        $response = $this->post('/desparacitar', $newData);

        $response->assertStatus(422);
    }

    public function testStoreFallaConDosisValorInvalido()
    {
        $paciente = Paciente::factory()->create();
        $medicamento = Medicamento::factory()->create();

        $newData = [
            'num_id' => $paciente->id,
            'medi_id' => $medicamento->id,
            'dosis' => 'valorInvalido', // Valor inválido para dosis
            'unidad_desparasitante' => 'ml',
            'fecha_aplicada' => now()->format('Y-m-d'),
            'aplicada' => true,
        ];

        $response = $this->post('/desparacitar', $newData);

        $response->assertStatus(422);
    }

    public function testStoreFallaConDosisValorVacio()
    {
        $paciente = Paciente::factory()->create();
        $medicamento = Medicamento::factory()->create();

        $newData = [
            'num_id' => $paciente->id,
            'medi_id' => $medicamento->id,
            'dosis' => '', // Valor vacío para dosis
            'unidad_desparasitante' => 'ml',
            'fecha_aplicada' => now()->format('Y-m-d'),
            'aplicada' => true,
        ];

        $response = $this->post('/desparacitar', $newData);

        $response->assertStatus(422);
    }

    public function testStoreFallaConDosisValorNegativo()
    {
        $paciente = Paciente::factory()->create();
        $medicamento = Medicamento::factory()->create();

        $newData = [
            'num_id' => $paciente->id,
            'medi_id' => $medicamento->id,
            'dosis' => -1, // Valor negativo para dosis
            'unidad_desparasitante' => 'ml',
            'fecha_aplicada' => now()->format('Y-m-d'),
            'aplicada' => true,
        ];

        $response = $this->post('/desparacitar', $newData);

        $response->assertStatus(422);
    }

    public function testStoreFallaConDosisValorNull()
    {
        $paciente = Paciente::factory()->create();
        $medicamento = Medicamento::factory()->create();

        $newData = [
            'num_id' => $paciente->id,
            'medi_id' => $medicamento->id,
            'dosis' => null, // Valor null para dosis
            'unidad_desparasitante' => 'ml',
            'fecha_aplicada' => now()->format('Y-m-d'),
            'aplicada' => true,
        ];

        $response = $this->post('/desparacitar', $newData);

        $response->assertStatus(422);
    }

    public function testStoreExitosoConDosisValorValido()
    {
        $paciente = Paciente::factory()->create();
        $medicamento = Medicamento::factory()->create();

        $newData = [
            'num_id' => $paciente->id,
            'medi_id' => $medicamento->id,
            'dosis' => 10, // Valor válido para dosis
            'unidad_desparasitante' => 'ml',
            'fecha_aplicada' => now()->format('Y-m-d'),
            'aplicada' => true,
        ];

        $response = $this->post('/desparacitar', $newData);

        $response->assertStatus(302);

        $this->assertDatabaseHas('aplicados', [
            'num_id' => $paciente->id,
            'medi_id' => $medicamento->id,
            'dosis' => 10,
        ]);
    }

    public function testStoreFallaConUnidadDesparasitanteValorNumerico()
    {
        $paciente = Paciente::factory()->create();
        $medicamento = Medicamento::factory()->create();

        $newData = [
            'num_id' => $paciente->id,
            'medi_id' => $medicamento->id,
            'dosis' => 10,
            'unidad_desparasitante' => 123, // Valor numérico para unidad_desparasitante
            'fecha_aplicada' => now()->format('Y-m-d'),
            'aplicada' => true,
        ];

        $response = $this->post('/desparacitar', $newData);

        $response->assertStatus(422);
    }

    public function testStoreFallaConUnidadDesparasitanteValorNull()
    {
        $paciente = Paciente::factory()->create();
        $medicamento = Medicamento::factory()->create();

        $newData = [
            'num_id' => $paciente->id,
            'medi_id' => $medicamento->id,
            'dosis' => 10,
            'unidad_desparasitante' => null, // Valor null para unidad_desparasitante
            'fecha_aplicada' => now()->format('Y-m-d'),
            'aplicada' => true,
        ];

        $response = $this->post('/desparacitar', $newData);

        $response->assertStatus(422);
    }

    public function testStoreFallaConUnidadDesparasitanteValorStringVacio()
    {
        $paciente = Paciente::factory()->create();
        $medicamento = Medicamento::factory()->create();

        $newData = [
            'num_id' => $paciente->id,
            'medi_id' => $medicamento->id,
            'dosis' => 10,
            'unidad_desparasitante' => '', // Valor string vacío para unidad_desparasitante
            'fecha_aplicada' => now()->format('Y-m-d'),
            'aplicada' => true,
        ];

        $response = $this->post('/desparacitar', $newData);

        $response->assertStatus(422);
    }

    public function testStoreFallaConUnidadDesparasitanteValorStringLargo()
    {
        $paciente = Paciente::factory()->create();
        $medicamento = Medicamento::factory()->create();

        $newData = [
            'num_id' => $paciente->id,
            'medi_id' => $medicamento->id,
            'dosis' => 10,
            'unidad_desparasitante' => str_repeat('a', 256), // Excede la longitud máxima permitida
            'fecha_aplicada' => now()->format('Y-m-d'),
            'aplicada' => true,
        ];

        $response = $this->post('/desparacitar', $newData);

        $response->assertStatus(422);
    }

    public function testStoreFallaConUnidadDesparasitanteValorStringCaracteresEspeciales()
    {
        $paciente = Paciente::factory()->create();
        $medicamento = Medicamento::factory()->create();

        $newData = [
            'num_id' => $paciente->id,
            'medi_id' => $medicamento->id,
            'dosis' => 10,
            'unidad_desparasitante' => '@#$$%%^&*', // Caracteres especiales
            'fecha_aplicada' => now()->format('Y-m-d'),
            'aplicada' => true,
        ];

        $response = $this->post('/desparacitar', $newData);

        $response->assertStatus(422);
    }

    public function testStoreFallaConUnidadDesparasitanteValorStringNumeros()
    {
        $paciente = Paciente::factory()->create();
        $medicamento = Medicamento::factory()->create();

        $newData = [
            'num_id' => $paciente->id,
            'medi_id' => $medicamento->id,
            'dosis' => 10,
            'unidad_desparasitante' => '123456', // Números como string
            'fecha_aplicada' => now()->format('Y-m-d'),
            'aplicada' => true,
        ];

        $response = $this->post('/desparacitar', $newData);

        $response->assertStatus(422);
    }

    public function testStoreFallaConUnidadDesparasitanteValorStringEspacios()
    {
        $paciente = Paciente::factory()->create();
        $medicamento = Medicamento::factory()->create();

        $newData = [
            'num_id' => $paciente->id,
            'medi_id' => $medicamento->id,
            'dosis' => 10,
            'unidad_desparasitante' => '   ', // String solo con espacios
            'fecha_aplicada' => now()->format('Y-m-d'),
            'aplicada' => true,
        ];

        $response = $this->post('/desparacitar', $newData);

        $response->assertStatus(422);
    }

    public function testStorePasaConUnidadDesparasitanteValorStringValido()
    {
        $paciente = Paciente::factory()->create();
        $medicamento = Medicamento::factory()->create();

        $newData = [
            'num_id' => $paciente->id,
            'medi_id' => $medicamento->id,
            'dosis' => 10,
            'unidad_desparasitante' => 'ml', // String válido
            'fecha_aplicada' => now()->format('Y-m-d'),
            'aplicada' => true,
        ];

        $response = $this->post('/desparacitar', $newData);

        $response->assertStatus(302);

        $this->assertDatabaseHas('aplicados', [
            'num_id' => $paciente->id,
            'unidad_desparasitante' => 'ml',
        ]);
    }

    public function testStoreFallaConUnidadDesparasitanteValorStringNoAlfabetico()
    {
        $paciente = Paciente::factory()->create();
        $medicamento = Medicamento::factory()->create();

        $newData = [
            'num_id' => $paciente->id,
            'medi_id' => $medicamento->id,
            'dosis' => 10,
            'unidad_desparasitante' => '123abc', // String con números
            'fecha_aplicada' => now()->format('Y-m-d'),
            'aplicada' => true,
        ];

        $response = $this->post('/desparacitar', $newData);

        $response->assertStatus(422);
    }

    public function testStoreFallaConUnidadDesparasitanteValorStringMayusculas()
    {
        $paciente = Paciente::factory()->create();
        $medicamento = Medicamento::factory()->create();

        $newData = [
            'num_id' => $paciente->id,
            'medi_id' => $medicamento->id,
            'dosis' => 10,
            'unidad_desparasitante' => 'ML', // String en mayúsculas
            'fecha_aplicada' => now()->format('Y-m-d'),
            'aplicada' => true,
        ];

        $response = $this->post('/desparacitar', $newData);

        $response->assertStatus(422);
    }

    public function testStoreFallaConUnidadDesparasitanteValorStringCaracteresNoPermitidos()
    {
        $paciente = Paciente::factory()->create();
        $medicamento = Medicamento::factory()->create();

        $newData = [
            'num_id' => $paciente->id,
            'medi_id' => $medicamento->id,
            'dosis' => 10,
            'unidad_desparasitante' => 'ml/kg', // String con caracteres no permitidos
            'fecha_aplicada' => now()->format('Y-m-d'),
            'aplicada' => true,
        ];

        $response = $this->post('/desparacitar', $newData);

        $response->assertStatus(422);
    }

    public function testStoreFallaConFechaAplicadaFormatoInvalido()
    {
        $paciente = Paciente::factory()->create();
        $medicamento = Medicamento::factory()->create();

        $newData = [
            'num_id' => $paciente->id,
            'medi_id' => $medicamento->id,
            'dosis' => 10,
            'unidad_desparasitante' => 'ml',
            'fecha_aplicada' => '2021-13-01', // Fecha con formato inválido
            'aplicada' => true,
        ];

        $response = $this->post('/desparacitar', $newData);

        $response->assertStatus(422);
    }

    public function testStorePasaConFechaAplicadaFormatoValido()
    {
        $paciente = Paciente::factory()->create();
        $medicamento = Medicamento::factory()->create();

        $newData = [
            'num_id' => $paciente->id,
            'medi_id' => $medicamento->id,
            'dosis' => 10,
            'unidad_desparasitante' => 'ml',
            'fecha_aplicada' => '2022-01-01', // Fecha con formato válido
            'aplicada' => true,
        ];

        $response = $this->post('/desparacitar', $newData);

        $response->assertStatus(302);

        $this->assertDatabaseHas('aplicados', [
            'num_id' => $paciente->id,
            'fecha_aplicada' => '2022-01-01',
        ]);
    }

    public function testStoreFallaConFechaAplicadaValorStringNoFecha()
    {
        $paciente = Paciente::factory()->create();
        $medicamento = Medicamento::factory()->create();

        $newData = [
            'num_id' => $paciente->id,
            'medi_id' => $medicamento->id,
            'dosis' => 10,
            'unidad_desparasitante' => 'ml',
            'fecha_aplicada' => 'no es una fecha', // String que no es una fecha
            'aplicada' => true,
        ];

        $response = $this->post('/desparacitar', $newData);

        $response->assertStatus(422);
    }

    public function testStoreFallaConFechaAplicadaValorStringFechaFutura()
    {
        $paciente = Paciente::factory()->create();
        $medicamento = Medicamento::factory()->create();

        $newData = [
            'num_id' => $paciente->id,
            'medi_id' => $medicamento->id,
            'dosis' => 10,
            'unidad_desparasitante' => 'ml',
            'fecha_aplicada' => '2030-01-01', // Fecha futura
            'aplicada' => true,
        ];

        $response = $this->post('/desparacitar', $newData);

        $response->assertStatus(422);
    }

    public function testStoreFallaConFechaAplicadaValorStringFechaPasada()
    {
        $paciente = Paciente::factory()->create();
        $medicamento = Medicamento::factory()->create();

        $newData = [
            'num_id' => $paciente->id,
            'medi_id' => $medicamento->id,
            'dosis' => 10,
            'unidad_desparasitante' => 'ml',
            'fecha_aplicada' => '2000-01-01', // Fecha pasada
            'aplicada' => true,
        ];

        $response = $this->post('/desparacitar', $newData);

        $response->assertStatus(422);
    }

    public function testStorePasaConFechaAplicadaValorStringFechaActual()
    {
        $paciente = Paciente::factory()->create();
        $medicamento = Medicamento::factory()->create();

        $newData = [
            'num_id' => $paciente->id,
            'medi_id' => $medicamento->id,
            'dosis' => 10,
            'unidad_desparasitante' => 'ml',
            'fecha_aplicada' => date('Y-m-d'), // Fecha actual
            'aplicada' => true,
        ];

        $response = $this->post('/desparacitar', $newData);

        $response->assertStatus(302);

        $this->assertDatabaseHas('aplicados', [
            'num_id' => $paciente->id,
            'fecha_aplicada' => date('Y-m-d'),
        ]);
    }

    public function testStoreFallaConFechaAplicadaValorStringFormatoNoEstandar()
    {
        $paciente = Paciente::factory()->create();
        $medicamento = Medicamento::factory()->create();

        $newData = [
            'num_id' => $paciente->id,
            'medi_id' => $medicamento->id,
            'dosis' => 10,
            'unidad_desparasitante' => 'ml',
            'fecha_aplicada' => '01/01/2022', // Formato no estándar
            'aplicada' => true,
        ];

        $response = $this->post('/desparacitar', $newData);

        $response->assertStatus(422);
    }

    public function testStorePasaConFechaAplicadaValorStringFormatoEstandar()
    {
        $paciente = Paciente::factory()->create();
        $medicamento = Medicamento::factory()->create();

        $newData = [
            'num_id' => $paciente->id,
            'medi_id' => $medicamento->id,
            'dosis' => 10,
            'unidad_desparasitante' => 'ml',
            'fecha_aplicada' => '2022-01-01', // Formato estándar
            'aplicada' => true,
        ];

        $response = $this->post('/desparacitar', $newData);

        $response->assertStatus(302);

        $this->assertDatabaseHas('aplicados', [
            'num_id' => $paciente->id,
            'fecha_aplicada' => '2022-01-01',
        ]);
    }

    public function testStoreFallaConFechaAplicadaValorStringFormatoAnoCorto()
    {
        $paciente = Paciente::factory()->create();
        $medicamento = Medicamento::factory()->create();

        $newData = [
            'num_id' => $paciente->id,
            'medi_id' => $medicamento->id,
            'dosis' => 10,
            'unidad_desparasitante' => 'ml',
            'fecha_aplicada' => '22-01-01', // Formato de año corto
            'aplicada' => true,
        ];

        $response = $this->post('/desparacitar', $newData);

        $response->assertStatus(422);
    }

    public function testStorePasaConFechaAplicadaValorStringFormatoAñoLargo()
    {
        $paciente = Paciente::factory()->create();
        $medicamento = Medicamento::factory()->create();

        $newData = [
            'num_id' => $paciente->id,
            'medi_id' => $medicamento->id,
            'dosis' => 10,
            'unidad_desparasitante' => 'ml',
            'fecha_aplicada' => '2022-01-01', // Formato de año largo
            'aplicada' => true,
        ];

        $response = $this->post('/desparacitar', $newData);

        $response->assertStatus(302);

        $this->assertDatabaseHas('aplicados', [
            'num_id' => $paciente->id,
            'fecha_aplicada' => '2022-01-01',
        ]);
    }

    public function testStoreFallaConFechaAplicadaValorStringFormatoDiaCorto()
    {
        $paciente = Paciente::factory()->create();
        $medicamento = Medicamento::factory()->create();

        $newData = [
            'num_id' => $paciente->id,
            'medi_id' => $medicamento->id,
            'dosis' => 10,
            'unidad_desparasitante' => 'ml',
            'fecha_aplicada' => '2022-1-1', // Formato de día corto
            'aplicada' => true,
        ];

        $response = $this->post('/desparacitar', $newData);

        $response->assertStatus(422);
    }

    public function testStorePasaConFechaAplicadaValorStringFormatoDiaLargo()
    {
        $paciente = Paciente::factory()->create();
        $medicamento = Medicamento::factory()->create();

        $newData = [
            'num_id' => $paciente->id,
            'medi_id' => $medicamento->id,
            'dosis' => 10,
            'unidad_desparasitante' => 'ml',
            'fecha_aplicada' => '2022-01-01', // Formato de día largo
            'aplicada' => true,
        ];

        $response = $this->post('/desparacitar', $newData);

        $response->assertStatus(302);

        $this->assertDatabaseHas('aplicados', [
            'num_id' => $paciente->id,
            'fecha_aplicada' => '2022-01-01',
        ]);
    }

    public function testStoreFallaConAplicadaValorNoValido()
    {
        $paciente = Paciente::factory()->create();
        $medicamento = Medicamento::factory()->create();

        $newData = [
            'num_id' => $paciente->id,
            'medi_id' => $medicamento->id,
            'dosis' => 10,
            'unidad_desparasitante' => 'ml',
            'fecha_aplicada' => now()->format('Y-m-d'),
            'aplicada' => 2, // Valor no válido
        ];

        $response = $this->post('/desparacitar', $newData);

        $response->assertStatus(422);
    }

    public function testStorePasaConAplicadaValorValido()
    {
        $paciente = Paciente::factory()->create();
        $medicamento = Medicamento::factory()->create();

        $newData = [
            'num_id' => $paciente->id,
            'medi_id' => $medicamento->id,
            'dosis' => 10,
            'unidad_desparasitante' => 'ml',
            'fecha_aplicada' => now()->format('Y-m-d'),
            'aplicada' => 1, // Valor válido
        ];

        $response = $this->post('/desparacitar', $newData);

        $response->assertStatus(302);

        $this->assertDatabaseHas('aplicados', [
            'num_id' => $paciente->id,
            'aplicada' => 1,
        ]);
    }

    public function testStoreFallaConAplicadaValorString()
    {
        $paciente = Paciente::factory()->create();
        $medicamento = Medicamento::factory()->create();

        $newData = [
            'num_id' => $paciente->id,
            'medi_id' => $medicamento->id,
            'dosis' => 10,
            'unidad_desparasitante' => 'ml',
            'fecha_aplicada' => now()->format('Y-m-d'),
            'aplicada' => 'string', // Valor string
        ];

        $response = $this->post('/desparacitar', $newData);

        $response->assertStatus(422);
    }

    public function testStoreFallaConAplicadaValorNegativo()
    {
        $paciente = Paciente::factory()->create();
        $medicamento = Medicamento::factory()->create();

        $newData = [
            'num_id' => $paciente->id,
            'medi_id' => $medicamento->id,
            'dosis' => 10,
            'unidad_desparasitante' => 'ml',
            'fecha_aplicada' => now()->format('Y-m-d'),
            'aplicada' => -1, // Valor negativo
        ];

        $response = $this->post('/desparacitar', $newData);

        $response->assertStatus(422);
    }

    public function testStoreFallaSinAplicadaValor()
    {
        $paciente = Paciente::factory()->create();
        $medicamento = Medicamento::factory()->create();

        $newData = [
            'num_id' => $paciente->id,
            'medi_id' => $medicamento->id,
            'dosis' => 10,
            'unidad_desparasitante' => 'ml',
            'fecha_aplicada' => now()->format('Y-m-d'),
            // 'aplicada' no se proporciona
        ];

        $response = $this->post('/desparacitar', $newData);

        $response->assertStatus(422);
    }
}