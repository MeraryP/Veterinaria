<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Medicamento;
use App\Models\Categoria;

class MedicamentosTest extends TestCase
{
    /**
     * Ejemplo de prueba de característica básica.
     *
     * @return void
     */

    public function test_recuperar_todos_medicamentos()
    {
        $response = $this->get('/medicamento');
        $response->assertStatus(200);
        $response->assertViewIs('medicamento/index');
        $response->assertViewHas('medicamentos');
    }

    public function test_crear_medicamento_con_datos_validos()
    {
        $data = [
            'nombre_medicamento' => 'Test Medicamento',
            'cate_id' => 1,
        ];
        $response = $this->post('/medicamento', $data);
        $response->assertRedirect('/medicamento');
        $this->assertDatabaseHas('medicamentos', $data);
    }

    public function test_actualizar_medicamento_con_datos_validos()
    {
        $medicamento = Medicamento::factory()->create();
        $data = [
            'nombre_medicamento' => 'Updated Medicamento',
            'cate_id' => 2,
        ];
        $response = $this->put('/medicamento/' . $medicamento->id, $data);
        $response->assertRedirect('/medicamento');
        $this->assertDatabaseHas('medicamentos', $data);
    }

    public function test_crear_medicamento_con_datos_invalidos()
    {
        $data = [
            'nombre_medicamento' => 'Invalid Medicamento 123',
            'cate_id' => 1,
        ];
        $response = $this->post('/medicamento', $data);
        $response->assertSessionHasErrors(['nombre_medicamento']);
        $this->assertDatabaseMissing('medicamentos', $data);
    }

    public function test_actualizar_medicamento_con_datos_invalidos()
    {
        $medicamento = Medicamento::factory()->create();
        $data = [
            'nombre_medicamento' => 'Invalid Medicamento 123',
            'cate_id' => 2,
        ];
        $response = $this->put('/medicamento/' . $medicamento->id, $data);
        $response->assertSessionHasErrors(['nombre_medicamento']);
        $this->assertDatabaseMissing('medicamentos', $data);
    }

    public function test_recuperar_medicamento_no_existente()
    {
        $response = $this->get('/medicamento/999');
        $response->assertStatus(404);
    }

    public function test_eliminar_medicamento()
    {
        $medicamento = Medicamento::factory()->create();

        $response = $this->delete('/medicamento/' . $medicamento->id);
        $response->assertRedirect('/medicamento');
        $this->assertDeleted($medicamento);
    }

    public function test_recuperar_todas_categorias()
    {
        $response = $this->get('/medicamento/create');
        $response->assertStatus(200);
        $response->assertViewIs('medicamento.create');
        $response->assertViewHas('categorias');
    }

    public function test_actualizar_medicamento_no_existente()
    {
        $response = $this->put('/medicamento/999', [
            'nombre_medicamento' => 'Updated Medicamento',
            'cate_id' => 1,
        ]);
        $response->assertNotFound();
    }

    public function test_no_puede_eliminar_medicamento_no_existente()
    {
        $response = $this->delete('/medicamento/100');
        $response->assertStatus(404);
    }

    public function test_puede_manejar_solicitudes_concurrentes()
    {
        $response1 = $this->post('/medicamento', ['nombre_medicamento' => 'Medicamento 1', 'cate_id' => 1]);
        $response2 = $this->post('/medicamento', ['nombre_medicamento' => 'Medicamento 2', 'cate_id' => 1]);

        $response1->assertStatus(302);
        $response2->assertStatus(302);
    }

    public function test_puede_manejar_errores_inesperados()
    {
        $response = $this->post('/medicamento', ['nombre_medicamento' => 'Medicamento', 'cate_id' => 100]);

        $response->assertStatus(500);
    }

    public function test_manipular_grandes_cantidades_datos()
    {
        Medicamento::factory(1000)->create();

        $response = $this->get('/medicamento');

        $response->assertStatus(200);

        $response->assertViewIs('medicamento/index');

        $response->assertViewHas('medicamentos');
    }

    // MedicamentoController puede manejar diferentes tipos de solicitudes HTTP (GET, POST, PUT, DELETE)
    public function test_manejar_diferentes_solicitudes_http()
    {
        $response = $this->get('/medicamento');
        $response->assertStatus(200);

        $response = $this->post('/medicamento', ['nombre_medicamento' => 'Test Medicamento', 'cate_id' => 1]);
        $response->assertRedirect('/medicamento');

        $response = $this->put('/medicamento/1', ['nombre_medicamento' => 'Updated Medicamento', 'cate_id' => 2]);
        $response->assertRedirect('/medicamento');

        $response = $this->delete('/medicamento/1');
        $response->assertRedirect('/medicamento');
    }

