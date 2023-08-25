@extends('layouts.madre')

@section('title', 'Crear Vacunas de ' .App\Models\Paciente::find($paciente)->nombre_mascota)

@section('content')

    <form action ="{{route('vacuna.store')}}"  method="POST">
        @csrf
    
        <br>
        <div class="mb-3" style="display:none !important;" >
            <label for="">Nombre de la Mascota</label>
            <input class="form-control" name="num_id" value= "{{$paciente}}"> 
               
           
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
            <input type="number" maxlength="4" pattern="[0-9]{4}" value="{{old('dosis')}}"  name="dosis"  id="Dosis" 
            class="form-control @error('dosis') is-invalid @enderror"  placeholder="Ingrese la dosis"
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
            <label>Estado </label>
            <div class="wrapper" style="display: flex; width: 100px;">
                <input type="checkbox" name="aplicada" id="aplicada" value="1" {{ old('aplicada') ? 'checked' : '' }}>
                <label for="aplicada" class="checkbox">Aplicado</label>
            </div>
        </div>
        <br>
        <div style="align-items: center; justify-content: center; display: flex;">
            <link rel="stylesheet" type="text/css" href="css/fonts.css" >      
            <button type="submit"class="btn btn-outline-success" tabindex="4" style="margin-right: 60px;"><span class="fas fa-user-plus"></span> Guardar</button> 

            <a href="{{route('vacunaMascota', ['id'=>$paciente])}}"  class="btn btn-outline-danger" tabindex="5"style="margin-rigth: 100px;"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
            <br>
            <br>
        </div>
        
    </form>

    <style>
        body{
            padding: 0;
            margin: 0;
        }

        .wrapper{
            height: 40px; 
            align-items: center; 
            justify-content: space-around;
        }

        input[type="checkbox"]{
            appearance: none;
            -webkit-appearance: none;
            height: 22px;
            width: 22px;
            background-color: #d5d5d5;
            border-radius: 5px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .checkbox{
            color: #4c4c4c;
            font-size: 15px;
            font-family: 'Poppins',sans-serif;
            font-weight: 600;
            cursor: pointer;
            align-items: center;
            justify-content: center;
        }

        input[type="checkbox"]:after{
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            content: "\f00c";
            font-size: 20px;
            color: white;
            display: none;
        }

        input[type="checkbox"]:hover{
            background-color: #55a5;
        }

        input[type="checkbox"]:checked{
            background-color: #5bcd3e;
        }

        input[type="checkbox"]:checked:after{
            display: block;
        }
    </style>

@endsection
