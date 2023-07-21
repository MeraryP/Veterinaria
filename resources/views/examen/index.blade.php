@extends('layouts.madre')

@section('title', 'Examen Físico')


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
    <a href="examen/create" title="Crear Registro" class="btn btn-outline-info"><i class='fas fa-file-medical'></i>  Crear</a>
    </div>
<br>
<br>
<br>
<table id="mitabla"  class = "table table-sm table-bordered ">
<thead  class="thead-dark">

<tr>


            <th style="font-size:15px;text-align:center; width:0px;"  scope="col">No</th>
            <th style="font-size:15px;text-align:center; width:0px;"  scope="col">Temperatura</th>
            <th style="font-size:15px;text-align:center; width:0px;"  scope="col">Frecuencia Cardíaca</th>
            <th style="font-size:15px;text-align:center; width:0px;"  scope="col">Frecuencia Respiratoria</th>
            <th style="font-size:15px;text-align:center; width:0px;"  scope="col">Peso</th>
            <th style="font-size:15px;text-align:center; width:0px;"  scope="col">Pulso</th>
            <th style="font-size:15px;text-align:center; width:0px;"  scope="col">Gastrointestal</th>
            <th style="font-size:15px;text-align:center; width:0px;"  scope="col">Tratamiento</th>

            <th style="font-size:15px;text-align:center;width:0px;"  scope="col">Acciones</th>
            
        </tr>
    </thead>

    <tbody>
    @php $n=0; @endphp

        @foreach ($examens as  $examen)
        <tr>
            

            <td class="align-middle" style="font-size:15px; text-align:right" scope="row">{{++ $n}}</td>
            <td class="align-middle" style="font-size:15px" >{{$examen->temperatura}}</td>
            <td class="align-middle" style="font-size:15px" >{{$examen->frecuencia_cardiaca}}</td>
            <td class="align-middle" style="font-size:15px">{{$examen->frecuencia_respiratoria}}</td>
            <td class="align-middle" style="font-size:15px">{{$examen->peso}}</td>
            <td class="align-middle" style="font-size:15px">{{$examen->pulso}}</td>
            <td class="align-middle" style="font-size:15px">{{$examen->gastrointestal}}</td>
            <td class="align-middle" style="font-size:15px">{{$examen->tratamiento}}</td>
           
           

            <td>
            <a type="button"  title="Editar registro" href="./examen/{{$examen->id}}/edit" class="btn btn-info" >
                <i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                
                <button type="bottom"  onClick="borrar{{$examen->id}}()" title="Eliminar registro" class="btn btn-danger">
               <i class="fa fa-window-close" aria-hidden="true"></i></button>
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