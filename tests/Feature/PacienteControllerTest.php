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

class PacienteControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_vista_de_vacuna_de_mascota_se_carga_con_datos_correctos()
    {
        $mascota = Paciente::factory()->has(Vacuna::factory(), 'vacunas')->create();

        $response = $this->get("/mascota/{$mascota->id}/vacuna");

        $response->assertStatus(200);
        $response->assertViewHas('aplicados', $mascota->vacunas);
        $response->assertViewHas('idMascota', $mascota->id);
    }

    public function test_vista_de_examen_de_mascota_se_carga_con_datos_correctos()
    {
        $mascota = Paciente::factory()->has(Examen::factory(), 'examenes')->create();

        $response = $this->get("/mascota/{$mascota->id}/examen");

        $response->assertStatus(200);
        $response->assertViewHas('examens', $mascota->examenes);
        $response->assertViewHas('idMascota', $mascota->id);
    }

    public function test_vista_de_desparacitacion_de_mascota_se_carga_con_datos_correctos()
    {
        $mascota = Paciente::factory()->has(Desparacitar::factory(), 'desparacitaciones')->create();

        $response = $this->get("/mascota/{$mascota->id}/desparacitacion");

        $response->assertStatus(200);
        $response->assertViewHas('aplicados', $mascota->desparacitaciones);
        $response->assertViewHas('idMascota', $mascota->id);
    }

    public function test_vista_clinica_de_mascota_se_carga_con_datos_correctos()
    {
        $mascota = Paciente::factory()->has(Clinico::factory(), 'clinicos')->create();

        $response = $this->get("/mascota/{$mascota->id}/clinico");

        $response->assertStatus(200);
        $response->assertViewHas('clinicos', $mascota->clinicos);
        $response->assertViewHas('idMascota', $mascota->id);
    }

    public function test_vacunas_de_mascota_se_recuperan_correctamente()
    {
        $mascota = Paciente::factory()->has(Vacuna::factory()->count(3), 'vacunas')->create();

        $response = $this->get("/mascota/{$mascota->id}/vacuna");

        $response->assertStatus(200);
        $this->assertCount(3, $response->viewData('aplicados'));
    }

    public function test_examenes_de_mascota_se_recuperan_correctamente()
    {
        $mascota = Paciente::factory()->has(Examen::factory()->count(3), 'examenes')->create();

        $response = $this->get("/mascota/{$mascota->id}/examen");

        $response->assertStatus(200);
        $this->assertCount(3, $response->viewData('examens'));
    }

    public function test_desparacitaciones_de_mascota_se_recuperan_correctamente()
    {
        $mascota = Paciente::factory()->has(Desparacitar::factory()->count(3), 'desparacitaciones')->create();

        $response = $this->get("/mascota/{$mascota->id}/desparacitacion");

        $response->assertStatus(200);
        $this->assertCount(3, $response->viewData('aplicados'));
    }

    public function test_clinicos_de_mascota_se_recuperan_correctamente()
    {
        $mascota = Paciente::factory()->has(Clinico::factory()->count(3), 'clinicos')->create();

        $response = $this->get("/mascota/{$mascota->id}/clinico");

        $response->assertStatus(200);
        $this->assertCount(3, $response->viewData('clinicos'));
    }
}
