@extends('layouts.madre')

@section('title', 'Editar Registro')

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
            <a href="{{ route('examen.index') }}"class="nav-link">
                  <div> 
                      <p style="text-align: center; margin-bottom: 0px; color:black;"><i class="fas fa-file-signature" style="margin-right: 5px;"></i>Examen Fisico</p>
                  </div>
            </a>
        </li>

        <li class="nav-item" role="presentation">
            <a href="{{ route('vacuna.index') }}" class="nav-link">
                <div> 
                    <p style="text-align: center; margin-bottom: 0px; color:black;"><i class="nav-icon fas fa-syringe" style="margin-right: 5px;"></i>Vacuna</p>
                </div>
            </a>
        </li>

        <li class="nav-item" role="presentation">
            <a href="{{ route('desparacitar.index') }}"class="nav-link">
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
    </ul> -->


    <form method="POST" action ="{{ route('desparacitar.update',['id'=>$aplicado->id])}}">
        @method('put')
        @csrf
        <br>


        <div class="mb-3">
            <label for="">Nombre de la Mascota</label>
            <select class="form-control" name="num_id">
                <option style="display:none" value="{{$aplicado->num_id}}"> {{$aplicado->paciente->nombre_mascota}}</option> 
                @foreach ($pacientes as $paciente)
                  <option value="{{$paciente->id}}">{{$paciente->nombre_mascota}}</option>
                @endforeach      
            </select>
        </div>

        <div class="mb-3">
            <label for="">Nombre del Desparasitante</label>
            <select class="form-control" name="medi_id">
                @foreach ($medicamentos as $medicamento)
                <option value="{{ $medicamento->id }}" @if($medicamento->id == $aplicado->medi_id) selected @endif>{{ $medicamento->nombre_medicamento }}</option> 
                @endforeach      
            </select>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Dosis de Desparasitante</label>
            <input type="number" value="{{ $aplicado->dosis }}"  name="dosis" id="dosis"  class="form-control @error('dosis') is-invalid @enderror"  
            tabindex="1" title="dosis">

            @error('dosis')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>



        <div class="mb-3">
            <label for="unidad_desparasitante">Unidad Desparasitante</label>
            <select name="unidad_desparasitante" id="unidad_desparasitante" class="form-control @error('unidad_desparasitante') is-invalid @enderror">
            <option value="ml" {{ old('unidad_desparasitante', $aplicado->unidad_desparasitante) === 'ml' ? 'selected' : '' }}>Mililitros</option>
            <option value="mg" {{ old('unidad_desparasitante', $aplicado->unidad_desparasitante) === 'mg' ? 'selected' : '' }}>Miligramos</option>
            <option value="tabletas" {{ old('unidad_desparasitante', $aplicado->unidad_desparasitante) === 'tabletas' ? 'selected' : '' }}>Tabletas</option>
            <option value="cucharaditas" {{ old('unidad_desparasitante', $aplicado->unidad_desparasitante) === 'cucharaditas' ? 'selected' : '' }}>Cucharaditas</option>
    </select>
            @error('unidad_desparasitante')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>



        
        <div class="mb-3">
            <label for="" class="form-label">Fecha de desparasitar</label>
            <input type="date" class="form-control @error('fecha_aplicada') is-invalid @enderror" name="fecha_aplicada" id="fecha_aplicada" 
            value="{{ $aplicado->fecha_aplicada }}" title="Ingrese Fecha de desparacitacion">
            @error('fecha_aplicacion')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        

        <div class="mb-3">
        <label for="aplicada">¿Aplicado?</label>
            <input type="checkbox" name="aplicada" id="aplicada" value="1" {{ old('aplicada', $aplicado->aplicada) ? 'checked' : '' }}>
        </div>


        <button type="submit"class="btn btn-outline-success" tabindex="4"style="margin-left: 350px;margin-right: 60px;"><span class="fas fa-user-plus"></span> Guardar</button> 
        <a href="/desparacitar" class="btn btn-outline-danger" tabindex="5"style="margin-rigth: 100px;"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
           
@endsection