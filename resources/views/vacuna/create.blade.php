@extends('layouts.madre')

@section('title', 'Registrar vacuna de '.$nombre_mascotas)

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
            <a href=""class="nav-link">
                <div> 
                    <p style="text-align: center; margin-bottom: 0px; color:black;"><i class="fa fa-stethoscope" style="margin-right: 5px;"></i>Examen Clínico</p>
                </div>
            </a>
        </li>
    </ul>


    <form action ="../vacuna"  method="POST">
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
            <label for="">Nombre de la Vacuna</label>
            <select class="form-control" name="medi_id"> 
                @foreach ($medicamentos as  $medicamento)
                    <option value="{{$medicamento->id}}">{{$medicamento->nombre_medicamento}}</option>
                @endforeach   
            </select>   
        </div>

        <div class="mb-3">
            <label for="">Dosis</label>
            <input type="number" maxlength="4" pattern="[0-9]{4}" value="{{old('dosis')}}"  name="dosis"  id="dosis" 
            class="form-control @error('dosis') is-invalid @enderror"   placeholder="Ingrese la cantidad aplicada de la vacuna"
            title="Ingrese la cantidad aplicada de la vacuna ">
            @error('dosis')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        <div class="mb-3">
            <label for="">Unidad</label>
            <select name="unidad" id="unidad" class="form-control @error('unidad') is-invalid @enderror">
                <option value="">Seleccione una opción</option>
                <option value="mililitros" {{ old('unidad') === 'mililitros' ? 'selected' : '' }}>Mililitros</option>
                <option value="miligramos" {{ old('unidad') === 'miligramos' ? 'selected' : '' }}>Miligramos</option>
            </select>
            @error('unidad')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="">Fecha de aplicación</label>
            <input type="date"value="{{old('fecha_aplicada')}}"  name="fecha_aplicada"  id="fecha_aplicada" 
            class="form-control @error('fecha_aplicada') is-invalid @enderror"   placeholder="Ingrese la fecha de la aplicacion de la vacuna"
            title="Ingrese la fecha de la aplicacion de la vacuna ">

            @error('fecha_aplicada')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        
        <div class="mb-3">
        <label for="aplicada">¿Aplicada?</label>
        <br>
        <input style="width:70px; heigh:40px;" type="checkbox" name="aplicada" id="aplicada" value="1" {{ old('aplicada') ? 'checked' : '' }}>
       </div>
 
        <link rel="stylesheet" type="text/css" href="css/fonts.css" >      
        <button type="submit"class="btn btn-outline-success" tabindex="4"style="margin-left: 350px;margin-right: 60px;"><span class="fas fa-user-plus"></span> Guardar</button> 

        <a href="{{ route('vacuna.index', ['id' => $paciente->id]) }}" class="btn btn-outline-danger" tabindex="5"style="margin-rigth: 100px;"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
        <br>
        <br>

    </form>


@endsection
