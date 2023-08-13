@extends('layouts.madre')

@section('title', 'Editar Registro del Examen Clinico de '.App\Models\Paciente::find($clinico->num_id)->nombre_mascota)

@section('content')





    <form  method="POST" action="{{ route('clinico.update',['id'=>$clinico->id])}}">
        @method('put')
        @csrf
    

        

        <div class="mb-3"style="display:none !important;">
            <label for="">Nombre de la Mascota</label>
            <input class="form-control" name="num_id" value="{{$clinico->num_id}}">
               
        </div>
        <br>

        <div class="mb-3">
        <label for="" class="form-label">Sintomas de la Mascota</label>
        <textarea type="text" name="sintomas"  id="sintomas"  class="form-control @error('sintomas') is-invalid @enderror"   placeholder="Ingrese los sintomas" 
        value="{{ $clinico->sintomas }}"
        title="Ingrese los sintomas">{{ $clinico->sintomas }}</textarea>
        @error('sintomas')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
    
      </div>
      <div class="mb-3">
        <label for="" class="form-label">Enfermedad Diagnosticada</label>
        <textarea type="text" name="enfermedad"  id="enfermedad"  class="form-control @error('enfermedad') is-invalid @enderror"   placeholder="Ingrese la enfermedad diagnosticada" 
        value="{{ $clinico->enfermedad }}"
        title="Ingrese la enfermedad diagnosticada">{{ $clinico->enfermedad }}</textarea>
        @error('enfermedad')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>

      <div class="mb-3">
        <label for="" class="form-label">Tratamiento de la Mascota</label>
        <textarea type="text" name="tratamiento"  id="tratamiento"  class="form-control @error('tratamiento') is-invalid @enderror"   placeholder="Ingrese el tratamiento" 
        value="{{ $clinico->tratamiento }}"
        title="Ingrese el tratamiento">{{ $clinico->tratamiento }}</textarea>
        @error('tratamiento')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>

        <button type="submit" class="btn btn-outline-success" tabindex="4"><span class="fas fa-user-plus"></span> Guardar cambios</button>     
        <a href="{{ route('clinicoMascota',['id'=>$clinico->num_id])}}"  class="btn btn-outline-danger" tabindex="5"> <i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>

        <br>
        <br>
    </form>

@endsection