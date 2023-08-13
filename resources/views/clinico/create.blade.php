@extends('layouts.madre')

@section('title', 'Registrar Examen Clinico de '.App\Models\Paciente::find($paciente)->nombre_mascota)

@section('content')



    <form action ="{{route('clinico.store')}}"  method="POST">
        @csrf
     

        <div class="mb-3"style="display:none !important;">
            <label for="">Nombre de la Mascota</label>
            <input class="form-control" name="num_id" value="{{$paciente}}"> 
              
        </div>
        <br>

        <div class="mb-3">
        <label for="" class="form-label">Sintomas de la Mascota</label>
        <textarea type="text" maxlength="1000" value="{{old('sintomas')}}"  name="sintomas"  id="sintomas"   
        class="form-control @error('sintomas') is-invalid @enderror" placeholder="Ingrese los sintomas"
        title="Ingrese los sintomas"></textarea>
        @error('sintomas')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      
      </div>

      <div class="mb-3">
        <label for="" class="form-label">Enfermedad Diagnosticada</label>
        <textarea type="text" maxlength="1000" value="{{old('enfermedad')}}"  name="enfermedad"  id="enfermedad"   
        class="form-control @error('enfermedad') is-invalid @enderror" placeholder="Ingrese la enfermedad diagnosticada"
        title="Ingrese la enfermedad diagnosticada"></textarea>
        @error('enfermedad')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      
      </div>

      <div class="mb-3">
        <label for="" class="form-label">Tratamiento de la Mascota</label>
        <textarea type="text" maxlength="1000" value="{{old('tratamiento')}}"  name="tratamiento"  id="tratamiento"   
        class="form-control @error('enfermedad') is-invalid @enderror" placeholder="Ingrese el tratamiento"
        title="Ingrese el tratamiento"></textarea>
        @error('tratamiento')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      
      </div>
    
       
 
        <link rel="stylesheet" type="text/css" href="css/fonts.css" >      
        <button type="submit"class="btn btn-outline-success" tabindex="4"style="margin-left: 350px;margin-right: 60px;"><span class="fas fa-user-plus"></span> Guardar</button> 

        <a href="{{route('clinicoMascota', ['id'=>$paciente])}}"  class="btn btn-outline-danger" tabindex="5"style="margin-rigth: 100px;"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
        <br>
        <br>

    </form>

@endsection
