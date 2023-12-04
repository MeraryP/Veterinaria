<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Vacuna;
use App\Models\Paciente;
use App\Models\Medicamento;
use App\Models\Categoria;

class VacunaControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_vacunaPaciente_carga_correctamente_con_categoria_vacuna()
    {
        $categoria = Categoria::factory()->create(['nombre_cate' => 'Vacuna']);
        $paciente = Paciente::factory()->create();

        $response = $this->get("/vacunaPaciente/{$paciente->id}");

        $response->assertStatus(200);
        $response->assertViewHas('paciente', $paciente->id);
    }

    public function test_vacunaPaciente_carga_correctamente_sin_categoria_vacuna()
    {
        $paciente = Paciente::factory()->create();

        $response = $this->get("/vacunaPaciente/{$paciente->id}");

        $response->assertStatus(200);
        $response->assertViewHas('paciente', $paciente->id);
        $response->assertViewHas('medicamentos', collect());
    }

    public function test_vacunaPaciente_pasa_medicamentos_correctos_con_categoria_vacuna()
    {
        $categoria = Categoria::factory()->create(['nombre_cate' => 'Vacuna']);
        $medicamento = Medicamento::factory()->create(['cate_id' => $categoria->id]);
        $paciente = Paciente::factory()->create();

        $response = $this->get("/vacunaPaciente/{$paciente->id}");

        $response->assertViewHas('medicamentos', function ($medicamentos) use ($medicamento) {
            return $medicamentos->contains($medicamento);
        });
    }

    public function test_store_guarda_correctamente()
    {
        $paciente = Paciente::factory()->create();
        $medicamento = Medicamento::factory()->create();

        $datos = [
            'num_id' => $paciente->id,
            'medi_id' => $medicamento->id,
            'dosis' => 10,
            'unidad' => 'mililitros',
            'fecha_aplicada' => '2020-12-31',
            'aplicada' => 1,
        ];

        $response = $this->post('/vacuna', $datos);

        $response->assertRedirect(route('vacunaMascota', ['id' => $paciente->id]));
        $this->assertDatabaseHas('vacunas', $datos);
    }

    public function test_update_actualiza_correctamente()
    {
        $vacuna = Vacuna::factory()->create();
        $vacuna->dosis = 20;

        $response = $this->put("/vacuna/{$vacuna->id}", $vacuna->toArray());

        $response->assertRedirect(route('vacunaMascota', ['id' => $vacuna->num_id]));
        $this->assertDatabaseHas('vacunas', ['id' => $vacuna->id, 'dosis' => 20]);
    }

    public function test_destroy_elimina_correctamente()
    {
        $vacuna = Vacuna::factory()->create();

        $response = $this->delete("/vacuna/{$vacuna->id}");

        $response->assertRedirect(route('vacuna.index'));
        $this->assertDatabaseMissing('vacunas', ['id' => $vacuna->id]);
    }
}
