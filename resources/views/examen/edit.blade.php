@extends('layouts.madre')

@section('title', 'Editar Examen Fisico de ' .App\Models\Paciente::find($examen->num_id)->nombre_mascota)

@section('content')

    <form  method="POST" action="{{ route('examen.update',['id'=>$examen->id])}}">
        @method('put')
        @csrf

        <br>

        <div class="mb-3"style="display:none !important;" >
            <label for="">Nombre de la Mascota</label>
            <input class="form-control" name="num_id" value= "{{$examen->num_id}}">
                
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Temperatura °C</label>
            <input type="number" maxlength="3" 
            title="Ingrese la temperatura"
            name="temperatura" id="temperatura" class="form-control @error('temperatura') is-invalid @enderror" 
            value="{{ $examen->temperatura }}"
            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
            @error('temperatura')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Frecuencia cardíaca /minuto</label>
            <input type="number" maxlength="3" 
            name="frecuencia_cardiaca"  id="frecuencia_cardiaca"  class="form-control @error('frecuencia_cardiaca') is-invalid @enderror" value="{{ $examen->frecuencia_cardiaca }}"
            title="Ingrese la frecuencia cardíaca"
            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
            @error('frecuencia_cardiaca')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Frecuencia respiratoria /minuto</label>
            <input type="number" maxlength="3" name="frecuencia_respiratoria"  id="frecuencia_respiratoria"  class="form-control @error('frecuencia_respiratoria') is-invalid @enderror"   placeholder="" value="{{ $examen->frecuencia_respiratoria }}"
            title="Ingrese la frecuencia respiratoria"
            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
            @error('frecuencia_respiratoria')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Peso Kg</label>
            <input type="number" maxlength="3" name="peso"  id="peso"  class="form-control @error('peso') is-invalid @enderror"   placeholder="" value="{{ $examen->peso }}"
            title="Ingrese el peso"
            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
            @error('peso')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Pulso /minuto</label>
            <input type="number" maxlength="3" name="pulso"  id="pulso"  class="form-control @error('pulso') is-invalid @enderror"   placeholder="" value="{{ $examen->pulso }}"
            title="Ingrese el pulso"
            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
            @error('pulso')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-outline-success" tabindex="4" style="margin-left: 350px;margin-right: 60px;"><span class="fas fa-user-plus"></span> Guardar cambios</button>     
        <a href="{{ route('examenMascota',['id'=>$examen->num_id])}}" class="btn btn-outline-danger" tabindex="5"> <i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>

        <br>
        <br>

    </form>




@endsection 