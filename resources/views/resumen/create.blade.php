@extends('layouts.madre')

@section('title', 'Crear Resumen')


@section('content')
<form action ="../resumen"  method="POST">
    @csrf
           

    <div class="mb-3">
    <label for="" class="form-label">Diagnostico</label>
    <input type="text"  maxlength="5" pattern="" 
    title="Ingrese el diagnostico" value="{{old('diagnostico')}}" 
    name="diagnostico" id="diagnostico" 
    class="form-control @error('diagnostico') is-invalid @enderror" placeholder=""
    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">

    @error('diagnostico')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
  </div>

      <div class="mb-3">
        <label for="" class="form-label">Indicaciones_medicas</label>
        <input type="text"  maxlength="100"   value="{{old('indicaciones_medicas')}}"  name="indicaciones_medicas"  id="indicaciones_medicas"   
        class="form-control @error('indicaciones_medicas') is-invalid @enderror" placeholder="Ingrese la indicaciones_medicas"
        title="Ingrese la indicaciones_medicas">
        @error('indicaciones_medicas')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      
      </div>


<div class="mb-3">
        <label for="" class="form-label">Evolucion_curso</label>
        <input type="text"  maxlength="100"   value="{{old('evolucion_curso')}}"  name="evolucion_curso"  id="evolucion_curso"   
        class="form-control @error('raza') is-invalid @enderror" placeholder="Ingrese la evolucion_curso"
        title="Ingrese la evolucion_curso">
        @error('evolucion_curso')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      
      </div>


      
      
<link rel="stylesheet" type="text/css" href="css/fonts.css" >     
<button type="submit"class="btn btn-primary" tabindex="4"><span class="fas fa-user-plus"></span> Guardar</button> 

<a href="../resumen" class="btn btn-danger" tabindex="5"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
<br>
<br>


</form>


@endsection
