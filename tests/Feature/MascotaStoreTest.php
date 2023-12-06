<?php

namespace Tests\Feature;

use App\Models\Paciente;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;

class MascotaStoreTest extends TestCase
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

    public function test_store()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nuevo nombre',
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => 'Nueva raza',
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertStatus(302);

        $mascota = Paciente::where('nombre_mascota', $mascotaData['nombre_mascota'])->first();
        $this->assertNotNull($mascota);
        $this->assertEquals($mascotaData['pro_id'], $mascota->pro_id);
        $this->assertEquals($mascotaData['especie_id'], $mascota->especie_id);
        $this->assertEquals($mascotaData['genero_id'], $mascota->genero_id);
        $this->assertEquals($mascotaData['raza'], $mascota->raza);
        $this->assertEquals($mascotaData['fecha_nacimiento'], $mascota->fecha_nacimiento->format('Y-m-d'));
    }

    public function test_nombre_mascota_requerido()
    {
        $mascotaData = [
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => 'Nueva raza',
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionHasErrors('nombre_mascota');
    }

    public function test_nombre_mascota_no_excede_maximo()
    {
        $mascotaData = [
            'nombre_mascota' => str_repeat('a', 101),
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => 'Nueva raza',
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionHasErrors('nombre_mascota');
    }

    public function test_nombre_mascota_solo_caracteres_permitidos()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre con caracteres no permitidos 123',
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => 'Nueva raza',
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionHasErrors('nombre_mascota');
    }

    public function test_nombre_mascota_acepta_maximo()
    {
        $mascotaData = [
            'nombre_mascota' => str_repeat('a', 100),
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => 'Nueva raza',
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionDoesntHaveErrors('nombre_mascota');
    }

    public function test_nombre_mascota_acepta_caracteres_permitidos()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre Válido',
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => 'Nueva raza',
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionDoesntHaveErrors('nombre_mascota');
    }

    public function test_nombre_mascota_no_puede_ser_vacio()
    {
        $mascotaData = [
            'nombre_mascota' => '',
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => 'Nueva raza',
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionHasErrors('nombre_mascota');
    }

    public function test_nombre_mascota_no_puede_ser_solo_espacios()
    {
        $mascotaData = [
            'nombre_mascota' => '   ',
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => 'Nueva raza',
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionHasErrors('nombre_mascota');
    }

    public function test_nombre_mascota_acepta_caracteres_especiales_permitidos()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre-Valido_2',
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => 'Nueva raza',
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionDoesntHaveErrors('nombre_mascota');
    }

    public function test_nombre_mascota_no_acepta_caracteres_especiales_no_permitidos()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre*Invalido',
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => 'Nueva raza',
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionHasErrors('nombre_mascota');
    }

    public function test_nombre_mascota_acepta_espacios_intermedios()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre Valido',
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => 'Nueva raza',
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionDoesntHaveErrors('nombre_mascota');
    }

    public function test_nombre_mascota_no_acepta_espacios_inicio_o_final()
    {
        $mascotaData = [
            'nombre_mascota' => ' Nombre Invalido ',
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => 'Nueva raza',
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionHasErrors('nombre_mascota');
    }

    public function test_nombre_mascota_no_acepta_mas_de_un_espacio_intermedio()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre  Invalido',
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => 'Nueva raza',
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionHasErrors('nombre_mascota');
    }

    public function test_pro_id_requerido()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre Valido',
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => 'Nueva raza',
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        unset($mascotaData['pro_id']);

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionHasErrors('pro_id');
    }

    public function test_pro_id_es_entero()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre Valido',
            'pro_id' => 'no es un entero',
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => 'Nueva raza',
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionHasErrors('pro_id');
    }

    public function test_pro_id_corresponde_a_propietario_existente()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre Valido',
            'pro_id' => 9999, // ID que no existe
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => 'Nueva raza',
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionHasErrors('pro_id');
    }

    public function test_pro_id_no_puede_ser_negativo()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre Valido',
            'pro_id' => -1,
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => 'Nueva raza',
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionHasErrors('pro_id');
    }

    public function test_pro_id_no_puede_ser_cero()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre Valido',
            'pro_id' => 0,
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => 'Nueva raza',
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionHasErrors('pro_id');
    }

    public function test_especie_id_requerido()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre Valido',
            'pro_id' => 1,
            'genero_id' => 1,
            'raza' => 'Nueva raza',
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        unset($mascotaData['especie_id']);

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionHasErrors('especie_id');
    }

    public function test_especie_id_es_entero()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre Valido',
            'pro_id' => 1,
            'especie_id' => 'no es un entero',
            'genero_id' => 1,
            'raza' => 'Nueva raza',
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionHasErrors('especie_id');
    }

    public function test_especie_id_corresponde_a_especie_existente()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre Valido',
            'pro_id' => 1,
            'especie_id' => 9999, // ID que no existe
            'genero_id' => 1,
            'raza' => 'Nueva raza',
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionHasErrors('especie_id');
    }

    public function test_especie_id_no_puede_ser_negativo()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre Valido',
            'pro_id' => 1,
            'especie_id' => -1,
            'genero_id' => 1,
            'raza' => 'Nueva raza',
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionHasErrors('especie_id');
    }

    public function test_especie_id_no_puede_ser_cero()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre Valido',
            'pro_id' => 1,
            'especie_id' => 0,
            'genero_id' => 1,
            'raza' => 'Nueva raza',
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionHasErrors('especie_id');
    }

    public function test_genero_id_requerido()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre Valido',
            'pro_id' => 1,
            'especie_id' => 1,
            'raza' => 'Nueva raza',
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        unset($mascotaData['genero_id']);

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionHasErrors('genero_id');
    }

    public function test_genero_id_es_entero()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre Valido',
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => 'no es un entero',
            'raza' => 'Nueva raza',
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionHasErrors('genero_id');
    }

    public function test_genero_id_corresponde_a_genero_existente()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre Valido',
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => 9999, // ID que no existe
            'raza' => 'Nueva raza',
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionHasErrors('genero_id');
    }

    public function test_genero_id_no_puede_ser_negativo()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre Valido',
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => -1,
            'raza' => 'Nueva raza',
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionHasErrors('genero_id');
    }

    public function test_genero_id_no_puede_ser_cero()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre Valido',
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => 0,
            'raza' => 'Nueva raza',
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionHasErrors('genero_id');
    }

    public function test_raza_requerida()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre Valido',
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => 1,
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        unset($mascotaData['raza']);

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionHasErrors('raza');
    }

    public function test_raza_es_cadena()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre Valido',
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => 123, // No es una cadena
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionHasErrors('raza');
    }

    public function test_raza_no_acepta_numeros()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre Valido',
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => '123', // Números
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionHasErrors('raza');
    }

    public function test_raza_no_acepta_caracteres_especiales()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre Valido',
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => 'Labrador@', // Caracteres especiales
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionHasErrors('raza');
    }

    public function test_raza_no_acepta_cadena_vacia()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre Valido',
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => '', // Cadena vacía
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionHasErrors('raza');
    }

    public function test_raza_no_acepta_solo_espacios()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre Valido',
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => '   ', // Solo espacios
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionHasErrors('raza');
    }

    public function test_raza_acepta_cadena_valida()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre Valido',
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => 'Labrador', // Cadena válida
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionDoesntHaveErrors('raza');
    }

    public function test_raza_no_acepta_cadena_demasiado_larga()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre Valido',
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => str_repeat('a', 256), // Cadena demasiado larga
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionHasErrors('raza');
    }

    public function test_raza_acepta_cadena_con_espacios_intermedios()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre Valido',
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => 'Golden Retriever', // Cadena con espacios intermedios
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionDoesntHaveErrors('raza');
    }

    public function test_raza_no_acepta_cadena_con_espacios_al_inicio_o_final()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre Valido',
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => ' Labrador ', // Cadena con espacios al inicio y final
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionHasErrors('raza');
    }

    public function test_raza_acepta_cadena_con_caracteres_especiales_validos()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre Valido',
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => "D'Artagnan", // Cadena con apóstrofe
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionDoesntHaveErrors('raza');
    }

    public function test_raza_no_acepta_cadena_con_caracteres_no_alfabeticos()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre Valido',
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => 'Labrador123', // Cadena con caracteres no alfabéticos
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionHasErrors('raza');
    }

    public function test_fecha_nacimiento_requerida()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre Valido',
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => 'Labrador',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionHasErrors('fecha_nacimiento');
    }

    public function test_fecha_nacimiento_es_fecha_valida()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre Valido',
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => 'Labrador',
            'fecha_nacimiento' => 'no es una fecha', // No es una fecha
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionHasErrors('fecha_nacimiento');
    }

    public function test_fecha_nacimiento_no_es_fecha_futura()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre Valido',
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => 'Labrador',
            'fecha_nacimiento' => now()->addDay(), // Fecha futura
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionHasErrors('fecha_nacimiento');
    }

    public function test_fecha_nacimiento_acepta_formato_correcto()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre Valido',
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => 'Labrador',
            'fecha_nacimiento' => '2000-01-01', // Formato correcto
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionDoesntHaveErrors('fecha_nacimiento');
    }

    public function test_fecha_nacimiento_no_acepta_formato_incorrecto()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre Valido',
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => 'Labrador',
            'fecha_nacimiento' => '01-01-2000', // Formato incorrecto
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionHasErrors('fecha_nacimiento');
    }

    public function test_fecha_nacimiento_no_acepta_fecha_demasiado_antigua()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre Valido',
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => 'Labrador',
            'fecha_nacimiento' => '1800-01-01', // Fecha demasiado antigua
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionHasErrors('fecha_nacimiento');
    }

    public function test_fecha_nacimiento_acepta_fecha_reciente()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre Valido',
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => 'Labrador',
            'fecha_nacimiento' => now()->subYear(), // Fecha reciente
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionDoesntHaveErrors('fecha_nacimiento');
    }

    public function test_fecha_nacimiento_no_acepta_formato_dia_mes_invertido()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre Valido',
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => 'Labrador',
            'fecha_nacimiento' => '01-12-2000', // Formato día-mes invertido
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionHasErrors('fecha_nacimiento');
    }

    public function test_fecha_nacimiento_no_acepta_formato_ano_mes_dia_invertido()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre Valido',
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => 'Labrador',
            'fecha_nacimiento' => '01-01-2000', // Formato año-mes-día invertido
            'imagen' => UploadedFile::fake()->image('imagen.jpg')
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionHasErrors('fecha_nacimiento');
    }

    public function test_imagen_es_imagen_valida()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre Valido',
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => 'Labrador',
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg') // Imagen válida
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionDoesntHaveErrors('imagen');
    }

    public function test_imagen_no_excede_tamano_maximo()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre Valido',
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => 'Labrador',
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')->size(5000) // 5MB
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionHasErrors('imagen');
    }

    public function test_imagen_no_acepta_archivos_no_imagen()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre Valido',
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => 'Labrador',
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->create('documento.pdf') // Archivo no imagen
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionHasErrors('imagen');
    }

    public function test_imagen_acepta_diferentes_extensiones()
    {
        $extensiones = ['jpg', 'png', 'gif'];

        foreach ($extensiones as $extension) {
            $mascotaData = [
                'nombre_mascota' => 'Nombre Valido',
                'pro_id' => 1,
                'especie_id' => 1,
                'genero_id' => 1,
                'raza' => 'Labrador',
                'fecha_nacimiento' => '2000-01-01',
                'imagen' => UploadedFile::fake()->image("imagen.{$extension}") // Diferentes extensiones
            ];

            $response = $this->post("/mascota", $mascotaData);

            $response->assertSessionDoesntHaveErrors('imagen');
        }
    }

    public function test_imagen_no_acepta_tamano_archivo_demasiado_grande()
    {
        $mascotaData = [
            'nombre_mascota' => 'Nombre Valido',
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => 'Labrador',
            'fecha_nacimiento' => '2000-01-01',
            'imagen' => UploadedFile::fake()->image('imagen.jpg')->size(60000) // 60MB
        ];

        $response = $this->post("/mascota", $mascotaData);

        $response->assertSessionHasErrors('imagen');
    }
}
