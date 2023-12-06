<?php

namespace Tests\Feature;

use App\Models\Propietario;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PropietarioCreateTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->actingAs($this->user);
    }
    //Esta es una prueba que verifica si la página que contiene el formulario de crear propietario está disponible y devuelve un 
    //código de estado HTTP 200.
    public function testCreatePropietarioFormIsAvailable()
    {
        $response = $this->get('/propietario/create');
        $response->assertStatus(200);
    }

    public function testRedireccionDespuesDeGuardarCliente()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $datos = Propietario::factory()->make()->toArray();

        $response = $this->post('/propietario', $datos);

        $response->assertRedirect('/');
    }

    public function testGuardarPropietario()
    {
        DB::beginTransaction();
        $data = Propietario::factory()->create([
            'identidad' => '0703-1996-02694',
            'nombre' => 'Juan Adolfo Pérez',
            'direccion' => 'Barrio El Centro',
            'telefono' => '9965-6330',
            'correo' => 'jadolfo@gmail.com'
        ])->toArray();

        $response = $this->post('/propietario', $data);

        $this->assertDatabaseHas('propietarios', [
            'identidad' => '0703-1996-02694',
            'nombre' => 'Juan Adolfo Pérez',
            'direccion' => 'Barrio El Centro',
            'telefono' => '9965-6330',
            'correo' => 'jadolfo@gmail.com'
        ]);
        DB::rollBack();
    }

    public function testIdentidadPropietarioNull()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $data = Propietario::factory()->create(['identidad' => null])->toArray();

        $response = $this->post('/propietario', $data);

        $response->assertSessionHasErrors('identidad');
    }

    public function testIdentidadPropietarioExtenso()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $data = Propietario::factory()->create(['identidad' => '172451230230000'])->toArray();

        $response = $this->post('/propietario', $data);

        $response->assertSessionHasErrors('identidad');
    }

    public function testIdentidadPropietarioCorto()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $data = Propietario::factory()->create(['identidad' => '1'])->toArray();

        $response = $this->post('/propietario', $data);

        $response->assertSessionHasErrors('identidad');
    }

    public function testIdentidadPropietarioConLetras()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $data = Propietario::factory()->create(['identidad' => 'ABCDE'])->toArray();

        $response = $this->post('/propietario', $data);

        $response->assertSessionHasErrors('identidad');
    }

    public function testIdentidadPropietarioConCaracteresEspeciales()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $data = Propietario::factory()->create(['identidad' => '@##$%%&%$'])->toArray();

        $response = $this->post('/propietario', $data);

        $response->assertSessionHasErrors('identidad');
    }

    public function testIdentidadPropietarioFormatoSinGuiones()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $data = Propietario::factory()->create(['identidad' => '0703199402416'])->toArray();

        $response = $this->post('/propietario', $data);

        $response->assertSessionHasErrors('identidad');
    }

    public function testIdentidadPropietarioFormatoSinGuionesConEspacios()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $data = Propietario::factory()->create(['identidad' => '0703 1994 02416'])->toArray();

        $response = $this->post('/propietario', $data);

        $response->assertSessionHasErrors('identidad');
    }

    public function testIdentidadPropietarioFormatoConGuiones()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $data = Propietario::factory()->create(['identidad' => '0703-1994-02416'])->toArray();

        $response = $this->post('/propietario', $data);

        $response->assertSessionHasErrors('identidad');
    }

    public function testNombrePropietarioNull()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $data = Propietario::factory()->create(['nombre' => null])->toArray();

        $response = $this->post('/propietario', $data);

        $response->assertSessionHasErrors('nombre');
    }

    public function testNombrePropietarioMuyExtenso()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $data = Propietario::factory()->create(['nombre' =>  str_repeat('A', 150)])->toArray();

        $response = $this->post('/propietario', $data);

        $response->assertSessionHasErrors('nombre');
    }

    public function testNombrePropietarioMuyCorto()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $data = Propietario::factory()->create(['nombre' =>  'A'])->toArray();

        $response = $this->post('/propietario', $data);

        $response->assertSessionHasErrors('nombre');
    }

    public function testNombrePropietarioNumerico()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $data = Propietario::factory()->create(['nombre' =>  '123456789'])->toArray();

        $response = $this->post('/propietario', $data);

        $response->assertSessionHasErrors('nombre');
    }

    public function testNombrePropietarioNumericoConLetras()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $data = Propietario::factory()->create(['nombre' =>  '1ABC2DEFG3'])->toArray();

        $response = $this->post('/propietario', $data);

        $response->assertSessionHasErrors('nombre');
    }

    public function testNombrePropietarioConCaracteresEspeciales()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $data = Propietario::factory()->create(['nombre' =>  '@$#%#$$%#$'])->toArray();

        $response = $this->post('/propietario', $data);

        $response->assertSessionHasErrors('nombre');
    }

    public function testDireccionPropietarioNull()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $data = Propietario::factory()->create(['direccion' =>  null])->toArray();

        $response = $this->post('/propietario', $data);

        $response->assertSessionHasErrors('direccion');
    }

    public function testDireccionPropietarioNumerica()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $data = Propietario::factory()->create(['direccion' =>  '1213456'])->toArray();

        $response = $this->post('/propietario', $data);

        $response->assertSessionHasErrors('direccion');
    }

    public function testDireccionPropietarioExtensa()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $data = Propietario::factory()->create(['direccion' =>  
        'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text ever since the 1500s,
         when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into
        electronic typesetting, remaining essentially unchanged.'])->toArray();

        $response = $this->post('/propietario', $data);

        $response->assertSessionHasErrors('direccion');
    }

    public function testDireccionPropietarioCorta()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $data = Propietario::factory()->create(['direccion' =>  'A'])->toArray();

        $response = $this->post('/propietario', $data);

        $response->assertSessionHasErrors('direccion');
    }


    public function testTelefonoPropietarioFormatoValido()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        
        // Creamos un número de teléfono válido
        $telefonoValido = '2345-6789';
    
        // Creamos un Propietario con el teléfono válido
        $data = Propietario::factory()->create(['telefono' => $telefonoValido])->toArray();
    
        // Enviar la información a la ruta para crear el Propietario
        $response = $this->post('/propietario', $data);
    
        // Verificar que no haya errores de validación para el teléfono
        $response->assertSessionDoesntHaveErrors('telefono');
    }
    
    public function testTelefonoPropietarioFormatoInvalidoLongitudIncorrecta()
{
    $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    
    // Creamos un número de teléfono con longitud incorrecta
    $telefonoInvalido = '123-45678';

    // Creamos un Propietario con el teléfono de longitud incorrecta
    $data = Propietario::factory()->create(['telefono' => $telefonoInvalido])->toArray();

    // Enviar la información a la ruta para crear el Propietario
    $response = $this->post('/propietario', $data);

    // Verificar que hay errores de validación para el teléfono
    $response->assertSessionHasErrors('telefono');
}

