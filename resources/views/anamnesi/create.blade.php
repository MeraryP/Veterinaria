@extends('layouts.madre')

@section('title', 'Crear paciente')


@section('content')
<form action ="../anamnesi"  method="POST">
    @csrf
   

    <div class="mb-3">
    <label for="" class="form-label">Tiempo_enfermedad</label>
    <input type="text"  maxlength="5" pattern="" 
    title="Ingrese la Identificacion" value="{{old('tiempo_enfermedad')}}" 
    name="tiempo_enfermedad" id="tiempo_enfermedad" 
    class="form-control @error('tiempo_enfermedad') is-invalid @enderror" placeholder=""
    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">

    @error('tiempo_enfermedad')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
  </div>

      <div class="mb-3">
        <label for="" class="form-label">Manifestaciones</label>
        <input type="text"  maxlength="100"   value="{{old('especie')}}"  name="manifestaciones"  id="manifestaciones"   
        class="form-control @error('manifestaciones') is-invalid @enderror" placeholder="Ingrese la manifestacion"
        title="Ingrese la manifestacion">
        @error('manifestaciones')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      
      </div>


<div class="mb-3">
        <label for="" class="form-label">Funcion_organos</label>
        <input type="text"  maxlength="100"   value="{{old('raza')}}"  name="funcion_organos"  id="funcion_organos"   
        class="form-control @error('funcion_organos') is-invalid @enderror" placeholder="Ingrese la funcion_organos"
        title="Ingrese la funcion_organos">
        @error('funcion_organos')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      
      </div>


      <div class="mb-3">
        <label for="" class="form-label">Causas_posibles</label>
        <input type="text" value="{{old('causas_posibles')}}" name="causas_posibles"  id="causas_posibles"  
        class="form-control @error('causas_posibles') is-invalid @enderror" placeholder="Ingrese la causas_posibles" 
        title="Ingrese la causas_posibles" >

      
        @error('causas_posibles')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>

   

    

      <div class="mb-3">
        <label for="">Enfermo_antes</label>
        <input type="text"value="{{old('enfermo_antes')}}"  name="enfermo_antes"  id="enfermo_antes" 
        class="form-control @error('enfermo_antes') is-invalid @enderror"   placeholder="Ingrese enfermo_antes"
        title="Ingrese enfermo_antes ">
      
        @error('enfermo_antes')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>
      <div class="mb-3">
        <label for="">Enfermos_multiples</label>
        <input type="text"value="{{old('enfermos_multiples')}}"  name="enfermos_multiples"  id="enfermos_multiples" 
        class="form-control @error('enfermos_multiples') is-invalid @enderror"   placeholder="Ingrese enfermos_multiples"
        title="Ingrese enfermos_multiples">
      
        @error('enfermos_multiples')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>
      <div class="mb-3">
        <label for="">Tratamiento</label>
        <input type="text"value="{{old('tratamiento')}}"  name="tratamiento"  id="tratamiento" 
        class="form-control @error('tratamiento') is-invalid @enderror"   placeholder="Ingrese el tratamiento"
        title="Ingrese el tratamiento ">
      
        @error('tratamiento')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>

      <div class="mb-3">
        <label for="">Vacuna</label>
        <input type="text"value="{{old('vacuna')}}"  name="vacuna"  id="vacuna" 
        class="form-control @error('vacuna') is-invalid @enderror"   placeholder="Ingrese la vacuna"
        title="Ingrese la vacuna ">
      
        @error('vacuna')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>

      
    

      
<link rel="stylesheet" type="text/css" href="css/fonts.css" >     
<button type="submit"class="btn btn-primary" tabindex="4"><span class="fas fa-user-plus"></span> Guardar</button> 

<a href="../anamnesi" class="btn btn-danger" tabindex="5"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
<br>
<br>


</form>


@endsection
