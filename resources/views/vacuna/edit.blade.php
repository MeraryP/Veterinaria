@extends('layouts.madre')

@section('title', 'Editar Vacunas de ' .App\Models\Paciente::find($aplicado->num_id)->nombre_mascota)

@section('content')

    <form  method="POST" action="{{ route('vacuna.update',['id'=>$aplicado->id])}}">
        @method('put')
        @csrf

        <br>
        <div class="mb-3" style="display:none !important;">
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
            <label>Estado </label>
            <div class="wrapper" style="display: flex; width: 100px;">
                <input type="checkbox" name="aplicada" id="aplicada" value="1" {{ old('aplicada', $aplicado->aplicada) ? 'checked' : '' }}>
                <label for="aplicada" class="checkbox">Aplicado</label>
            </div>
        </div>


        <button type="submit" class="btn btn-outline-success" tabindex="4" style="margin-left: 350px;margin-right: 60px;"><span class="fas fa-user-plus"></span> Guardar cambios</button>     
        <a href="{{ route('vacunaMascota',['id'=>$aplicado->num_id])}}"  class="btn btn-outline-danger" tabindex="5"> <i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>

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