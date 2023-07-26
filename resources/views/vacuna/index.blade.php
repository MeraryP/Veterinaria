@extends('layouts.madre')

@section('title', 'Vacunas')

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
        }
        setTimeout(quitarerror, 3000);
    </script>
    <br>

    
    <div class="contrainer">
    </div>

    <br>
    <br>
    <div align="right" style="float:right">
        <a href="vacuna/create" title="Crear Registro" class="btn btn-outline-info"><i class='fas fa-file-medical'></i> Crear</a>
    </div>
    <br>
    <br>

    <table id="mitabla"  class = "table table-sm table-bordered ">
        <thead   style="width: 100%; border-collapse: collapse; background-color: #228B22; tabla color ">

            <tr>
                <th style="font-size:15px;text-align:center; width:45px;"  scope="col">No</th>
                
                <th style="font-size:15px;text-align:center; width:40px;"  scope="col">Vacuna</th>
                <th style="font-size:15px;text-align:center; width:40px;"  scope="col">Fecha de Aplicación </th>
      
                <th style="font-size:15px;text-align:center;width:125px;"  scope="col">Acciones</th>           
            </tr>
        </thead>

        <tbody>
            @php $n=0; @endphp
            @foreach ($vacunas as  $vacuna)
                <tr>
                    <td class="align-middle" style="font-size:15px; text-align:right" scope="row">{{++ $n}}</td>
                    <td class="align-middle" style="font-size:15px">{{$vacuna->num_id}}</td>
                    <td class="align-middle" style="font-size:15px">{{$vacuna->nombre_vacuna}}</td>
                    <td class="align-middle" style="font-size:15px">{{$vacuna->fecha_aplicada}}</td>
 
                    <td>
                        <a type="button"  title="Editar registro" href="./vacuna/{{$vacuna->id}}/edit" class="btn btn-outline-info" >
                            <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                        </a>
                            
                        <button type="bottom"  onClick="borrar{{$vacuna->id}}()" title="Eliminar registro" class="btn btn-outline-danger">
                            <i class="fa fa-window-close" aria-hidden="true"></i>
                        </button>

                        <form action="{{route ('vacuna.destroy',$vacuna->id)}}" method="POST" id="eliminar{{$vacuna->id}}"> 
                            @csrf
                            @method('DELETE')       
                        
                            <script>
                                function borrar{{$vacuna->id}}(){
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
                                            document.getElementById('eliminar{{$vacuna->id}}').submit();
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