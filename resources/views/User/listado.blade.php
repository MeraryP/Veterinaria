@extends('layouts.madre')

@section('title', 'Listado de usuario')

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

<div align="right" style="float:right">
    <a href="./registrar"  class="btn btn-primary"><i class="fa fa-file" aria-hidden="true"></i> Crear Usuario</a>
    </div>
    <br>
    <br>
<table class = "table table-sm table-bordered">
<thead class="thead-dark">
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nombre</th>
            <th scope="col">Usuario</th>
            <th scope="col">Fecha de Nacimiento</th>
            <th scope="col">Correo electronico</th>
            <th scope="col">Telefono</th>
            <th scope="col">Identidad</th>
            
            
            <th scope="col">Acciones</th>
            
        </tr>
    </thead>

    <tbody>
        @foreach ($usuarios as $m=>$users)
        <tr>
            <th scope="row">{{++$m + ($usuarios->perPage()*($usuarios->currentPage()-1))}}</th>
            <td>{{$users->name}}</td>
            <td>{{$users->username}}</td>
            <td>{{$users->nacimiento}}</td>
            <td>{{$users->correo}}</td>
            <td>{{$users->telefono}}</td>
            <td>{{$users->identidad}}</td>
           
           

            <td>
                @if($users->estado == 0)
                    <a type="button" href="{{route('user.desactivar',['id'=>$users->id])}}" class="btn btn-danger">
                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                    </a>
                @else
                    <a type="button" href="{{route('user.activar',['id'=>$users->id])}}" class="btn btn-success">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                    </a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{$usuarios->links()}}
@stop