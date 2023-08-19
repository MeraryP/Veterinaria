@extends('layouts.madre')

@section('title', 'Examen Físico de ' .App\Models\Paciente::find($idMascota)->nombre_mascota)

@section('content')

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a href= "/paciente/{{$idMascota}}/edit" class="nav-link">
                <div> 
                    <p style="text-align: center; margin-bottom: 0px; color:black;"><i class="nav-icon fas fa-file-alt" style="color:blue;margin-right: 5px;"></i>Datos generales</p>
                </div>
            </a>
        </li>

        <li class="nav-item" role="presentation">
            <a href="{{route('examenMascota', ['id'=>$idMascota])}}" class="nav-link">
                <div> 
                    <p style="text-align: center; margin-bottom: 0px; color:black;"><i class="fas fa-file-signature" style="color:green;margin-right: 5px;"></i>Examen Fisico</p>
                </div>
            </a>
        </li>

        <li class="nav-item" role="presentation">
            <a href="{{route('vacunaMascota', ['id'=>$idMascota])}}" class="nav-link">
                <div> 
     
                    <p style="text-align: center; margin-bottom: 0px; color:black;"><i class="nav-icon fas fa-syringe" style="color:orange;margin-right: 5px;"></i>Vacuna</p>
                </div>
            </a>
        </li>

        <li class="nav-item" role="presentation">
            <a href="{{route('desparacitacionMascota', ['id'=>$idMascota])}}" class="nav-link">
                <div> 
                    <p style="text-align: center; margin-bottom: 0px; color:black;"><i class="nav-icon fa fa-capsules" style="color:purple;margin-right: 5px;"></i>Desparacitación</p>
                </div>
            </a>
        </li>

        <li class="nav-item" role="presentation">
            <a href="{{route('clinicoMascota', ['id'=>$idMascota])}}" class="nav-link">
                <div> 
                    <p style="text-align: center; margin-bottom: 0px; color:black;"><i class="fa fa-stethoscope" style="color:red;margin-right: 5px;"></i>Examen Clínico</p>
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

    <div align="right" style="float:right">
        <a href="{{route('paciente.examen.nuevo', ['id' => $idMascota])}}" title="Crear Registro" class="btn btn-outline-primary"><i class='fas fa-file-medical'></i>  Crear</a>
    </div>
    <br>
    <br>
  

    <table id="mitabla"  class = "table table-sm table-bordered " style="margin: 0 auto; width: 100%; text-align: center; ">
        <thead  style="width: 100%; border-collapse: collapse; background-color:LightBlue; tabla color ">
            <tr>
                <th style="font-size:15px;text-align:center; width:0px;"  scope="col">No</th>
                <th style="font-size:15px;text-align:center; width:0px;"  scope="col">Temperatura °C</th>
                <th style="font-size:15px;text-align:center; width:0px;"  scope="col">F.C /minuto</th>
                <th style="font-size:15px;text-align:center; width:0px;"  scope="col">F.R /minuto</th>
                <th style="font-size:15px;text-align:center; width:0px;"  scope="col">Peso Kg</th>
                <th style="font-size:15px;text-align:center; width:0px;"  scope="col">Pulso /minuto</th>

                <th style="font-size:15px;text-align:center;width:0px;"  scope="col">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @php $n=0; @endphp

            @foreach ($examens as  $examen)
                <tr>
                    <td class="align-middle" style="font-size:15px; text-align:center" scope="row">{{++ $n}}</td>
                    <td class="align-middle" style="font-size:15px" >{{$examen->temperatura}}</td>
                    <td class="align-middle" style="font-size:15px" >{{$examen->frecuencia_cardiaca}}</td>
                    <td class="align-middle" style="font-size:15px">{{$examen->frecuencia_respiratoria}}</td>
                    <td class="align-middle" style="font-size:15px">{{$examen->peso}}</td>
                    <td class="align-middle" style="font-size:15px">{{$examen->pulso}}</td>
                    
                    <td>
                        <a type="button"  title="Editar registro" href="/examen/{{$examen->id}}/edit" class="btn btn-outline-success" style="margin-left: 10px;margin-right: 20px;">
                            <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                        </a>
                            
                        <button type="bottom"  onClick="borrar{{$examen->id}}()" title="Eliminar registro" class="btn btn-outline-danger">
                            <i class="fa fa-window-close" aria-hidden="true"></i>
                        </button>
                        
                        <form action="{{route ('examen.destroy',$examen->id)}}" method="POST" id="eliminar{{$examen->id}}"> 
                        
                            @csrf
                            @method('DELETE')       
                    
                            <script>
                                function borrar{{$examen->id}}(){
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
                                            document.getElementById('eliminar{{$examen->id}}').submit();
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