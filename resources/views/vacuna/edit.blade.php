@extends('layouts.madre')

@section('title', 'Editar Registro de Vacuna')

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
            <a href="{{ route('vacuna.index', ['id' => $paciente->id]) }}" class="nav-link">
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



    <form  method="POST" action="{{ route('vacuna.update',['id'=>$aplicado->id])}}">
        @method('put')
        @csrf

        <br>
        <div class="mb-3">
            <label for="">Nombre de la Mascota</label>
            <select class="form-control" name="num_id">
                <option style="display:none" value="{{$aplicado->num_id}}"> {{$aplicado->paciente->nombre_mascota}} </option> 
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
            <label for="" class="form-label">Dosis</label>
            <input type="number" minlength="4" name="dosis"  id="dosis" class="form-control @error('dosis') is-invalid @enderror"   
            placeholder="Ingrese la cantidad aplicada de la vacuna" value="{{ $aplicado->dosis}}"
            title="Ingrese la cantidad aplicada de la vacuna ">
            
            @error('dosis')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        <div class="mb-3">
            <label for="unidad">Unidad</label>
            <select name="unidad" id="unidad" class="form-control @error('unidad') is-invalid @enderror">
        <option value="">Seleccione una opción</option>
        <option value="mililitros" {{ old('unidad', $aplicado->unidad) === 'mililitros' ? 'selected' : '' }}>Mililitros</option>
        <option value="miligramos" {{ old('unidad', $aplicado->unidad) === 'miligramos' ? 'selected' : '' }}>Miligramos</option>
    </select>
            @error('unidad')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


            
        <div class="mb-3">
            <label for="" class="form-label">Fecha de Aplicación</label>
            <input type="date" name="fecha_aplicada"  id="fecha_aplicada"  class="form-control @error('fecha_aplicada') is-invalid @enderror"   
            placeholder="" value="{{ $aplicado->fecha_aplicada }}"
            title="Ingrese la fecha aplicada">
            @error('fecha_aplicada')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
        <label for="aplicada">¿Aplicada?</label>
            <input type="checkbox" name="aplicada" id="aplicada" value="1" {{ old('aplicada', $aplicado->aplicada) ? 'checked' : '' }}>
        </div>


        <button type="submit" class="btn btn-outline-success" tabindex="4"><span class="fas fa-user-plus"></span> Guardar cambios</button>     
        <a href="{{ route('vacuna.index', ['id' => $paciente->id]) }}"  class="btn btn-outline-danger" tabindex="5"> <i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>

        <br>
        <br>
    </form>

@endsection 