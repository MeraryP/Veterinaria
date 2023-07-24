@extends('layouts.madre')

@section('title', 'Registrar Examen')


@section('content')





  
<form action ="../examen"  method="POST">
    @csrf
           
   <br> 
    
    <div class="mb-3">
        <label for="" class="form-label">Codigo</label>
        <input type="text"  maxlength="100"   value="{{old('codigo_examen')}}"  name="codigo_examen"  id="codigo_examen"   
        class="form-control @error('codigo_examen') is-invalid @enderror" placeholder="0000"
        title="ingrese el codigo">
        @error('codigo_examen')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      
      </div>

    <div class="mb-3">
    <label for="" class="form-label">Temperatura</label>
    <input type="text"  maxlength="200" 
    title="Ingrese la temperatura" value="{{old('temperatura')}}" 
    name="temperatura" id="temperatura" 
    class="form-control @error('temperatura') is-invalid @enderror" placeholder="Ingrese la temperatura"
    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">

    @error('temperatura')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
  </div>

      <div class="mb-3">
        <label for="" class="form-label">Frecuencia cardíaca</label>
        <input type="text"  maxlength="100"   value="{{old('frecuencia_cardiaca')}}"  name="frecuencia_cardiaca"  id="frecuencia_cardiaca"   
        class="form-control @error('frecuencia_cardiaca') is-invalid @enderror" placeholder="Ingrese la frecuencia cardíaca"
        title="Ingrese la frecuencia cardíaca">
        @error('frecuencia_cardiaca')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      
      </div>

      <div class="mb-3">
        <label for="" class="form-label"> Frecuencia respiratoria</label>
        <input type="text"  maxlength="100"   value="{{old('frecuencia_respiratoria')}}"  name="frecuencia_respiratoria"  id="frecuencia_respiratoria"   
        class="form-control @error('frecuencia_respiratoria') is-invalid @enderror" placeholder="Ingrese la frecuencia respiratoria"
        title="Ingrese la  frecuencia respiratoria">
        @error('frecuencia_respiratoria')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      
      </div>


<div class="mb-3">
        <label for="" class="form-label">Peso</label>
        <input type="text"  maxlength="100"   value="{{old('peso')}}"  name="peso"  id="peso"   
        class="form-control @error('peso') is-invalid @enderror" placeholder="Ingrese el peso"
        title="Ingrese el peso">
        @error('peso')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      
      </div>
      
      <div class="mb-3">
        <label for="" class="form-label">Pulso</label>
        <input type="text"  maxlength="100"   value="{{old('pulso')}}"  name="pulso"  id="pulso"   
        class="form-control @error('pulso') is-invalid @enderror" placeholder="Ingrese el pulso"
        title="Ingrese el pulso">
        @error('pulso')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      
      </div>

      </div>
      <div class="mb-3">
        <label for="" class="form-label">Gastrointestal</label>
        <input type="text"  maxlength="100"   value="{{old('gastrointestal')}}"  name="gastrointestal"  id="gastrointestal"   
        class="form-control @error('gastrointestal') is-invalid @enderror" placeholder="Ingrese la enfermedad gastrointestal "
        title="Ingrese la enfermedad gastrointestal">
        @error('gastrointestal')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      
      </div>

     
      <div class="mb-3">
        <label for="" class="form-label">Tratamiento</label>
        <input type="text"  maxlength="100"   value="{{old('tratamiento')}}"  name="tratamiento"  id="tratamiento"   
        class="form-control @error('tratamiento') is-invalid @enderror" placeholder="Ingrese el tratamiento "
        title="Ingrese el tratamiento">
        @error('tratamiento')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      
      </div>




      
      
<link rel="stylesheet" type="text/css" href="css/fonts.css" >     
<button type="submit"class="btn btn-outline-success" tabindex="4"><span class="fas fa-user-plus"></span> Guardar</button> 

<a href="../examen" class="btn btn-outline-danger" tabindex="5"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
<br>
<br>


</form>


@endsection
