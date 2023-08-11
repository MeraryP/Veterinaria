@extends('layouts.madre')

@section('title', 'Registrar Examen Fisico de '.$nombre_mascotas)


@section('content')

<!-- <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
<a href="{{ URL::previous() }}" class="nav-link">
     <div> 
       <p style="text-align: center; margin-bottom: 0px; color:black;"><i class="nav-icon fas fa-file-alt" style="margin-right: 5px;"></i>Datos generales</p>
       </div>
     </a>
  </li>

  <li class="nav-item" role="presentation">
  <a href=""class="nav-link">
     <div> 
       <p style="text-align: center; margin-bottom: 0px; color:black;"><i class="fas fa-file-signature" style="margin-right: 5px;"></i>Examen Fisico</p>
       </div>
     </a>
      </li>
  <li class="nav-item" role="presentation">
   <a href="" class="nav-link">
     <div> 
       <p style="text-align: center; margin-bottom: 0px; color:black;"><i class="nav-icon fas fa-syringe" style="margin-right: 5px;"></i>Vacuna</p>
       </div>
     </a>
  </li>
  <li class="nav-item" role="presentation">
  <a href=""class="nav-link">
     <div> 
       <p style="text-align: center; margin-bottom: 0px; color:black;"><i class="nav-icon fa fa-capsules" style="margin-right: 5px;"></i>Desparacitación</p>
       </div>
     </a>
      </li>

      <li class="nav-item" role="presentation">
            <a href=""class="nav-link">
                <div> 
                    <p style="text-align: center; margin-bottom: 0px; color:black;"><i class="fa fa-stethoscope" style="margin-right: 5px;"></i>Examen Clínico</p>
                </div>
            </a>
        </li>
      
  
</ul> -->



  
<form action ="../examen"  method="POST">
    @csrf
           
   <br> 
   
   
      <div class="mb-3" style="display:none !important;" >
      <label for="">Nombre de la Mascota</label>
      <select class="form-control" name="num_id"> 
       @foreach ($pacientes as  $paciente)
        <option value="{{$paciente->id}}">{{$paciente->nombre_mascota}}</option>
        @endforeach   
      </select>
      </div>

    <div class="mb-3">
    <label for="" class="form-label">Temperatura °C</label>
    <input type="number"  maxlength="3" 
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
        <label for="" class="form-label">Frecuencia cardíaca /minuto</label>
        <input type="number"  maxlength="3"   value="{{old('frecuencia_cardiaca')}}"  name="frecuencia_cardiaca"  id="frecuencia_cardiaca"   
        class="form-control @error('frecuencia_cardiaca') is-invalid @enderror" placeholder="Ingrese la frecuencia cardíaca"
        title="Ingrese la frecuencia cardíaca">
        @error('frecuencia_cardiaca')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      
      </div>

      <div class="mb-3">
        <label for="" class="form-label"> Frecuencia respiratoria /minuto</label>
        <input type="number"  maxlength="3"   value="{{old('frecuencia_respiratoria')}}"  name="frecuencia_respiratoria"  id="frecuencia_respiratoria"   
        class="form-control @error('frecuencia_respiratoria') is-invalid @enderror" placeholder="Ingrese la frecuencia respiratoria"
        title="Ingrese la  frecuencia respiratoria">
        @error('frecuencia_respiratoria')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      
      </div>


<div class="mb-3">
        <label for="" class="form-label">Peso Kg</label>
        <input type="number"  maxlength="3"   value="{{old('peso')}}"  name="peso"  id="peso"   
        class="form-control @error('peso') is-invalid @enderror" placeholder="Ingrese el peso"
        title="Ingrese el peso">
        @error('peso')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      
      </div>
      
      <div class="mb-3">
        <label for="" class="form-label">Pulso /minuto</label>
        <input type="number"  maxlength="3"   value="{{old('pulso')}}"  name="pulso"  id="pulso"   
        class="form-control @error('pulso') is-invalid @enderror" placeholder="Ingrese el pulso"
        title="Ingrese el pulso">
        @error('pulso')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      
      </div>

      </div>
      
 
      
<link rel="stylesheet" type="text/css" href="css/fonts.css" >     
<button type="submit"class="btn btn-outline-success" tabindex="4"><span class="fas fa-user-plus"></span> Guardar</button> 

<a href="{{ route('examen.index', ['id' => $paciente->id]) }}" class="btn btn-outline-danger" tabindex="5"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
<br>
<br>


</form>


@endsection
