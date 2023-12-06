<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Paciente;
use Illuminate\Http\UploadedFile;
use App\Models\User;

class MascotaUpdateTest extends TestCase
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
    public function test_update()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = [
            'nombre_mascota' => 'Nuevo nombre',
            'pro_id' => 1,
            'especie_id' => 1,
            'genero_id' => 1,
            'raza' => 'Nueva raza',
            'fecha_nacimiento' => '2000-01-01',
        ];

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertStatus(302);

        $paciente->refresh();
        $this->assertEquals($updatedData['nombre_mascota'], $paciente->nombre_mascota);
        $this->assertEquals($updatedData['pro_id'], $paciente->pro_id);
        $this->assertEquals($updatedData['especie_id'], $paciente->especie_id);
        $this->assertEquals($updatedData['genero_id'], $paciente->genero_id);
        $this->assertEquals($updatedData['raza'], $paciente->raza);
        $this->assertEquals($updatedData['fecha_nacimiento'], $paciente->fecha_nacimiento->format('Y-m-d'));
    }

    public function test_nombre_mascota_requerido()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        unset($updatedData['nombre_mascota']);

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionHasErrors('nombre_mascota');
    }

    public function test_nombre_mascota_no_excede_maximo()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['nombre_mascota'] = str_repeat('a', 101);

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionHasErrors('nombre_mascota');
    }

    public function test_nombre_mascota_solo_caracteres_permitidos()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['nombre_mascota'] = 'Nombre con caracteres no permitidos 123';

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionHasErrors('nombre_mascota');
    }

    public function test_nombre_mascota_acepta_maximo()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['nombre_mascota'] = str_repeat('a', 100);

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionDoesntHaveErrors('nombre_mascota');
    }

    public function test_nombre_mascota_acepta_caracteres_permitidos()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['nombre_mascota'] = 'Nombre Válido';

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionDoesntHaveErrors('nombre_mascota');
    }

    public function test_nombre_mascota_no_puede_ser_vacio()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['nombre_mascota'] = '';

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionHasErrors('nombre_mascota');
    }

    public function test_nombre_mascota_no_puede_ser_solo_espacios()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['nombre_mascota'] = '   ';

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionHasErrors('nombre_mascota');
    }

    public function test_nombre_mascota_acepta_caracteres_especiales_permitidos()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['nombre_mascota'] = 'Nombre-Valido_2';

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionDoesntHaveErrors('nombre_mascota');
    }

    public function test_nombre_mascota_no_acepta_caracteres_especiales_no_permitidos()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['nombre_mascota'] = 'Nombre*Invalido';

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionHasErrors('nombre_mascota');
    }

    public function test_nombre_mascota_acepta_espacios_intermedios()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['nombre_mascota'] = 'Nombre Valido';

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionDoesntHaveErrors('nombre_mascota');
    }

    public function test_nombre_mascota_no_acepta_espacios_inicio_o_final()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['nombre_mascota'] = ' Nombre Invalido ';

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionHasErrors('nombre_mascota');
    }

    public function test_nombre_mascota_no_acepta_mas_de_un_espacio_intermedio()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['nombre_mascota'] = 'Nombre  Invalido';

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionHasErrors('nombre_mascota');
    }

    public function test_pro_id_requerido()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        unset($updatedData['pro_id']);

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionHasErrors('pro_id');
    }

    public function test_pro_id_es_entero()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['pro_id'] = 'no es un entero';

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionHasErrors('pro_id');
    }

    public function test_pro_id_corresponde_a_propietario_existente()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['pro_id'] = 9999; // ID que no existe

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionHasErrors('pro_id');
    }

    public function test_pro_id_no_puede_ser_negativo()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['pro_id'] = -1;

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionHasErrors('pro_id');
    }

    public function test_pro_id_no_puede_ser_cero()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['pro_id'] = 0;

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionHasErrors('pro_id');
    }

    public function test_especie_id_requerido()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        unset($updatedData['especie_id']);

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionHasErrors('especie_id');
    }

    public function test_especie_id_es_entero()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['especie_id'] = 'no es un entero';

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionHasErrors('especie_id');
    }

    public function test_especie_id_corresponde_a_especie_existente()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['especie_id'] = 9999; // ID que no existe

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionHasErrors('especie_id');
    }

    public function test_especie_id_no_puede_ser_negativo()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['especie_id'] = -1;

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionHasErrors('especie_id');
    }

    public function test_especie_id_no_puede_ser_cero()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['especie_id'] = 0;

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionHasErrors('especie_id');
    }

    public function test_genero_id_requerido()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        unset($updatedData['genero_id']);

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionHasErrors('genero_id');
    }

    public function test_genero_id_es_entero()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['genero_id'] = 'no es un entero';

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionHasErrors('genero_id');
    }

    public function test_genero_id_corresponde_a_genero_existente()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['genero_id'] = 9999; // ID que no existe

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionHasErrors('genero_id');
    }

    public function test_genero_id_no_puede_ser_negativo()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['genero_id'] = -1;

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionHasErrors('genero_id');
    }

    public function test_genero_id_no_puede_ser_cero()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['genero_id'] = 0;

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionHasErrors('genero_id');
    }

    public function test_raza_requerida()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        unset($updatedData['raza']);

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionHasErrors('raza');
    }

    public function test_raza_es_cadena()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['raza'] = 123; // No es una cadena

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionHasErrors('raza');
    }

    public function test_raza_no_acepta_numeros()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['raza'] = '123'; // Números

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionHasErrors('raza');
    }

    public function test_raza_no_acepta_caracteres_especiales()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['raza'] = 'Labrador@'; // Caracteres especiales

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionHasErrors('raza');
    }

    public function test_raza_no_acepta_cadena_vacia()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['raza'] = ''; // Cadena vacía

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionHasErrors('raza');
    }

    public function test_raza_no_acepta_solo_espacios()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['raza'] = '   '; // Solo espacios

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionHasErrors('raza');
    }

    public function test_raza_acepta_cadena_valida()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['raza'] = 'Labrador'; // Cadena válida

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionDoesntHaveErrors('raza');
    }

    public function test_raza_no_acepta_cadena_demasiado_larga()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['raza'] = str_repeat('a', 256); // Cadena demasiado larga

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionHasErrors('raza');
    }

    public function test_raza_acepta_cadena_con_espacios_intermedios()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['raza'] = 'Golden Retriever'; // Cadena con espacios intermedios

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionDoesntHaveErrors('raza');
    }

    public function test_raza_no_acepta_cadena_con_espacios_al_inicio_o_final()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['raza'] = ' Labrador '; // Cadena con espacios al inicio y final

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionHasErrors('raza');
    }

    public function test_raza_acepta_cadena_con_caracteres_especiales_validos()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['raza'] = "D'Artagnan"; // Cadena con apóstrofe

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionDoesntHaveErrors('raza');
    }

    public function test_raza_no_acepta_cadena_con_caracteres_no_alfabeticos()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['raza'] = 'Labrador123'; // Cadena con caracteres no alfabéticos

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionHasErrors('raza');
    }

    public function test_fecha_nacimiento_requerida()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        unset($updatedData['fecha_nacimiento']);

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionHasErrors('fecha_nacimiento');
    }

    public function test_fecha_nacimiento_es_fecha_valida()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['fecha_nacimiento'] = 'no es una fecha';

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionHasErrors('fecha_nacimiento');
    }

    public function test_fecha_nacimiento_no_es_fecha_futura()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['fecha_nacimiento'] = now()->addDay();

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionHasErrors('fecha_nacimiento');
    }

    public function test_fecha_nacimiento_acepta_formato_correcto()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['fecha_nacimiento'] = '2000-01-01'; // Formato correcto

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionDoesntHaveErrors('fecha_nacimiento');
    }

    public function test_fecha_nacimiento_no_acepta_formato_incorrecto()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['fecha_nacimiento'] = '01-01-2000'; // Formato incorrecto

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionHasErrors('fecha_nacimiento');
    }

    public function test_fecha_nacimiento_no_acepta_fecha_demasiado_antigua()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['fecha_nacimiento'] = '1800-01-01'; // Fecha demasiado antigua

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionHasErrors('fecha_nacimiento');
    }

    public function test_fecha_nacimiento_acepta_fecha_reciente()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['fecha_nacimiento'] = now()->subYear(); // Fecha reciente

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionDoesntHaveErrors('fecha_nacimiento');
    }

    public function test_fecha_nacimiento_no_acepta_formato_dia_mes_invertido()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['fecha_nacimiento'] = '01-12-2000'; // Formato día-mes invertido

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionHasErrors('fecha_nacimiento');
    }

    public function test_fecha_nacimiento_no_acepta_formato_ano_mes_dia_invertido()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['fecha_nacimiento'] = '01-01-2000'; // Formato año-mes-día invertido

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionHasErrors('fecha_nacimiento');
    }

    public function test_imagen_es_imagen_valida()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['imagen'] = UploadedFile::fake()->image('imagen.jpg');

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionDoesntHaveErrors('imagen');
    }

    public function test_imagen_no_excede_tamano_maximo()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['imagen'] = UploadedFile::fake()->image('imagen.jpg')->size(5000); // 5MB

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionHasErrors('imagen');
    }

    public function test_imagen_no_acepta_archivos_no_imagen()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['imagen'] = UploadedFile::fake()->create('documento.pdf');

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionHasErrors('imagen');
    }

    public function test_imagen_acepta_diferentes_extensiones()
    {
        $paciente = Paciente::factory()->create();

        $extensiones = ['jpg', 'png', 'gif'];

        foreach ($extensiones as $extension) {
            $updatedData = $paciente->toArray();
            $updatedData['imagen'] = UploadedFile::fake()->image("imagen.{$extension}");

            $response = $this->put("/paciente/{$paciente->id}", $updatedData);

            $response->assertSessionDoesntHaveErrors('imagen');
        }
    }

    public function test_imagen_no_acepta_tamano_archivo_demasiado_grande()
    {
        $paciente = Paciente::factory()->create();

        $updatedData = $paciente->toArray();
        $updatedData['imagen'] = UploadedFile::fake()->image('imagen.jpg')->size(60000); // 60MB

        $response = $this->put("/paciente/{$paciente->id}", $updatedData);

        $response->assertSessionHasErrors('imagen');
    }
}
