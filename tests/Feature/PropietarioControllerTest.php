<?php

namespace Tests\Feature;

use App\Models\Propietario;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PropietarioControllerTest extends TestCase
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

    use DatabaseTransactions;

    public function testIndex()
    {
        $response = $this->get('/propietario');
        $response->assertStatus(200);
    }

    public function testCreate()
{
    $response = $this->get('/propietario/create');
    $response->assertStatus(200);
}

public function testStore()
{
    $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    $data = [
        'identidad' => '1234-5678-90123',
        'nombre' => 'Nombre Apellido',
        'direccion' => 'Dirección de prueba',
        'gene_id' => 1, // Reemplaza con el ID válido de un género existente
        'telefono' => '9876-5432',
        'correo' => 'correo@example.com',
    ];

    $response = $this->post('/propietario', $data);
    $response->assertRedirect('/propietario');
}
public function testEdit()
    {
        // Crear un propietario de prueba en la base de datos
        $propietario = factory(Propietario::class)->create();

        // Simular solicitud GET a /propietario/{id}/editar
        $response = $this->get("/propietario/{$propietario->id}/editar");

        // Verificar que se cargue la vista propietario.edit con el propietario correcto
        $response->assertViewIs('propietario.edit')
                 ->assertStatus(200)
                 ->assertSee($propietario->nombre); // Verificar que el nombre del propietario se muestra en la vista
    }

    public function testUpdate()
    {
        // Crear un propietario de prueba en la base de datos
        $propietario = factory(Propietario::class)->create();

        // Datos válidos para actualizar el propietario
        $data = [
            'identidad' => '1234-5678-90123',
            'nombre' => 'Nombre Actualizado',
            'direccion' => 'Nueva Dirección',
            'gene_id' => 2, // Reemplaza con el ID válido de un género existente
            'telefono' => '1111-2222',
            'correo' => 'correo_actualizado@example.com',
        ];

        // Simular solicitud PUT a /propietario/{id} con datos de actualización
        $response = $this->put("/propietario/{$propietario->id}", $data);

        // Verificar que se haya actualizado el propietario correctamente
        $updatedPropietario = Propietario::find($propietario->id);
        $this->assertEquals($data['nombre'], $updatedPropietario->nombre);
        // Verificar los demás campos actualizados

        $response->assertRedirect('/propietario')
                 ->assertSessionHas('mensaje', 'El registro fue modificado exitosamente.');
    }

    public function testDestroy()
    {
        // Crear un propietario de prueba en la base de datos
        $propietario = factory(Propietario::class)->create();

        // Simular solicitud DELETE a /propietario/{id}
        $response = $this->delete("/propietario/{$propietario->id}");

        // Verificar que se haya eliminado el propietario correctamente
        $this->assertDeleted($propietario);

        $response->assertRedirect('/propietario')
                 ->assertSessionHas('mensaje', 'El Registro fue borrado exitosamente.');
    }

    public function testShow()
    {
        // Crear un propietario de prueba en la base de datos
        $propietario = factory(Propietario::class)->create();

        // Simular solicitud GET a /propietario/{id}
        $response = $this->get("/propietario/{$propietario->id}");

        // Verificar que se muestre la vista propietario.show con el propietario correcto
        $response->assertViewIs('propietario.show')
                 ->assertStatus(200)
                 ->assertSee($propietario->nombre); // Verificar que el nombre del propietario se muestra en la vista
    }

    public function testInvalidUpdate()
    {
        // Crear un propietario de prueba en la base de datos
        $propietario = factory(Propietario::class)->create();

        // Datos inválidos para actualizar el propietario
        $data = [
            'identidad' => 'identidad_invalida',
            'nombre' => 'Nombre Inválido 123',
            'direccion' => '', // Dirección vacía
            'gene_id' => 999, // ID de género inexistente
            'telefono' => 'teléfono_invalido',
            'correo' => 'correo_invalido',
        ];

        // Simular solicitud PUT a /propietario/{id} con datos inválidos
        $response = $this->put("/propietario/{$propietario->id}", $data);

        // Verificar que la actualización falle debido a datos inválidos
        $response->assertSessionHasErrors(['identidad', 'nombre', 'direccion', 'gene_id', 'telefono', 'correo']);
    }

    public function testNonExistentDestroy()
    {
        // Simular solicitud DELETE a /propietario/{id} para un propietario que no existe
        $response = $this->delete("/propietario/999");

        // Verificar que la eliminación falle debido a un propietario inexistente
        $response->assertNotFound();
    }

    public function testStoreWithDuplicateEmail()
    {
        // Crear un propietario de prueba en la base de datos
        $existingPropietario = factory(Propietario::class)->create();

        // Datos para crear un nuevo propietario con el mismo correo que el propietario existente
        $data = [
            'identidad' => '1234-5678-90123',
            'nombre' => 'Nuevo Propietario',
            'direccion' => 'Dirección de prueba',
            'gene_id' => 1, // Reemplaza con el ID válido de un género existente
            'telefono' => '9876-5432',
            'correo' => $existingPropietario->correo, // Usar el mismo correo que el propietario existente
        ];

        // Simular solicitud POST a /propietario con datos de un propietario duplicado
        $response = $this->post('/propietario', $data);

        // Verificar que la creación falle debido al correo electrónico duplicado
        $response->assertSessionHasErrors('correo');
    }

    public function testNonExistentEdit()
    {
        // Simular solicitud GET a /propietario/{id}/editar para un propietario que no existe
        $response = $this->get("/propietario/999/editar");

        // Verificar que la edición falle debido a un propietario inexistente
        $response->assertNotFound();
    }

    public function testInvalidStoreWithMissingData()
    {
        // Datos incompletos para crear un nuevo propietario
        $data = [
            // Faltan datos requeridos
            'nombre' => 'Nuevo Propietario',
            // Faltan otros campos requeridos...
        ];

        // Simular solicitud POST a /propietario con datos faltantes
        $response = $this->post('/propietario', $data);

        // Verificar que la creación falle debido a datos faltantes
        $response->assertSessionHasErrors(['identidad', 'direccion', 'gene_id', 'telefono', 'correo']);
    }

    public function testValidDestroy()
    {
        // Crear un propietario de prueba en la base de datos
        $propietario = factory(Propietario::class)->create();

        // Simular solicitud DELETE a /propietario/{id}
        $response = $this->delete("/propietario/{$propietario->id}");

        // Verificar que se haya eliminado el propietario correctamente
        $this->assertDeleted($propietario);

        $response->assertRedirect('/propietario')
                 ->assertSessionHas('mensaje', 'El Registro fue borrado exitosamente.');
    }

    public function testValidUpdate()
    {
        // Crear un propietario de prueba en la base de datos
        $propietario = factory(Propietario::class)->create();

        // Datos válidos para actualizar el propietario
        $data = [
            'identidad' => '1234-5678-90123',
            'nombre' => 'Nombre Actualizado',
            'direccion' => 'Nueva Dirección',
            'gene_id' => 2, // Reemplaza con el ID válido de un género existente
            'telefono' => '1111-2222',
            'correo' => 'correo_actualizado@example.com',
        ];

        // Simular solicitud PUT a /propietario/{id} con datos válidos de actualización
        $response = $this->put("/propietario/{$propietario->id}", $data);

        // Verificar que se haya actualizado el propietario correctamente
        $updatedPropietario = Propietario::find($propietario->id);
        $this->assertEquals($data['nombre'], $updatedPropietario->nombre);
        // Verificar los demás campos actualizados

        $response->assertRedirect('/propietario')
                 ->assertSessionHas('mensaje', 'El registro fue modificado exitosamente.');
    }

    public function testValidStore()
    {
        // Datos válidos para crear un nuevo propietario
        $data = [
            'identidad' => '1234-5678-90123',
            'nombre' => 'Nuevo Propietario',
            'direccion' => 'Dirección de prueba',
            'gene_id' => 1, // Reemplaza con el ID válido de un género existente
            'telefono' => '9876-5432',
            'correo' => 'correo_nuevo@example.com',
        ];

        // Simular solicitud POST a /propietario con datos válidos
        $response = $this->post('/propietario', $data);

        // Verificar que se haya creado el propietario correctamente
        $this->assertCount(1, Propietario::all()); // Verificar que se haya agregado un propietario a la base de datos
        $response->assertRedirect('/propietario')
                 ->assertSessionHas('mensaje', 'El registro fue creado exitosamente.');
   
    }
    public function testInvalidStore()
    {
        // Crear un propietario de prueba en la base de datos
        $existingPropietario = factory(Propietario::class)->create();

        // Datos inválidos para crear un nuevo propietario
        $data = [
            'identidad' => 'identidad_invalida',
            'nombre' => 'Nombre Inválido 123',
            'direccion' => '', // Dirección vacía
            'gene_id' => 999, // ID de género inexistente
            'telefono' => 'teléfono_invalido',
            'correo' => $existingPropietario->correo, // Usar el mismo correo que el propietario existente
        ];

        // Simular solicitud POST a /propietario con datos inválidos
        $response = $this->post('/propietario', $data);

        // Verificar que la creación falle debido a datos inválidos
        $response->assertSessionHasErrors(['identidad', 'nombre', 'direccion', 'gene_id', 'telefono', 'correo']);
     
    }

    public function testValidEdit()
    {
        // Crear un propietario de prueba en la base de datos
        $propietario = factory(Propietario::class)->create();

        // Simular solicitud GET a /propietario/{id}/editar
        $response = $this->get("/propietario/{$propietario->id}/editar");

        // Verificar que se cargue la vista propietario.edit con el propietario correcto
        $response->assertViewIs('propietario.edit')
                 ->assertStatus(200)
                 ->assertSee($propietario->nombre); // Verificar que el nombre del propietario se muestra en la vista
    }

    public function testInvalidEdit()
    {
        // Simular solicitud GET a /propietario/{id}/editar para un propietario que no existe
        $response = $this->get("/propietario/999/editar");

        // Verificar que la edición falle debido a un propietario inexistente
        $response->assertNotFound();
    }
}
