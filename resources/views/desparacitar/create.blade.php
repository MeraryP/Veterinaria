@extends('layouts.madre')

@section('title', 'Registro de desparasitar de ')

@section('content')

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
            <input type="number" value="{{old('dosis')}}"  name="dosis" id="dosis" title="Dosis" 
            class="form-control @error('dosis') is-invalid @enderror" placeholder="Ingrese la dosis">
            @error('dosis')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

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
            <input type="date" value="{{old('fecha_aplicada')}}"  name="fecha_aplicada" id="fecha_aplicada"  
            class="form-control @error('fecha_aplicada') is-invalid @enderror"  tabindex="1" 
            title="Ingrese fecha de Desparacitar">
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

        <button type="submit"class="btn btn-outline-success" tabindex="4"style="margin-left: 350px;margin-right: 60px;"><span class="fas fa-user-plus"></span> Guardar</button> 
        <a href="{{route('desparacitacionMascota', ['id'=>$paciente])}}" class="btn btn-outline-danger" tabindex="5"style="margin-rigth: 100px;"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
        
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