    // MedicamentoController puede manejar diferentes tipos de datos de entrada (datos de formulario, datos JSON)
    public function test_manejar_diferentes_datos_entrada()
    {
        $response = $this->post('/medicamento', ['nombre_medicamento' => 'Test Medicamento', 'cate_id' => 1]);
        $response->assertRedirect('/medicamento');

        $response = $this->postJson('/medicamento', ['nombre_medicamento' => 'Test Medicamento', 'cate_id' => 1]);
        $response->assertStatus(201);
        $response->assertJson(['message' => 'El registro fue creado exitosamente.']);

        $response = $this->put('/medicamento/1', ['nombre_medicamento' => 'Updated Medicamento', 'cate_id' => 2]);
        $response->assertRedirect('/medicamento');

        $response = $this->putJson('/medicamento/1', ['nombre_medicamento' => 'Updated Medicamento', 'cate_id' => 2]);
        $response->assertStatus(200);
        $response->assertJson(['message' => 'El registro fue modificado exitosamente.']);
    }

    public function prueba_validacion_nombre_medicamento_obligatorio()
    {
        $respuesta = $this->post('/medicamento', ['cate_id' => 1]);
        $respuesta->assertSessionHasErrors('nombre_medicamento');
    }

    public function prueba_validacion_nombre_medicamento_coincide_con_patron()
    {
        $respuesta = $this->post('/medicamento', ['nombre_medicamento' => '123', 'cate_id' => 1]);
        $respuesta->assertSessionHasErrors('nombre_medicamento');
    }

    public function prueba_validacion_nombre_medicamento_no_excede_100_caracteres()
    {
        $respuesta = $this->post('/medicamento', ['nombre_medicamento' => str_repeat('a', 101), 'cate_id' => 1]);
        $respuesta->assertSessionHasErrors('nombre_medicamento');
    }

    public function prueba_validacion_cate_id_obligatorio()
    {
        $respuesta = $this->post('/medicamento', ['nombre_medicamento' => 'Test Medicamento']);
        $respuesta->assertSessionHasErrors('cate_id');
    }

    public function prueba_validacion_cate_id_existe_en_tabla_categorias()
    {
        $respuesta = $this->post('/medicamento', ['nombre_medicamento' => 'Test Medicamento', 'cate_id' => 999]);
        $respuesta->assertSessionHasErrors('cate_id');
    }

    public function test_index_devuelve_vista_con_medicamentos()
    {
        $response = $this->get('/medicamento');
        $response->assertViewIs('medicamento.index');
        $response->assertViewHas('medicamentos');
    }

    public function test_create_devuelve_vista_con_categorías()
    {
        $response = $this->get('/medicamento/create');
        $response->assertViewIs('medicamento.create');
        $response->assertViewHas('categorias');
    }

    public function test_edit_devuelve_vista_con_medicamento_y_categorías()
    {
        $medicamento = Medicamento::factory()->create();
        $response = $this->get("/medicamento/{$medicamento->id}/edit");
        $response->assertViewIs('medicamento.edit');
        $response->assertViewHas('medicamento');
        $response->assertViewHas('categorias');
    }

    public function test_destroy_borra_y_redirige()
    {
        $medicamento = Medicamento::factory()->create();
        $response = $this->delete("/medicamento/{$medicamento->id}");
        $response->assertRedirect('/medicamento');
        $this->assertDatabaseMissing('medicamentos', ['id' => $medicamento->id]);
    }

    public function test_store_validación_con_datos_vacíos()
    {
        $response = $this->post('/medicamento', []);
        $response->assertSessionHasErrors(['nombre_medicamento', 'cate_id']);
    }

    public function test_store_validación_con_ID_de_cate_inválido()
    {
        $response = $this->post('/medicamento', ['nombre_medicamento' => 'Test', 'cate_id' => 'invalid']);
        $response->assertSessionHasErrors('cate_id');
    }

    public function test_store_validación_con_ID_de_cate_inexistente()
    {
        $response = $this->post('/medicamento', ['nombre_medicamento' => 'Test', 'cate_id' => 9999]);
        $response->assertSessionHasErrors('cate_id');
    }

    public function test_store_validación_con_nombre_de_medicamento_inválido()
    {
        $response = $this->post('/medicamento', ['nombre_medicamento' => 123, 'cate_id' => 1]);
        $response->assertSessionHasErrors('nombre_medicamento');
    }

    public function test_store_validación_con_nombre_de_medicamento_largo()
    {
        $response = $this->post('/medicamento', ['nombre_medicamento' => str_repeat('a', 101), 'cate_id' => 1]);
        $response->assertSessionHasErrors('nombre_medicamento');
    }

