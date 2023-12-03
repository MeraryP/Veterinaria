<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Paciente;
use App\Models\Examen;

class ClinicoUpdateTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_update_examen()
    {
        $paciente = Paciente::factory()->create();

        $examen = Examen::factory()->create(['num_id' => $paciente->id]);

        $updatedData = [
            'num_id' => $paciente->id,
            'temperatura' => 37.5,
            'frecuencia_cardiaca' => 80,
            'frecuencia_respiratoria' => 20,
            'peso' => 70,
            'pulso' => 80,
        ];

        $response = $this->put(route('examen.update', $examen->id), $updatedData);

        $response->assertStatus(302);

        $this->assertDatabaseHas('examens', $updatedData);
    }

    public function test_actualizar_examen_con_datos_invalidos()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datosInvalidos = [
            'num_id' => $paciente->id,
            'temperatura' => 'invalido',
            'frecuencia_cardiaca' => 'invalido',
            'frecuencia_respiratoria' => 'invalido',
            'peso' => 'invalido',
            'pulso' => 'invalido',
        ];
        $response = $this->put(route('examen.update', $examen->id), $datosInvalidos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'temperatura',
            'frecuencia_cardiaca',
            'frecuencia_respiratoria',
            'peso',
            'pulso',
        ]);
    }

    public function test_actualizar_examen_no_existente()
    {
        $paciente = Paciente::factory()->create();
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37.5,
            'frecuencia_cardiaca' => 80,
            'frecuencia_respiratoria' => 20,
            'peso' => 70,
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', 999), $datos);
        $response->assertStatus(404);
    }

    public function test_actualizar_examen_con_num_id_invalido()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datosInvalidos = [
            'num_id' => 'invalido',
            'temperatura' => 37.5,
            'frecuencia_cardiaca' => 80,
            'frecuencia_respiratoria' => 20,
            'peso' => 70,
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datosInvalidos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['num_id']);
    }

    public function test_actualizar_examen_con_num_id_no_existente()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => 999,
            'temperatura' => 37.5,
            'frecuencia_cardiaca' => 80,
            'frecuencia_respiratoria' => 20,
            'peso' => 70,
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['num_id']);
    }

    public function test_actualizar_examen_con_num_id_nulo()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => null,
            'temperatura' => 37.5,
            'frecuencia_cardiaca' => 80,
            'frecuencia_respiratoria' => 20,
            'peso' => 70,
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['num_id']);
    }

    public function test_actualizar_examen_con_num_id_negativo()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => -1,
            'temperatura' => 37.5,
            'frecuencia_cardiaca' => 80,
            'frecuencia_respiratoria' => 20,
            'peso' => 70,
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['num_id']);
    }

    public function test_actualizar_examen_con_temperatura_nula()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => null,
            'frecuencia_cardiaca' => 80,
            'frecuencia_respiratoria' => 20,
            'peso' => 70,
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['temperatura']);
    }

    public function test_actualizar_examen_con_temperatura_no_numerica()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 'no numerico',
            'frecuencia_cardiaca' => 80,
            'frecuencia_respiratoria' => 20,
            'peso' => 70,
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['temperatura']);
    }

    public function test_actualizar_examen_con_temperatura_negativa()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => -1,
            'frecuencia_cardiaca' => 80,
            'frecuencia_respiratoria' => 20,
            'peso' => 70,
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['temperatura']);
    }

    public function test_actualizar_examen_con_temperatura_muy_alta()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 86,
            'frecuencia_cardiaca' => 80,
            'frecuencia_respiratoria' => 20,
            'peso' => 70,
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['temperatura']);
    }

    public function test_actualizar_examen_con_temperatura_normal()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37,
            'frecuencia_cardiaca' => 80,
            'frecuencia_respiratoria' => 20,
            'peso' => 70,
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(200);
    }

    public function test_actualizar_examen_con_temperatura_con_demasiados_decimales()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37.123,
            'frecuencia_cardiaca' => 80,
            'frecuencia_respiratoria' => 20,
            'peso' => 70,
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['temperatura']);
    }

    public function test_actualizar_examen_con_temperatura_muy_baja()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 30,
            'frecuencia_cardiaca' => 80,
            'frecuencia_respiratoria' => 20,
            'peso' => 70,
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['temperatura']);
    }

    public function test_actualizar_examen_con_temperatura_con_dos_decimales()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37.12,
            'frecuencia_cardiaca' => 80,
            'frecuencia_respiratoria' => 20,
            'peso' => 70,
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(200);
    }

    public function test_actualizar_examen_con_temperatura_con_mas_de_dos_decimales()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37.12345,
            'frecuencia_cardiaca' => 80,
            'frecuencia_respiratoria' => 20,
            'peso' => 70,
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['temperatura']);
    }

    public function test_actualizar_examen_con_frecuencia_cardiaca_negativa()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37,
            'frecuencia_cardiaca' => -1,
            'frecuencia_respiratoria' => 20,
            'peso' => 70,
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['frecuencia_cardiaca']);
    }

    public function test_actualizar_examen_con_frecuencia_cardiaca_muy_alta()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37,
            'frecuencia_cardiaca' => 201,
            'frecuencia_respiratoria' => 20,
            'peso' => 70,
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['frecuencia_cardiaca']);
    }

    public function test_actualizar_examen_con_frecuencia_cardiaca_normal_perro()
    {
        $paciente = Paciente::factory()->create(['especie' => 'perro']);
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37,
            'frecuencia_cardiaca' => 80,
            'frecuencia_respiratoria' => 20,
            'peso' => 70,
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(200);
    }

    public function test_actualizar_examen_con_frecuencia_cardiaca_fuera_de_rango_gato()
    {
        $paciente = Paciente::factory()->create(['especie' => 'gato']);
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37,
            'frecuencia_cardiaca' => 221,
            'frecuencia_respiratoria' => 20,
            'peso' => 70,
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['frecuencia_cardiaca']);
    }

    public function test_actualizar_examen_con_frecuencia_cardiaca_normal_gato()
    {
        $paciente = Paciente::factory()->create(['especie' => 'gato']);
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37,
            'frecuencia_cardiaca' => 150,
            'frecuencia_respiratoria' => 20,
            'peso' => 70,
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(200);
    }

    public function test_actualizar_examen_con_frecuencia_cardiaca_fuera_de_rango_perro()
    {
        $paciente = Paciente::factory()->create(['especie' => 'perro']);
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37,
            'frecuencia_cardiaca' => 59,
            'frecuencia_respiratoria' => 20,
            'peso' => 70,
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['frecuencia_cardiaca']);
    }

    public function test_actualizar_examen_con_frecuencia_cardiaca_muy_grande()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37,
            'frecuencia_cardiaca' => 10000,
            'frecuencia_respiratoria' => 20,
            'peso' => 70,
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['frecuencia_cardiaca']);
    }

    public function test_actualizar_examen_con_frecuencia_cardiaca_como_texto()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37,
            'frecuencia_cardiaca' => 'ochenta',
            'frecuencia_respiratoria' => 20,
            'peso' => 70,
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['frecuencia_cardiaca']);
    }

    public function test_actualizar_examen_con_frecuencia_cardiaca_con_caracteres_especiales()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37,
            'frecuencia_cardiaca' => '80#',
            'frecuencia_respiratoria' => 20,
            'peso' => 70,
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['frecuencia_cardiaca']);
    }

    public function test_actualizar_examen_con_frecuencia_cardiaca_decimal()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37,
            'frecuencia_cardiaca' => 80.5,
            'frecuencia_respiratoria' => 20,
            'peso' => 70,
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['frecuencia_cardiaca']);
    }

    public function test_actualizar_examen_con_frecuencia_cardiaca_nula()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37,
            'frecuencia_cardiaca' => null,
            'frecuencia_respiratoria' => 20,
            'peso' => 70,
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['frecuencia_cardiaca']);
    }

    public function test_actualizar_examen_con_frecuencia_cardiaca_cero()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37,
            'frecuencia_cardiaca' => 0,
            'frecuencia_respiratoria' => 20,
            'peso' => 70,
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['frecuencia_cardiaca']);
    }

    public function test_actualizar_examen_con_frecuencia_cardiaca_vacia()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37,
            'frecuencia_cardiaca' => '',
            'frecuencia_respiratoria' => 20,
            'peso' => 70,
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['frecuencia_cardiaca']);
    }

    public function test_actualizar_examen_con_frecuencia_respiratoria_decimal()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37,
            'frecuencia_cardiaca' => 80,
            'frecuencia_respiratoria' => 20.5,
            'peso' => 70,
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['frecuencia_respiratoria']);
    }

    public function test_actualizar_examen_con_frecuencia_respiratoria_nula()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37,
            'frecuencia_cardiaca' => 80,
            'frecuencia_respiratoria' => null,
            'peso' => 70,
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['frecuencia_respiratoria']);
    }

    public function test_actualizar_examen_con_frecuencia_respiratoria_negativa()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37,
            'frecuencia_cardiaca' => 80,
            'frecuencia_respiratoria' => -1,
            'peso' => 70,
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['frecuencia_respiratoria']);
    }

    public function test_actualizar_examen_con_frecuencia_respiratoria_muy_grande()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37,
            'frecuencia_cardiaca' => 80,
            'frecuencia_respiratoria' => 10000,
            'peso' => 70,
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['frecuencia_respiratoria']);
    }

    public function test_actualizar_examen_con_frecuencia_respiratoria_cero()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37,
            'frecuencia_cardiaca' => 80,
            'frecuencia_respiratoria' => 0,
            'peso' => 70,
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['frecuencia_respiratoria']);
    }

    public function test_actualizar_examen_con_frecuencia_respiratoria_vacia()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37,
            'frecuencia_cardiaca' => 80,
            'frecuencia_respiratoria' => '',
            'peso' => 70,
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['frecuencia_respiratoria']);
    }

    public function test_actualizar_examen_con_frecuencia_respiratoria_string()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37,
            'frecuencia_cardiaca' => 80,
            'frecuencia_respiratoria' => 'veinte',
            'peso' => 70,
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['frecuencia_respiratoria']);
    }

    public function test_actualizar_examen_con_peso_negativo()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37,
            'frecuencia_cardiaca' => 80,
            'frecuencia_respiratoria' => 20,
            'peso' => -1,
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['peso']);
    }

    public function test_actualizar_examen_con_peso_string()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37,
            'frecuencia_cardiaca' => 80,
            'frecuencia_respiratoria' => 20,
            'peso' => 'setenta',
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['peso']);
    }

    public function test_actualizar_examen_con_peso_cero()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37,
            'frecuencia_cardiaca' => 80,
            'frecuencia_respiratoria' => 20,
            'peso' => 0,
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['peso']);
    }

    public function test_actualizar_examen_con_peso_muy_grande()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37,
            'frecuencia_cardiaca' => 80,
            'frecuencia_respiratoria' => 20,
            'peso' => 10000,
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['peso']);
    }

    public function test_actualizar_examen_con_peso_decimal()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37,
            'frecuencia_cardiaca' => 80,
            'frecuencia_respiratoria' => 20,
            'peso' => 70.5,
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['peso']);
    }

    public function test_actualizar_examen_con_peso_vacio()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37,
            'frecuencia_cardiaca' => 80,
            'frecuencia_respiratoria' => 20,
            'peso' => '',
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['peso']);
    }

    public function test_actualizar_examen_con_peso_null()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37,
            'frecuencia_cardiaca' => 80,
            'frecuencia_respiratoria' => 20,
            'peso' => null,
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['peso']);
    }

    public function test_actualizar_examen_con_peso_string_no_numerico()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37,
            'frecuencia_cardiaca' => 80,
            'frecuencia_respiratoria' => 20,
            'peso' => 'setenta',
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['peso']);
    }

    public function test_actualizar_examen_con_pulso_negativo()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37,
            'frecuencia_cardiaca' => 80,
            'frecuencia_respiratoria' => 20,
            'peso' => 70,
            'pulso' => -1,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['pulso']);
    }

    public function test_actualizar_examen_con_pulso_string_no_numerico()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37,
            'frecuencia_cardiaca' => 80,
            'frecuencia_respiratoria' => 20,
            'peso' => 70,
            'pulso' => 'ochenta',
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['pulso']);
    }

    public function test_actualizar_examen_con_pulso_null()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37,
            'frecuencia_cardiaca' => 80,
            'frecuencia_respiratoria' => 20,
            'peso' => 70,
            'pulso' => null,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['pulso']);
    }

    public function test_actualizar_examen_con_pulso_limite_superior()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37,
            'frecuencia_cardiaca' => 80,
            'frecuencia_respiratoria' => 20,
            'peso' => 70,
            'pulso' => 200,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(200);
    }

    public function test_actualizar_examen_con_pulso_decimal()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37,
            'frecuencia_cardiaca' => 80,
            'frecuencia_respiratoria' => 20,
            'peso' => 70,
            'pulso' => 80.5,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['pulso']);
    }

    public function test_actualizar_examen_con_pulso_vacio()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37,
            'frecuencia_cardiaca' => 80,
            'frecuencia_respiratoria' => 20,
            'peso' => 70,
            'pulso' => '',
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['pulso']);
    }

    public function test_actualizar_examen_con_pulso_cero()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37,
            'frecuencia_cardiaca' => 80,
            'frecuencia_respiratoria' => 20,
            'peso' => 70,
            'pulso' => 0,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['pulso']);
    }

    public function test_actualizar_examen_con_pulso_limite_inferior()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37,
            'frecuencia_cardiaca' => 80,
            'frecuencia_respiratoria' => 20,
            'peso' => 70,
            'pulso' => 1,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(200);
    }

    public function test_actualizar_examen_con_pulso_fuera_limite_superior()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37,
            'frecuencia_cardiaca' => 80,
            'frecuencia_respiratoria' => 20,
            'peso' => 70,
            'pulso' => 201,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['pulso']);
    }

    public function test_actualizar_examen_sin_pulso()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37,
            'frecuencia_cardiaca' => 80,
            'frecuencia_respiratoria' => 20,
            'peso' => 70,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['pulso']);
    }

    public function test_actualizar_examen_con_pulso_entero_valido()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->create(['num_id' => $paciente->id]);
        $datos = [
            'num_id' => $paciente->id,
            'temperatura' => 37,
            'frecuencia_cardiaca' => 80,
            'frecuencia_respiratoria' => 20,
            'peso' => 70,
            'pulso' => 80,
        ];
        $response = $this->put(route('examen.update', $examen->id), $datos);
        $response->assertStatus(200);
    }
}