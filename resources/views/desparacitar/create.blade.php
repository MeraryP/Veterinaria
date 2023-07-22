@extends('layouts.madre')

@section('title', 'Desparasitar')

@section('content')

<nav class="main-header navbar
    navbar-expand
    navbar-white navbar-light">

    <a class="nav-link" data-widget="pushmenu" href="#" data-enable-remember="true"style="color: black">
        <i class="fas fa-bars"></i>
        <span class="sr-only">Alternar barra de navegación</span>
    </a>  

  <h3>Desparasitante</h3>
  </nav>


    <form action ="../desparacitar"  method="POST">
    
        @csrf
        <br>
        <div class="mb-3">
            <label for="" class="form-label">Antiparacitario</label>
            <input type="text" value="{{old('antiparacitario')}}"  name="antiparacitario" id="antiparacitario"  class="form-control @error('antiparacitario') is-invalid @enderror"  tabindex="1"
            title="Antiparacitario">

            @error('antiparacitario')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Fecha de desparacitacion</label>
            <input type="date" value="{{old('fecha_desparacitacion')}}"  name="fecha_desparacitacion" id="fecha_desparacitacion"  class="form-control @error('fecha_desparacitacion') is-invalid @enderror"  tabindex="1"
            title="fecha desparacitacion">

            @error('fecha_desparacitacion')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
        </div>
        
        <div class="mb-3">
            <label for="" class="form-label">Fecha de volver Desparacitar</label>
            <input type="date" value="{{old('fecha_volverDesparacitar')}}"  name="fecha_volverDesparacitar" id="fecha_volverDesparacitar"  class="form-control @error('fecha_volverDesparacitar') is-invalid @enderror"  tabindex="1"
            title="Fecha volver Desparacitar">

            @error('fecha_volverDesparacitar')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
        </div>

        <button type="submit" class="btn btn-outline-success" tabindex="4"><span class="fas fa-user-plus"></span>Guardar</button>
        <a href="/desparacitar" class="btn btn-outline-danger" tabindex="5"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>


    </form>

@endsection