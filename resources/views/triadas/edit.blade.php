@extends('layouts.madre')

@section('title', 'Editar triada')

@section('content')


<form method="POST" action ="{{ route('triada.update',['id'=>$triada->id])}}">
@method('put')
    @csrf

   
        <div class="mb-3">
            <label for="" class="form-label">Frecuencia Respiratoria</label>
            <input type="text" name="frecuencia_respiratoria"  id="frecuencia_respiratoria"  class="form-control @error('frecuencia_respiratoria') is-invalid @enderror"   
            placeholder="Frecuencia Respiratoria" value="{{ $triada->frecuencia_respiratoria }}"
            title="Ingrese Frecuencia Respiratoria">
            @error('frecuencia_respiratoria')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Frecuencia Pulso</label>
            <input type="text" name="frecuencia_pulso"  id="frecuencia_pulso"  class="form-control @error('frecuencia_pulso') is-invalid @enderror"   
            placeholder="Frecuencia Pulso" value="{{ $triada->frecuencia_pulso }}"
            title="Ingrese Frecuencia Pulso">
            @error('frecuencia_pulso')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Temperatura Corporaral</label>
            <input type="text" name="femperatura_corporaral"  id="femperatura_corporaral"  class="form-control @error('femperatura_corporaral') is-invalid @enderror"   
            placeholder="Temperatura Corporaral" value="{{ $triada->femperatura_corporaral }}"
            title="Ingrese Temperatura Corporaral">
            @error('femperatura_corporaral')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary" tabindex="4"><span class="fas fa-user-plus"></span>Guardar cambios</button>
        <a href="/triadas" class="btn btn-danger" tabindex="5"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>

@endsection