@extends('layouts.madre')

@section('title', 'Editar Perfil')

@section('content')
    <style>
        .form-control{
            border-top-left-radius: 5px !important;
            border-bottom-left-radius: 5px !important;
            border-top-right-radius: 5px !important;
            border-bottom-right-radius: 5px !important;
            padding-left: 10px !important;
            border-width: 1px;
        }
        input{
            margin-left:10px !important;
            border:0.5px solid !important;
        }
    </style>

    <center><h1></h1></center>
    <br>
    
    <form action="{{route('usuario.actualizar')}}" method="post"enctype="multipart/form-data" >
        @method("put")
        @csrf

        <div class="mb-3"id="imagen-container" style="max-width: 400px; max-height: 200px;overflow: hidden;margin-left: 200px;">
            <img id="imagen-preview" src="#" alt="Vista previa de la imagen" style="display: none; max-width: 250px; max-height: 300;border-style:solid;border-width: 7px;border-radius:.375rem;border-color:#E9EEEE;">
            <img src="/perfil/{{ auth()->user()->imagen }}" class="icono-imagen" alt="Icono de Foto" style="max-width: 250px; max-height: 300px;border-style:solid;border-width: 7px;border-radius:.375rem;border-color:#DADBDB;">
            <!--<img src="/imagen/usuarios.png" class="icono-imagen" alt="Icono de Foto" style="max-width: 200px; max-height: 200px;margin-left: 130px;">-->
        </div>

        <div> 
            <input type="file" name="imagen" id="imagen" class="form-control @error('imagen') is-invalid @enderror"style="max-width: 400px;display:none !important;">
            <button  type="button" id="cargar-imagen-btn" class="btn btn-success" style="margin-left: 200px;width:250px; height: 40px;"><i  style="font-size:20px;" align ="center" class="far fa-image" aria-hidden="true"></i> Agregar Foto</button>
            @error('imagen')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <br>
        
        <div class="input-group mb-3">
            <label for="" style="width:20%">Nombre Completo:</label>
            <input name="name" type="text"  title="Ingrese su nombre completo" class="form-control @error('name') is-invalid @enderror" value="{{auth()->user()->name}}" >
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="input-group mb-3">
            <label for="" style="width:20%">Nombre de Usuario:</label>
            <input name="username" type="text" title="Ingrese un  username" class="form-control @error('username') is-invalid @enderror" value="{{auth()->user()->username}}" >
            @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="input-group mb-3">
            <label for="" style="width:20%">Correo Electrónico:</label>
            <input name="correo" type="text" title="Ingrese el correo electrónico" class="form-control @error('correo') is-invalid @enderror" value="{{auth()->user()->correo}}" >
            @error('correo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="input-group mb-3">
            <label for="" style="width:20%">Fecha de nacimiento:</label>
            <input name="nacimiento" type="text"  title="Ingresar número de Identidad separado por guiones" maxlength="15" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"  class="form-control @error('nacimiento') is-invalid @enderror"  value="{{auth()->user()->nacimiento}}" >
            @error('nacimiento')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="input-group mb-3">
            <label for="" style="width:20%">Identidad:</label>
            <input name="identidad" type="text"  title="Ingresar número de Identidad separado por guiones" maxlength="15" pattern="[0-9]{4}-[0-9]{4}-[0-9]{5}"  class="form-control @error('identidad') is-invalid @enderror"  value="{{auth()->user()->identidad}}" >
            @error('identidad')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="input-group mb-3">
            <label for="" style="width:20%">Teléfono:</label>
            <input name="telefono" type="text" title="Ingrese el número teléfonico" autofocus maxLength="9" class="form-control @error('telefono') is-invalid @enderror" value="{{auth()->user()->telefono}}" >
            @error('telefono')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <br>
        <div style="align-items: center; justify-content: center; display: flex;">
            <button type="submit" class="btn btn-outline-success" style="margin-right: 60px;"><span class="fas fa-user-plus"></span>
            Guardar Cambios
            </button>
            
            <a type="button" class="btn btn-outline-danger" href="/usuario"><i class="fa fa-times" aria-hidden="true"></i>
                Cancelar
            </a>
        </div>
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
    </script>

    <script>
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
    </script>

@stop