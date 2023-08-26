@extends('layouts.madre')

@section('title', 'Examen Clínico de ' .App\Models\Paciente::find($idMascota)->nombre_mascota)

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
                    <p style="text-align: center; margin-bottom: 0px; color:black;"><i class="fas fa-file-signature" style="color:green;margin-right: 5px;"></i>Examen Físico</p>
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
        <a href="{{route('paciente.clinico.nuevo', ['id' => $idMascota])}}" title="Crear Registro" class="btn btn-outline-primary"><i class='fas fa-file-medical'></i> Crear</a>
    </div>
    <br>
    <br>

    <table id="mitabla"  class = "table table-sm table-bordered " style="margin: 0 auto; width: 100%; text-align: center; ">
        <thead   style="width: 100%; border-collapse: collapse; background-color:LightBlue; tabla color ">
            <tr>
                <th style="font-size:15px; text-align:center; width:45px;"  scope="col">No</th>
                <th style="font-size:15px; text-align:center;" scope="col">Sintomas</th>
                <th style="font-size:15px; text-align:center;" scope="col">Enfermedad Diagnosticada</th>
                <th style="font-size:15px; text-align:center;" scope="col">Tratamiento </th>
                <th style="font-size:15px; text-align:center; width:130px" scope="col">Acciones</th>           
            </tr>
        </thead>
     
      

        <tbody>
            @php $n=0; @endphp
            @foreach ($clinicos as  $clinico)
                <tr>
                    <td class="align-middle" style="font-size:15px; text-align:center" scope="row">{{++ $n}}</td>
                    <td class="align-middle" style='width: 200px; white-space: initial;font-size:13px;text-align: center' >{{$clinico->sintomas}}</td>
                    <td class="align-middle" style='width: 200px; white-space: initial;font-size:13px;text-align: center'>{{$clinico->enfermedad}}</td>
                    <td class="align-middle" style='width: 200px; white-space: initial;font-size:13px;text-align: justify'>{{$clinico->tratamiento}}</td>
 
                    <td>
                        <a type="button"  title="Editar registro" href="/clinico/{{$clinico->id}}/edit" class="btn btn-outline-success" style="margin-left: 10px;margin-right: 20px;">
                            <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                        </a>
                            
                        <button type="bottom"  onClick="borrar{{$clinico->id}}()" title="Eliminar registro" class="btn btn-outline-danger">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>

                        <form action="{{route ('clinico.destroy',$clinico->id)}}"   method="POST" id="eliminar{{$clinico->id}}"> 
                            @csrf
                            @method('DELETE')       
                        
                            <script>
                                function borrar{{$clinico->id}}(){
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
                                            document.getElementById('eliminar{{$clinico->id}}').submit();
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
    <br>
    <br>
@endsection 