<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Propietario;
use App\Models\User;
use Tests\TestCase;

class VistaPropietarioTest extends TestCase
{
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Buscar el usuario en la base de datos por correo electrónico
        $this->user = User::where('correo', 'patitas@gmail.com')
        ->orWhere('correo', 'karlagalo@gmail.com')
        ->first();

        // Si no puedes encontrar el usuario, podrías querer lanzar un error para que sepas que algo está mal
        if (!$this->user) {
            $this->fail('Usuario no encontrado');
        }

        // Actuar como el usuario encontrado
        $this->actingAs($this->user);
    }

    
    public function test_VistaPropietarioIndex()
    {
        $response = $this->get('/propietario');

        $response->assertStatus(200);
        $response->assertViewIs('propietario.index');
    }

    public function test_VistaPropietarioCreate()
    {
        $response = $this->get('/propietario/create');

        $response->assertStatus(200);
        $response->assertViewIs('propietario.create');
    }

    public function test_VistaPropietarioEdit()
    {
        $response = $this->get('/propietario/1/edit');

        $response->assertStatus(200);
        $response->assertViewIs('propietario.editar');
    }

     //Prueba de la vista index para propietario devuelve un código de estado 404 cuando el usuario no está autenticado
     public function test_VistaIndexPropietarioCuandoUsuarioNoAutenticado()
     {
         $this->be(null); // Desautenticar al usuario
 
         $response = $this->get('/propietario');
 
         $response->assertStatus(404);
     }

     //Prueba de la vista create para propietario devuelve un código de estado 404 cuando el usuario no está autenticado
     public function test_VistaCreatePropietarioCuandoUsuarioNoAutenticado()
     {
         $this->be(null); // Desautenticar al usuario
 
         $response = $this->get('/propietario/create');
 
         $response->assertStatus(404);
     }

     //Prueba de la vista edit para propietario devuelve un código de estado 404 cuando el usuario no está autenticado
     public function test_VistaEditPropietarioCuandoUsuarioNoAutenticado()
     {
         $this->be(null); // Desautenticar al usuario
 
         $response = $this->get('/propietario/1/editar');
 
         $response->assertStatus(404);
     }

     // Prueba de la vista index para propietario devuelve un código de estado 403 cuando el usuario está autenticado pero no tiene el rol de 'admin'.
    public function test_VistaIndexPropietarioSinRolAdmin()
    { 
    $this->user->assignRole('admin'); // Asignar el rol 'admin' al usuario

    $this->be($this->user); // Autenticar al usuario

    // Simular la eliminación del rol 'admin'
    $this->user->removeRole('admin');

    $response = $this->get('/propietario');

    $response->assertStatus(403); // Verificar que se recibe un status 403 (Forbidden)
    }

       // Prueba de la vista create para propietario devuelve un código de estado 403 cuando el usuario está autenticado pero no tiene el rol de 'admin'.
       public function test_VistaCreatePropietarioSinRolAdmin()
       { 
       $this->user->assignRole('admin'); // Asignar el rol 'admin' al usuario
   
       $this->be($this->user); // Autenticar al usuario
   
       // Simular la eliminación del rol 'admin'
       $this->user->removeRole('admin');
   
       $response = $this->get('/propietario/create');
   
       $response->assertStatus(403); // Verificar que se recibe un status 403 (Forbidden)
       }

       // Prueba de la vista edit para propietario devuelve un código de estado 403 cuando el usuario está autenticado pero no tiene el rol de 'admin'.
       public function test_VistaEditPropietarioSinRolAdmin()
       { 
       $this->user->assignRole('admin'); // Asignar el rol 'admin' al usuario
   
       $this->be($this->user); // Autenticar al usuario
   
       // Simular la eliminación del rol 'admin'
       $this->user->removeRole('admin');
   
       $response = $this->get('/propietario/1/editar');
   
       $response->assertStatus(403); // Verificar que se recibe un status 403 (Forbidden)
       }

    // Prueba de la vista index para propietario devuelve un código de estado 200 cuando el usuario está autenticado y tiene el rol de 'admin'.
    public function test_VistaIndexPropietarioCuandoUsuarioAutenticadoRolAdmin()
    {
        $this->user->assignRole(); // Asignar el rol 'admin' al usuario

        $this->be($this->user); // Autenticar al usuario

        $response = $this->get('/propietario');

        $response->assertStatus(200);
    }
 
    // Prueba de la vista create para propietario devuelve un código de estado 200 cuando el usuario está autenticado y tiene el rol de 'admin'.
    public function test_VistaCreatePropietarioCuandoUsuarioAutenticadoRolAdmin()
    {
        $this->user->assignRole(); // Asignar el rol 'admin' al usuario

        $this->be($this->user); // Autenticar al usuario

        $response = $this->get('/propietario/create');

        $response->assertStatus(200);
    }

    // Prueba de la vista edit para propietario devuelve un código de estado 200 cuando el usuario está autenticado y tiene el rol de 'admin'.
    public function test_VistaEditPropietarioCuandoUsuarioAutenticadoRolAdmin()
    {
        $this->user->assignRole(); // Asignar el rol 'admin' al usuario

        $this->be($this->user); // Autenticar al usuario

        $response = $this->get('/propietario/1/editar');

        $response->assertStatus(200);
    }

        // Prueba de la vista de edit para propietario con un ID inválido devuelve un código de estado 404
        public function test_VistaEditPropietarioConIDInvalido()
        {
            $response = $this->get('/propietario/999/edit');
    
            $response->assertStatus(404);
        }

         //Prueba de la vista edit con ID invalido para propietario devuelve un código de estado 404 cuando el usuario no está autenticado
         public function test_VistaEditPropietarioIDInvalidoCuandoUsuarioNoAutenticado()
         {
             $this->be(null); // Desautenticar al usuario
     
             $response = $this->get('/propietario/999/editar');
     
             $response->assertStatus(404);
         }
}
