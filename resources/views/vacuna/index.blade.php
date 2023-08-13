@extends('layouts.madre')

@section('title', 'Vacunas de ' .App\Models\Paciente::find($idMascota)->nombre_mascota)

@section('content')

<<<<<<< HEAD

 
<ul class="nav nav-tabs" id="myTab" role="tablist">
=======
    <ul class="nav nav-tabs" id="myTab" role="tablist">
>>>>>>> d6b8b1f5d96fe8ab90f4b981dbae36fa89dbecc8
        <li class="nav-item" role="presentation">
            <a href= "/paciente/{{$idMascota}}/edit" class="nav-link">
                <div> 
                    <p style="text-align: center; margin-bottom: 0px; color:black;"><i class="nav-icon fas fa-file-alt" style="margin-right: 5px;"></i>Datos generales</p>
                </div>
            </a>
        </li>

        <li class="nav-item" role="presentation">
            <a href="{{route('examenMascota', ['id'=>$idMascota])}}" class="nav-link">
                <div> 
                    <p style="text-align: center; margin-bottom: 0px; color:black;"><i class="fas fa-file-signature" style="margin-right: 5px;"></i>Examen Fisico</p>
                </div>
            </a>
        </li>

        <li class="nav-item" role="presentation">
            <a href="{{route('vacunaMascota', ['id'=>$idMascota])}}" class="nav-link">
                <div> 
     
                    <p style="text-align: center; margin-bottom: 0px; color:black;"><i class="nav-icon fas fa-syringe" style="margin-right: 5px;"></i>Vacuna</p>
                </div>
            </a>
        </li>

        <li class="nav-item" role="presentation">
            <a href="{{route('desparacitacionMascota', ['id'=>$idMascota])}}" class="nav-link">
                <div> 
                    <p style="text-align: center; margin-bottom: 0px; color:black;"><i class="nav-icon fa fa-capsules" style="margin-right: 5px;"></i>Desparacitación</p>
                </div>
            </a>
        </li>

    
        <li class="nav-item" role="presentation">
            <a href="{{route('clinicoMascota', ['id'=>$idMascota])}}" class="nav-link">
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
        <a href="{{route('paciente.vacuna.nuevo', ['id' => $idMascota])}}"  title="Crear Registro" class="btn btn-outline-info"><i class='fas fa-file-medical'></i> Crear</a>
    </div>
    <br>
    <br>

    <table id="mitabla"  class = "table table-sm table-bordered " style="margin: 0 auto; width: 100%; text-align: center; ">
        <thead   style="width: 100%; border-collapse: collapse; background-color:LightBlue; tabla color ">

            <tr>
                <th style="font-size:15px; text-align:center; width:45px;"  scope="col">No</th>
                <th style="font-size:15px; text-align:center" scope="col">Vacuna</th>
                <th style="font-size:15px; text-align:center" scope="col">Dosis</th>
                <th style="font-size:15px; text-align:center" scope="col">Fecha de aplicación </th>
                <th style="font-size:15px; text-align:center" scope="col">Estado </th>
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
                    <td class="align-middle" style="font-size:15px">{{$aplicado->dosis}} {{$aplicado->unidad}}</td>
                    <td class="align-middle" style="font-size:15px">{{$aplicado->fecha_aplicada}}</td>
                    <td class="align-middle" style="font-size:15px">{{ $aplicado->aplicada ? 'Aplicado' : 'Pendiente' }}</td>
<<<<<<< HEAD
        

=======
>>>>>>> d6b8b1f5d96fe8ab90f4b981dbae36fa89dbecc8
                    <td>
                        <a type="button"  title="Editar registro" href="/vacuna/{{$aplicado->id}}/edit" class="btn btn-outline-info" style="margin-left: 10px;margin-right: 20px;">
                            <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                        </a>
                            
                        <button type="bottom"  onClick= "borrar{{ $aplicado->id }}()"title="Eliminar registro" class="btn btn-outline-danger">
                            <i class="fa fa-window-close" aria-hidden="true"></i>
                        </button>

                        <form action="{{route ('vacuna.destroy',$aplicado->id)}}" method="POST" id="eliminar{{ $aplicado->id }}"> 
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