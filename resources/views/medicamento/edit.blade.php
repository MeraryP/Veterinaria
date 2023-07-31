@extends('layouts.madre')

@section('title', 'Editar Registro del medicamento')


@section('content')


<form  method="POST" action="{{ route('medicamento.update',['id'=>$medicamento->id])}}">
    @method('put')
    @csrf

  <div class="mb-3">
        <label for="" class="form-label">Nombre de la vacuna</label>
        <input type="text" name="nombre_vacuna"  id="nombre_vacuna"  class="form-control @error('nombre_vacuna') is-invalid @enderror"   placeholder="" value="{{ $medicamento->nombre_vacuna }}"
        title="Ingrese el nombre del medicamento">
        @error('nombre_vacuna')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
  </div>

  <div class="mb-3">
        <label for="" class="form-label">Nombre del Desparasitante</label>
        <input type="text" name="nombre_desp"  id="nombre_desp"  class="form-control @error('nombre_desp') is-invalid @enderror"   placeholder="" value="{{ $medicamento->nombre_desp }}"
        title="Ingrese el nombre del medicamento">
        @error('nombre_desp')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
  </div>


 <div class="mb-3">
        <label for="" class="form-label">Dosis del medicamento</label>
        <input type="number" name="dosis"  id="dosis"  class="form-control @error('dosis') is-invalid @enderror"   placeholder="" value="{{ $medicamento->dosis }}"
        title="Ingrese la dosis">
        @error('dosis')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
</div>



      
<button type="submit" class="btn btn-outline-success" tabindex="4" style="margin-left: 300px;margin-right: 60px;"><span class="fas fa-user-plus"></span> Guardar cambios</button>     
<a href="/medicamento" class="btn btn-outline-danger" tabindex="5"> <i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>

<br>
<br>



</form>




@endsection 