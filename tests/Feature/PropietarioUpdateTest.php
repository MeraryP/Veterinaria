<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Propietario;
use Illuminate\Support\Facades\DB;

class PropietarioUpdateTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_actualizar_propietario()
    {
        DB::beginTransaction();
        $propietario = Propietario::factory()->create([
            'identidad' => '0703-1996-02694',
            'nombre' => 'Juan Adolfo Pérez',
            'direccion' => 'Barrio El Centro',
            'telefono' => '9965-6330',
            'correo' => 'jadolfo@gmail.com'
        ]);

        $updatedData = [
            'identidad' => '0703-1996-02694',
            'nombre' => 'Juan Pérez Modificado',
            'direccion' => 'Barrio La Libertad',
            'telefono' => '9988-1234',
            'correo' => 'juanperez@gmail.com'
        ];

        $response = $this->put('/propietario/' . $propietario->id, $updatedData);

        $this->assertDatabaseHas('propietarios', [
            'id' => $propietario->id,
            'nombre' => 'Juan Pérez Modificado',
            'direccion' => 'Barrio La Libertad',
            'telefono' => '9988-1234',
            'correo' => 'juanperez@gmail.com'
        ]);
        DB::rollBack();
    }

    public function test_identidad_propietario_nulo()
    {
        $propietario = Propietario::factory()->create(['identidad' => null]);

        $updatedData = [
            'identidad' => null, // Puede variar dependiendo de tu lógica de actualización
            'nombre' => 'Nombre Actualizado',
            'direccion' => 'Dirección Actualizada',
            'telefono' => '9988-1234',
            'correo' => 'correo@example.com'
        ];

        $response = $this->put('/propietario/' . $propietario->id, $updatedData);

        $response->assertSessionHasErrors('identidad');
    }

    public function test_identidad_propietario_extenso()
    {
        $propietario = Propietario::factory()->create(['identidad' => '172451230230000']);

        $updatedData = [
            'identidad' => '172451230230000', // Puede variar dependiendo de tu lógica de actualización
            'nombre' => 'Nombre Actualizado',
            'direccion' => 'Dirección Actualizada',
            'telefono' => '9988-1234',
            'correo' => 'correo@example.com'
        ];

        $response = $this->put('/propietario/' . $propietario->id, $updatedData);

        $response->assertSessionHasErrors('identidad');
    }

    public function test_identidad_propietario_corto()
    {
        $propietario = Propietario::factory()->create(['identidad' => '1']);

        $updatedData = [
            'identidad' => '1', // Puede variar dependiendo de tu lógica de actualización
            'nombre' => 'Nombre Actualizado',
            'direccion' => 'Dirección Actualizada',
            'telefono' => '9988-1234',
            'correo' => 'correo@example.com'
        ];

        $response = $this->put('/propietario/' . $propietario->id, $updatedData);

        $response->assertSessionHasErrors('identidad');
    }

    public function test_identidad_propietario_con_letras()
    {
        $propietario = Propietario::factory()->create(['identidad' => 'ABCDE']);

        $updatedData = [
            'identidad' => 'ABCDE', // Puede variar dependiendo de tu lógica de actualización
            'nombre' => 'Nombre Actualizado',
            'direccion' => 'Dirección Actualizada',
            'telefono' => '9988-1234',
            'correo' => 'correo@example.com'
        ];

        $response = $this->put('/propietario/' . $propietario->id, $updatedData);

        $response->assertSessionHasErrors('identidad');
    }

    public function test_identidad_propietario_con_caracteres_especiales()
    {
        $propietario = Propietario::factory()->create(['identidad' => '@##$%%&%$']);

        $updatedData = [
            'identidad' => '@##$%%&%$', // Puede variar dependiendo de tu lógica de actualización
            'nombre' => 'Nombre Actualizado',
            'direccion' => 'Dirección Actualizada',
            'telefono' => '9988-1234',
            'correo' => 'correo@example.com'
        ];

        $response = $this->put('/propietario/' . $propietario->id, $updatedData);

        $response->assertSessionHasErrors('identidad');
    }

    public function testIdentidadPropietarioFormatoSinGuiones()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $data = Propietario::factory()->make(['identidad' => '0703199402416'])->toArray();

        $response = $this->post('/propietario', $data);

        $response->assertSessionHasErrors('identidad');
    }

    public function testIdentidadPropietarioFormatoSinGuionesConEspacios()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $data = Propietario::factory()->make(['identidad' => '0703 1994 02416'])->toArray();

        $response = $this->post('/propietario', $data);

        $response->assertSessionHasErrors('identidad');
    }

    public function testIdentidadPropietarioFormatoConGuiones()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $data = Propietario::factory()->make(['identidad' => '0703-1994-02416'])->toArray();

        $response = $this->post('/propietario', $data);

        $response->assertSessionHasErrors('identidad');
    }

    public function testNombrePropietarioNull()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $data = Propietario::factory()->make(['nombre' => null])->toArray();

        $response = $this->post('/propietario', $data);

        $response->assertSessionHasErrors('nombre');
    }

    public function testNombrePropietarioNumerico()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $propietario = Propietario::factory()->create();

        $data = [
            'nombre' => '123456789',
        ];

        $response = $this->put('/propietario/' . $propietario->id, $data);

        $response->assertSessionHasErrors('nombre');
    }

    public function testNombrePropietarioNumericoConLetras()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $propietario = Propietario::factory()->create();

        $data = [
            'nombre' => '1ABC2DEFG3',
        ];

        $response = $this->put('/propietario/' . $propietario->id, $data);

        $response->assertSessionHasErrors('nombre');
    }

    public function testNombrePropietarioConCaracteresEspeciales()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $propietario = Propietario::factory()->create();

        $data = [
            'nombre' => '@$#%#$$%#$',
            // Agrega aquí los demás campos que deseas actualizar en la solicitud
        ];

        $response = $this->put('/propietario/' . $propietario->id, $data);

        $response->assertSessionHasErrors('nombre');
    }

    public function testNombrePropietarioMuyExtenso()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $propietario = Propietario::factory()->create();

        $data = [
            'nombre' => str_repeat('A', 150),
            // Agrega aquí los demás campos que deseas actualizar en la solicitud
        ];

        $response = $this->put('/propietario/' . $propietario->id, $data);

        $response->assertSessionHasErrors('nombre');
    }

    public function testNombrePropietarioMuyCorto()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $propietario = Propietario::factory()->create();

        $data = [
            'nombre' => 'A',
        ];

        $response = $this->put('/propietario/' . $propietario->id, $data);

        $response->assertSessionHasErrors('nombre');
    }

    public function testActualizarPropietarioDireccionNull()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $propietario = Propietario::factory()->create();
        $data = ['direccion' => null]; // Valida la actualización con 'direccion' nula

        $response = $this->put("/propietario/{$propietario->id}", $data);

        $response->assertSessionHasErrors('direccion');
    }

    public function testActualizarPropietarioDireccionNumerica()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $propietario = Propietario::factory()->create();
        $data = ['direccion' => '1213456']; // Valida la actualización con 'direccion' numérica

        $response = $this->put("/propietario/{$propietario->id}", $data);

        $response->assertSessionHasErrors('direccion');
    }

    public function testActualizarPropietarioDireccionExtensa()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $propietario = Propietario::factory()->create();
        $data = [
            'direccion' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.'
        ]; // Valida la actualización con 'direccion' demasiado extensa

        $response = $this->put("/propietario/{$propietario->id}", $data);

        $response->assertSessionHasErrors('direccion');
    }

    public function testActualizarPropietarioDireccionCorta()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $propietario = Propietario::factory()->create();
        $data = ['direccion' => 'A']; // Valida la actualización con 'direccion' muy corta

        $response = $this->put("/propietario/{$propietario->id}", $data);

        $response->assertSessionHasErrors('direccion');
    }

    public function testTelefonoPropietarioFormatoValido()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        // Creamos un número de teléfono válido
        $telefonoValido = '2345-6789';

        // Creamos un Propietario existente
        $propietario = Propietario::factory()->create();

        // Enviar la información a la ruta para actualizar el Propietario con el teléfono válido
        $response = $this->put("/propietario/{$propietario->id}", ['telefono' => $telefonoValido]);

        // Verificar que no haya errores de validación para el teléfono
        $response->assertSessionDoesntHaveErrors('telefono');
    }

    public function testTelefonoPropietarioFormatoInvalidoLongitudIncorrecta()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        // Creamos un número de teléfono con longitud incorrecta
        $telefonoInvalido = '123-45678';

        // Creamos un Propietario existente
        $propietario = Propietario::factory()->create();

        // Enviar la información a la ruta para actualizar el Propietario con el teléfono de longitud incorrecta
        $response = $this->put("/propietario/{$propietario->id}", ['telefono' => $telefonoInvalido]);

        // Verificar que hay errores de validación para el teléfono
        $response->assertSessionHasErrors('telefono');
    }

    public function testTelefonoPropietarioFormatoInvalidoCaracteresNoNumericos()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        // Creamos un número de teléfono con caracteres no numéricos
        $telefonoInvalido = '23A5-67B9';

        // Creamos un Propietario y obtenemos su ID
        $propietario = Propietario::factory()->create();
        $propietarioID = $propietario->id;

        // Enviamos una solicitud para actualizar el teléfono con un formato inválido
        $response = $this->put("/propietario/{$propietarioID}", ['telefono' => $telefonoInvalido]);

        // Verificar que hay errores de validación para el teléfono
        $response->assertSessionHasErrors('telefono');
    }

    public function testTelefonoPropietarioFormatoInvalidoInicioIncorrecto()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        // Creamos un número de teléfono que no inicia con 2, 3, 8 o 9
        $telefonoInvalido = '6123-4567';

        // Creamos un Propietario y obtenemos su ID
        $propietario = Propietario::factory()->create();
        $propietarioID = $propietario->id;

        // Enviamos una solicitud para actualizar el teléfono con un inicio incorrecto
        $response = $this->put("/propietario/{$propietarioID}", ['telefono' => $telefonoInvalido]);

        // Verificar que hay errores de validación para el teléfono
        $response->assertSessionHasErrors('telefono');
    }

    public function testTelefonoPropietarioFormatoInvalidoInicioDos()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        // Teléfono que comienza con '2' pero no tiene el formato correcto
        $telefonoInvalido = '2123-4567';

        // Creamos un Propietario y obtenemos su ID
        $propietario = Propietario::factory()->create();
        $propietarioID = $propietario->id;

        // Enviamos una solicitud para actualizar el teléfono con un inicio '2' incorrecto
        $response = $this->put("/propietario/{$propietarioID}", ['telefono' => $telefonoInvalido]);

        // Verificar que hay errores de validación para el teléfono
        $response->assertSessionHasErrors('telefono');
    }

    public function testTelefonoPropietarioFormatoInvalidoInicioTresActualizacion()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        // Teléfono que comienza con '3' pero no tiene el formato correcto
        $telefonoInvalido = '312-34567';

        // Crear un Propietario existente
        $propietario = Propietario::factory()->create();

        // Datos para actualizar con un teléfono que comienza con '3' pero tiene un formato incorrecto
        $data = [
            'identidad' => $propietario->identidad,
            'nombre' => $propietario->nombre,
            'direccion' => $propietario->direccion,
            'gene_id' => $propietario->gene_id,
            'telefono' => $telefonoInvalido, // Teléfono con formato incorrecto
            'correo' => $propietario->correo,
        ];

        // Enviar la información a la ruta para actualizar el Propietario
        $response = $this->put("/propietario/{$propietario->id}", $data);

        // Verificar que hay errores de validación para el teléfono
        $response->assertSessionHasErrors('telefono');
    }

    public function testTelefonoPropietarioFormatoInvalidoInicioOchoActualizacion()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        // Teléfono que comienza con '8' pero no tiene el formato correcto
        $telefonoInvalido = '81234-567';

        // Crear un Propietario existente
        $propietario = Propietario::factory()->create();

        // Datos para actualizar con un teléfono que comienza con '8' pero tiene un formato incorrecto
        $data = [
            'identidad' => $propietario->identidad,
            'nombre' => $propietario->nombre,
            'direccion' => $propietario->direccion,
            'gene_id' => $propietario->gene_id,
            'telefono' => $telefonoInvalido, // Teléfono con formato incorrecto
            'correo' => $propietario->correo,
        ];

        // Enviar la información a la ruta para actualizar el Propietario
        $response = $this->put("/propietario/{$propietario->id}", $data);

        // Verificar que hay errores de validación para el teléfono
        $response->assertSessionHasErrors('telefono');
    }

    public function testTelefonoPropietarioFormatoInvalidoInicioNueveActualizacion()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        // Teléfono que comienza con '9' pero no tiene el formato correcto
        $telefonoInvalido = '9000-123';

        // Crear un Propietario existente
        $propietario = Propietario::factory()->create();

        // Datos para actualizar con un teléfono que comienza con '9' pero tiene un formato incorrecto
        $data = [
            'identidad' => $propietario->identidad,
            'nombre' => $propietario->nombre,
            'direccion' => $propietario->direccion,
            'gene_id' => $propietario->gene_id,
            'telefono' => $telefonoInvalido, // Teléfono con formato incorrecto
            'correo' => $propietario->correo,
        ];

        // Enviar la información a la ruta para actualizar el Propietario
        $response = $this->put("/propietario/{$propietario->id}", $data);

        // Verificar que hay errores de validación para el teléfono
        $response->assertSessionHasErrors('telefono');
    }
    public function testTelefonoPropietarioFormatoInvalidoCaracterEspecial()
    {
        // Teléfono con un carácter especial
        $telefonoInvalido = '23@5-67B9';

        // ID de un Propietario existente en la base de datos que queremos actualizar
        $propietarioId = 1; // Cambia esto al ID válido en tu base de datos

        // Enviar la información de actualización a la ruta
        $response = $this->put('/propietario/' . $propietarioId, ['telefono' => $telefonoInvalido]);

        // Verificar que hay errores de validación para el teléfono
        $response->assertSessionHasErrors('telefono');
    }

    public function testCorreoPropietarioFormatoValido()
    {
        // Correo electrónico válido
        $correoValido = 'usuario@example.com';

        // ID de un Propietario existente en la base de datos que queremos actualizar
        $propietarioId = 1; // Cambia esto al ID válido en tu base de datos

        // Enviar la información de actualización a la ruta
        $response = $this->put('/propietario/' . $propietarioId, ['correo' => $correoValido]);

        // Verificar que no haya errores de validación para el correo
        $response->assertSessionDoesntHaveErrors('correo');
    }
    public function testTelefonoPropietarioFormatoInvalidoConLetras()
    {
        // Teléfono con un formato completamente incorrecto
        $telefonoInvalido = 'abcdefghi';

        // ID de un Propietario existente en la base de datos que queremos actualizar
        $propietarioId = 1; // Cambia esto al ID válido en tu base de datos

        // Enviar la información de actualización a la ruta
        $response = $this->put('/propietario/' . $propietarioId, ['telefono' => $telefonoInvalido]);

        // Verificar que hay errores de validación para el teléfono
        $response->assertSessionHasErrors('telefono');
    }

    public function testTelefonoPropietarioFormatoInvalidoSinGuion()
    {
        // Teléfono sin guiones
        $telefonoInvalido = '23456789';

        // ID de un Propietario existente en la base de datos que queremos actualizar
        $propietarioId = 1; // Cambia esto al ID válido en tu base de datos

        // Enviar la información de actualización a la ruta
        $response = $this->put('/propietario/' . $propietarioId, ['telefono' => $telefonoInvalido]);

        // Verificar que hay errores de validación para el teléfono
        $response->assertSessionHasErrors('telefono');
    }

    public function testCorreoPropietarioFormatoInvalidoDominio()
    {
        // Correo electrónico con formato de dominio incorrecto
        $correoInvalido = 'usuario@example';

        // ID de un Propietario existente en la base de datos que queremos actualizar
        $propietarioId = 1; // Cambia esto al ID válido en tu base de datos

        // Enviar la información de actualización a la ruta
        $response = $this->put('/propietario/' . $propietarioId, ['correo' => $correoInvalido]);

        // Verificar que hay errores de validación para el correo
        $response->assertSessionHasErrors('correo');
    }

    public function testCorreoPropietarioFormatoInvalidoUsuario()
    {
        // Correo electrónico con formato de usuario incorrecto
        $correoInvalido = 'usuario@';

        // ID de un Propietario existente en la base de datos que queremos actualizar
        $propietarioId = 1; // Cambia esto al ID válido en tu base de datos

        // Enviar la información de actualización a la ruta
        $response = $this->put('/propietario/' . $propietarioId, ['correo' => $correoInvalido]);

        // Verificar que hay errores de validación para el correo
        $response->assertSessionHasErrors('correo');
    }
    public function testCorreoPropietarioFormatoInvalidoCaracterEspecialActualizacion()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        // Correo con un carácter especial
        $correoInvalido = 'usuario@exa!mple.com';

        // Crear un Propietario existente en la base de datos
        $propietario = Propietario::factory()->create();

        // Enviar la actualización con el correo que contiene un carácter especial
        $response = $this->put('/propietario/' . $propietario->id, ['correo' => $correoInvalido]);

        // Verificar que hay errores de validación para el correo
        $response->assertSessionHasErrors('correo');
    }

    public function testCorreoPropietarioFormatoInvalidoSinArrobaActualizacion()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        // Correo sin el símbolo '@'
        $correoInvalido = 'usuarioexample.com';

        // Crear un Propietario existente en la base de datos
        $propietario = Propietario::factory()->create();

        // Enviar la actualización con el correo que no tiene el símbolo '@'
        $response = $this->put('/propietario/' . $propietario->id, ['correo' => $correoInvalido]);

        // Verificar que hay errores de validación para el correo
        $response->assertSessionHasErrors('correo');
    }

    public function testCorreoPropietarioFormatoInvalidoEspaciosBlancosActualizacion()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        // Correo con espacios en blanco al principio o al final
        $correoInvalido = ' usuario@example.com ';

        // Crear un Propietario existente en la base de datos
        $propietario = Propietario::factory()->create();

        // Enviar la actualización con el correo que contiene espacios en blanco
        $response = $this->put('/propietario/' . $propietario->id, ['correo' => $correoInvalido]);

        // Verificar que hay errores de validación para el correo
        $response->assertSessionHasErrors('correo');
    }

    public function testUpdatePropietarioCorreoFormatoInvalidoPuntoFinal()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        // Correo con un punto al final del dominio
        $correoInvalido = 'usuario@example.com.';

        // Crear un Propietario existente en la base de datos
        $propietario = Propietario::factory()->create();

        // Preparar los datos para actualizar con el correo inválido
        $datosActualizados = $propietario->toArray();
        $datosActualizados['correo'] = $correoInvalido;

        // Enviar la información a la ruta para actualizar el Propietario
        $response = $this->put("/propietario/{$propietario->id}", $datosActualizados);

        // Verificar que hay errores de validación para el correo
        $response->assertSessionHasErrors('correo');
    }

    public function testUpdatePropietarioCorreoFormatoNumerico()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        // Correo con un valor numérico
        $correoInvalido = '123456789';

        // Crear un Propietario existente en la base de datos
        $propietario = Propietario::factory()->create();

        // Preparar los datos para actualizar con el correo inválido
        $datosActualizados = $propietario->toArray();
        $datosActualizados['correo'] = $correoInvalido;

        // Enviar la información a la ruta para actualizar el Propietario
        $response = $this->put("/propietario/{$propietario->id}", $datosActualizados);

        // Verificar que hay errores de validación para el correo
        $response->assertSessionHasErrors('correo');
    }

    public function testCorreoPropietarioFormatoParrafoActualizacion()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        // Correo con un punto al final del dominio
        $correoInvalido = 'correo_invalido@example.com.'; // Coloca el correo inválido que deseas probar

        // Crear un Propietario
        $propietario = Propietario::factory()->create();

        // Datos actualizados con el correo inválido
        $datosActualizados = [
            'identidad' => $propietario->identidad,
            'nombre' => $propietario->nombre,
            'direccion' => $propietario->direccion,
            'gene_id' => $propietario->gene_id,
            'telefono' => $propietario->telefono,
            'correo' => $correoInvalido,
        ];

        // Enviar la información a la ruta para actualizar el Propietario
        $response = $this->put('/propietario/' . $propietario->id, $datosActualizados);

        // Verificar que hay errores de validación para el correo
        $response->assertSessionHasErrors('correo');
    }
}
