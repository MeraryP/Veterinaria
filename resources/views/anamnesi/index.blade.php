@extends('layouts.madre')

@section('title', 'Anamnesis')


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
    <a href="anamnesi/create" title="Crear Registro" class="btn btn-info"><i class='fas fa-file-medical'></i>  Crear</a>
    </div>
<br>
<br>
<br>
<table id="mitabla"  class = "table table-sm table-bordered ">
<thead  class="thead-dark">

<tr>

            <th style="font-size:15px;text-align:center; width:45px;"  scope="col">No</th>
            <th style="font-size:15px;text-align:center; width:135px;" scope="col">Tiempo_enfermedad</th>
            <th style="font-size:15px;text-align:center; width:100px;" scope="col">Función_organos</th>
            <th style="font-size:15px;text-align:center; width:40px;"  scope="col">Causas_posibles</th>
            <th style="font-size:15px;text-align:center; width:40px;"  scope="col">Tratamiento</th>
            <th style="font-size:15px;text-align:center; width:40px;"  scope="col">Vacuna</th>
           


            <th style="font-size:15px;text-align:center;width:125px;"  scope="col">Acciones</th>
            
        </tr>
    </thead>

    <tbody>
    @php $n=0; @endphp

        @foreach ($anamnesis as  $anamnesi)
        <tr>
            
        

            <td class="align-middle" style="font-size:15px; text-align:right" scope="row">{{++ $n}}</td>
            <td class="align-middle" style="font-size:15px" >{{$anamnesi->tiempo_enfermedad}}</td>
            <td class="align-middle" style="font-size:15px">{{$anamnesi->funcion_organos}}</td>
            <td class="align-middle" style="font-size:15px">{{$anamnesi->causas_posibles}}</td>
            <td class="align-middle" style="font-size:15px">{{$anamnesi->tratamiento}}</td>
            <td class="align-middle" style="font-size:15px">{{$anamnesi->vacuna}}</td>
          
           

            <td>
            <a type="button"  title="Editar registro" href="./anamnesi/{{$anamnesi->id}}/edit" class="btn btn-info" >
                <i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                
                <button type="bottom"  onClick="borrar{{$anamnesi->id}}()" title="Eliminar registro" class="btn btn-danger">
               <i class="fa fa-window-close" aria-hidden="true"></i></button>
                <form action="{{route ('anamnesi.destroy',$anamnesi->id)}}" method="POST" id="eliminar{{$anamnesi->id}}"> 
                
                @csrf
                @method('DELETE')       
               
               <script>
                function borrar{{$anamnesi->id}}(){
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
    document.getElementById('eliminar{{$anamnesi->id}}').submit();
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