public function testTelefonoPropietarioFormatoInvalidoCaracteresNoNumericos()
{
    $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    
    // Creamos un número de teléfono con caracteres no numéricos
    $telefonoInvalido = '23A5-67B9';

    // Creamos un Propietario con el teléfono que contiene caracteres no numéricos
    $data = Propietario::factory()->create(['telefono' => $telefonoInvalido])->toArray();

    // Enviar la información a la ruta para crear el Propietario
    $response = $this->post('/propietario', $data);

    // Verificar que hay errores de validación para el teléfono
    $response->assertSessionHasErrors('telefono');
}

public function testTelefonoPropietarioFormatoInvalidoInicioIncorrecto()
{
    $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    
    // Creamos un número de teléfono que no inicia con 2, 3, 8 o 9
    $telefonoInvalido = '6123-4567';

    // Creamos un Propietario con el teléfono que no inicia correctamente
    $data = Propietario::factory()->create(['telefono' => $telefonoInvalido])->toArray();

    // Enviar la información a la ruta para crear el Propietario
    $response = $this->post('/propietario', $data);

    // Verificar que hay errores de validación para el teléfono
    $response->assertSessionHasErrors('telefono');
}
public function testTelefonoPropietarioFormatoInvalidoInicioDos()
{
    $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    
    // Teléfono que comienza con '2' pero no tiene el formato correcto
    $telefonoInvalido = '2123-4567';

    // Crear un Propietario con un teléfono que comienza con '2' pero tiene un formato incorrecto
    $data = Propietario::factory()->create(['telefono' => $telefonoInvalido])->toArray();

    // Enviar la información a la ruta para crear el Propietario
    $response = $this->post('/propietario', $data);

    // Verificar que hay errores de validación para el teléfono
    $response->assertSessionHasErrors('telefono');
}

