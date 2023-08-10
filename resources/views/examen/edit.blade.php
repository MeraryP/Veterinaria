@extends('layouts.madre')

@section('title', 'Editar Examen Fisico')


@section('content')
<ul class="nav nav-tabs" id="myTab" role="tablist">
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
            <a href="{{ route('clinico.index') }}"class="nav-link">
                <div> 
                    <p style="text-align: center; margin-bottom: 0px; color:black;"><i class="fa fa-stethoscope" style="margin-right: 5px;"></i>Examen Clínico</p>
                </div>
            </a>
        </li>
</ul>


<form  method="POST" action="{{ route('examen.update',['id'=>$examen->id])}}">
    @method('put')
    @csrf

    <br>

   
   

      <div class="mb-3">
      <label for="">Nombre de la Mascota</label>
      <select class="form-control" name="num_id">
      <option style="display:none" value="{{$examen->num_id}}"> {{$examen->paciente->nombre_mascota}}</option> 
        @foreach ($pacientes as $paciente)
        <option value="{{$paciente->id}}">{{$paciente->nombre_mascota}}</option>
        @endforeach      
      </select>
      </div>

    <div class="mb-3">
    <label for="" class="form-label">Temperatura °C</label>
    <input type="number" maxlength="3" 
    title="Ingrese la temperatura"
    name="temperatura" id="temperatura" class="form-control @error('temperatura') is-invalid @enderror" 
    value="{{ $examen->temperatura }}"
    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">

    @error('temperatura')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
</div>



       <div class="mb-3">
        <label for="" class="form-label">Frecuencia cardíaca /minuto</label>
        <input type="number" maxlength="3" 
        name="frecuencia_cardiaca"  id="frecuencia_cardiaca"  class="form-control @error('frecuencia_cardiaca') is-invalid @enderror" value="{{ $examen->frecuencia_cardiaca }}"
        title="Ingrese la frecuencia cardíaca"
        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
       
       @error('frecuencia_cardiaca')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>

      <div class="mb-3">
        <label for="" class="form-label">Frecuencia respiratoria /minuto</label>
        <input type="number" maxlength="3" name="frecuencia_respiratoria"  id="frecuencia_respiratoria"  class="form-control @error('frecuencia_respiratoria') is-invalid @enderror"   placeholder="" value="{{ $examen->frecuencia_respiratoria }}"
        title="Ingrese la frecuencia respiratoria"
        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
        @error('frecuencia_respiratoria')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
</div>

<div class="mb-3">
        <label for="" class="form-label">Peso Kg</label>
        <input type="number" maxlength="3" name="peso"  id="peso"  class="form-control @error('peso') is-invalid @enderror"   placeholder="" value="{{ $examen->peso }}"
        title="Ingrese el peso"
        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
        @error('peso')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
</div>

<div class="mb-3">
        <label for="" class="form-label">Pulso /minuto</label>
        <input type="number" maxlength="3" name="pulso"  id="pulso"  class="form-control @error('pulso') is-invalid @enderror"   placeholder="" value="{{ $examen->pulso }}"
        title="Ingrese el pulso"
        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
        @error('pulso')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
</div>



      
<button type="submit" class="btn btn-outline-success" tabindex="4"><span class="fas fa-user-plus"></span> Guardar cambios</button>     
<a href="{{ route('examen.index', ['id' => $paciente->id]) }}" class="btn btn-outline-danger" tabindex="5"> <i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>

<br>
<br>



</form>




@endsection 