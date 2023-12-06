<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Desparacitar;
use App\Models\User;

class DesparacitarDestoyTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testDestroyEliminaRegistroExistente()
    {
        $desparacitar = Desparacitar::factory()->create();

        $response = $this->delete('/desparacitar/' . $desparacitar->id);

        $response->assertStatus(302);
        $response->assertSessionHas('mensaje', 'El registro fue eliminado exitosamente.');

        $this->assertDatabaseMissing('aplicados', [
            'id' => $desparacitar->id,
        ]);
    }

    public function testDestroyFallaConRegistroNoExistente()
    {
        $response = $this->delete('/desparacitar/1000');

        $response->assertStatus(404);
    }

    public function testDestroyNoEliminaRegistroSiNoEsPropietario()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $desparacitar = Desparacitar::factory()->for($user1)->create();

        $this->actingAs($user2);
        $response = $this->delete('/desparacitar/' . $desparacitar->id);

        $response->assertStatus(403);
        $this->assertDatabaseHas('aplicados', [
            'id' => $desparacitar->id,
        ]);
    }

    public function testDestroyNoEliminaRegistroSiNoEstaAutenticado()
    {
        $desparacitar = Desparacitar::factory()->create();

        $response = $this->delete('/desparacitar/' . $desparacitar->id);

        $response->assertRedirect('/login');
        $this->assertDatabaseHas('aplicados', [
            'id' => $desparacitar->id,
        ]);
    }

    public function testDestroyReduceElNumeroDeRegistros()
    {
        $desparacitar = Desparacitar::factory()->create();

        $totalAntes = Desparacitar::count();
        $response = $this->delete('/desparacitar/' . $desparacitar->id);
        $totalDespues = Desparacitar::count();

        $this->assertEquals($totalAntes - 1, $totalDespues);
    }

    public function testDestroyEliminaRegistrosRelacionados()
    {
        $desparacitar = Desparacitar::factory()->hasAplicaciones(3)->create();

        $this->delete('/desparacitar/' . $desparacitar->id);

        $this->assertDatabaseMissing('aplicaciones', [
            'desparacitar_id' => $desparacitar->id,
        ]);
    }

    public function testDestroyRedirigeCorrectamente()
    {
        $desparacitar = Desparacitar::factory()->create();

        $response = $this->delete('/desparacitar/' . $desparacitar->id);

        $response->assertRedirect('/desparacitacionMascota/1');
    }
}