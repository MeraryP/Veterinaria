@extends('layouts.madre')

@section('title', 'Paciente')


@section('content')
<form  method="POST" action="{{ route('paciente.update',['id'=>$paciente->id])}}">
    @method('put')
    @csrf


    <div class="mb-3">
    <label for="" class="form-label">Identificacion</label>
    <input type="text" maxlength="5" pattern="" 
    title="Ingrese la Identificacion"
    name="identificacion" id="identificacion" class="form-control @error('identificacion') is-invalid @enderror"  placeholder="" 
    value="{{ $paciente->identificacion }}"
    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">

    @error('identificacion')
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
        <label for="" class="form-label">Edad_dias</label>
        <input type="text" name="edad_dias"  id="edad_dias"  class="form-control @error('edad_dias') is-invalid @enderror"   placeholder="" value="{{ $paciente->edad_dias }}"
        title="Ingrese la edad_dias">
        @error('edad_dias')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>


      <div class="mb-3">
        <label for="" class="form-label">Edad_meses</label>
        <input type="text" name="edad_meses"  id="edad_meses"  class="form-control @error('edad_meses') is-invalid @enderror"   placeholder="" value="{{ $paciente->edad_meses }}"
        title="Ingrese la edad_meses">
        @error('edad_meses')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>


      <div class="mb-3">
        <label for="" class="form-label">Edad_anio</label>
        <input type="text" name="edad_anio"  id="edad_anio"  class="form-control @error('edad_anio') is-invalid @enderror"   placeholder="" value="{{ $paciente->edad_anio }}"
        title="Ingrese la edad_anio">
        @error('edad_anio')
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


      <div class="mb-3">
        <label for="" class="form-label">Talla</label>
        <input type="text" name="talla"  id="talla"  class="form-control @error('talla') is-invalid @enderror"   placeholder="" value="{{ $paciente->talla }}"
        title="Ingrese la talla">
        @error('talla')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>

      <div class="mb-3">
        <label for="" class="form-label">Aptitud</label>
        <input type="text" name="aptitud"  id="aptitud"  class="form-control @error('aptitud') is-invalid @enderror"   placeholder="" value="{{ $paciente->aptitud }}"
        title="Ingrese la aptitud">
        @error('aptitud')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>



      
<button type="submit" class="btn btn-primary" tabindex="4"><span class="fas fa-user-plus"></span> Guardar cambios</button>     
<a href="/paciente" class="btn btn-danger" tabindex="5"> <i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>

<br>
<br>



</form>




@endsection 