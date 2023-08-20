@extends('layouts.madre')

@section('title', 'Nuevo paciente')


@section('content')


 <br>
  

<form action ="../paciente"  method="POST"enctype="multipart/form-data" >
    @csrf
   
    
    <br>
    
    <div class="mb-3"id="imagen-container" style="max-width: 400px; max-height: 200px;overflow: hidden;">
        <img id="imagen-preview" src="#" alt="Vista previa de la imagen" style="display: none; max-width: 250px; max-height: 300;border-style:solid;border-width: 7px;border-radius:.375rem;border-color:#E9EEEE;">
        <!--<img src="/imagen/usuarios.png" class="icono-imagen" alt="Icono de Foto" style="max-width: 200px; max-height: 200px;margin-left: 130px;">-->
    </div>

    
    <div > 
    <input type="file" name="imagen" id="imagen" class="form-control @error('imagen') is-invalid @enderror"style="max-width: 400px;display:none !important;">
        <button  type="button" id="cargar-imagen-btn" class="btn btn-success" style="margin-left: 45px;width: 150px; height: 40px;"><i  style="font-size:20px;" align ="center" class="far fa-image" aria-hidden="true"></i> Agregar Foto</button>
        @error('imagen')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
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
    
    document.getElementById('cargar-imagen-btn').addEventListener('click', function () {
        document.getElementById('imagen').click();
    });
</script>


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

  
</script>

<!--<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cargarImagenBtn = document.getElementById('cargar-imagen-btn');
        const imagenInput = document.getElementById('imagen');
        const imagenPreview = document.getElementById('imagen-preview');
        const iconoImagen = document.querySelector('.icono-imagen'); // Agregamos el icono

        cargarImagenBtn.addEventListener('click', function() {
            imagenInput.click();
        });

        imagenInput.addEventListener('change', function() {
            const reader = new FileReader();

            reader.onload = function(e) {
                imagenPreview.setAttribute('src', e.target.result);
                imagenPreview.style.display = 'block';
                iconoImagen.style.display = 'none'; // Ocultamos el icono
            };

            const file = this.files[0];

            if (file) {
                reader.readAsDataURL(file);
            } else {
                imagenPreview.removeAttribute('src');
                imagenPreview.style.display = 'none';
                iconoImagen.style.display = 'block'; // Mostramos el icono
            }
        });
    });
</script>-->



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
