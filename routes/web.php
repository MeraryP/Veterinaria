<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicamentoController;
use App\Http\Controllers\PropietarioController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\VacunaController;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\DesparacitarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClinicoController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\LoginController;






/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware("auth")->group(function () {
    Route::middleware("desactivado")->group(function () {


        Route::put('/profile/update',[ProfileController::class, 'update']);

        Route::put('/profile/password',[ProfileController::class, 'password']);

        //ruta propietario
        Route::resource('/propietario', 'App\Http\Controllers\PropietarioController');

        Route::put('/propietario/{id}/editar', [PropietarioController::class, 'update'])
        ->name('propietario.update')->where('id','[0-9]+');
        //ruta paciente
        Route::resource('/paciente', 'App\Http\Controllers\PacienteController');
        
        //ruta para recuperar los datos de la mascota
        Route::get('vacunaMascota/{id}', [PacienteController::class, 'vacunaMascota'])->name('vacunaMascota');
        Route::get('examenMascota/{id}', [PacienteController::class, 'examenMascota'])->name('examenMascota');
        Route::get('desparacitacionMascota/{id}', [PacienteController::class, 'desparacitacionMascota'])->name('desparacitacionMascota');
        Route::get('clinicoMascota/{id}', [PacienteController::class, 'clinicoMascota'])->name('clinicoMascota');

        //rutas para guardar especificamente la mascota
        Route::get('vacuna/{id}/create', [VacunaController::class, 'vacunaPaciente'])->name('paciente.vacuna.nuevo');
        Route::get('examen/{id}/create', [ExamenController::class, 'examenPaciente'])->name('paciente.examen.nuevo');
        Route::get('desparacitar/{id}/create', [DesparacitarController::class, 'desparacitarPaciente'])->name('paciente.desparacitar.nuevo');
        Route::get('clinico/{id}/create', [ClinicoController::class, 'clinicoPaciente'])->name('paciente.clinico.nuevo');


        
        
        
        Route::put('/paciente/{id}/editar', [PacienteController::class, 'update'])
        ->name('paciente.update')->where('id','[0-9]+');
       

        //ruta Medicamentos
        Route::resource('/medicamento', 'App\Http\Controllers\MedicamentoController');

        Route::put('/medicamento/{id}/editar', [MedicamentoController::class, 'update'])
        ->name('medicamento.update')->where('id','[0-9]+');

        //ruta vacuna
        Route::resource('/vacuna', 'App\Http\Controllers\VacunaController');

        Route::put('/vacuna/{id}/editar', [VacunaController::class, 'update'])
        ->name('vacuna.update')->where('id','[0-9]+');


        //ruta resumen
        Route::resource('/examen', 'App\Http\Controllers\ExamenController');

        Route::put('/examen/{id}/editar', [ExamenController::class, 'update'])
        ->name('examen.update')->where('id','[0-9]+');

        //ruta desparasitar
        Route::resource('desparacitar', 'App\Http\Controllers\DesparacitarController');

        Route::put('/desparacitar/{id}/editar', [DesparacitarController::class, 'update'])
        ->name('desparacitar.update')->where('id','[0-9]+');
        
        
        
        
        Route::get('/contrasenia',[UserController::class, 'formularioclave'])
        ->name('contrasenia.cambiar');
        //ruta guardar
        Route::post('/contrasenia',[UserController::class, 'guardarclave'])
        ->name('contrasenia.cambiada');
    
        //rutas usuarios
        Route::get('/usuario',[UserController::class, 'usuario'])
        ->name('usuario.datos');

        Route::get('/usuario/editar',[UserController::class, 'editar'])
        ->name('usuario.editar');
    
        Route::put('/usuario/editar',[UserController::class, 'actualizar'])
        ->name('usuario.actualizar'); 
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

        //ruta  formulario usuarios
        Route::get('/listausuarios',[UserController::class, 'listado'])->middleware('can:index_usuario')
        ->name('usuario.listado');

        Route::get('/registrar',[UserController::class, 'registrar'])->middleware('can:index_usuario')
        ->name('usuario.registrar');

        Route::post('/registrar',[UserController::class, 'guardar'])
        ->name('usuario.guardar');
       
        Route::get('/usuario/desactivar/{id}',[UserController::class, 'desactivar'])
        ->name('user.desactivar');
    
        Route::get('/usuario/activar/{id}',[UserController::class, 'activar'])
        ->name('user.activar');
        
        Route::delete('/usuario/eliminar/{id}',[UserController::class, 'destroy'])
        ->name('user.destroy');

        Route::put('/usuario/{id}/edit',[UserController::class, 'update'])
        ->name('usuario.update');

        Route::get('/usuario/{id}/edit',[UserController::class, 'editaru'])
        ->name('usuario.editaru');

         
              
 
        //ruta EXAMEN CLINICO
        Route::resource('/clinico', 'App\Http\Controllers\ClinicoController');

        Route::put('/clinico/{id}/editar', [ClinicoController::class, 'update'])
        ->name('clinico.update')->where('id','[0-9]+');
    
        
        Route::get('logout2', [LoginController::class, 'logout'])->name('logout2');

        

    });
    
});

Auth::routes(["register" => false]);

