@extends('layouts.madre')

@section('title', 'Propietario')


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
<nav class="main-header navbar
    navbar-expand
    navbar-white navbar-light">

    <a class="nav-link" data-widget="pushmenu" href="#" data-enable-remember="true"style="color: black">
        <i class="fas fa-bars"></i>
        <span class="sr-only">Alternar barra de navegación</span>
    </a>  

  <h3>Propietarios</h3>
  </nav>

<div class="contrainer">
</div>
    <div align="right" style="float:right">
    <a href="propietario/create" title="Crear Registro" class="btn btn-outline-info"><i class='fas fa-file-medical'></i>  Crear</a>
    </div>

    
<br>
<br>
<br>
<table id="mitabla"  class = "table table-sm table-bordered ">
<thead  class="thead-dark">
<tr>

            <th style="font-size:15px;text-align:center; width:45px;"  scope="col">No</th>
            <th style="font-size:15px;text-align:center; width:135px;"   scope="col">Identidad</th>
            <th style="font-size:15px;text-align:center; width:250px;"  scope="col">Nombre Completo</th>
            <th style="font-size:15px;text-align:center; width:70px;"  scope="col">Telefono</th>
            <th style="font-size:15px;text-align:center; width:150px;"  scope="col">Correo</th>
            <th style="font-size:15px;text-align:center;width:125px;"  scope="col">Acciones</th>
            
        </tr>
    </thead>

    <tbody>
    @php $n=0; @endphp

        @foreach ($propietarios as  $propietario)
        <tr>
            
            <td class="align-middle" style="font-size:15px; text-align:right" scope="row">{{++ $n}}</td>
            <td class="align-middle" style="font-size:15px" >{{$propietario->identidad}}</td>
            <td class="align-middle" style="font-size:15px" >{{$propietario->nombre}}</td>
            <td class="align-middle" style="font-size:15px">{{$propietario->telefono}}</td>
            <td class="align-middle" style="font-size:15px">{{$propietario->correo}}</td>
           
            <td>
            <a type="button"  title="Editar registro" href="./propietario/{{$propietario->id}}/edit" class="btn btn-outline-info" >
                <i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                
                <button type="bottom"  onClick="borrar{{$propietario->id}}()" title="Eliminar registro" class="btn btn-outline-danger">
               <i class="fa fa-window-close" aria-hidden="true"></i></button>
                <form action="{{route ('propietario.destroy',$propietario->id)}}" method="POST" id="eliminar{{$propietario->id}}"> 
                
                @csrf
                @method('DELETE')       
               
               <script>
                function borrar{{$propietario->id}}(){
                    Swal.fire({
  title: 'Eliminar Propietario',
  text: '¿Desea eliminar al propietario seleccionado?',
  icon: 'error',
  showCancelButton: true,
  confirmButtonText: 'Si',
  cancelButtonText: `No`,
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.value) {
    document.getElementById('eliminar{{$propietario->id}}').submit();
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



