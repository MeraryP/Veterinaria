<?php

namespace Tests\Feature;

//use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use App\Models\User;
use App\Models\Clinico;
use App\Models\Paciente;

class ClinicoControllerTest extends TestCase
{
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Busqueda de el usuario en la base de datos por medio de correo electrónico
        $this->user = User::where('correo', 'patitas@gmail.com')->first();
        // Si  no se encuentra el usuario, debe lanzar un error
        if (!$this->user) {
            $this->fail('Usuario no encontrado');
        }
        // Actuando como el usuario encontrado
        $this->actingAs($this->user);
    }


    public function testIndex()
    {
        $response = $this->get('/clinico/index');
        $response->assertStatus(200);
    }

    public function testCreate()
{
    $response = $this->get('clinico/create');
    $response->assertStatus(200);
}

/** @test Prueba para verificar que se puede crear */
public function it_can_create_a_clinico()
    {
        $paciente = Paciente::factory()->create();

        $response = $this->post(route('clinico.store'), [
            'num_id' => $paciente->id,
            'sintomas' => 'Fiebre, Tos',
            'enfermedad' => 'Resfriado',
            'tratamiento' => 'Descanso y medicamentos',
        ]);

        $response->assertRedirect(route('clinicoMascota', ['id' => $paciente->id]))
            ->assertSessionHas('mensaje', 'El registro fue creado exitosamente.');

        $this->assertDatabaseHas('clinicos', [
            'num_id' => $paciente->id,
            'sintomas' => 'Fiebre, Tos',
            'enfermedad' => 'Resfriado',
            'tratamiento' => 'Descanso y medicamentos',
        ]);
    }

   /** @test Prueba para verificar que se puede actualizar */
    public function it_can_update_a_clinico()
    {
        $clinico = Clinico::factory()->create();
        $paciente = Paciente::factory()->create();

        $response = $this->put(route('clinico.update', ['id' => $clinico->id]), [
            'num_id' => $paciente->id,
            'sintomas' => 'Dolor de cabeza',
            'enfermedad' => 'Migraña',
            'tratamiento' => 'Descanso',
        ]);

        $response->assertRedirect(route('clinicoMascota', ['id' => $paciente->id]))
            ->assertSessionHas('mensaje', 'El registro fue modificado exitosamente.');

        $this->assertDatabaseHas('clinicos', [
            'id' => $clinico->id,
            'num_id' => $paciente->id,
            'sintomas' => 'Dolor de cabeza',
            'enfermedad' => 'Migraña',
            'tratamiento' => 'Descanso',
        ]);
    }

    /** @test Prueba para verificar que se puede borrar */
    public function it_can_delete_a_clinico()
    {
        $clinico = Clinico::factory()->create();

        $response = $this->delete(route('clinico.destroy', ['id' => $clinico->id]));

        $response->assertRedirect();
        $this->assertDeleted($clinico);
    }

    /** @test Prueba para verificar que se muestre el formulario de creacion clinico*/
    public function it_can_show_clinico_create_form()
{
    $response = $this->get(route('clinico.create'));

    $response->assertSuccessful()
        ->assertViewIs('clinico.create')
        ->assertSee('Create Clinico');
}

/** @test Prueba para verificar que se muestre el formulario de edicion clinico*/
public function it_can_show_clinico_edit_form()
{
    $clinico = Clinico::factory()->create();

    $response = $this->get(route('clinico.edit', ['id' => $clinico->id]));

    $response->assertSuccessful()
        ->assertViewIs('clinico.edit')
        ->assertViewHas('clinico', $clinico);
}

/** @test Prueba para verificar que se muestre el index de clinico*/
public function it_can_show_clinico_index()
{
    $clinicos = Clinico::factory()->create(5);

    $response = $this->get(route('clinico.index'));

    $response->assertSuccessful()
        ->assertViewIs('clinico.index')
        ->assertViewHas('clinicos', $clinicos);
}

/** @test Prueba para verificar que valida la solicitud de guardar */
public function it_validates_store_request()
{
    $response = $this->post(route('clinico.store'), []);

    $response->assertSessionHasErrors(['num_id', 'sintomas', 'enfermedad', 'tratamiento']);
}

/** @test Prueba para verificar que valida la solicitud de actualizar */
public function it_validates_update_request()
{
    $clinico = Clinico::factory()->create();

    $response = $this->put(route('clinico.update', ['id' => $clinico->id]), []);

    $response->assertSessionHasErrors(['num_id', 'sintomas', 'enfermedad', 'tratamiento']);
}

}
