@extends('layouts.madre')

@section('title', 'Editar Registro del Examen Clinico de '.$nombre_mascotas)

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



    <form  method="POST" action="{{ route('clinico.update',['id'=>$clinico->id])}}">
        @method('put')
        @csrf
    

        

        <div class="mb-3"style="display:none !important;">
            <label for="">Nombre de la Mascota</label>
            <select class="form-control" name="num_id">
                <option style="display:none" value="{{$clinico->num_id}}"> {{$clinico->paciente->nombre_mascota}}</option> 
                @foreach ($pacientes as $paciente)
                  <option value="{{$paciente->id}}">{{$paciente->nombre_mascota}}</option>
                @endforeach      
            </select>
        </div>
        <br>

        <div class="mb-3">
        <label for="" class="form-label">Sintomas de la Mascota</label>
        <textarea type="text" name="sintomas"  id="sintomas"  class="form-control @error('sintomas') is-invalid @enderror"   placeholder="Ingrese los sintomas" 
        value="{{ $clinico->sintomas }}"
        title="Ingrese los sintomas">{{ $clinico->sintomas }}</textarea>
        @error('sintomas')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
    
      </div>
      <div class="mb-3">
        <label for="" class="form-label">Enfermedad Diagnosticada</label>
        <textarea type="text" name="enfermedad"  id="enfermedad"  class="form-control @error('enfermedad') is-invalid @enderror"   placeholder="Ingrese la enfermedad diagnosticada" 
        value="{{ $clinico->enfermedad }}"
        title="Ingrese la enfermedad diagnosticada">{{ $clinico->enfermedad }}</textarea>
        @error('enfermedad')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>

      <div class="mb-3">
        <label for="" class="form-label">Tratamiento de la Mascota</label>
        <textarea type="text" name="tratamiento"  id="tratamiento"  class="form-control @error('tratamiento') is-invalid @enderror"   placeholder="Ingrese el tratamiento" 
        value="{{ $clinico->tratamiento }}"
        title="Ingrese el tratamiento">{{ $clinico->tratamiento }}</textarea>
        @error('tratamiento')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>

        <button type="submit" class="btn btn-outline-success" tabindex="4"><span class="fas fa-user-plus"></span> Guardar cambios</button>     
        <a href="{{ route('clinico.index', ['id' => $paciente->id]) }}" class="btn btn-outline-danger" tabindex="5"> <i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>

        <br>
        <br>
    </form>

@endsection 