    public function test_update_validación_con_datos_vacíos()
    {
        $medicamento = Medicamento::factory()->create();
        $response = $this->put("/medicamento/{$medicamento->id}", []);
        $response->assertSessionHasErrors(['nombre_medicamento', 'cate_id']);
    }

    public function test_update_validación_con_ID_de_categoria_inválido()
    {
        $medicamento = Medicamento::factory()->create();
        $response = $this->put("/medicamento/{$medicamento->id}", ['nombre_medicamento' => 'Test', 'cate_id' => 'invalid']);
        $response->assertSessionHasErrors('cate_id');
    }

    public function test_update_validación_con_ID_de_categoria_inexistente()
    {
        $medicamento = Medicamento::factory()->create();
        $response = $this->put("/medicamento/{$medicamento->id}", ['nombre_medicamento' => 'Test', 'cate_id' => 9999]);
        $response->assertSessionHasErrors('cate_id');
    }

    public function test_update_validación_con_nombre_de_medicamento_inválido()
    {
        $medicamento = Medicamento::factory()->create();
        $response = $this->put("/medicamento/{$medicamento->id}", ['nombre_medicamento' => 123, 'cate_id' => 1]);
        $response->assertSessionHasErrors('nombre_medicamento');
    }

    public function test_update_validación_con_nombre_de_medicamento_largo()
    {
        $medicamento = Medicamento::factory()->create();
        $response = $this->put("/medicamento/{$medicamento->id}", ['nombre_medicamento' => str_repeat('a', 101), 'cate_id' => 1]);
        $response->assertSessionHasErrors('nombre_medicamento');
    }

    public function test_index_retorna_vista_correcta()
    {
        $respuesta = $this->get('/medicamento');
        $respuesta->assertViewIs('medicamento.index');
    }

    public function test_create_retorna_vista_correcta()
    {
        $respuesta = $this->get('/medicamento/create');
        $respuesta->assertViewIs('medicamento.create');
    }

    public function test_edit_retorna_vista_correcta()
    {
        $medicamento = Medicamento::factory()->create();
        $respuesta = $this->get("/medicamento/{$medicamento->id}/edit");
        $respuesta->assertViewIs('medicamento.edit');
    }

    public function test_store_crea_nuevo_medicamento()
    {
        $categoria = Categoria::factory()->create();
        $respuesta = $this->post('/medicamento', [
            'nombre_medicamento' => 'Test',
            'cate_id' => $categoria->id,
        ]);
        $respuesta->assertRedirect('/medicamento');
        $this->assertDatabaseHas('medicamentos', ['nombre_medicamento' => 'Test']);
    }

    public function test_update_modifica_medicamento_existente()
    {
        $medicamento = Medicamento::factory()->create();
        $categoria = Categoria::factory()->create();
        $respuesta = $this->put("/medicamento/{$medicamento->id}", [
            'nombre_medicamento' => 'Actualizado',
            'cate_id' => $categoria->id,
        ]);
        $respuesta->assertRedirect('/medicamento');
        $this->assertDatabaseHas('medicamentos', ['nombre_medicamento' => 'Actualizado']);
    }

    public function test_destroy_elimina_medicamento()
    {
        $medicamento = Medicamento::factory()->create();
        $respuesta = $this->delete("/medicamento/{$medicamento->id}");
        $respuesta->assertRedirect('/medicamento');
        $this->assertDatabaseMissing('medicamentos', ['id' => $medicamento->id]);
    }

    public function prueba_validacion_cate_id_es_numerico()
    {
        $respuesta = $this->post('/medicamento', ['nombre_medicamento' => 'Test Medicamento', 'cate_id' => 'abc']);
        $respuesta->assertSessionHasErrors('cate_id');
    }

    public function prueba_validacion_cate_id_asociacion_correcta()
    {
        $categoria = Categoria::factory()->create();
        $medicamento = Medicamento::factory()->create(['cate_id' => $categoria->id]);
        $this->assertEquals($categoria->id, $medicamento->categoria->id);
    }

    public function prueba_validacion_cate_id_no_puede_ser_cero()
    {
        $respuesta = $this->post('/medicamento', ['nombre_medicamento' => 'Test Medicamento', 'cate_id' => 0]);
        $respuesta->assertSessionHasErrors('cate_id');
    }

    public function prueba_validacion_cate_id_no_puede_ser_negativo()
    {
        $respuesta = $this->post('/medicamento', ['nombre_medicamento' => 'Test Medicamento', 'cate_id' => -1]);
        $respuesta->assertSessionHasErrors('cate_id');
    }

    public function prueba_validacion_cate_id_debe_ser_entero()
    {
        $respuesta = $this->post('/medicamento', ['nombre_medicamento' => 'Test Medicamento', 'cate_id' => 1.5]);
        $respuesta->assertSessionHasErrors('cate_id');
    }
}