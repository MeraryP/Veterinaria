@extends('layouts.madre')

@section('title', 'Registrar Propietario')

@section('content')
    
        
<form action ="../propietario"  method="POST">
    @csrf

    <br>

   


      <div class="mb-3">
      <label for="">Numero de expediente</label>
      <select class="form-control" name="num_id"> 
       @foreach ($pacientes as  $paciente)
        <option value="{{$paciente->id}}">{{$paciente->numero_expediente}}</option>
        @endforeach   
      </select>
      </div>

      
    <div class="mb-3">
    <label for="" class="form-label">Identidad</label>
    <input type="text"  maxlength="15" pattern="[0-9]{4}-[0-9]{4}-[0-9]{5}" 
    title="Ingrese número de Identidad separado por guiones" value="{{old('identidad')}}" 
    name="identidad" id="identidad" 
    class="form-control @error('identidad') is-invalid @enderror" placeholder="0000-0000-00000"
    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">

    @error('identidad')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
  </div>



<div class="mb-3">
        <label for="" class="form-label">Nombre Completo</label>
        <input type="text" maxlength="100" value="{{old('nombre')}}"  name="nombre"  id="nombre"   
        class="form-control @error('nombre') is-invalid @enderror" placeholder="Nombre Completo del Estudiante"
        title="Ingrese el nombre completo del egresado">
        @error('nombre')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      
      </div>


      <div class="mb-3">
        <label for="" class="form-label">Direccion</label>
        <input type="text" maxlength="300" value="{{old('direccion')}}" name="direccion"  id="direccion"  
        class="form-control @error('direccion') is-invalid @enderror" placeholder="Direccion" 
        title="Ingrese la dirección " >

      
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
        <option value="{{$genero->id}}">{{$genero->name}}</option>
        @endforeach      
      </select>
      </div>
    

      <div class="mb-3">
        <label for="">Telefono</label>
        <input type="text"value="{{old('telefono')}}"  name="telefono"  id="telefono" 
        class="form-control @error('telefono') is-invalid @enderror"   placeholder="0000-0000"
        title="Ingrese el número telefonico ">
      
        @error('telefono')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>

      <div class="mb-3">
        <label for="">Correo</label>
        <input type="text"value="{{old('correo')}}"  name="correo"  id="correo" 
        class="form-control @error('correo') is-invalid @enderror"   placeholder="correo@gmail.com"
        title="Ingrese el correo electronico">
      
        @error('correo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>

      
<link rel="stylesheet" type="text/css" href="css/fonts.css" >     
<button type="submit"class="btn btn-outline-success" tabindex="4"><span class="fas fa-user-plus"></span> Guardar</button> 

<a href="../propietario" class="btn btn-outline-danger" tabindex="5"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
<br>
<br>


</form>


@endsection



