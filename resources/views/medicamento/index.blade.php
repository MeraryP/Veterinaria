@extends('layouts.madre')

@section('title', 'Medicamentos')


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

  <h3>Medicamentos</h3>
  </nav>

<div class="contrainer">
</div>
    <div align="right" style="float:right">
    <a href="medicamento/create" title="Crear Registro" class="btn btn-outline-info"><i class='fas fa-file-medical'></i>  Crear</a>
    </div>
<br>
<br>
<br>
<table id="mitabla"  class = "table table-sm table-bordered " style="margin: 0 auto; width: 100%; text-align: center; ">
<thead  style="width: 100%; border-collapse: collapse; background-color:pink; tabla color ">

<tr>


            <th style="font-size:15px;text-align:center; width:0px;"  scope="col">No</th>
            <th style="font-size:15px;text-align:center; width:0px;"  scope="col">Vacunas</th>
            <th style="font-size:15px;text-align:center; width:0px;"  scope="col">Desparasitante</th>
            <th style="font-size:15px;text-align:center; width:0px;"  scope="col">Dosis</th>
            <th style="font-size:15px;text-align:center;width:0px;"  scope="col">Acciones</th>
            
        </tr>
    </thead>

    <tbody>
    @php $n=0; @endphp

        @foreach ($medicamentos as  $medicamento)
        <tr >
            

            <td class="align-middle" style="font-size:15px; text-align:right" scope="row">{{++ $n}}</td>
            <td class="align-middle" style="font-size:15px" >{{$medicamento->nombre_vacuna}}</td>
            <td class="align-middle" style="font-size:15px" >{{$medicamento->nombre_desp}}</td>
            <td class="align-middle" style="font-size:15px">{{$medicamento->dosis}}</td>
            
           
           

            <td style="margin-left: 50px;margin-right: 30px;" >
            <a type="button"  title="Editar registro" href="./medicamento/{{$medicamento->id}}/edit" class="btn btn-outline-info" style="margin-left: 10px;margin-right: 20px;" >
                <i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                
                <button type="bottom"  onClick="borrar{{$medicamento->id}}()" title="Eliminar registro"class="btn btn-outline-danger"  >
               <i class="fa fa-window-close" aria-hidden="true"></i></button>
                <form action="{{route ('medicamento.destroy',$medicamento->id)}}" method="POST" id="eliminar{{$medicamento->id}}" > 
                
                @csrf
                @method('DELETE')       
               
               <script>
                function borrar{{$medicamento->id}}(){
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
    document.getElementById('eliminar{{$medicamento->id}}').submit();
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