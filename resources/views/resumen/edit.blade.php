@extends('layouts.madre')

@section('title', 'Paciente')


@section('content')
<form  method="POST" action="{{ route('resumen.update',['id'=>$resumen->id])}}">
    @method('put')
    @csrf
   

    <div class="mb-3">
    <label for="" class="form-label">Diagnostico</label>
    <input type="text" maxlength="200" 
    title="Ingrese el diagnostico"
    name="diagnostico" id="diagnostico" class="form-control @error('diagnostico') is-invalid @enderror"  placeholder="" 
    value="{{ $resumen->diagnostico }}"
    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">

    @error('diagnostico')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
</div>
       <div class="mb-3">
        <label for="" class="form-label">Indicaciones_medicas</label>
        <input type="text" name="indicaciones_medicas"  id="especie"  class="form-control @error('indicaciones_medicas') is-invalid @enderror"   placeholder="Ingrese la indicaciones_medicas" value="{{ $resumen->indicaciones_medicas }}"
        title="Ingrese la indicaciones_medicas">
        @error('indicaciones_medicas')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>

      <div class="mb-3">
        <label for="" class="form-label">Evolucion_curso</label>
        <input type="text" name="evolucion_curso"  id="evolucion_curso"  class="form-control @error('evolucion_curso') is-invalid @enderror"   placeholder="" value="{{ $resumen->evolucion_curso }}"
        title="Ingrese la evolucion_curso">
        @error('evolucion_curso')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
</div>


      
<button type="submit" class="btn btn-primary" tabindex="4"><span class="fas fa-user-plus"></span> Guardar cambios</button>     
<a href="/resumen" class="btn btn-danger" tabindex="5"> <i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>

<br>
<br>



</form>




@endsection 