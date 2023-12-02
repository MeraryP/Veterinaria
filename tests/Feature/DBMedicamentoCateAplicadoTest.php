<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Categoria;
use App\Models\Medicamento;
use App\Models\Desparacitar;

class DBMedicamentoCateDesparacitarTest extends TestCase
{
    //Todas las pruebas esten dirigidas a la integrdad de la base de datos, que este normalizada, y pruebas a las relaciones de las tablas
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_creacion_medicamento_con_categoria_existente()
    {
        $categoria = Categoria::factory()->create();
        $medicamento = Medicamento::factory()->make(['cate_id' => $categoria->id]);
        $this->assertDatabaseHas('categorias', ['id' => $categoria->id]);
        $this->assertEquals($categoria->id, $medicamento->cate_id);
    }

    public function test_creacion_Desparacitar_con_medicamento_existente()
    {
        $medicamento = Medicamento::factory()->create();
        $Desparacitar = Desparacitar::factory()->make(['medi_id' => $medicamento->id]);
        $this->assertDatabaseHas('medicamentos', ['id' => $medicamento->id]);
        $this->assertEquals($medicamento->id, $Desparacitar->medi_id);
    }

    public function test_eliminacion_categoria_cascada_medicamentos()
    {
        $categoria = Categoria::factory()->create();
        $medicamento = Medicamento::factory()->create(['cate_id' => $categoria->id]);
        $categoria->delete();
        $this->assertDatabaseMissing('medicamentos', ['id' => $medicamento->id, 'cate_id' => $categoria->id]);
    }

    public function test_eliminacion_medicamento_cascada_Desparacitars()
    {
        $medicamento = Medicamento::factory()->create();
        $Desparacitar = Desparacitar::factory()->create(['medi_id' => $medicamento->id]);
        $medicamento->delete();
        $this->assertDatabaseMissing('Desparacitars', ['id' => $Desparacitar->id, 'medi_id' => $medicamento->id]);
    }

    public function test_creacion_medicamento_sin_categoria()
    {
        $medicamento = Medicamento::factory()->make();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $medicamento->save();
    }

    public function test_creacion_Desparacitar_sin_medicamento()
    {
        $Desparacitar = Desparacitar::factory()->make();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $Desparacitar->save();
    }

    public function test_actualizacion_medicamento_con_categoria_inexistente()
    {
        $medicamento = Medicamento::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $medicamento->update(['cate_id' => 999]);
    }

    public function test_actualizacion_Desparacitar_con_medicamento_inexistente()
    {
        $Desparacitar = Desparacitar::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $Desparacitar->update(['medi_id' => 999]);
    }

    public function test_creacion_categoria_con_nombre_duplicado()
    {
        $categoria = Categoria::factory()->create();
        $categoriaDuplicada = Categoria::factory()->make(['nombre_cate' => $categoria->nombre_cate]);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $categoriaDuplicada->save();
    }

    public function test_creacion_medicamento_con_nombre_duplicado()
    {
        $medicamento = Medicamento::factory()->create();
        $medicamentoDuplicado = Medicamento::factory()->make(['nombre_medicamento' => $medicamento->nombre_medicamento]);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $medicamentoDuplicado->save();
    }

    public function test_actualizacion_categoria_con_nombre_duplicado()
    {
        $categoria1 = Categoria::factory()->create();
        $categoria2 = Categoria::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $categoria2->update(['nombre_cate' => $categoria1->nombre_cate]);
    }

    public function test_actualizacion_medicamento_con_nombre_duplicado()
    {
        $medicamento1 = Medicamento::factory()->create();
        $medicamento2 = Medicamento::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $medicamento2->update(['nombre_medicamento' => $medicamento1->nombre_medicamento]);
    }

    public function test_creacion_categoria_con_nombre_vacio()
    {
        $categoria = Categoria::factory()->make(['nombre_cate' => '']);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $categoria->save();
    }

    public function test_creacion_medicamento_con_nombre_vacio()
    {
        $medicamento = Medicamento::factory()->make(['nombre_medicamento' => '']);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $medicamento->save();
    }

    public function test_actualizacion_categoria_con_nombre_vacio()
    {
        $categoria = Categoria::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $categoria->update(['nombre_cate' => '']);
    }

    public function test_actualizacion_medicamento_con_nombre_vacio()
    {
        $medicamento = Medicamento::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $medicamento->update(['nombre_medicamento' => '']);
    }

    public function test_creacion_categoria_con_nombre_nulo()
    {
        $categoria = Categoria::factory()->make(['nombre_cate' => null]);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $categoria->save();
    }

    public function test_creacion_medicamento_con_nombre_nulo()
    {
        $medicamento = Medicamento::factory()->make(['nombre_medicamento' => null]);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $medicamento->save();
    }

    public function test_actualizacion_categoria_con_nombre_nulo()
    {
        $categoria = Categoria::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $categoria->update(['nombre_cate' => null]);
    }

