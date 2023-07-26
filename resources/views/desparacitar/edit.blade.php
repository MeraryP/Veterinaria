@extends('layouts.madre')

@section('title', 'Editar Registro')

@section('content')
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
<a href="../paciente.edit" class="nav-link">
     <div> 
       <p style="text-align: center; margin-bottom: 0px;"><i class="nav-icon fas fa-file-alt" style="margin-right: 5px;"></i>Datos generales</p>
       </div>
     </a>
  </li>
  <li class="nav-item" role="presentation">
   <a href="{{ route('vacuna.index') }}" class="nav-link">
     <div> 
       <p style="text-align: center; margin-bottom: 0px;"><i class="nav-icon fas fa-syringe" style="margin-right: 5px;"></i>Vacuna</p>
       </div>
     </a>
  </li>
  <li class="nav-item" role="presentation">
  <a href="{{ route('desparacitar.index') }}"class="nav-link">
     <div> 
       <p style="text-align: center; margin-bottom: 0px;"><i class="nav-icon fa fa-capsules" style="margin-right: 5px;"></i>Desparacitación</p>
       </div>
     </a>
      </li>

      <li class="nav-item" role="presentation">
  <a href="{{ route('examen.index') }}"class="nav-link">
     <div> 
       <p style="text-align: center; margin-bottom: 0px;"><i class="fas fa-file-signature" style="margin-right: 5px;"></i>Examen Fisico</p>
       </div>
     </a>
      </li>
  
</ul>
    <form method="POST" action ="{{ route('desparacitar.update',['id'=>$desparacitar->id])}}">
        @method('put')
        @csrf
        <br>

        <div class="mb-3">
            <label for="" class="form-label">codigo Desparasitar</label>
            <input type="text" class="form-control @error('cod_desparasitar') is-invalid @enderror" name="codigo_desparasitar" id="codigo_desparasitar" 
            value="{{ $desparacitar->codigo_desparasitar }}" title="Ingrese el codigo">
            @error('codigo_desparasitar')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Desparasitante</label>
            <input type="text" class="form-control @error('antiparacitario') is-invalid @enderror" name="antiparacitario" id="antiparacitario" 
            value="{{ $desparacitar->antiparacitario }}" title="Ingrese el nombre del Antiparacitario">
            @error('antiparacitario')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        <div class="mb-3">
      <label for="">Numero de expediente</label>
      <select class="form-control" name="num_id">
      <option style="display:none" value="{{$desparacitar->num_id}}"> {{$desparacitar->paciente->numero_expediente}}</option> 
        @foreach ($pacientes as $paciente)
        <option value="{{$paciente->id}}">{{$paciente->numero_expediente}}</option>
        @endforeach      
      </select>
      </div>

        <div class="mb-3">
            <label for="" class="form-label">Fecha de desparasitacion</label>
            <input type="date" class="form-control @error('fecha_desparacitacion') is-invalid @enderror" name="fecha_desparacitacion" id="fecha_desparacitacion" 
            value="{{ $desparacitar->fecha_desparacitacion }}" title="Ingrese Fecha de desparacitacion">
            @error('fecha_desparacitacion')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Fecha de volver Desparasitar</label>
            <input type="date" class="form-control @error('fecha_volverDesparacitar') is-invalid @enderror" name="fecha_volverDesparacitar" id="fecha_volverDesparacitar" 
            value="{{ $desparacitar->fecha_volverDesparacitar }}" title="Ingrese Fecha de volver Desparacitar">
            @error('fecha_volverDesparacitar')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-outline-success" tabindex="4"><span class="fas fa-user-plus"></span>Guardar</button>
        <a href="/desparacitar" class="btn btn-outline-danger" tabindex="5"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
            
@endsection