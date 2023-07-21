@extends('layouts.madre')

@section('title', 'Vacuna')


@section('content')
<form  method="POST" action="{{ route('vacuna.update',['id'=>$vacuna->id])}}">
    @method('put')
    @csrf


    <div class="mb-3">
    <label for="" class="form-label">Nombre de la vacuna</label>
    <input type="text" maxlength="200" 
    title="Ingrese el nombre de la vacuna"
    name="nombre_vacuna" id="nombre_vacuna" class="form-control @error('nombre_vacuna') is-invalid @enderror"  placeholder="Ingrese el nombre de la vacuna" 
    value="{{ $vacuna->nombre_vacuna }}"
    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">

    @error('nombre_vacuna')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
</div>
     
      <div class="mb-3">
        <label for="" class="form-label">Fecha apliacada</label>
        <input type="date" name="fecha_aplicada"  id="fecha_aplicada"  class="form-control @error('fecha_aplicada') is-invalid @enderror"   placeholder="" value="{{ $vacuna->fecha_aplicada }}"
        title="Ingrese la fecha aplicada">
        @error('fecha_aplicada')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>


      <div class="mb-3">
        <label for="" class="form-label">Nombre de la proxima vacuna</label>
        <input type="text" name="nombre_proximavacuna"  id="nombre_proximavacuna"  class="form-control @error('nombre_proximavacuna') is-invalid @enderror"   placeholder="" value="{{ $vacuna->nombre_proximavacuna }}"
        title="Ingrese el nombre de la proxima vacuna">
        @error('nombre_proximavacuna')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>


      <div class="mb-3">
        <label for="" class="form-label">Fecha de la proxima vacuna</label>
        <input type="date" name="fecha_proximadosis"  id="fecha_proximadosis"  class="form-control @error('fecha_proximadosis') is-invalid @enderror"   placeholder="" value="{{ $vacuna->fecha_proximadosis }}"
        title="Ingrese la fecha de la proxima dosis">
        @error('fecha_proximadosis')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>


      
<button type="submit" class="btn btn-outline-success" tabindex="4"><span class="fas fa-user-plus"></span> Guardar cambios</button>     
<a href="/vacuna" class="btn btn-outline-danger" tabindex="5"> <i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>

<br>
<br>
</form>

@endsection 