<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Medicamento;

class MedicamentosTest extends TestCase
{
    /**
     * Ejemplo de prueba de característica básica.
     *
     * @return void
     */

    // MedicamentoController puede recuperar todos los objetos Medicamento de la base de datos y devolverlos en una vista
    public function test_recuperar_todos_medicamentos()
    {
        $response = $this->get('/medicamento');
        $response->assertStatus(200);
        $response->assertViewIs('medicamento/index');
        $response->assertViewHas('medicamentos');
    }

    // MedicamentoController puede crear un nuevo objeto Medicamento con datos válidos y almacenarlo en la base de datos
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

    // MedicamentoController puede actualizar un objeto Medicamento existente con datos válidos y almacenarlo en la base de datos
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

    // MedicamentoController no puede crear un nuevo objeto Medicamento con datos inválidos y almacenarlo en la base de datos
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

    // MedicamentoController no puede actualizar un objeto Medicamento existente con datos inválidos y almacenarlo en la base de datos
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

    // MedicamentoController no puede recuperar un objeto Medicamento inexistente de la base de datos
    public function test_recuperar_medicamento_no_existente()
    {
        $response = $this->get('/medicamento/999');
        $response->assertStatus(404);
    }

    // MedicamentoController puede eliminar un objeto Medicamento existente de la base de datos
    public function test_eliminar_medicamento()
    {
        $medicamento = Medicamento::factory()->create();

        $response = $this->delete('/medicamento/' . $medicamento->id);
        $response->assertRedirect('/medicamento');
        $this->assertDeleted($medicamento);
    }

    // MedicamentoController puede recuperar todos los objetos Categoria de la base de datos y devolverlos en una vista
    public function test_recuperar_todas_categorias()
    {
        $response = $this->get('/medicamento/create');
        $response->assertStatus(200);
        $response->assertViewIs('medicamento.create');
        $response->assertViewHas('categorias');
    }

    // MedicamentoController no puede actualizar un objeto Medicamento inexistente en la base de datos
    public function test_actualizar_medicamento_no_existente()
    {
        $response = $this->put('/medicamento/999', [
            'nombre_medicamento' => 'Updated Medicamento',
            'cate_id' => 1,
        ]);
        $response->assertNotFound();
    }

    // MedicamentoController no puede eliminar un objeto Medicamento inexistente de la base de datos
    public function test_no_puede_eliminar_medicamento_no_existente()
    {
        $response = $this->delete('/medicamento/100');
        $response->assertStatus(404);
    }

    // MedicamentoController puede manejar solicitudes concurrentes al mismo recurso
    public function test_puede_manejar_solicitudes_concurrentes()
    {
        $response1 = $this->post('/medicamento', ['nombre_medicamento' => 'Medicamento 1', 'cate_id' => 1]);
        $response2 = $this->post('/medicamento', ['nombre_medicamento' => 'Medicamento 2', 'cate_id' => 1]);

        $response1->assertStatus(302);
        $response2->assertStatus(302);
    }

    // MedicamentoController puede manejar errores y excepciones inesperados
    public function test_puede_manejar_errores_inesperados()
    {
        // Simular un error inesperado al pasar un ID de categoría no válido
        $response = $this->post('/medicamento', ['nombre_medicamento' => 'Medicamento', 'cate_id' => 100]);

        $response->assertStatus(500);
    }

    // MedicamentoController puede manejar grandes cantidades de datos en la base de datos
    public function test_manipular_grandes_cantidades_datos()
    {
        // Generar una gran cantidad de datos en la base de datos
        factory(Medicamento::class, 1000)->create();

        // Enviar una solicitud al método index
        $response = $this->get('/medicamento');

        // Asegurar que la respuesta sea exitosa
        $response->assertStatus(200);

        // Asegurar que la vista sea la correcta
        $response->assertViewIs('medicamento/index');

        // Asegurar que la vista tenga los datos correctos
        $response->assertViewHas('medicamentos');
    }

    // MedicamentoController puede manejar diferentes tipos de solicitudes HTTP (GET, POST, PUT, DELETE)
    public function test_manejar_diferentes_solicitudes_http()
    {
        // Enviar una solicitud GET al método index
        $response = $this->get('/medicamento');
        $response->assertStatus(200);

        // Enviar una solicitud POST al método store
        $response = $this->post('/medicamento', ['nombre_medicamento' => 'Test Medicamento', 'cate_id' => 1]);
        $response->assertRedirect('/medicamento');

        // Enviar una solicitud PUT al método update
        $response = $this->put('/medicamento/1', ['nombre_medicamento' => 'Updated Medicamento', 'cate_id' => 2]);
        $response->assertRedirect('/medicamento');

        // Enviar una solicitud DELETE al método destroy
        $response = $this->delete('/medicamento/1');
        $response->assertRedirect('/medicamento');
    }

    // MedicamentoController puede manejar diferentes tipos de datos de entrada (datos de formulario, datos JSON)
    public function test_manejar_diferentes_datos_entrada()
    {
        // Enviar una solicitud con datos de formulario al método store
        $response = $this->post('/medicamento', ['nombre_medicamento' => 'Test Medicamento', 'cate_id' => 1]);
        $response->assertRedirect('/medicamento');

        // Enviar una solicitud con datos JSON al método store
        $response = $this->postJson('/medicamento', ['nombre_medicamento' => 'Test Medicamento', 'cate_id' => 1]);
        $response->assertStatus(201);
        $response->assertJson(['message' => 'El registro fue creado exitosamente.']);

        // Enviar una solicitud con datos de formulario al método update
        $response = $this->put('/medicamento/1', ['nombre_medicamento' => 'Updated Medicamento', 'cate_id' => 2]);
        $response->assertRedirect('/medicamento');

        // Enviar una solicitud con datos JSON al método update
        $response = $this->putJson('/medicamento/1', ['nombre_medicamento' => 'Updated Medicamento', 'cate_id' => 2]);
        $response->assertStatus(200);
        $response->assertJson(['message' => 'El registro fue modificado exitosamente.']);
    }

    // Validación de almacenamiento
    public function test_validacion_almacenamiento()
    {
        // 1. Prueba que nombre_medicamento es obligatorio
        $response = $this->post('/medicamento', ['cate_id' => 1]);
        $response->assertSessionHasErrors('nombre_medicamento');

        // 2. Prueba que nombre_medicamento debe coincidir con el patrón regex
        $response = $this->post('/medicamento', ['nombre_medicamento' => '123', 'cate_id' => 1]);
        $response->assertSessionHasErrors('nombre_medicamento');

        // 3. Prueba que nombre_medicamento no debe exceder los 100 caracteres
        $response = $this->post('/medicamento', ['nombre_medicamento' => str_repeat('a', 101), 'cate_id' => 1]);
        $response->assertSessionHasErrors('nombre_medicamento');

        // 4. Prueba que cate_id es obligatorio
        $response = $this->post('/medicamento', ['nombre_medicamento' => 'Test Medicamento']);
        $response->assertSessionHasErrors('cate_id');

        // 5. Prueba que cate_id debe existir en la tabla categorias
        $response = $this->post('/medicamento', ['nombre_medicamento' => 'Test Medicamento', 'cate_id' => 999]);
        $response->assertSessionHasErrors('cate_id');
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
}