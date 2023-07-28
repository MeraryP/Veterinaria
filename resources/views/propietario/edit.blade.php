@extends('layouts.madre')

@section('title', 'Editar  Propietario')


@section('content')


<form  method="POST" action="{{ route('propietario.update',['id'=>$propietario->id])}}">
    @method('PUT')
    @csrf


    <br>
   

     


    <div class="mb-3">
    <label for="" class="form-label">Identidad</label>
    <input type="text" maxlength="15" pattern="[0-9]{4}-[0-9]{4}-[0-9]{5}" 
    title="Ingrese número de Identidad separado por guiones"
    name="identidad" id="identidad" class="form-control @error('identidad') is-invalid @enderror"  placeholder="0000-0000-00000" 
    value="{{ $propietario->identidad }}"
    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">

    @error('identidad')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
</div>
       <div class="mb-3">
        <label for="" class="form-label">Nombre Completo</label>
        <input type="text" name="nombre"  id="nombre"  class="form-control @error('nombre') is-invalid @enderror"   placeholder="Nombre Completo del Estudiante" value="{{ $propietario->nombre }}"
        title="Ingrese el nombre completo del egresado">
        @error('nombre')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>

      <div class="mb-3">
        <label for="" class="form-label">Direccion</label>
        <input type="text" maxlength="300" name="direccion"  id="direccion"  class="form-control @error('direccion') is-invalid @enderror"   placeholder="Ingrese la direccion" value="{{ $propietario->direccion }}"
        title="Ingrese la direccion">
        @error('direccion')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>

      <div class="for-group">
    <label for="">Género</label>
    <select class="form-control" name="gene_id">
        @foreach ($generos as $genero)
            <option value="{{$genero->id}}" @if($genero->id === $propietario->gene_id) selected @endif>{{$genero->name}}</option>
        @endforeach      
    </select>
    </div>
      <div class="mb-3">
        <label for="" class="form-label">Telefono</label>
        <input type="text" name="telefono"  id="telefono" maxlength="9"  pattern="[0-9]{4}-[0-9]{4}"  class="form-control @error('telefono') is-invalid @enderror"   placeholder="0000-0000" value="{{ $propietario->telefono }}"
        title="Ingrese el número telefonico">
        @error('telefono')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>

      <div class="mb-3">
        <label for="" class="form-label">Correo</label>
        <input type="text" name="correo"  id="correo"  class="form-control @error('correo') is-invalid @enderror"   placeholder="correo@gmail.com" value="{{ $propietario->correo }}"
        title="Ingrese el correo electronico">
        @error('correo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>

      
<button type="submit" class="btn btn-outline-success" tabindex="4"><span class="fas fa-user-plus"></span> Guardar cambios</button>     
<a href="/propietario" class="btn btn-outline-danger" tabindex="5"> <i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>

<br>
<br>



</form>




@endsection 