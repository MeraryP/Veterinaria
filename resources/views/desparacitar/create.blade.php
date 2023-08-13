@extends('layouts.madre')

<<<<<<< HEAD
@section('title', 'Registro de desparasitar de ')

@section('content')

  
=======
@section('title', 'Registro de desparasitante a '.$nombre_mascotas)

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
                    <p style="text-align: center; margin-bottom: 0px;"><i class="fas fa-file-signature" style="margin-right: 5px;"></i>Examen Fisico</p>
                </div>
            </a>
        </li>

        <li class="nav-item" role="presentation">
            <a href="" class="nav-link">
                <div> 
                    <p style="text-align: center; margin-bottom: 0px;"><i class="nav-icon fas fa-syringe" style="margin-right: 5px;"></i>Vacuna</p>
                </div>
            </a>
        </li>

        <li class="nav-item" role="presentation">
            <a href=""class="nav-link">
                <div> 
                    <p style="text-align: center; margin-bottom: 0px;"><i class="nav-icon fa fa-capsules" style="margin-right: 5px;"></i>Desparacitación</p>
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
>>>>>>> d6b8b1f5d96fe8ab90f4b981dbae36fa89dbecc8


    <form action ="{{route('desparacitar.store')}}"  method="POST">
    
        @csrf
        <br>

        <div class="mb-3" style="display:none !important;" >
            <label for="">Nombre de la Mascota</label>
            <input class="form-control" name="num_id" value= "{{$paciente}}">  
            
        </div>

        <div class="mb-3">
            <label for="">Nombre del Desparasitante</label>
            <select class="form-control" name="medi_id"> 
                @foreach ($medicamentos as  $medicamento)
                    <option value="{{$medicamento->id}}">{{$medicamento->nombre_medicamento}}</option>
                @endforeach   
            </select>   
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Dosis de Desparasitante</label>
            <input type="number" value="{{old('dosis')}}"  name="dosis" id="dosis"  class="form-control @error('dosis') is-invalid @enderror"  
             title="dosis">

            @error('dosis')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

<<<<<<< HEAD


=======
       <!-- <div class="mb-3">
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
        </div>-->
>>>>>>> d6b8b1f5d96fe8ab90f4b981dbae36fa89dbecc8

       <div class="mb-3">
            <label for="unidad_desparasitante">Unidad Desparasitante </label>
            <select name="unidad_desparasitante" id="unidad_desparasitante" class="form-control @error('unidad_desparasitante') is-invalid @enderror">
                <option value="ml">Mililitros</option>
                <option value="mg">Miligramos</option>
                <option value="tabletas">Tabletas</option>
                <option value="cucharaditas">Cucharaditas</option>
            </select>
            @error('unidad_desparasitante')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Fecha de Aplicacion</label>
            <input type="date" value="{{old('fecha_aplicada')}}"  name="fecha_aplicada" id="fecha_aplicada"  class="form-control @error('fecha_aplicada') is-invalid @enderror"  tabindex="1"
            title="fecha desparacitacion">

            @error('fecha_aplicada')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="aplicada">Estado</label><br>
            Aplicado<input style="width:70px; heigh:40px;" type="checkbox" name="aplicada" id="aplicada" value="1" {{ old('aplicada') ? 'checked' : '' }}>
        </div>

        <button type="submit"class="btn btn-outline-success" tabindex="4"style="margin-left: 350px;margin-right: 60px;"><span class="fas fa-user-plus"></span> Guardar</button> 
        <a href="{{route('desparacitacionMascota', ['$id'=>$paciente])}}" class="btn btn-outline-danger" tabindex="5"style="margin-rigth: 100px;"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
        
        
    </form>

@endsection