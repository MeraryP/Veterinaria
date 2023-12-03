<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Models\Desparacitar;
use App\Models\Paciente;
use App\Models\Categoria;
use App\Models\Medicamento;
use Tests\TestCase;

class DesparacitarControllerTest extends TestCase
{
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Buscar el usuario en la base de datos por correo electrónico
        $this->user = User::where('correo', 'patitas@gmail.com')
        ->orWhere('correo', 'karlagalo@gmail.com')
        ->first();

        // Si no puedes encontrar el usuario, podrías querer lanzar un error para que sepas que algo está mal
        if (!$this->user) {
            $this->fail('Usuario no encontrado');
        }

        // Actuar como el usuario encontrado
        $this->actingAs($this->user);
    }
    
/** @test  Prueba para metodo index */
public function test_metodoIndex()
{
    $response = $this->get(route('desparacitar.index'));

    $response->assertStatus(200);
}

/** @test Prueba para metodo edit */
public function test_metodoEdit()
{
    $desparacitar = Desparacitar::factory()->create();

    $response = $this->get(route('desparacitar.edit', $desparacitar->id));

    $response->assertStatus(200); // Verificar que la página se cargue correctamente
    // Puedes agregar más aserciones para verificar elementos específicos en la vista si es necesario
}

/** @test Prueba para metodo Update */
public function test_metodoUpdate()
{
    $desparacitar = Desparacitar::factory()->create();
    $nueva_dosis = 5; // Nueva dosis para la actualización

    $data = [
        'num_id' => $desparacitar->num_id,
        'medi_id' => $desparacitar->medi_id,
        'dosis' => $nueva_dosis,
        'unidad_desparasitante' => $desparacitar->unidad_desparasitante,
        'fecha_aplicada' => $desparacitar->fecha_aplicada,
        'aplicado' => $desparacitar->aplicado,
    ];

    $response = $this->put(route('desparacitar.update', $desparacitar->id), $data);

    $response->assertStatus(302); // Verificar redirección exitosa después de la actualización
    $this->assertEquals($nueva_dosis, $desparacitar->fresh()->dosis); // Verificar que la dosis se haya actualizado en la base de datos
}

/** @test Prueba para metodo Destroy */
public function test_metodoDestroy()
{
    $desparacitar = Desparacitar::factory()->create();

    $response = $this->delete(route('desparacitar.destroy', $desparacitar->id));

    $response->assertStatus(302); // Verificar redirección exitosa después de la eliminación
    $this->assertDeleted($desparacitar); // Verificar que el registro se haya eliminado de la base de datos
}

/** @test Prueba para metodo Show */
public function test_metodoShow()
{
    $desparacitar = Desparacitar::factory()->create();

    $response = $this->get(route('desparacitar.show', $desparacitar->id));

    $response->assertStatus(404); // Verificar que el método show no esté accesible
}

/** @test Prueba para metodo Create*/
public function test_metodoCreate()
{
    $response = $this->get(route('desparacitar.create'));

    $response->assertStatus(200); // Verificar que la página se cargue correctamente
    // Puedes agregar más aserciones para verificar elementos específicos en la vista si es necesario
}

/** @test Prueba para metodo Desparacitar Paciente */
public function test_DesparacitarPaciente()
{
    $pacienteId = 1; // ID del paciente específico para la prueba
    $response = $this->get(route('desparacitar.desparacitarPaciente', $pacienteId));

    $response->assertStatus(200); // Verificar que la página se cargue correctamente
    // Puedes agregar más aserciones para verificar elementos específicos en la vista si es necesario
}

/** @test Prueba para verificar redireccionamiento en el método store al fallar la validación */
public function test_redireccionMetodoStoreCuandoFallaLaValidacion()
{
    $response = $this->post(route('desparacitar.store'), []);

    $response->assertStatus(302); // Verificar redirección
    $response->assertSessionHasErrors(); // Verificar que se muestren errores de validación
}

/** @test Prueba para verificar redireccionamiento en el método update al fallar la validación */
public function test_redireccionMetodoUpdateCuandoFallaLaValidacion()
{
    $desparacitar = Desparacitar::factory()->create();

    $response = $this->put(route('desparacitar.update', $desparacitar->id), []);

    $response->assertStatus(302); // Verificar redirección
    $response->assertSessionHasErrors(); // Verificar que se muestren errores de validación
}

/** @test Prueba para verificar si se crea un nuevo registro en el método store */
public function test_creacionNuevoRegistroMetodoStore()
{
    $paciente = Paciente::factory()->create();
    $medicamento = Medicamento::factory()->create();

    $data = [
        'num_id' => $paciente->id,
        'medi_id' => $medicamento->id,
        'dosis' => 5, // Dosis válida para la prueba
        'unidad_desparasitante' => 'ml', // Unidad válida para la prueba
        'fecha_aplicada' => now()->format('Y-m-d'), // Fecha válida para la prueba
        'aplicado' => true // Estado válido para la prueba
        // Otros campos necesarios según tu lógica de aplicación
    ];

    $response = $this->post(route('desparacitar.store'), $data);

    $response->assertStatus(302); // Verificar redirección
    $this->assertDatabaseHas('desparacitars', ['num_id' => $paciente->id]); // Verificar que se haya creado el registro
}


/** @test Prueba para verificar si se actualiza un registro en el método update */
public function test_ActualizacionRegistroMetodoUpdate()
{
    $$desparacitar = Desparacitar::factory()->create();

    $nueva_dosis = 8; // Nueva dosis válida para la actualización

    $data = [
        'num_id' => $desparacitar->num_id,
        'medi_id' => $desparacitar->medi_id,
        'dosis' => $nueva_dosis, // Nueva dosis válida para la actualización
        'unidad_desparasitante' => $desparacitar->unidad_desparasitante,
        'fecha_aplicada' => $desparacitar->fecha_aplicada,
        'aplicado' => $desparacitar->aplicado,
        // Otros campos necesarios según tu lógica de aplicación
    ];

    $response = $this->put(route('desparacitar.update', $desparacitar->id), $data);

    $response->assertStatus(302); // Verificar redirección
    $this->assertEquals($nueva_dosis, $desparacitar->fresh()->dosis); // Verificar que la dosis se haya actualizado en la base de datos
}

/** @test  Prueba para verificar la vista del método index*/
public function test_MostrarVistaMetodoIndex()
{
    $response = $this->get(route('desparacitar.index'));

    $response->assertStatus(200); // Verificar que la página se cargue correctamente
    $response->assertViewIs('desparacitar.index'); // Verificar que la vista sea la correcta

}
/** @test  Prueba para verificar la vista del método edit */
public function test_MostrarVistaMetodoEdit()
{
    $desparacitar = Desparacitar::factory()->create();

    $response = $this->get(route('desparacitar.edit', $desparacitar->id));

    $response->assertStatus(200); // Verificar que la página se cargue correctamente
    $response->assertViewIs('desparacitar.edit'); // Verificar que la vista sea la correcta
}
}

