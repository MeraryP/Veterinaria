<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Route;
use App\Models\User;

class RutasTest extends TestCase
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
    //La función debe manejar correctamente todas las rutas definidas y sus correspondientes controladores.
    public function test_manejar_rutas_y_controladores_definidos()
    {
        $closure = function () {
            // Definir las rutas esperadas y sus correspondientes controladoras
            $expectedRoutes = [
                '/propietario' => 'App\Http\Controllers\PropietarioController',
                '/paciente' => 'App\Http\Controllers\PacienteController',
                '/medicamento' => 'App\Http\Controllers\MedicamentoController',
                '/vacuna' => 'App\Http\Controllers\VacunaController',
                '/examen' => 'App\Http\Controllers\ExamenController',
                '/desparacitar' => 'App\Http\Controllers\DesparacitarController',
                '/clinico' => 'App\Http\Controllers\ClinicoController',
            ];

            // Iterar sobre las rutas definidas y comprobar si tienen el controlador correcto
            foreach ($expectedRoutes as $route => $controller) {
                $routeInfo = Route::getRoutes()->getByName($route);
                $this->assertEquals($controller, $routeInfo->getAction()['controller']);
            }
        };

        $closure();
    }

    //La función debe manejar correctamente todo el middleware definido.
    public function test_manejo_de_middleware()
    {
        $closure = function () {
            // Define el estado del middleware
            $expectedMiddleware = [
                'auth',
                'desactivado',
            ];

            // Obtención de los grupos de middleware de las rutas
            $middlewareGroups = Route::getMiddlewareGroups();

            // Iterar sobre el middleware esperado y comprobar si está presente en los grupos de middleware
            foreach ($expectedMiddleware as $middleware) {
                $this->assertArrayHasKey($middleware, $middlewareGroups);
            }
        };

        $closure();
    }

    //La función debe manejar correctamente todas las rutas de recursos definidas.
    public function test_handle_defined_resource_routes()
    {
        $closure = function () {
            // Definir las rutas de recursos esperadas
            $expectedResourceRoutes = [
                '/propietario',
                '/paciente',
                '/medicamento',
                '/vacuna',
                '/examen',
                '/desparacitar',
                '/clinico',
            ];

            // Obtener las rutas de recursos de las rutas
            $resourceRoutes = Route::getRoutes()->getResources();

            // Iterar sobre las rutas de recursos esperadas y comprobar si están presentes en las rutas de recursos
            foreach ($expectedResourceRoutes as $route) {
                $this->assertArrayHasKey($route, $resourceRoutes);
            }
        };

        $closure();
    }

    // La función debe manejar correctamente los parámetros de entrada no válidos.
    public function test_manejar_parámetros_de_entrada_inválidos()
    {
        $closure = function () {
            // Definir un parámetro de entrada no válido
            $invalidParameter = 'invalid';

            // Llame al cierre con el parámetro no válido y espere que se produzca una excepción
            $this->expectException(Exception::class);
            $this->expectExceptionMessage('Invalid input parameter');

            $closure($invalidParameter);
        };

        $closure();
    }

    // La función debe manejar correctamente los parámetros de entrada que faltan.
    public function test_manejar_parámetros_de_entrada_faltantes()
    {
        $closure = function ($parameter) {
            // Llame al cierre sin el parámetro requerido y espere que se produzca una excepción
            $this->expectException(Exception::class);
            $this->expectExceptionMessage('Missing input parameter');

            $closure();
        };

        $closure();
    }

    // La función debe manejar correctamente las rutas no válidas.
    public function test_manejar_rutas_inválidas()
    {
        $closure = function () {
            $invalidRoute = '/invalid';

            $this->expectException(Exception::class);
            $this->expectExceptionMessage('Invalid route');

            $closure($invalidRoute);
        };

        $closure();
    }

    // La función debe manejar correctamente todas las rutas con nombre definidas.
    public function test_manejar_rutas_nombradas_definidas()
    {
        $closure = function () {
            $expectedRoutes = [
                'propietario.update',
                'vacunaMascota',
                'examenMascota',
                'desparacitacionMascota',
                'clinicoMascota',
                'paciente.vacuna.nuevo',
                'paciente.examen.nuevo',
                'paciente.desparacitar.nuevo',
                'paciente.clinico.nuevo',
                'paciente.update',
                'medicamento.update',
                'vacuna.update',
                'examen.update',
                'desparacitar.update',
                'contrasenia.cambiar',
                'contrasenia.cambiada',
                'usuario.datos',
                'usuario.editar',
                'usuario.actualizar',
                'home',
                'usuario.listado',
                'usuario.registrar',
                'user.desactivar',
                'user.activar',
                'user.destroy',
                'usuario.update',
                'usuario.editaru',
                'clinico.update',
                'logout2'
            ];

            foreach ($expectedRoutes as $route) {
                $this->assertTrue(Route::has($route));
            }
        };

        $closure();
    }

    // La función debe manejar correctamente todas las cláusulas where definidas.
    public function test_manejar_cláusulas_where_definidas()
    {
        $closure = function () {
            // Definir las cláusulas where esperadas
            $expectedWhereClauses = [
                'id' => '[0-9]+'
            ];

            foreach ($expectedWhereClauses as $parameter => $clause) {
                $routeInfo = Route::getRoutes()->getByName('propietario.update');
                $this->assertEquals($clause, $routeInfo->wheres[$parameter]);
            }
        };

        $closure();
    }

    // La función debe manejar correctamente todas las rutas de autenticación definidas.
    public function test_manejar_rutas_de_autenticación_definidas()
    {
        $closure = function () {
            // Definir las rutas de autenticación esperadas
            $expectedRoutes = [
                'contrasenia.cambiar',
                'contrasenia.cambiada',
                'usuario.datos',
                'usuario.editar',
                'usuario.actualizar',
                'home',
                'usuario.listado',
                'usuario.registrar',
                'user.desactivar',
                'user.activar',
                'user.destroy',
                'usuario.update',
                'usuario.editaru',
                'clinico.update',
                'logout2'
            ];

            foreach ($expectedRoutes as $route) {
                $routeInfo = Route::getRoutes()->getByName($route);
                $this->assertTrue(in_array('auth', $routeInfo->middleware()));
            }
        };

        $closure();
    }

    // La función debe manejar correctamente todas las rutas de autorización definidas.
    public function test_manejar_rutas_de_autorización_definidas()
    {
        $closure = function () {
            $expectedRoutes = [
                '/contrasenia' => 'App\Http\Controllers\UserController',
                '/usuario' => 'App\Http\Controllers\UserController',
                '/usuario/editar' => 'App\Http\Controllers\UserController',
                '/listausuarios' => 'App\Http\Controllers\UserController',
                '/registrar' => 'App\Http\Controllers\UserController',
                '/usuario/desactivar/{id}' => 'App\Http\Controllers\UserController',
                '/usuario/activar/{id}' => 'App\Http\Controllers\UserController',
                '/usuario/eliminar/{id}' => 'App\Http\Controllers\UserController',
                '/usuario/{id}/edit' => 'App\Http\Controllers\UserController',
                '/clinico' => 'App\Http\Controllers\ClinicoController',
                '/logout2' => 'App\Http\Controllers\Auth\LoginController',
            ];

            foreach ($expectedRoutes as $route => $controller) {
                $routeInfo = Route::getRoutes()->getByName($route);
                $this->assertEquals($controller, $routeInfo->getAction()['controller']);
            }
        };

        $closure();
    }

    // La función debe manejar correctamente todas las redirecciones definidas.
    public function test_manejar_redirecciones_definidas()
    {
        $closure = function () {
            $expectedRedirects = [
                '/' => 'App\Http\Controllers\HomeController',
            ];

            foreach ($expectedRedirects as $redirect => $controller) {
                $routeInfo = Route::getRoutes()->getByName($redirect);
                $this->assertEquals($controller, $routeInfo->getAction()['controller']);
            }
        };

        $closure();
    }

    // La función debe manejar correctamente todas las vistas definidas.
    public function test_manejar_vistas_definidas()
    {
        $closure = function () {
            $expectedViews = [
                'home' => 'App\Http\Controllers\HomeController',
                'usuario.datos' => 'App\Http\Controllers\UserController',
                'usuario.editar' => 'App\Http\Controllers\UserController',
                'usuario.listado' => 'App\Http\Controllers\UserController',
                'usuario.registrar' => 'App\Http\Controllers\UserController',
            ];

            foreach ($expectedViews as $view => $controller) {
                $routeInfo = Route::getRoutes()->getByName($view);
                $this->assertEquals($controller, $routeInfo->getAction()['controller']);
            }
        };

        $closure();
    }

    // La función debe controlar correctamente los controladores no válidos.
    public function test_manejar_controladores_inválidos()
    {
        $closure = function () {
            // Definir las rutas esperadas y sus correspondientes controladores
            $expectedRoutes = [
                '/propietario' => 'App\Http\Controllers\PropietarioController',
                '/paciente' => 'App\Http\Controllers\PacienteController',
                '/medicamento' => 'App\Http\Controllers\MedicamentoController',
                '/vacuna' => 'App\Http\Controllers\VacunaController',
                '/examen' => 'App\Http\Controllers\ExamenController',
                '/desparacitar' => 'App\Http\Controllers\DesparacitarController',
                '/clinico' => 'App\Http\Controllers\ClinicoController',
            ];

            foreach ($expectedRoutes as $route => $controller) {
                $routeInfo = Route::getRoutes()->getByName($route);
                $this->assertEquals($controller, $routeInfo->getAction()['controller']);
            }
        };

        $closure();
    }

    // La función debe controlar correctamente el middleware no válido.
    public function test_manejar_middleware_inválido()
    {
        $closure = function () {
            $expectedMiddleware = [
                '/propietario' => 'desactivado',
                '/paciente' => 'desactivado',
                '/medicamento' => 'desactivado',
                '/vacuna' => 'desactivado',
                '/examen' => 'desactivado',
                '/desparacitar' => 'desactivado',
                '/clinico' => 'desactivado',
            ];

            foreach ($expectedMiddleware as $route => $middleware) {
                $routeInfo = Route::getRoutes()->getByName($route);
                $this->assertEquals($middleware, $routeInfo->getAction()['middleware']);
            }
        };

        $closure();
    }

    // La función debe controlar correctamente el middleware válido.
    public function test_manejar_middleware_válido()
    {
        $closure = function () {
            $expectedMiddleware = [
                '/propietario' => 'auth',
                '/paciente' => 'auth',
                '/medicamento' => 'auth',
                '/vacuna' => 'auth',
                '/examen' => 'auth',
                '/desparacitar' => 'auth',
                '/clinico' => 'auth',
            ];

            foreach ($expectedMiddleware as $route => $middleware) {
                $routeInfo = Route::getRoutes()->getByName($route);
                $this->assertEquals($middleware, $routeInfo->getAction()['middleware']);
            }
        };

        $closure();
    }

    // La función debe controlar correctamente las rutas de recursos no válidas.
    public function test_manejar_rutas_de_recursos_inválidas()
    {
        $closure = function () {
            // Rutas
            $expectedResourceRoutes = [
                '/propietario',
                '/paciente',
                '/medicamento',
                '/vacuna',
                '/examen',
                '/desparacitar',
                '/clinico',
            ];

            foreach ($expectedResourceRoutes as $route) {
                $routeInfo = Route::getRoutes()->getByName($route);
                $this->assertNotNull($routeInfo);
            }
        };

        $closure();
    }

    // La función debe controlar correctamente las rutas con nombre no válidas.
    public function test_manejar_rutas_nombradas_inválidas()
    {
        $closure = function () {
            // Rutas invalidas
            $invalidRoutes = [
                'invalid_route1',
                'invalid_route2',
                'invalid_route3',
            ];

            foreach ($invalidRoutes as $route) {
                $routeInfo = Route::getRoutes()->getByName($route);
                $this->assertNull($routeInfo);
            }
        };

        $closure();
    }

    // La función debe controlar correctamente las cláusulas where no válidas.
    public function test_manejar_cláusulas_where_inválidas()
    {
        $closure = function () {
            // Definir las cláusulas where no válidas esperadas
            $invalidWhereClauses = [
                'id' => '[A-Z]+',
                'name' => '[0-9]+',
                'email' => '[A-Za-z]+',
            ];

            foreach ($invalidWhereClauses as $parameter => $whereClause) {
                $routeInfo = Route::getRoutes()->getByName('propietario.update');
                $whereClauses = $routeInfo->wheres;
                $this->assertArrayNotHasKey($parameter, $whereClauses);
            }
        };

        $closure();
    }

    // La función debe manejar correctamente las rutas de autenticación no válidas.
    public function test_manejar_rutas_de_autenticación_inválidas()
    {
        $closure = function () {
            $invalidRoutes = [
                'login',
                'register',
                'logout',
            ];

            foreach ($invalidRoutes as $route) {
                $routeInfo = Route::getRoutes()->getByName($route);
                $this->assertNull($routeInfo);
            }
        };

        $closure();
    }

    // La función debe controlar correctamente las rutas de autorización no válidas.
    public function test_manejar_rutas_de_autorización_inválidas()
    {
        $closure = function () {
            $invalidRoutes = [
                '/invalid_route1',
                '/invalid_route2',
                '/invalid_route3',
            ];

            foreach ($invalidRoutes as $route) {
                $this->assertFalse(Route::has($route));
            }
        };

        $closure();
    }

    // La función debe manejar correctamente todos los métodos HTTP definidos.
    public function test_manejar_métodos_HTTP_definidos()
    {
        $closure = function () {
            // Definir las rutas esperadas y sus correspondientes métodos HTTP
            $expectedMethods = [
                '/propietario' => 'GET',
                '/paciente' => 'POST',
                '/medicamento' => 'PUT',
                '/vacuna' => 'DELETE',
                '/examen' => 'PATCH',
                '/desparacitar' => 'OPTIONS',
                '/clinico' => 'HEAD',
            ];

            foreach ($expectedMethods as $route => $method) {
                $routeInfo = Route::getRoutes()->getByName($route);
                $this->assertEquals($method, $routeInfo->methods()[0]);
            }
        };

        $closure();
    }
}