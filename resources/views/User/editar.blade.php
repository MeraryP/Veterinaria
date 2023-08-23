@extends('layouts.madre')

@section('title', 'Editar Usuario')

@section('content')

    <br>
    <br>
    <form action="{{route('usuario.update',['id'=>$user->id])}}" method="post">

        @method("put")
        @csrf

        <div class="mb-3"id="imagen-container" style="max-width: 400px; max-height: 200px;overflow: hidden;">
            <img id="imagen-preview" src="#" alt="Vista previa de la imagen" style="display: none; max-width: 250px; max-height: 300;border-style:solid;border-width: 7px;border-radius:.375rem;border-color:#E9EEEE;">
            <!--<img src="/imagen/usuarios.png" class="icono-imagen" alt="Icono de Foto" style="max-width: 200px; max-height: 200px;margin-left: 130px;">-->
        </div>

        <div > 
        <input type="file" name="imagen" id="imagen" class="form-control @error('imagen') is-invalid @enderror"style="max-width: 400px;display:none !important;">
            <button  type="button" id="cargar-imagen-btn" class="btn btn-success" style="margin-left:0px;width: 245px; height: 40px;"><i  style="font-size:20px;" align ="center" class="far fa-image" aria-hidden="true"></i> Agregar Foto</button>
            @error('imagen')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
       
        {{-- Nombre --}}
        <label for="" class="form-label">Nombre Completo</label>
        <div class="input-group mb-3">
            <input type="text" style="width:90%" title="Ingrese su nombre completo"   name="name" class="form-control @error('name') is-invalid @enderror"
                   value= "{{ $user->name }}"  autofocus maxLength="100">

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Username --}}
        <label for="" class="form-label">Nombre de Usuario</label>
        <div class="input-group mb-3">
            <input type="text" style="width:90%" title="Ingrese un  username" name="username" class="form-control @error('username') is-invalid @enderror"
            value= "{{ $user->username }}"  autofocus maxLength="25">

            @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- correo electronico --}}
        <label for="" class="form-label">Correo Electrónico</label>
        <div class="input-group mb-3">
            <input type="text" style="width:90%" title="Ingrese el correo electrónico" name="correo" class="form-control @error('correo') is-invalid @enderror"
            value= "{{ $user->correo }}" autofocus maxLength="100">

            @error('correo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- identidad --}}
        <label for="" class="form-label">Número de Identidad</label>
        <div class="input-group mb-3">
            <input type="text" style="width:90%"   maxlength="15" pattern="[0-9]{4}-[0-9]{4}-[0-9]{5}" title="Ingresar número de Identidad separado por guiones"  name="identidad" class="form-control @error('identidad') is-invalid @enderror" 
            value= "{{ $user->identidad }}" autofocus maxLength="100" placeholder="0000-0000-00000" 
            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">

            @error('identidad')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- fecha nacimiento --}}
        <label for="" class="form-label">Fecha de Nacimiento</label>
        <div class="input-group mb-3">
            <input type="text" style="width:90%" title="Ingrese su fecha de nacimiento" name="nacimiento" class="form-control @error('nacimiento') is-invalid @enderror" id="nacimiento"
            value= "{{ $user->nacimiento }}"  autofocus>

            @error('nacimiento')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- telefono --}}
        <label for="" class="form-label">Número Teléfonico</label>
        <div class="input-group mb-3">
            <input type="text" style="width:90%" title="Ingrese el número teléfonico" name="telefono" class="form-control @error('telefono') is-invalid @enderror" 
            value= "{{ $user->telefono }}" autofocus maxLength="9" placeholder="0000-0000"
            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">

            @error('telefono')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        
        <br>

        {{-- Register button --}}
        <button type="submit"  class="btn btn-primary"   >
            <span class="fas fa-user-plus"></span>
            Guardar Datos
        </button>
      
        <a type="button" class="btn btn-danger" href="/listausuarios"  ><i class="fa fa-times" aria-hidden="true"></i>
           Cancelar
        </a>
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


    <script>
        window.addEventListener('load',function(){
            document.getElementById('nacimiento').type= 'text';
            document.getElementById('nacimiento').addEventListener('blur',function(){
                document.getElementById('nacimiento').type= 'text';
            });
            document.getElementById('nacimiento').addEventListener('focus',function(){
                document.getElementById('nacimiento').type= 'date';
            });
        });
    </script>

@stop