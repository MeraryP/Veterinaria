@extends('layouts.madre')

@section('title', 'Paciente')


@section('content')
<form  method="POST" action="{{ route('paciente.update',['id'=>$paciente->id])}}">
    @method('put')
    @csrf


    <div class="mb-3">
    <label for="" class="form-label">Identificación</label>
    <input type="text" maxlength="4"
    title="Ingrese la Identificacion"
    name="identificacion" id="identificacion" class="form-control @error('identificacion') is-invalid @enderror"  placeholder="0000" 
    value="{{ $paciente->identificacion }}">
   
    @error('identificacion')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
</div>

<div class="mb-3">
        <label for="" class="form-label">Nombre de la Mascota</label>
        <input type="text" name="nombre"  id="nombre"  class="form-control @error('nombre') is-invalid @enderror"   placeholder="Nombre Completo de la Mascota" value="{{ $paciente->nombre }}"
        title="Ingrese el nombre de la mascota">
        @error('nombre')
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
        <label for="" class="form-label">Color</label>
        <input type="text" name="color"  id="color"  class="form-control @error('color') is-invalid @enderror"   placeholder="" value="{{ $paciente->color }}"
        title="Ingrese el color">
        @error('color')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>

     
      <div class="mb-3">
        <label for="" class="form-label">Fecha de Nacimiento</label>
        <input type="" name="fecha"  id="fecha"  class="form-control @error('fecha') is-invalid @enderror" placeholder="0000-00-00" value="{{ $paciente->fecha}}"
        title="Ingrese la fecha de nacimiento ">
        @error('fecha')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>

      <div class="mb-3">
        <label for="" class="form-label">Peso</label>
        <input type="text" name="peso"  id="peso"  class="form-control @error('peso') is-invalid @enderror"   placeholder="" value="{{ $paciente->peso }}"
        title="Ingrese el peso">
        @error('peso')
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