public function testTelefonoPropietarioFormatoInvalidoInicioTres()
{
    $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    
    // Teléfono que comienza con '3' pero no tiene el formato correcto
    $telefonoInvalido = '312-34567';

    // Crear un Propietario con un teléfono que comienza con '3' pero tiene un formato incorrecto
    $data = Propietario::factory()->create(['telefono' => $telefonoInvalido])->toArray();

    // Enviar la información a la ruta para crear el Propietario
    $response = $this->post('/propietario', $data);

    // Verificar que hay errores de validación para el teléfono
    $response->assertSessionHasErrors('telefono');
}

public function testTelefonoPropietarioFormatoInvalidoInicioOcho()
{
    $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    
    // Teléfono que comienza con '8' pero no tiene el formato correcto
    $telefonoInvalido = '81234-567';

    // Crear un Propietario con un teléfono que comienza con '8' pero tiene un formato incorrecto
    $data = Propietario::factory()->create(['telefono' => $telefonoInvalido])->toArray();

    // Enviar la información a la ruta para crear el Propietario
    $response = $this->post('/propietario', $data);

    // Verificar que hay errores de validación para el teléfono
    $response->assertSessionHasErrors('telefono');
}

public function testTelefonoPropietarioFormatoInvalidoInicioNueve()
{
    $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    
    // Teléfono que comienza con '9' pero no tiene el formato correcto
    $telefonoInvalido = '9000-123';

    // Crear un Propietario con un teléfono que comienza con '9' pero tiene un formato incorrecto
    $data = Propietario::factory()->create(['telefono' => $telefonoInvalido])->toArray();

    // Enviar la información a la ruta para crear el Propietario
    $response = $this->post('/propietario', $data);

    // Verificar que hay errores de validación para el teléfono
    $response->assertSessionHasErrors('telefono');
}

public function testTelefonoPropietarioFormatoInvalidoCaracterEspecial()
{
    $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    
    // Teléfono con un carácter especial
    $telefonoInvalido = '23@5-67B9';

    // Crear un Propietario con un teléfono que contiene un carácter especial
    $data = Propietario::factory()->create(['telefono' => $telefonoInvalido])->toArray();

    // Enviar la información a la ruta para crear el Propietario
    $response = $this->post('/propietario', $data);

    // Verificar que hay errores de validación para el teléfono
    $response->assertSessionHasErrors('telefono');
}

public function testTelefonoPropietarioFormatoInvalidoConLetras()
{
    $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    
    // Teléfono con un formato completamente incorrecto
    $telefonoInvalido = 'abcdefghi';

    // Crear un Propietario con un teléfono que tiene un formato completamente incorrecto
    $data = Propietario::factory()->create(['telefono' => $telefonoInvalido])->toArray();

    // Enviar la información a la ruta para crear el Propietario
    $response = $this->post('/propietario', $data);

    // Verificar que hay errores de validación para el teléfono
    $response->assertSessionHasErrors('telefono');
}

public function testTelefonoPropietarioFormatoInvalidoSinGuion()
{
    $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    
    // Teléfono sin guiones
    $telefonoInvalido = '23456789';

    // Crear un Propietario con un teléfono sin guiones
    $data = Propietario::factory()->create(['telefono' => $telefonoInvalido])->toArray();

    // Enviar la información a la ruta para crear el Propietario
    $response = $this->post('/propietario', $data);

    // Verificar que hay errores de validación para el teléfono
    $response->assertSessionHasErrors('telefono');
}

public function testCorreoPropietarioFormatoValido()
{
    $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    
    // Correo electrónico válido
    $correoValido = 'usuario@example.com';

    // Crear un Propietario con el correo válido
    $data = Propietario::factory()->create(['correo' => $correoValido])->toArray();

    // Enviar la información a la ruta para crear el Propietario
    $response = $this->post('/propietario', $data);

    // Verificar que no haya errores de validación para el correo
    $response->assertSessionDoesntHaveErrors('correo');
}

