<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ResumenSemologico;
use Illuminate\Support\Facades\DB;

class ResumenController extends Controller
{
    public function index(Request $request)
    {
       $resumenes= ResumenSemologico::all();
        return view ('resumen/index',compact('resumenes'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        //$generos = Genero::all();
        return view ('resumen.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
           
            'diagnostico'=>'required|max:300',
            'indicaciones_medicas'=>'required|max:300',
            'evolucion_curso'=>'required|max:300'
  
        
        ]);
     
        $resumenes = new ResumenSemologico();
        $resumenes->diagnostico = $request->get('diagnostico');
        $resumenes->indicaciones_medicas = $request->get('indicaciones_medicas');
        $resumenes->evolucion_curso = $request->get('evolucion_curso');
        $resumenes->save();

        if($resumenes){
            return redirect('/resumen')->with('mensaje', 'El registro fue creado exitosamente.');
        }else{
            //retornar con un mensaje de error.
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $resumen = ResumenSemologico::findOrfail($id);
        return view('resumen.edit')->with('resumen', $resumen);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)

    {
        $this->validate($request,[
           
            'diagnostico'=>'required|max:300',
            'indicaciones_medicas'=>'required|max:300',
            'evolucion_curso'=>'required|max:300'
  
        
        ]);
     
        $resumen = ResumenSemologico::find($id);
        $resumen->diagnostico = $request->get('diagnostico');
        $resumen->indicaciones_medicas = $request->get('indicaciones_medicas');
        $resumen->evolucion_curso = $request->get('evolucion_curso');
        $resumen->save();

        if($resumen){
            return redirect('/resumen')->with('mensaje', 'El registro fue modificado exitosamente.');
        }else{
            //retornar con un mensaje de error.
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resumen = ResumenSemologico::find($id);
        $resumen->delete();
        return redirect('/resumen')->with('mensaje', 'El Registro fue borrado exitosamente');
    }
}
