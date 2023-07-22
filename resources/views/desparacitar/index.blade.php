@extends('layouts.madre')

@section('title', 'Desparacitar')

@section('content')

    <script>
        var msg = '{{Session::get('mensaje')}}';
        var exist = '{{Session::has('mensaje')}}';
        if(exist){
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: msg,
                showConfirmButton: false,
                toast: true,
                background: '#0be004ab',
                timer: 3500
            })
        }
    </script>

    <script>
        function quitarerror(){
        const elements = document.getElementsByClassName('alert');
            while (elements[0]){
                elements[0].parentNode.removeChild(elements[0]);
            }
        }S
        setTimeout(quitarerror, 3000);
    </script>

    
    <nav class="main-header navbar
    navbar-expand
    navbar-white navbar-light">

    <a class="nav-link" data-widget="pushmenu" href="#" data-enable-remember="true"style="color: black">
        <i class="fas fa-bars"></i>
        <span class="sr-only">Alternar barra de navegación</span>
    </a>  

    <h3>Desparasitar</h3>
    </nav>

    <br>
        <div align="right">
            <a href="desparacitar/create" title="Crear registro" class="btn btn-outline-info">
                <i class='fas fa-file-medical'></i> Crear
            </a>
        </div>
    <br>


    <table class = "table table-sm table-bordered">

        <thead class="thead-dark"  >
            <tr>
                <th style="font-size:15px; text-align:center" scope="col">Antiparacitario</th>
                <th style="font-size:15px; text-align:center" scope="col">Fecha de desparacitacion</th>
                <th style="font-size:15px; text-align:center" scope="col">Fecha de volver Desparacitar</th>
                <th style="font-size:15px; text-align:center" scope="col">Opciones</th>
            </tr>
        </thead>

        <tbody>
            
            @foreach ($desparacitars as $desparacitar)
                <tr>
                    <td class="align-middle" style="font-size:15px">{{$desparacitar->antiparacitario}}</td>
                    <td class="align-middle" style="font-size:15px">{{$desparacitar->fecha_desparacitacion}}</td>
                    <td class="align-middle" style="font-size:15px">{{$desparacitar->fecha_volverDesparacitar}}</td>

                    <td>
                        <form action="{{route ('desparacitar.destroy',$desparacitar->id )}}" method="POST"> 
                        <a type="button" href="./desparacitar/{{$desparacitar->id}}/edit" class="btn btn-info" title="Editar">
                        <i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                        @csrf
                    
                        </form>
                    </td>
                </tr>
            
            @endforeach
        </tbody>
    </table>

@endsection 