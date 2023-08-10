@extends('layouts.madre')

@section('title', 'Crear paciente')


@section('content')


 <br>
 <br> 

<form action ="../paciente"  method="POST"enctype="multipart/form-data" >
    @csrf
    <div>
        <label for="imagen" class="form-label">Foto</label>
        <input type="file" name="imagen" id="imagen" class="form-control @error('imagen') is-invalid @enderror"style="max-width: 400px;">
        @error('imagen')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    
    <div class="mb-3">
        <br>
        <img id="imagen-preview" src="#" alt="Vista previa de la imagen" style="display: none; max-width: 200px; max-height: 200px;margin-left: 130px;">
    </div>

    <br>
        <a href="#" id="eliminar-imagen-btn" class="btn btn-outline-danger btn-sm"style="margin-left:180px;margin-right: 20px;">Eliminar Foto</a>
    <br>
    
  <div class="mb-3">
        <label for="" class="form-label">Nombre de la Mascota</label>
        <input type="text" maxlength="100" value="{{old('nombre_mascota')}}"  name="nombre_mascota"  id="nombre_mascota"   
        class="form-control @error('nombre_mascota') is-invalid @enderror" placeholder="Ingrese el nombre de la mascota"
        title="Ingrese el nombre de la mascota">
        @error('nombre_mascota')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      
      </div>

      
      <div class="for-group">
        <label for="">Nombre del Propietario</label>
        <select class="form-control" name="pro_id">
        @foreach ($propietarios as $propietario)
        <option value="{{$propietario->id}}">{{$propietario->nombre}}</option>
        @endforeach      
      </select>


      <br>

      <div class="for-group">
        <label for="">Especie</label>
        <select class="form-control" name="especie_id">
        @foreach ($especies as $especie)
        <option value="{{$especie->id}}">{{$especie->nombre_especie}}</option>
        @endforeach      
      </select>

     <br>
      <div class="for-group">
        <label for="">Género</label>
        <select class="form-control" name="genero_id">
        @foreach ($genero_mascotas as $genero_mascota)
        <option value="{{$genero_mascota->id}}">{{$genero_mascota->name}}</option>
        @endforeach      
      </select>
      </div>
   
      
  <br>

<div class="mb-3">
        <label for="" class="form-label">Raza</label>
        <input type="text"  maxlength="100"   value="{{old('raza')}}"  name="raza"  id="raza"   
        class="form-control @error('raza') is-invalid @enderror" placeholder="Ingrese la raza"
        title="Ingrese la raza">
        @error('raza')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      
      </div>

   

   
    

      <div class="mb-3">
        <label for="" class="form-label">Fecha de Nacimiento</label>
        <input type="date" value="{{old('fecha_nacimiento')}}" name="fecha_nacimiento"  id="fecha_nacimiento"  
        class="form-control @error('fecha_nacimiento') is-invalid @enderror" placeholder="aa-mm-dd" 
        title="Ingrese la fecha de nacimiento " autofocus>

      
        @error('fecha_nacimiento')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>

  


      
<link rel="stylesheet" type="text/css" href="css/fonts.css" >     
<button type="submit"class="btn btn-outline-success" tabindex="4"style="margin-left: 350px;margin-right: 60px;"><span class="fas fa-user-plus"></span> Guardar</button> 

<a href="../paciente" class="btn btn-outline-danger" tabindex="5"style="margin-rigth: 100px;"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
<br>
<br>


</form>


<script>
    document.getElementById('imagen').addEventListener('change', function () {
        var reader = new FileReader();

        reader.onload = function (e) {
            document.getElementById('imagen-preview').setAttribute('src', e.target.result);
            document.getElementById('imagen-preview').style.display = 'block';
        }

        var file = this.files[0];
        if (file) {
            reader.readAsDataURL(file);
        }
    });

    document.getElementById('eliminar-imagen-btn').addEventListener('click', function (e) {
        e.preventDefault();
        document.getElementById('imagen-preview').style.display = 'none';
        document.getElementById('imagen').value = '';
    });
</script>

<script>
        document.addEventListener('DOMContentLoaded', function() {
            function scrollPage() {
                window.scrollBy(0, -10);

                if (window.scrollY > 0) {
                    requestAnimationFrame(scrollPage);
                }
            }

            scrollPage();
        });
    </script>

@endsection
