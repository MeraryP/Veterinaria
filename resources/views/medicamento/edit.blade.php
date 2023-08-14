@extends('layouts.madre')

@section('title', 'Editar Registro del medicamento')


@section('content')


<form  method="POST" action="{{ route('medicamento.update',['id'=>$medicamento->id])}}">
    @method('put')
    @csrf

    <br>


<div class="mb-3">
        <label for="" class="form-label">Nombre del medicamento</label>
        <input type="text" name="nombre_medicamento"  id="nombre_medicamento"  class="form-control @error('nombre_medicamento') is-invalid @enderror"   placeholder="" value="{{ $medicamento->nombre_medicamento }}"
        title="Ingrese el nombre del medicamento">
        @error('nombre_medicamento')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
</div>

<div class="for-group">
        <label for="">Categoria</label>
        <select class="form-control" name="cate_id">
        <option style="display:none" value="{{$medicamento->cate_id}}"> {{$medicamento->categoria->nombre_cate}}</option>    
        @foreach ($categorias as $categoria)
        <option value="{{$categoria->id}}">{{$categoria->nombre_cate}}</option>
        @endforeach      
      </select>
      </div>





      
<button type="submit" class="btn btn-outline-success" tabindex="4" style="margin-left: 300px;margin-right: 60px;"><span class="fas fa-user-plus"></span> Guardar cambios</button>     
<a href="/medicamento" class="btn btn-outline-danger" tabindex="5"> <i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>

<br>
<br>



</form>




@endsection 