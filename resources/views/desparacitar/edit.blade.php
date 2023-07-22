@extends('layouts.madre')

@section('title', 'Editar desparacitacion')

@section('content')

    <form method="POST" action ="{{ route('desparacitar.update',['id'=>$desparacitar->id])}}">
        @method('put')
        @csrf

        <div class="mb-3">
            <label for="" class="form-label">Antiparacitario</label>
            <input type="text" class="form-control @error('antiparacitario') is-invalid @enderror" name="antiparacitario" id="antiparacitario" 
            value="{{ $desparacitar->antiparacitario }}" title="Ingrese el nombre del Antiparacitario">
            @error('antiparacitario')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Fecha de desparacitacion</label>
            <input type="date" class="form-control @error('fecha_desparacitacion') is-invalid @enderror" name="fecha_desparacitacion" id="fecha_desparacitacion" 
            value="{{ $desparacitar->fecha_desparacitacion }}" title="Ingrese Fecha de desparacitacion">
            @error('fecha_desparacitacion')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Fecha de volver Desparacitar</label>
            <input type="date" class="form-control @error('fecha_volverDesparacitar') is-invalid @enderror" name="fecha_volverDesparacitar" id="fecha_volverDesparacitar" 
            value="{{ $desparacitar->fecha_volverDesparacitar }}" title="Ingrese Fecha de volver Desparacitar">
            @error('fecha_volverDesparacitar')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-outline-success" tabindex="4"><span class="fas fa-user-plus"></span>Guardar</button>
        <a href="/desparacitar" class="btn btn-outline-danger" tabindex="5"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
            
@endsection