@extends('layouts.madre')

@section('title', 'Crear Triada')

@section('content')

    <form action ="../triadas"  method="POST">
        @csrf
        <div class="mb-3">
            <label for="" class="form-label">Frecuencia Respiratoria</label>
            <input type="text" value="{{old('frecuencia_respiratoria')}}"  name="frecuencia_respiratoria" id="frecuencia_respiratoria"  class="form-control @error('frecuencia_respiratoria') is-invalid @enderror"  tabindex="1"
            title="Ingrese Frecuencia Respiratoria">

            @error('frecuencia_respiratoria')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Frecuencia Pulso</label>
            <input type="text" value="{{old('frecuencia_pulso')}}"  name="frecuencia_pulso" id="frecuencia_pulso"  class="form-control @error('frecuencia_pulso') is-invalid @enderror"  tabindex="1"
            title="Ingrese Frecuencia Pulso">

            @error('frecuencia_pulso')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
        </div>
        
        <div class="mb-3">
            <label for="" class="form-label">Temperatura Corporaral</label>
            <input type="text" value="{{old('femperatura_corporaral')}}"  name="femperatura_corporaral" id="femperatura_corporaral"  class="form-control @error('femperatura_corporaral') is-invalid @enderror"  tabindex="1"
            title="Ingrese Temperatura Corporaral">

            @error('femperatura_corporaral')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
        </div>

        <button type="submit" class="btn btn-primary" tabindex="4"><span class="fas fa-user-plus"></span>Guardar</button>
        <a href="/triadas" class="btn btn-danger" tabindex="5"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>


    </form>

@endsection