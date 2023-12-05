<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Paciente;
use App\Models\User;
use Tests\TestCase;

class VistaPacienteTest extends TestCase
{
    //refrescamos base de datos y logiamos
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->actingAs($this->user);
    }

    
    public function test_VistaPacienteIndex()
    {
        $response = $this->get('/paciente');

        $response->assertStatus(200);
        $response->assertViewIs('paciente.index');
    }

    public function test_VistaPacienteCreate()
    {
        $response = $this->get('/paciente/create');

        $response->assertStatus(200);
        $response->assertViewIs('paciente.create');
    }

    public function test_VistaPacienteEdit()
    {
        $response = $this->get('/paciente/1/editar');

        $response->assertStatus(200);
        $response->assertViewIs('paciente.edit');
    }

    //Prueba de la vista index para paciente devuelve un código de estado 404 cuando el usuario no está autenticado
    public function test_VistaIndexPacienteCuandoUsuarioNoAutenticado()
    {
        $this->be(null); // Desautenticar al usuario

        $response = $this->get('/paciente');

        $response->assertStatus(404);
    }

    //Prueba de la vista create para paciente devuelve un código de estado 404 cuando el usuario no está autenticado
    public function test_VistaCreatePacienteCuandoUsuarioNoAutenticado()
    {
        $this->be(null); // Desautenticar al usuario

        $response = $this->get('/paciente/create');

        $response->assertStatus(404);
    }

     //Prueba de la vista edit para paciente devuelve un código de estado 404 cuando el usuario no está autenticado
     public function test_VistaEditPacienteCuandoUsuarioNoAutenticado()
     {
         $this->be(null); // Desautenticar al usuario
 
         $response = $this->get('/paciente/1/editar');
 
         $response->assertStatus(404);
     }
       
         // Prueba de la vista de edit para paciente con un ID inválido devuelve un código de estado 404
         public function test_VistaEditPacienteConIDInvalido()
         {
             $response = $this->get('/paciente/999/edit');
     
             $response->assertStatus(404);
         }

    //Prueba de la vista edit  con ID invalido para paciente devuelve un código de estado 404 cuando el usuario no está autenticado
           public function test_VistaEditPacienteIDInvalidoCuandoUsuarioNoAutenticado()
           {
               $this->be(null); // Desautenticar al usuario
       
               $response = $this->get('/paciente/999/editar');
       
               $response->assertStatus(404);
           }
  
    // Prueba de la vista index para paciente devuelve un código de estado 403 cuando el usuario está autenticado pero no tiene el rol de 'admin'.
    public function test_VistaIndexPacienteSinRolAdmin()
    { 
    $this->user->assignRole('admin'); // Asignar el rol 'admin' al usuario

    $this->be($this->user); // Autenticar al usuario

    // Simular la eliminación del rol 'admin'
    $this->user->removeRole('admin');

    $response = $this->get('/paciente');

    $response->assertStatus(403); // Verificar que se recibe un status 403 (Forbidden)
    }

     // Prueba de la vista create para paciente devuelve un código de estado 403 cuando el usuario está autenticado pero no tiene el rol de 'admin'.
     public function test_VistaCreatePacienteSinRolAdmin()
     { 
     $this->user->assignRole('admin'); // Asignar el rol 'admin' al usuario
 
     $this->be($this->user); // Autenticar al usuario
 
     // Simular la eliminación del rol 'admin'
     $this->user->removeRole('admin');
 
     $response = $this->get('/paciente/create');
 
     $response->assertStatus(403); // Verificar que se recibe un status 403 (Forbidden)
     }

       // Prueba de la vista edit para paciente devuelve un código de estado 403 cuando el usuario está autenticado pero no tiene el rol de 'admin'.
       public function test_VistaEditPacienteSinRolAdmin()
       { 
       $this->user->assignRole('admin'); // Asignar el rol 'admin' al usuario
   
       $this->be($this->user); // Autenticar al usuario
   
       // Simular la eliminación del rol 'admin'
       $this->user->removeRole('admin');
   
       $response = $this->get('/paciente/1/edit');
   
       $response->assertStatus(403); // Verificar que se recibe un status 403 (Forbidden)
       }

       // Prueba de la vista index para paciente devuelve un código de estado 200 cuando el usuario está autenticado y tiene el rol de 'admin'.
    public function test_VistaIndexPacienteCuandoUsuarioAutenticadoRolAdmin()
    {
        $this->user->assignRole(); // Asignar el rol 'admin' al usuario

        $this->be($this->user); // Autenticar al usuario

        $response = $this->get('/paciente');

        $response->assertStatus(200);
    }

       // Prueba de la vista create para paciente devuelve un código de estado 200 cuando el usuario está autenticado y tiene el rol de 'admin'.
       public function test_VistaCreatePacienteCuandoUsuarioAutenticadoRolAdmin()
       {
           $this->user->assignRole(); // Asignar el rol 'admin' al usuario
   
           $this->be($this->user); // Autenticar al usuario
   
           $response = $this->get('/paciente/create');
   
           $response->assertStatus(200);
       }

        // Prueba de la vista edit para paciente devuelve un código de estado 200 cuando el usuario está autenticado y tiene el rol de 'admin'.
        public function test_VistaEditPacienteCuandoUsuarioAutenticadoRolAdmin()
        {
            $this->user->assignRole(); // Asignar el rol 'admin' al usuario
    
            $this->be($this->user); // Autenticar al usuario
    
            $response = $this->get('/paciente/1/edit');
    
            $response->assertStatus(200);
        }
}