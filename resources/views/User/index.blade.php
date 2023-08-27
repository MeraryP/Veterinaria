@extends('layouts.madre')

@section('title', 'Usuarios')

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
    
    <div align="right" style="float:right">
        <a href="/registrar" title="Crear Registro" class="btn btn-outline-info"><i class='fas fa-file-medical'></i>  Crear</a>
    </div>
 
    
    <br>
    <br>

    <table id="mitabla"  class = "table table-sm table-bordered " style="margin: 0 auto; width: 100%; text-align: center; ">
        <thead   style="width: 100%; border-collapse: collapse; background-color:LightBlue; tabla color ">
            <tr>
                <th style="font-size:15px;text-align:center;  width:45px;" scope="col">No</th>
                <th style="font-size:15px;text-align:center; width:135px;" scope="col">Identidad</th>
                <th style="font-size:15px;text-align:center; width:250px;" scope="col">Nombre Completo</th>
                <th style="font-size:15px;text-align:center;  width:70px;" scope="col">Teléfono</th>
                <th style="font-size:15px;text-align:center; width:150px;" scope="col">Correo</th>
                <th style="font-size:15px;text-align:center; width:125px;" scope="col">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @php $n=0; @endphp
            @foreach ($usuarios as $m=>$users)
                <tr>
                    <td class="align-middle" style="font-size:15px; text-align:center" scope="row">{{++ $n}}</td>
                    <td class="align-middle" style="font-size:15px">{{$users->identidad}}</td>
                    <td class="align-middle" style="font-size:15px">{{$users->name}}</td>
                    <td class="align-middle" style="font-size:15px">{{$users->telefono}}</td>
                    <td class="align-middle" style="font-size:15px">{{$users->correo}}</td>
                    <td>
                        <div align="center">
                            @if($users->estado == 1)
                        
                                <a type="button" style="margin-left: 10px;margin-right: 20px;" title="Editar registro" href=" /usuario/{{$users->id}}/edit"class="btn btn-outline-info" >
                                    <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                                </a>

                                <button type="bottom"  onClick="desactivar{{$users->id}}()" title="Desactivar Usuario " class="btn btn-outline-success">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </button>

                                <form action="{{route('user.desactivar',['id'=>$users->id])}}"  id="desac{{$users->id}}">     
                                    

                                    <script>
                                        function desactivar{{$users->id}}(){
                                            Swal.fire({
                                                title: 'Desactivar Usuario',
                                                text: '¿Desea desactivar al usuario seleccionado?',
                                                icon: 'question',
                                                showCancelButton: true,
                                                confirmButtonText: 'Si',
                                                cancelButtonText: `No`,
                                            }).then((result) => {
                                                /* Read more about isConfirmed, isDenied below */
                                                if (result.value) {
                                                    document.getElementById('desac{{$users->id}}').submit();
                                                } else {
                                                    
                                                }
                                            })
                                        }
                                    </script>
                                </form>
                            @else
                                    
                                <button type="bottom"style="margin-left: 10px;margin-right: 20px;"   onClick="activar{{$users->id}}()" title="Activar Usuario " class="btn btn-outline-primary">
                                    <i class="fa fa-eye-slash" aria-hidden="true"></i> 
                                </button>
                                
                                <form action="{{route('user.activar',['id'=>$users->id])}}"  id="act{{$users->id}}">
                                    <script>
                                        function activar{{$users->id}}(){
                                            Swal.fire({
                                                title: 'Activar Usuario',
                                                text: '¿Desea activar al usuario seleccionado?',
                                                icon: 'question',
                                                showCancelButton: true,
                                                confirmButtonText: 'Si',
                                                cancelButtonText: `No`,
                                            }).then((result) => {
                                                /* Read more about isConfirmed, isDenied below */
                                                if (result.value) {
                                                    document.getElementById('act{{$users->id}}').submit();
                                                } else {
                                                    
                                                }
                                            })
                                        }
                                    </script>
                                </form>
                            @endif               
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$usuarios->links()}}
@stop