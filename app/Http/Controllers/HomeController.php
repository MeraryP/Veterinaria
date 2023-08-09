<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\PropietarioController;
use App\Http\Controllers\MedicamentoController;
use App\Models\Paciente;
use App\Models\Propietario;
use App\Models\Medicamento;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //$graficos = Egresado::select('año_egresado', DB::raw('count(*)as cantidad'))->groupby ('año_egresado')->orderby('año_egresado')->get();
       // $graficagrupo = Medicamento::select('medicamento', DB::raw('count(*)as cantidad'))->groupby ('nombre_mascota')->get();
  
       // $totalmedicamento= Medicamento::all()->count();

        $graficagrupo = Paciente::select('id', DB::raw('count(*)as cantidad'))->groupby ('id')->get();
        //$graficagrupo = Propietario::select('id', DB::raw('count(*)as cantidad'))->groupby ('id')->get();
        $totalpaciente = Paciente::all()->count();
        $totalpropietario= Propietario::all()->count();
        $totalmedicamento= Medicamento::all()->count();
       
       return view('welcome')->with('graficagrupo', $graficagrupo)->with('totalpaciente', $totalpaciente)->with('totalpropietario', $totalpropietario)->with('totalmedicamento', $totalmedicamento);
        

    }
}
