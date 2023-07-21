@extends('layouts.madre')

@section('title', 'Paciente')


@section('content')
<form  method="POST" action="{{ route('paciente.update',['id'=>$paciente->id])}}">
    @method('put')
    @csrf


<div class="mb-3">
        <label for="" class="form-label">Nombre de la Mascota</label>
        <input type="text" name="nombre_mascota"  id="nombre_mascota"  class="form-control @error('nombre_mascota') is-invalid @enderror"   placeholder="Nombre Completo de la Mascota" value="{{ $paciente->nombre_mascota }}"
        title="Ingrese el nombre de la mascota">
        @error('nombre_mascota')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>

       <div class="mb-3">
        <label for="" class="form-label">Especie</label>
        <input type="text" name="especie"  id="especie"  class="form-control @error('especie') is-invalid @enderror"   placeholder="Ingrese la especie" value="{{ $paciente->especie }}"
        title="Ingrese la especie">
        @error('especie')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>

      <div class="for-group">
        <label for="">Género</label>
        <select class="form-control" name="gene_id">
        <option style="display:none" value="{{$paciente->gene_id}}"> {{$paciente->genero->name}}</option>    
        @foreach ($generos as $genero)
        <option value="{{$genero->id}}">{{$genero->name}}</option>
        @endforeach      
      </select>
      </div>

      <div class="mb-3">
        <label for="" class="form-label">Raza</label>
        <input type="text" name="raza"  id="raza"  class="form-control @error('raza') is-invalid @enderror"   placeholder="" value="{{ $paciente->raza }}"
        title="Ingrese la raza">
        @error('raza')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>

      <div class="mb-3">
        <label for="" class="form-label">Edad</label>
        <input type="number" name="edad"  id="edad"  class="form-control @error('edad') is-invalid @enderror"   placeholder="" value="{{ $paciente->edad }}"
        title="Ingrese la edad">
        @error('edad')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>


      <div class="mb-3">
      <label for="">Vacunas</label>
      <select class="form-control" name="vacuna_id">
        @foreach ($vacunas as $vacuna)
        <option value="{{$vacuna->id}}">{{$vacuna->nombre_vacuna}}</option>
        @endforeach      
      </select>
      </div> 

      
     
      <div class="mb-3">
        <label for="" class="form-label">Fecha de Nacimiento</label>
        <input type="date" name="fecha_nacimiento"  id="fecha_nacimiento"  class="form-control @error('fecha_nacimiento') is-invalid @enderror" placeholder="0000-00-00" value="{{ $paciente->fecha_nacimiento}}"
        title="Ingrese la fecha de nacimiento ">
        @error('fecha_nacimiento')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>

      <div class="mb-3">
        <label for="" class="form-label">Ultima visita</label>
        <input type="date" name="ultima_visita"  id="ultima_visita"  class="form-control @error('ultima_visita') is-invalid @enderror"   placeholder="" value="{{ $paciente->ultima_visita }}"
        title="Ingrese la última pagina">
        @error('ultima_visita')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>



      
<button type="submit" class="btn btn-outline-success" tabindex="4"><span class="fas fa-user-plus"></span> Guardar cambios</button>     
<a href="/paciente" class="btn btn-outline-danger" tabindex="5"> <i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>

<br>
<br>



</form>




@endsection 