public function testCorreoPropietarioFormatoInvalidoDominio()
{
    $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    
    // Correo electrónico con formato de dominio incorrecto
    $correoInvalido = 'usuario@example';

    // Crear un Propietario con el correo que tiene un dominio incorrecto
    $data = Propietario::factory()->create(['correo' => $correoInvalido])->toArray();

    // Enviar la información a la ruta para crear el Propietario
    $response = $this->post('/propietario', $data);

    // Verificar que hay errores de validación para el correo
    $response->assertSessionHasErrors('correo');
}

public function testCorreoPropietarioFormatoInvalidoUsuario()
{
    $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    
    // Correo electrónico con formato de usuario incorrecto
    $correoInvalido = 'usuario@';

    // Crear un Propietario con el correo que tiene un usuario incorrecto
    $data = Propietario::factory()->create(['correo' => $correoInvalido])->toArray();

    // Enviar la información a la ruta para crear el Propietario
    $response = $this->post('/propietario', $data);

    // Verificar que hay errores de validación para el correo
    $response->assertSessionHasErrors('correo');
}

public function testCorreoPropietarioFormatoInvalidoCaracterEspecial()
{
    $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    
    // Correo con un carácter especial
    $correoInvalido = 'usuario@exa!mple.com';

    // Crear un Propietario con el correo que contiene un carácter especial
    $data = Propietario::factory()->create(['correo' => $correoInvalido])->toArray();

    // Enviar la información a la ruta para crear el Propietario
    $response = $this->post('/propietario', $data);

    // Verificar que hay errores de validación para el correo
    $response->assertSessionHasErrors('correo');
}

public function testCorreoPropietarioFormatoInvalidoSinArroba()
{
    $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    
    // Correo sin el símbolo '@'
    $correoInvalido = 'usuarioexample.com';

    // Crear un Propietario con el correo que no tiene el símbolo '@'
    $data = Propietario::factory()->create(['correo' => $correoInvalido])->toArray();

    // Enviar la información a la ruta para crear el Propietario
    $response = $this->post('/propietario', $data);

    // Verificar que hay errores de validación para el correo
    $response->assertSessionHasErrors('correo');
}

public function testCorreoPropietarioFormatoInvalidoEspaciosBlancos()
{
    $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    
    // Correo con espacios en blanco al principio o al final
    $correoInvalido = ' usuario@example.com ';

    // Crear un Propietario con el correo que contiene espacios en blanco
    $data = Propietario::factory()->create(['correo' => $correoInvalido])->toArray();

    // Enviar la información a la ruta para crear el Propietario
    $response = $this->post('/propietario', $data);

    // Verificar que hay errores de validación para el correo
    $response->assertSessionHasErrors('correo');
}

public function testCorreoPropietarioFormatoInvalidoPuntoFinal()
{
    $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    
    // Correo con un punto al final del dominio
    $correoInvalido = 'usuario@example.com.';

    // Crear un Propietario con el correo que tiene un punto al final del dominio
    $data = Propietario::factory()->create(['correo' => $correoInvalido])->toArray();

    // Enviar la información a la ruta para crear el Propietario
    $response = $this->post('/propietario', $data);

    // Verificar que hay errores de validación para el correo
    $response->assertSessionHasErrors('correo');
}

public function testCorreoPropietarioFormatoNumerico()
{
    $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    
    // Correo con un punto al final del dominio
    $correoInvalido = '123456789';

    // Crear un Propietario con el correo que tiene un punto al final del dominio
    $data = Propietario::factory()->create(['correo' => $correoInvalido])->toArray();

    // Enviar la información a la ruta para crear el Propietario
    $response = $this->post('/propietario', $data);

    // Verificar que hay errores de validación para el correo
    $response->assertSessionHasErrors('correo');
}

public function testCorreoPropietarioFormatoParrafo()
{
    $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    
    // Correo con un punto al final del dominio
    $correoInvalido = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
    Lorem Ipsum has been the industry s standard dummy text ever since the 1500s,when an unknown printer
    took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, 
    but also the leap into electronic typesetting, remaining essentially unchanged';

    // Crear un Propietario con el correo que tiene un punto al final del dominio
    $data = Propietario::factory()->create(['correo' => $correoInvalido])->toArray();

    // Enviar la información a la ruta para crear el Propietario
    $response = $this->post('/propietario', $data);

    // Verificar que hay errores de validación para el correo
    $response->assertSessionHasErrors('correo');
}

}
