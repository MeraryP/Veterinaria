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

        //ruta propietario
        Route::resource('/propietario', 'App\Http\Controllers\PropietarioController');

        Route::put('/propietario/{id}/editar', [PropietarioController::class, 'update'])
        ->name('propietario.update')->where('id','[0-9]+');
        //ruta paciente
        Route::resource('/paciente', 'App\Http\Controllers\PacienteController');

        Route::put('/paciente/{id}/editar', [PacienteController::class, 'update'])
        ->name('paciente.update')->where('id','[0-9]+');
       

        //ruta Medicamentos
        Route::resource('/medicamento', 'App\Http\Controllers\MedicamentoController');

        Route::put('/medicamento/{id}/editar', [MedicamentoController::class, 'update'])
        ->name('medicamento.update')->where('id','[0-9]+');

        //ruta vacuna
        Route::resource('/paciente/{id}/vacuna', 'App\Http\Controllers\VacunaController');

        Route::put('/vacuna/{id}/editar', [VacunaController::class, 'update'])
        ->name('vacuna.update')->where('id','[0-9]+');
       




        //ruta resumen
        Route::resource('/paciente/{id}/examen', 'App\Http\Controllers\ExamenController');

        Route::put('/examen/{id}/editar', [ExamenController::class, 'update'])
        ->name('examen.update')->where('id','[0-9]+');


        //ruta triadas
        Route::resource('/paciente/{id}/desparacitar', 'App\Http\Controllers\DesparacitarController');

        Route::put('/desparacitar/{id}/editar', [DesparacitarController::class, 'update'])
        ->name('desparacitar.update')->where('id','[0-9]+');
        
        
        
        
        Route::get('/contrasenia',[UserController::class, 'formularioclave'])
        ->name('contrasenia.cambiar');
        //ruta guardar
        Route::post('/contrasenia',[UserController::class, 'guardarclave'])
            ->name('contrasenia.cambiada');
    
        Route::get('/usuario',[UserController::class, 'usuario'])
        ->name('usuario.datos');

        Route::get('/usuario/editar',[UserController::class, 'editar'])
        ->name('usuario.editar');
    
        Route::put('/usuario/editar',[UserController::class, 'actualizar'])
        ->name('usuario.actualizar'); 
        
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
      
              
 
        //ruta EXAMEN CLINICO
        Route::resource('/paciente/{id}/clinico', 'App\Http\Controllers\ClinicoController');

        Route::put('/clinico/{id}/editar', [ClinicoController::class, 'update'])
        ->name('clinico.update')->where('id','[0-9]+');
    
       
        //Route::resource('/clinico', 'App\Http\Controllers\ClinicoController');

    });
    
});

Auth::routes(["register" => false]);
