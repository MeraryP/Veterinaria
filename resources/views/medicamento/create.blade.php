@extends('layouts.madre')

@section('title', 'Registrar Medicamento')

@section('content')

    <form action ="../medicamento"  method="POST">
        @csrf  
        <br> 
        
        <div class="mb-3">
            <label for="" class="form-label">Nombre del Medicamento</label>
            <input type="text"  maxlength="100"   value="{{old('nombre_medicamento')}}"  name="nombre_medicamento"  id="nombre_medicamento"   
            class="form-control @error('nombre_medicamento') is-invalid @enderror" placeholder="Ingrese el nombre del medicamento "
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
                @foreach ($categorias as $categoria)
                <option value="{{$categoria->id}}">{{$categoria->nombre_cate}}</option>
                @endforeach      
            </select>
        </div>

        <!-- <div class="mb-3">
            <label for="" class="form-label">Dosis del medicamento</label>
            <input type="number"    value="{{old('dosis')}}"  name="dosis"  id="dosis"   
            class="form-control @error('dosis') is-invalid @enderror" placeholder="Ingrese la dosis "
            title="Ingrese la dosis">
            @error('dosis')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div> -->

        <br> 
   
        <div style="align-items: center; justify-content: center; display: flex;">
            <link rel="stylesheet" type="text/css" href="css/fonts.css" >     
            <button type="submit"class="btn btn-outline-success" tabindex="4"style="margin-right: 60px;"><span class="fas fa-user-plus"></span> Guardar</button> 
            <a href="../medicamento" class="btn btn-outline-danger" tabindex="5"style="margin-rigth: 100px;" ><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
        </div>
        <br>
        <br>

    </form>

@endsection
