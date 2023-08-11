@extends('layouts.madre')

@section('title', 'Vacunas')

@section('content')


    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a href="{{ URL::previous() }}" class="nav-link">
                <div> 
                    <p style="text-align: center; margin-bottom: 0px; color:black;"><i class="nav-icon fas fa-file-alt" style="margin-right: 5px;"></i>Datos generales</p>
                </div>
            </a>
        </li>

        <li class="nav-item" role="presentation">
            <a href=""class="nav-link">
                <div> 
                    <p style="text-align: center; margin-bottom: 0px; color:black;"><i class="fas fa-file-signature" style="margin-right: 5px;"></i>Examen Fisico</p>
                </div>
            </a>
        </li>

        <li class="nav-item" role="presentation">
            <a href="{{ route('vacuna.index', ['id' => $paciente->id]) }}" class="nav-link">
                <div> 
                    <p style="text-align: center; margin-bottom: 0px; color:black;"><i class="nav-icon fas fa-syringe" style="margin-right: 5px;"></i>Vacuna</p>
                </div>
            </a>
        </li>

        <li class="nav-item" role="presentation">
            <a href=""class="nav-link">
                <div> 
                    <p style="text-align: center; margin-bottom: 0px; color:black;"><i class="nav-icon fa fa-capsules" style="margin-right: 5px;"></i>Desparacitación</p>
                </div>
            </a>
        </li>

    
        <li class="nav-item" role="presentation">
            <a href="{{ route('clinico.index') }}"class="nav-link">
                <div> 
                    <p style="text-align: center; margin-bottom: 0px; color:black;"><i class="fa fa-stethoscope" style="margin-right: 5px;"></i>Examen Clínico</p>
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
        }
        setTimeout(quitarerror, 3000);
    </script>
    <br>

    
    <div class="contrainer">
    </div>

    <br>
    <div align="right" style="float:right">
        <a href="{{ route('vacuna.create', ['id' => $paciente->id]) }}" title="Crear Registro" class="btn btn-outline-info"><i class='fas fa-file-medical'></i> Crear</a>
    </div>
    <br>
    <br>

    <table id="mitabla"  class = "table table-sm table-bordered " style="margin: 0 auto; width: 100%; text-align: center; ">
        <thead   style="width: 100%; border-collapse: collapse; background-color:LightBlue; tabla color ">

            <tr>
                <th style="font-size:15px; text-align:center; width:45px;"  scope="col">No</th>
                <th style="font-size:15px; text-align:center" scope="col">Vacuna</th>
                <th style="font-size:15px; text-align:center" scope="col">Fecha de aplicación </th>
                <th style="font-size:15px; text-align:center" scope="col">Aplicada </th>
                <th style="font-size:15px; text-align:center" scope="col">Acciones</th>           
            </tr>
        </thead>

        <tbody>
            @php $n=0; @endphp
            @foreach ($aplicados as  $aplicado)

            @if($aplicado->medicamento->categoria->nombre_cate === 'Vacuna') 
                <tr>
                    <td class="align-middle" style="font-size:15px; text-align:center" scope="row">{{++ $n}}</td>
                    
                    <td class="align-middle" style="font-size:15px">{{$aplicado->medicamento->nombre_medicamento}}</td>
                    <td class="align-middle" style="font-size:15px">{{$aplicado->fecha_aplicada}}</td>
                    <td class="align-middle" style="font-size:15px">{{ $aplicado->aplicada ? 'Sí' : 'No' }}</td>
        

                    <td>
                        <a type="button"  title="Editar registro" href="./vacuna/{{$aplicado->id}}/edit" class="btn btn-outline-info" style="margin-left: 10px;margin-right: 20px;">
                            <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                        </a>
                            
                        <button type="bottom"  onClick= "borrar{{ $aplicado->id }}()"title="Eliminar registro" class="btn btn-outline-danger">
                            <i class="fa fa-window-close" aria-hidden="true"></i>
                        </button>

                        <form action="{{ route('vacuna.destroy', ['id' => $paciente->id, 'vacuna' => $aplicado->id]) }}"method="POST" id="eliminar{{ $aplicado->id }}"> 
                            @csrf
                            @method('DELETE')       
                        
                            <script>
                                function borrar{{ $aplicado->id }}(){
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
                                            document.getElementById('eliminar{{ $aplicado->id }}').submit();
                                        } else {   
                                        }
                                    })
                                }
                            </script>
                        </form>
                    </td>
                </tr>
                @endif 
            @endforeach
        </tbody>
    </table>
@endsection 