    public function test_actualizacion_medicamento_con_nombre_nulo()
    {
        $medicamento = Medicamento::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $medicamento->update(['nombre_medicamento' => null]);
    }

    public function test_creacion_medicamento_con_categoria_nula()
    {
        $medicamento = Medicamento::factory()->make(['cate_id' => null]);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $medicamento->save();
    }

    public function test_creacion_Desparacitar_con_medicamento_nulo()
    {
        $Desparacitar = Desparacitar::factory()->make(['medi_id' => null]);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $Desparacitar->save();
    }

    public function test_actualizacion_medicamento_con_categoria_nula()
    {
        $medicamento = Medicamento::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $medicamento->update(['cate_id' => null]);
    }

    public function test_actualizacion_Desparacitar_con_medicamento_nulo()
    {
        $Desparacitar = Desparacitar::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $Desparacitar->update(['medi_id' => null]);
    }

    public function test_creacion_categoria_con_nombre_muy_largo()
    {
        $nombre = str_repeat('a', 256);
        $categoria = Categoria::factory()->make(['nombre_cate' => $nombre]);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $categoria->save();
    }

    public function test_creacion_medicamento_con_nombre_muy_largo()
    {
        $nombre = str_repeat('a', 256);
        $medicamento = Medicamento::factory()->make(['nombre_medicamento' => $nombre]);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $medicamento->save();
    }

    public function test_actualizacion_categoria_con_nombre_muy_largo()
    {
        $nombre = str_repeat('a', 256);
        $categoria = Categoria::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $categoria->update(['nombre_cate' => $nombre]);
    }

    public function test_actualizacion_medicamento_con_nombre_muy_largo()
    {
        $nombre = str_repeat('a', 256);
        $medicamento = Medicamento::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $medicamento->update(['nombre_medicamento' => $nombre]);
    }

    public function test_creacion_categoria_con_nombre_especial()
    {
        $categoria = Categoria::factory()->make(['nombre_cate' => '@#$%^&*()']);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $categoria->save();
    }

    public function test_creacion_medicamento_con_nombre_especial()
    {
        $medicamento = Medicamento::factory()->make(['nombre_medicamento' => '@#$%^&*()']);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $medicamento->save();
    }

    public function test_actualizacion_categoria_con_nombre_especial()
    {
        $categoria = Categoria::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $categoria->update(['nombre_cate' => '@#$%^&*()']);
    }

    public function test_actualizacion_medicamento_con_nombre_especial()
    {
        $medicamento = Medicamento::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $medicamento->update(['nombre_medicamento' => '@#$%^&*()']);
    }

    public function test_creacion_categoria_con_nombre_numerico()
    {
        $categoria = Categoria::factory()->make(['nombre_cate' => '123456']);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $categoria->save();
    }

    public function test_creacion_medicamento_con_nombre_numerico()
    {
        $medicamento = Medicamento::factory()->make(['nombre_medicamento' => '123456']);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $medicamento->save();
    }

    public function test_actualizacion_categoria_con_nombre_numerico()
    {
        $categoria = Categoria::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $categoria->update(['nombre_cate' => '123456']);
    }

    public function test_actualizacion_medicamento_con_nombre_numerico()
    {
        $medicamento = Medicamento::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $medicamento->update(['nombre_medicamento' => '123456']);
    }

    public function test_creacion_categoria_con_nombre_espacio_blanco()
    {
        $categoria = Categoria::factory()->make(['nombre_cate' => ' ']);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $categoria->save();
    }

    public function test_creacion_medicamento_con_nombre_espacio_blanco()
    {
        $medicamento = Medicamento::factory()->make(['nombre_medicamento' => ' ']);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $medicamento->save();
    }

    public function test_actualizacion_categoria_con_nombre_espacio_blanco()
    {
        $categoria = Categoria::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $categoria->update(['nombre_cate' => ' ']);
    }

    public function test_actualizacion_medicamento_con_nombre_espacio_blanco()
    {
        $medicamento = Medicamento::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $medicamento->update(['nombre_medicamento' => ' ']);
    }

    public function test_borrado_categoria_con_medicamentos_asociados()
    {
        $categoria = Categoria::factory()->has(Medicamento::factory()->count(3))->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $categoria->delete();
    }

    public function test_borrado_medicamento_con_Desparacitars_asociados()
    {
        $medicamento = Medicamento::factory()->has(Desparacitar::factory()->count(3))->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $medicamento->delete();
    }

    public function test_borrado_categoria_con_medicamentos_y_Desparacitars_asociados()
    {
        $categoria = Categoria::factory()->has(Medicamento::factory()->has(Desparacitar::factory()->count(3))->count(3))->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $categoria->delete();
    }

    public function test_borrado_Desparacitar_con_medicamento_asociado()
    {
        $Desparacitar = Desparacitar::factory()->for(Medicamento::factory())->create();
        $this->assertNotNull(Desparacitar::find($Desparacitar->id));
        $Desparacitar->delete();
        $this->assertNull(Desparacitar::find($Desparacitar->id));
    }

    public function test_borrado_medicamento_con_categoria_asociada()
    {
        $medicamento = Medicamento::factory()->for(Categoria::factory())->create();
        $this->assertNotNull(Medicamento::find($medicamento->id));
        $medicamento->delete();
        $this->assertNull(Medicamento::find($medicamento->id));
    }

    public function test_borrado_categoria_sin_medicamentos_asociados()
    {
        $categoria = Categoria::factory()->create();
        $this->assertNotNull(Categoria::find($categoria->id));
        $categoria->delete();
        $this->assertNull(Categoria::find($categoria->id));
    }

    public function test_borrado_cascada_medicamento_Desparacitar()
    {
        $medicamento = Medicamento::factory()->has(Desparacitar::factory()->count(3))->create();
        $this->assertNotNull(Medicamento::find($medicamento->id));
        $this->assertEquals(3, Desparacitar::where('medi_id', $medicamento->id)->count());
        $medicamento->delete();
        $this->assertNull(Medicamento::find($medicamento->id));
        $this->assertEquals(0, Desparacitar::where('medi_id', $medicamento->id)->count());
    }

    public function test_borrado_cascada_categoria_medicamento()
    {
        $categoria = Categoria::factory()->has(Medicamento::factory()->count(3))->create();
        $this->assertNotNull(Categoria::find($categoria->id));
        $this->assertEquals(3, Medicamento::where('cate_id', $categoria->id)->count());
        $categoria->delete();
        $this->assertNull(Categoria::find($categoria->id));
        $this->assertEquals(0, Medicamento::where('cate_id', $categoria->id)->count());
    }

    public function test_borrado_cascada_categoria_medicamento_Desparacitar()
    {
        $categoria = Categoria::factory()->has(Medicamento::factory()->has(Desparacitar::factory()->count(3))->count(3))->create();
        $this->assertNotNull(Categoria::find($categoria->id));
        $this->assertEquals(3, Medicamento::where('cate_id', $categoria->id)->count());
        $this->assertEquals(9, Desparacitar::where('medi_id', Medicamento::where('cate_id', $categoria->id)->pluck('id'))->count());
        $categoria->delete();
        $this->assertNull(Categoria::find($categoria->id));
        $this->assertEquals(0, Medicamento::where('cate_id', $categoria->id)->count());
        $this->assertEquals(0, Desparacitar::where('medi_id', Medicamento::where('cate_id', $categoria->id)->pluck('id'))->count());
    }

    public function test_creacion_categoria_con_nombre_largo()
    {
        $categoria = Categoria::factory()->make(['nombre_cate' => str_repeat('a', 256)]);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $categoria->save();
    }

    public function test_creacion_medicamento_con_nombre_largo()
    {
        $medicamento = Medicamento::factory()->make(['nombre_medicamento' => str_repeat('a', 256)]);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $medicamento->save();
    }

    public function test_actualizacion_categoria_con_nombre_largo()
    {
        $categoria = Categoria::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $categoria->update(['nombre_cate' => str_repeat('a', 256)]);
    }

    public function test_actualizacion_medicamento_con_nombre_largo()
    {
        $medicamento = Medicamento::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $medicamento->update(['nombre_medicamento' => str_repeat('a', 256)]);
    }

    public function test_creacion_categoria_con_nombre_corto()
    {
        $categoria = Categoria::factory()->make(['nombre_cate' => 'a']);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $categoria->save();
    }

    public function test_creacion_medicamento_con_nombre_corto()
    {
        $medicamento = Medicamento::factory()->make(['nombre_medicamento' => 'a']);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $medicamento->save();
    }

    public function test_actualizacion_categoria_con_nombre_corto()
    {
        $categoria = Categoria::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $categoria->update(['nombre_cate' => 'a']);
    }

    public function test_actualizacion_medicamento_con_nombre_corto()
    {
        $medicamento = Medicamento::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $medicamento->update(['nombre_medicamento' => 'a']);
    }

    public function test_creacion_categoria_sin_nombre()
    {
        $categoria = Categoria::factory()->make(['nombre_cate' => null]);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $categoria->save();
    }

    public function test_creacion_medicamento_sin_nombre()
    {
        $medicamento = Medicamento::factory()->make(['nombre_medicamento' => null]);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $medicamento->save();
    }

    public function test_actualizacion_categoria_sin_nombre()
    {
        $categoria = Categoria::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $categoria->update(['nombre_cate' => null]);
    }

    public function test_actualizacion_medicamento_sin_nombre()
    {
        $medicamento = Medicamento::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $medicamento->update(['nombre_medicamento' => null]);
    }
}