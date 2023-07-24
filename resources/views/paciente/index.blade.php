@extends('layouts.madre')

@section('title', 'Mascota')


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
<br>




<div class="contrainer">
</div>
    <div align="right" style="float:right">
    <a href="paciente/create" title="Crear Registro" class="btn btn-outline-info"><i class='fas fa-file-medical'></i>  Crear</a>

</div>

    
<br>
<br>
<br>

<table id="mitabla"  class = "table table-sm table-bordered ">
<thead  class="thead-dark">

<tr>

            <th style="font-size:15px;text-align:center; width:45px;"  scope="col">No</th>
            <th style="font-size:15px;text-align:center; width:100px;"  scope="col">Nombre de la Mascota</th>
            <th style="font-size:15px;text-align:center; width:100px;"  scope="col">Especie</th>
            <th style="font-size:15px;text-align:center; width:100px;"  scope="col">Raza</th>
            <th style="font-size:15px;text-align:center; width:100px;"  scope="col">Edad</th>
            <th style="font-size:15px;text-align:center;width:125px;"  scope="col">Acciones</th>
            
        </tr>
    </thead>

    <tbody>
    @php $n=0; @endphp

        @foreach ($pacientes as  $paciente)
        <tr>
            
            <td class="align-middle" style="font-size:15px; text-align:right" scope="row">{{++ $n}}</td>
            <td class="align-middle" style="font-size:15px" >{{$paciente->nombre_mascota}}</td>
            <td class="align-middle" style="font-size:15px" >{{$paciente->especie}}</td>
            <td class="align-middle" style="font-size:15px">{{$paciente->raza}}</td>
            <td class="align-middle" style="font-size:15px" >{{$paciente->edad}}</td>
            <td>
            <a type="button"  title="Editar registro" href="./paciente/{{$paciente->id}}/edit" class="btn btn-outline-info" >
                <i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                
                <button type="bottom"  onClick="borrar{{$paciente->id}}()" title="Eliminar registro" class="btn btn-outline-danger">
               <i class="fa fa-window-close" aria-hidden="true"></i></button>
                <form action="{{route ('paciente.destroy',$paciente->id)}}" method="POST" id="eliminar{{$paciente->id}}"> 
                
                @csrf
                @method('DELETE')       
               
               <script>
                function borrar{{$paciente->id}}(){
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
    document.getElementById('eliminar{{$paciente->id}}').submit();
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