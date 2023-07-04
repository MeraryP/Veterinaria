@extends('layouts.madre')

@section('title', 'Crear Usuario')

@section('content')
<br>
<br>
<form action="" method="post">
        @csrf

        {{-- Nombre --}}
        <label for="" class="form-label">Nombre completo</label>
        <div class="input-group mb-3">
            <input type="text" style="width:90%" name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name') }}" placeholder="Nombre completo" autofocus maxLength="100">


            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Username --}}
        <label for="" class="form-label">Nombre de usuario</label>
        <div class="input-group mb-3">
            <input type="text" style="width:90%" name="username" class="form-control @error('username') is-invalid @enderror"
                   value="{{ old('username') }}" placeholder="Usuario" autofocus maxLength="25">

            

            @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- correo electronico --}}
        <label for="" class="form-label">Correo electronico</label>
        <div class="input-group mb-3">
            <input type="email" style="width:90%" name="correo" class="form-control @error('correo') is-invalid @enderror"
                   value="{{ old('correo') }}" placeholder="correo electronico" autofocus maxLength="100">

            @error('correo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- identidad --}}
        <label for="" class="form-label">Número de identidad</label>
        <div class="input-group mb-3">
            <input type="text" style="width:90%" maxlength="15" pattern="[0-9]{4}-[0-9]{4}-[0-9]{5}" title="Ingresar número de Identidad separado por guiones"  name="identidad" class="form-control @error('identidad') is-invalid @enderror" 
            value="{{ old('identidad') }}" placeholder="Identidad" autofocus maxLength="100"
            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">

            

            @error('identidad')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- fecha nacimiento --}}
        <label for="" class="form-label">Fecha de nacimiento</label>
        <div class="input-group mb-3">
            <input type="text" style="width:90%" name="nacimiento" class="form-control @error('nacimiento') is-invalid @enderror" id="nacimiento"
                   value="{{ old('nacimiento') }}" placeholder="Fecha de Nacimiento" autofocus>

            

            @error('nacimiento')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        

        {{-- telefono --}}
        <label for="" class="form-label">Número telefonico</label>
        <div class="input-group mb-3">
            <input type="text" style="width:90%" name="telefono" class="form-control @error('telefono') is-invalid @enderror" 
            value="{{ old('telefono') }}" placeholder="teléfono" autofocus maxLength="8"
            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">

            

            @error('telefono')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Rols --}}
        <label for="" class="form-label">Cargo</label>
        <div class="input-group mb-3">
       
            <select name="rol" id="rol" class="form-control @error('rol') is-invalid @enderror">
                @if(old('rol'))
                    <option value="{{old('rol')}}" style="display:none">{{old('rol')}}</option>
                @else
                    <option value="" style="display:none">Seleccione el cargo</option>
                @endif
                @foreach($roles as $r)
                    <option value="{{$r->name}}">{{$r->name}}</option>
                @endforeach
            </select>

            

            @error('rol')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Password field --}}
        <label for="" class="form-label">Contraseña</label>
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   placeholder="Contraseña">

           

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Confirm password field --}}
        <label for="" class="form-label">Confirmar Contraseña</label>
        <div class="input-group mb-3">
            <input type="password" name="password_confirmation"
                   class="form-control @error('password_confirmation') is-invalid @enderror"
                   placeholder="{{ __('adminlte::adminlte.retype_password') }}">

            

            @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <br>

        {{-- Register button --}}
        <button type="submit"  class="btn btn-primary" >
            <span class="fas fa-user-plus"></span>
            Guardar datos
        </button>
      
        <a type="button" class="btn btn-danger" href="/listadousuario"  ><i class="fa fa-times" aria-hidden="true"></i>
           Cancelar
        </a>
<br>
<br>
    </form>

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