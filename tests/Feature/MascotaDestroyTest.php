<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Paciente;
use App\Models\Vacuna;
use App\Models\Examen;
use App\Models\Desparacitar;
use App\Models\Clinico;
use App\Models\User;

class MascotaDestroyTest extends TestCase
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
    public function test_mascota_es_borrada_exitosamente()
    {
        $mascota = Paciente::factory()->create();

        $response = $this->delete("/mascota/{$mascota->id}");

        $response->assertRedirect('/mascota');
        $response->assertSessionHas('mensaje', 'El Registro fue borrado exitosamente.');

        $this->assertDatabaseMissing('mascotas', ['id' => $mascota->id]);
    }

    public function test_no_se_puede_borrar_mascota_inexistente()
    {
        $response = $this->delete("/mascota/99999"); // ID inexistente

        $response->assertStatus(404);
    }

    public function test_mascota_no_es_borrada_si_tiene_vacunas_asociadas()
    {
        $mascota = Paciente::factory()->has(Vacuna::factory(), 'vacunas')->create();

        $response = $this->delete("/mascota/{$mascota->id}");

        $response->assertStatus(403); // Forbidden

        $this->assertDatabaseHas('pacientes', ['id' => $mascota->id]);
    }

    public function test_mascota_no_es_borrada_si_tiene_examenes_asociados()
    {
        $mascota = Paciente::factory()->has(Examen::factory(), 'examenes')->create();

        $response = $this->delete("/mascota/{$mascota->id}");

        $response->assertStatus(403); // Forbidden

        $this->assertDatabaseHas('pacientes', ['id' => $mascota->id]);
    }

    public function test_mascota_no_es_borrada_si_tiene_desparacitaciones_asociadas()
    {
        $mascota = Paciente::factory()->has(Desparacitar::factory(), 'desparacitaciones')->create();

        $response = $this->delete("/mascota/{$mascota->id}");

        $response->assertStatus(403); // Forbidden

        $this->assertDatabaseHas('pacientes', ['id' => $mascota->id]);
    }

    public function test_mascota_no_es_borrada_si_tiene_clinicos_asociados()
    {
        $mascota = Paciente::factory()->has(Clinico::factory(), 'clinicos')->create();

        $response = $this->delete("/mascota/{$mascota->id}");

        $response->assertStatus(403); // Forbidden

        $this->assertDatabaseHas('pacientes', ['id' => $mascota->id]);
    }

    public function test_usuario_no_autorizado_no_puede_borrar_mascota()
    {
        $mascota = Paciente::factory()->create();

        $response = $this->delete("/mascota/{$mascota->id}");

        $response->assertRedirect('/login'); // Redirige a la página de login si el usuario no está autenticado
    }

    public function test_admin_puede_borrar_cualquier_mascota()
    {
        $mascota = Paciente::factory()->for(User::factory()->create())->create();
        $admin = User::factory()->state(['is_admin' => true])->create();

        $response = $this->actingAs($admin)->delete("/mascota/{$mascota->id}");

        $response->assertRedirect('/mascota');
        $response->assertSessionHas('mensaje', 'El Registro fue borrado exitosamente.');

        $this->assertDatabaseMissing('pacientes', ['id' => $mascota->id]);
    }
}
