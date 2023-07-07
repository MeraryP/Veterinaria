@extends('layouts.madre')

@section('title', 'Resumen Semológico')


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
    <a href="resumen/create" title="Crear Registro" class="btn btn-info"><i class='fas fa-file-medical'></i>  Crear</a>
    </div>
<br>
<br>
<br>
<table id="mitabla"  class = "table table-sm table-bordered ">
<thead  class="thead-dark">

<tr>

            <th style="font-size:15px;text-align:center; width:0px;"  scope="col">No</th>
            <th style="font-size:15px;text-align:center; width:0px;"   scope="col">Diagnostico</th>
            <th style="font-size:15px;text-align:center; width:0px;"  scope="col">Indicaciones_medicas</th>
            <th style="font-size:15px;text-align:center; width:0px;"  scope="col">Evolucion_curso</th>
        

            <th style="font-size:15px;text-align:center;width:0px;"  scope="col">Acciones</th>
            
        </tr>
    </thead>

    <tbody>
    @php $n=0; @endphp

        @foreach ($resumenes as  $resumen)
        <tr>
            
            <td class="align-middle" style="font-size:15px; text-align:right" scope="row">{{++ $n}}</td>
            <td class="align-middle" style="font-size:15px" >{{$resumen->diagnostico}}</td>
            <td class="align-middle" style="font-size:15px" >{{$resumen->indicaciones_medicas}}</td>
            <td class="align-middle" style="font-size:15px">{{$resumen->evolucion_curso}}</td>
           
           

            <td>
            <a type="button"  title="Editar registro" href="./resumen/{{$resumen->id}}/edit" class="btn btn-info" >
                <i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                
                <button type="bottom"  onClick="borrar{{$resumen->id}}()" title="Eliminar registro" class="btn btn-danger">
               <i class="fa fa-window-close" aria-hidden="true"></i></button>
                <form action="{{route ('resumen.destroy',$resumen->id)}}" method="POST" id="eliminar{{$resumen->id}}"> 
                
                @csrf
                @method('DELETE')       
               
               <script>
                function borrar{{$resumen->id}}(){
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
    document.getElementById('eliminar{{$resumen->id}}').submit();
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