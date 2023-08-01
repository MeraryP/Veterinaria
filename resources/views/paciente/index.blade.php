@extends('layouts.madre')

@section('title', 'Maskotas')


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

<table id="mitabla"  class = "table table-sm table-bordered border-black" style="margin: 0 auto; width: 100%; text-align: center; ">
<thead style="width: 100%; border-collapse: collapse; background-color:pink; tabla color ">

<tr>

            <th style="font-size:15px;text-align:center; width:45px;"style="margin-left: 50px;margin-right: 20px;" scope="col">No</th>
            <th style="font-size:15px;text-align:center; width:100px;"  scope="col">Nombre del propietario</th>
            <th style="font-size:15px;text-align:center; width:100px;"  scope="col">Nombre de la Mascota</th>
            <th style="font-size:15px;text-align:center; width:100px;"  scope="col">Especie</th>
            <th style="font-size:15px;text-align:center; width:100px;"  scope="col">Raza</th>
            <th style="font-size:15px;text-align:center;width:100px;"  scope="col">Acciones</th>
            
        </tr>
    </thead>

    <tbody>
    @php $n=0; @endphp

        @foreach ($pacientes as  $paciente)
        <tr>
            
            <td class="align-middle" style="font-size:15px; text-align:center;" scope="row">{{++ $n}}</td>
            <td class="align-middle" style="font-size:15px;" >{{$paciente->propietario->nombre}}</td>
            <td class="align-middle" style="font-size:15px;" >{{$paciente->nombre_mascota}}</td>
            <td class="align-middle" style="font-size:15px;" >{{$paciente->especie->nombre_especie}}</td>
            <td class="align-middle" style="font-size:15px;">{{$paciente->raza}}</td>
         
            <td style="margin-left: 50px;margin-right: 30px;">
            <a type="button"  title="Editar registro" href="./paciente/{{$paciente->id}}/edit" class="btn btn-outline-info"style="margin-left: 10px;margin-right: 20px;" >
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