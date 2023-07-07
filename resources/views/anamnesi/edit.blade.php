@extends('layouts.madre')

@section('title', 'Anamnesis')


@section('content')
<form  method="POST" action="{{ route('anamnesi.update',['id'=>$anamnesi->id])}}">
    @method('put')
    @csrf


    <div class="mb-3">
    <label for="" class="form-label">Tiempo_enfermedad</label>
    <input type="text" maxlength="200" 
    title="Ingrese el Tiempo_enfermedad "
    name="tiempo_enfermedad" id="tiempo_enfermedad" class="form-control @error('tiempo_enfermedad') is-invalid @enderror"  placeholder="" 
    value="{{ $anamnesi->tiempo_enfermedad }}"
    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">

    @error('tiempo_enfermedad')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
</div>
     
      <div class="mb-3">
        <label for="" class="form-label">Funcion_organos</label>
        <input type="text" name="funcion_organos"  id="funcion_organos"  class="form-control @error('funcion_organos') is-invalid @enderror"   placeholder="" value="{{ $anamnesi->funcion_organos }}"
        title="Ingrese la funcion_organos">
        @error('funcion_organos')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>

      <div class="mb-3">
        <label for="" class="form-label">Causas_posibles</label>
        <input type="text" name="causas_posibles"  id="causas_posibles"  class="form-control @error('causas_posibles') is-invalid @enderror"   placeholder="" value="{{ $anamnesi->causas_posibles }}"
        title="Ingrese la causas_posibles">
        @error('causas_posibles')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>

      <div class="mb-3">
        <label for="" class="form-label">Enfermo_antes</label>
        <input type="text" name="enfermo_antes"  id="edad_dias"  class="form-control @error('enfermo_antes') is-invalid @enderror"   placeholder="" value="{{ $anamnesi->enfermo_antes }}"
        title="Ingrese la enfermo_antes">
        @error('enfermo_antes')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>


      <div class="mb-3">
        <label for="" class="form-label">Enfermos_multiples</label>
        <input type="text" name="enfermos_multiples"  id="enfermos_multiples"  class="form-control @error('enfermos_multiples') is-invalid @enderror"   placeholder="" value="{{ $anamnesi->enfermos_multiples }}"
        title="Ingrese  enfermos_multiples">
        @error('enfermos_multiples')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>


      <div class="mb-3">
        <label for="" class="form-label">Tratamiento</label>
        <input type="text" name="tratamiento"  id="tratamiento"  class="form-control @error('tratamiento') is-invalid @enderror"   placeholder="" value="{{ $anamnesi->tratamiento }}"
        title="Ingrese el tratamiento">
        @error('tratamiento')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>

      <div class="mb-3">
        <label for="" class="form-label">Vacuna</label>
        <input type="text" name="vacuna"  id="vacuna"  class="form-control @error('vacuna') is-invalid @enderror"   placeholder="" value="{{ $anamnesi->vacuna }}"
        title="Ingrese la vacuna">
        @error('vacuna')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>

<button type="submit" class="btn btn-primary" tabindex="4"><span class="fas fa-user-plus"></span> Guardar cambios</button>     
<a href="/anamnesi





" class="btn btn-danger" tabindex="5"> <i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>

<br>
<br>



</form>




@endsection 