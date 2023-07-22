@extends('layouts.madre')

@section('title', 'Datos del Examen Fisico')


@section('content')



<nav class="main-header navbar
    navbar-expand
    navbar-white navbar-light">

    <a class="nav-link" data-widget="pushmenu" href="#" data-enable-remember="true"style="color: black">
        <i class="fas fa-bars"></i>
        <span class="sr-only">Alternar barra de navegación</span>
    </a>  

  <h3>Datos del Examen Fisico</h3>
  </nav>
<form  method="POST" action="{{ route('examen.update',['id'=>$examen->id])}}">
    @method('put')
    @csrf

    <br>

    <div class="mb-3">
        <label for="" class="form-label">codigo de Examen</label>
        <input type="number" name="cod_examen"  id="cod_examen"  class="form-control @error('cod_examen') is-invalid @enderror"   placeholder="" value="{{ $examen->cod_examen }}"
        title="Ingrese el codigo de examen">
        @error('cod_examen')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>

    <div class="mb-3">
    <label for="" class="form-label">Temperatura</label>
    <input type="text" maxlength="200" 
    title="Ingrese la temperatura"
    name="temperatura" id="temperatura" class="form-control @error('temperatura') is-invalid @enderror"  placeholder="" 
    value="{{ $examen->temperatura }}"
    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">

    @error('temperatura')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
</div>



       <div class="mb-3">
        <label for="" class="form-label">Frecuencia cardíaca</label>
        <input type="text" name="frecuencia_cardiaca"  id="frecuencia_cardiaca"  class="form-control @error('frecuencia_cardiaca') is-invalid @enderror"   placeholder="Ingrese la frecuencia cardíaca" value="{{ $examen->frecuencia_cardiaca }}"
        title="Ingrese la frecuencia cardíaca">
        @error('frecuencia_cardiaca')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>

      <div class="mb-3">
        <label for="" class="form-label">Frecuencia respiratoria</label>
        <input type="text" name="frecuencia_respiratoria"  id="frecuencia_respiratoria"  class="form-control @error('frecuencia_respiratoria') is-invalid @enderror"   placeholder="" value="{{ $examen->frecuencia_respiratoria }}"
        title="Ingrese la frecuencia respiratoria">
        @error('frecuencia_respiratoria')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
</div>

<div class="mb-3">
        <label for="" class="form-label">Peso</label>
        <input type="text" name="peso"  id="peso"  class="form-control @error('peso') is-invalid @enderror"   placeholder="" value="{{ $examen->peso }}"
        title="Ingrese el peso">
        @error('peso')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
</div>

<div class="mb-3">
        <label for="" class="form-label">Pulso</label>
        <input type="text" name="pulso"  id="pulso"  class="form-control @error('pulso') is-invalid @enderror"   placeholder="" value="{{ $examen->pulso }}"
        title="Ingrese el pulso">
        @error('pulso')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
</div>

<div class="mb-3">
        <label for="" class="form-label">Gastrointestal</label>
        <input type="text" name="gastrointestal"  id="gastrointestal"  class="form-control @error('gastrointestal') is-invalid @enderror"   placeholder="" value="{{ $examen->gastrointestal }}"
        title="Ingrese la enfermedad gastrointestal">
        @error('gastrointestal')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
</div>

<div class="mb-3">
        <label for="" class="form-label">Tratamiento</label>
        <input type="text" name="tratamiento"  id="tratamiento"  class="form-control @error('tratamiento') is-invalid @enderror"   placeholder="" value="{{ $examen->tratamiento }}"
        title="Ingrese el tratamiento">
        @error('tratamiento')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
</div>



      
<button type="submit" class="btn btn-outline-success" tabindex="4"><span class="fas fa-user-plus"></span> Guardar cambios</button>     
<a href="/examen" class="btn btn-outline-danger" tabindex="5"> <i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>

<br>
<br>



</form>




@endsection 