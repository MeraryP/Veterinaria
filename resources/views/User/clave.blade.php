@extends('layouts.madre')

@section('title', 'Cambiar contraseña')

@section('content')

    <style>
        .form-control{
            border-top-left-radius: 5px !important;
            border-bottom-left-radius: 5px !important;
            border-top-right-radius: 5px !important;
            border-bottom-right-radius: 5px !important;
            padding-left: 5px !important;
        }
    </style>

    <form action="" method="post">
         @csrf

        <center><h4></h4></center>
        <br>
        
        <div class="input-group mb-3">
            <label for="" style="width:15%">Contraseña Actual:</label>
            <input type="password" name="viejapassword" class="form-control @error('viejapassword') is-invalid @enderror" placeholder="Ingresar la contraseña actual">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('viejapassword')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        {{-- Password field --}}
        <div class="input-group mb-3">
            <label for="" style="width:15%">Contraseña Nueva:</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Ingresar la contraseña nueva">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Confirm password field --}}
        <div class="input-group mb-3">
            <label for="" style="width:15%">Confirmar Contraseña:</label>
            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder=" Confirme la contraseña nueva">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Register button --}}
        <div style="align-items: center; justify-content: center; display: flex;">
            <button type="submit"  class="btn btn-outline-success " style="margin-right: 60px;">
                <span class="fas fa-user-plus"></span>
                Guardar cambios
            </button>
            
            <a type="button" class="btn btn-outline-danger" href="./usuario"><i class="fa fa-times" aria-hidden="true"></i>
                Cancelar
            </a>
        </div>
        
    </form>
@stop