<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropietarioController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\AnamnesisController;
use App\Http\Controllers\ResumenController;
use App\Http\Controllers\TriadaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;

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
       
        //ruta anamnesis
        Route::resource('/anamnesi', 'App\Http\Controllers\AnamnesisController');

        Route::put('/anamnesi/{id}/editar', [AnamnesisController::class, 'update'])
        ->name('anamnesi.update')->where('id','[0-9]+');

        //ruta resumen
        Route::resource('/resumen', 'App\Http\Controllers\ResumenController');

        Route::put('/resumen/{id}/editar', [ResumenController::class, 'update'])
        ->name('resumen.update')->where('id','[0-9]+');

        //ruta triadas
        Route::resource('triadas', 'App\Http\Controllers\TriadaController');

        Route::put('/triadas/{id}/editar', [TriadaController::class, 'update'])
        ->name('triada.update')->where('id','[0-9]+');
        
        
        
        
        Route::get('/contrasenia',[UserController::class, 'formularioclave'])
        ->name('contrasenia.cambiar');
        //ruta guardar
        Route::post('/contrasenia',[UserController::class, 'guardarclave'])
            ->name('contrasenia.cambiada');
    
        Route::get('/usuario',[UserController::class, 'usuario'])
        ->name('usuario.datos');
    
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
              
 
    
       


    });
    
});

Auth::routes(["register" => false]);
