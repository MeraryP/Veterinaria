@extends('layouts.madre')

@section('title', 'Desparacitar')

@section('content')
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a href="../paciente.edit" class="nav-link">
                <div> 
                    <p style="text-align: center; margin-bottom: 0px;"><i class="nav-icon fas fa-file-alt" style="margin-right: 5px;"></i>Datos generales</p>
                </div>
            </a>
        </li>

        <li class="nav-item" role="presentation">
            <a href="{{ route('vacuna.index') }}" class="nav-link">
                <div> 
                    <p style="text-align: center; margin-bottom: 0px;"><i class="nav-icon fas fa-syringe" style="margin-right: 5px;"></i>Vacuna</p>
                </div>
            </a>
        </li>

        <li class="nav-item" role="presentation">
            <a href="{{ route('desparacitar.index') }}"class="nav-link">
                <div> 
                    <p style="text-align: center; margin-bottom: 0px;"><i class="nav-icon fa fa-capsules" style="margin-right: 5px;"></i>Desparacitación</p>
                </div>
            </a>
        </li>

        <li class="nav-item" role="presentation">
            <a href="{{ route('examen.index') }}"class="nav-link">
                <div> 
                    <p style="text-align: center; margin-bottom: 0px;"><i class="fas fa-file-signature" style="margin-right: 5px;"></i>Examen Fisico</p>
                </div>
            </a>
        </li>
    </ul>

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


    
    <table class = "table table-sm table-bordered" style="margin: 0 auto; width: 100%; text-align: center; ">

        <thead style="width: 100%; border-collapse: collapse; background-color:pink; tabla color ">
            <tr>
                <th style="font-size:15px;text-align:center; width:45px;"  scope="col">No</th>
                <th style="font-size:15px; text-align:center" scope="col">Antiparacitario</th>
                <th style="font-size:15px; text-align:center" scope="col">Dosis</th>
                <th style="font-size:15px; text-align:center" scope="col">Fecha de desparasitar</th>
                <th style="font-size:15px; text-align:center" scope="col">Opciones</th>
            </tr>
        </thead>

        <tbody>
            @php $n=0; @endphp
            @foreach ($desparacitars as $desparacitar)
                <tr>
                    <td class="align-middle" style="font-size:15px; text-align:right" scope="row">{{++ $n}}</td>
                    <td class="align-middle" style="font-size:15px">{{$desparacitar->antiparacitario}}</td>
                    <td class="align-middle" style="font-size:15px">{{$desparacitar->dosis}}</td>
                    <td class="align-middle" style="font-size:15px">{{$desparacitar->fecha_desparacitacion}}</td>
                    
                    <td>
                    <a type="button"  title="Editar registro" href="./desparacitar/{{$desparacitar->id}}/edit" class="btn btn-outline-info" style="margin-left: 10px;margin-right: 20px;" >
                            <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                        </a>
                            
                        <button type="bottom"  onClick="borrar{{$desparacitar->id}}()" title="Eliminar registro" class="btn btn-outline-danger">
                            <i class="fa fa-window-close" aria-hidden="true"></i>
                        </button>

                        <form action="{{route ('desparacitar.destroy',$desparacitar->id)}}" method="POST" id="eliminar{{$desparacitar->id}}"> 
                            @csrf
                            @method('DELETE')       
                        
                            <script>
                                function borrar{{$desparacitar->id}}(){
                                    Swal.fire({
                                        title: 'Eliminar Registro',
                                        text: '¿Desea eliminar el registro seleccionado?',
                                        icon: 'error',
                                        showCancelButton: true,
                                        confirmButtonText: 'Si',
                                        cancelButtonText: `No`,
                                    }).then((result) => {
                                        /* Read more about isConfirmed, isDenied below */
                                        if (result.value) {
                                            document.getElementById('eliminar{{$desparacitar->id}}').submit();
                                        } else {   
                                        }
                                    })
                                }
                            </script>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection 