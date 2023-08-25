@extends('layouts.madre')

@section('title', 'Editar Registro desparasitar de  ' .App\Models\Paciente::find($aplicado->num_id)->nombre_mascota)

@section('content')
    
    <form method="POST" action ="{{route('desparacitar.update',['id'=>$aplicado->id])}}">
        @method('put')
        @csrf
        <br>

        <div class="mb-3"style="display:none !important;" >
            <label for="">Nombre de la Mascota</label>
            <input class="form-control" name="num_id" value= "{{$aplicado->num_id}}">
                
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
            tabindex="1" title="Dosis">
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
            value="{{ $aplicado->fecha_aplicada }}" title="Ingrese fecha de desparacitar">
            @error('fecha_aplicacion')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label>Estado </label>
            <div class="wrapper" style="display: flex; width: 100px;">
                <input type="checkbox" name="aplicada" id="aplicada" value="1" {{ old('aplicada', $aplicado->aplicada) ? 'checked' : '' }}>
                <label for="aplicada" class="checkbox">Aplicado</label>
            </div>
        </div>

        <div style="align-items: center; justify-content: center; display: flex;">
            <button type="submit"class="btn btn-outline-success" tabindex="4" style="margin-right: 60px;"><span class="fas fa-user-plus"></span> Guardar cambios</button> 
            <a href="{{ route('desparacitacionMascota',['id'=>$aplicado->num_id])}}" class="btn btn-outline-danger" tabindex="5"style="margin-rigth: 100px;"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
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