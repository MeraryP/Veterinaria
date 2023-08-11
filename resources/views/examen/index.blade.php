@extends('layouts.madre')

@section('title', 'Examen Físico' )



@section('content')


<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
<a href="{{ URL::previous() }}" class="nav-link">
     <div> 
       <p style="text-align: center; margin-bottom: 0px; color:black;"><i class="nav-icon fas fa-file-alt" style="margin-right: 5px;"></i>Datos generales</p>
       </div>
     </a>
  </li>
  <li class="nav-item" role="presentation">
  <a href=""class="nav-link">
     <div> 
       <p style="text-align: center; margin-bottom: 0px; color:black;"><i class="fas fa-file-signature" style="margin-right: 5px;"></i>Examen Fisico</p>
       </div>
     </a>
      </li>

  <li class="nav-item" role="presentation">
   <a href="" class="nav-link">
     <div> 
       <p style="text-align: center; margin-bottom: 0px; color:black;"><i class="nav-icon fas fa-syringe" style="margin-right: 5px;"></i>Vacuna</p>
       </div>
     </a>
  </li>
  <li class="nav-item" role="presentation">
  <a href=""class="nav-link">
     <div> 
       <p style="text-align: center; margin-bottom: 0px; color:black;"><i class="nav-icon fa fa-capsules" style="margin-right: 5px;"></i>Desparacitación</p>
       </div>
     </a>
      </li>

   
      <li class="nav-item" role="presentation">
            <a href="{{ route('clinico.index') }}"class="nav-link">
                <div> 
                    <p style="text-align: center; margin-bottom: 0px; color:black;"><i class="fa fa-stethoscope" style="margin-right: 5px;"></i>Examen Clínico</p>
                </div>
            </a>
        </li>
  
</ul>

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

  <h3>Examen Físico</h3>
  </nav>

<div class="contrainer">
</div>
    <div align="right" style="float:right">
    <a href="{{ route('examen.create', ['id' => $paciente->id]) }}"title="Crear Registro" class="btn btn-outline-info"><i class='fas fa-file-medical'></i>  Crear</a>
    </div>
<br>
<br>
<br>
<table id="mitabla"  class = "table table-sm table-bordered " style="margin: 0 auto; width: 100%; text-align: center; ">
<thead  style="width: 100%; border-collapse: collapse; background-color:LightBlue; tabla color ">

<tr>


            <th style="font-size:15px;text-align:center; width:0px;"  scope="col">No</th>
            <th style="font-size:15px;text-align:center; width:0px;"  scope="col">Temperatura °C</th>
            <th style="font-size:15px;text-align:center; width:0px;"  scope="col">F.C /minuto</th>
            <th style="font-size:15px;text-align:center; width:0px;"  scope="col">F.R /minuto</th>
            <th style="font-size:15px;text-align:center; width:0px;"  scope="col">Peso Kg</th>
            <th style="font-size:15px;text-align:center; width:0px;"  scope="col">Pulso /minuto</th>

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
            
           

            <td>
            <a type="button"  title="Editar registro" href="./examen/{{$examen->id}}/edit" class="btn btn-info" >
                <i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                
                <button type="bottom"  onClick="borrar{{$examen->id}}()" title="Eliminar registro" class="btn btn-danger">
               <i class="fa fa-window-close" aria-hidden="true"></i></button>
                <form action="{{ route('examen.destroy', ['id' => $paciente->id, 'examan' => $examen->id]) }}" method="POST" id="eliminar{{$examen->id}}"> 
                
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