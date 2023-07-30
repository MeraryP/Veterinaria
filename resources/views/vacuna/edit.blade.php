@extends('layouts.madre')

@section('title', 'Editar Registro de Vacuna')

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



    <form  method="POST" action="{{ route('vacuna.update',['id'=>$vacuna->id])}}">
        @method('put')
        @csrf

        <br>
        <div class="mb-3">
            <label for="">Nombre de la Maskota</label>
            <select class="form-control" name="num_id">
                <option style="display:none" value="{{$vacuna->num_id}}"> {{$vacuna->paciente->nombre_mascota}} </option> 
                  @foreach ($pacientes as $paciente)
                <option value="{{$paciente->id}}">{{$paciente->nombre_mascota}}</option>
                  @endforeach      
            </select>
        </div>        

        <div class="mb-3">
            <label for="" class="form-label">Vacuna</label>
            <select onfocus="this.blur();"  title="Ingrese el nombre de la vacuna" name="nombre_vacuna" id="nombre_vacuna" 
            class="form-control @error('nombre_vacuna') is-invalid @enderror"  placeholder="Ingrese el nombre de la vacuna" 
            value="{{ $vacuna->nombre_vacuna }}"
            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
            >
                <option>Rabia</option> 
                <option>Tos MSD</option> 
                <option>Quintuple</option>  
                <option>Helmican Suspension</option> 
                <option>Cuadruple</option>   
            </select>

            @error('nombre_vacuna')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Cantidad aplicada</label>
            <input type="number" minlength="4" name="cantidad"  id="cantidad" class="form-control @error('cantidad') is-invalid @enderror"   
            placeholder="Ingrese la cantidad aplicada de la vacuna" value="{{ $vacuna->cantidad}}"
            title="Ingrese la cantidad aplicada de la vacuna ">
            
            @error('cantidad')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
            
        <div class="mb-3">
            <label for="" class="form-label">Fecha de Aplicación</label>
            <input type="date" name="fecha_aplicada"  id="fecha_aplicada"  class="form-control @error('fecha_aplicada') is-invalid @enderror"   
            placeholder="" value="{{ $vacuna->fecha_aplicada }}"
            title="Ingrese la fecha aplicada">
            @error('fecha_aplicada')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-outline-success" tabindex="4"><span class="fas fa-user-plus"></span> Guardar cambios</button>     
        <a href="/vacuna" class="btn btn-outline-danger" tabindex="5"> <i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>

        <br>
        <br>
    </form>

@endsection 