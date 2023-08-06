@extends('layouts.madre')

@section('title', 'Propietario')

@section('content')
<style>
     .range-label{
        position: absolute !important;
        margin-top: -52px !important;
        margin-left: -630% !important;
        color:black;
    }
    .irs--flat{
        position: absolute !important;
        margin-top: -102px !important;
        width: 765% !important;
        margin-left: -490% !important;
    }
       .dt-buttons button{
        margin-left: 1vh !important;
        border-radius: 5px 5px 5px 5px !important;
        border: none !important;
        width: auto;
    }
    .dataTables_length{
        margin-right: 2vh;
        margin-bottom: 10vh;
      
    }
    .select-filter{
        position: absolute;
        margin-top: -90px;
        margin-left:-75vh ;
    }
   .dataTables_filter
   {
    margin-right:-6vh !important;
}
</style>


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
    <a href="propietario/create" title="Crear Registro" class="btn btn-outline-info"><i class='fas fa-file-medical'></i>  Crear</a>
    </div>

    
<br>
<br>
<br>

<table id="mitabla"  class = "table table-sm table-bordered " style="margin: 0 auto; width: 100%; text-align: center; ">

<thead   style="width: 100%; border-collapse: collapse; background-color:pink; tabla color ">
<tr>

            <th style="font-size:15px;text-align:center; width:45px;"  scope="col">No</th>
            <th style="font-size:15px;text-align:center; width:135px;"   scope="col">Identidad</th>
            <th style="font-size:15px;text-align:center; width:250px;"  scope="col">Nombre Completo</th>
            <th style="font-size:15px;text-align:center; width:70px;"  scope="col">Teléfono</th>
            <th style="font-size:15px;text-align:center; width:150px;"  scope="col">Correo Electrónico</th>
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
 
  @section('js') 
 
  <script src="https://code.jquery.com/jquery-3.7.0.js"> </script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"> </script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"> </script>

   
  <script>
     $(document).ready(function() {
            $('#mitabla').DataTable({
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
                rowCallback: function(row, data, index) {
                // Agregue el índice autoincrementable a la primera celda de la fila
                $('td:eq(0)', row).html(index + 1);
                },  
   
       language: {
                    "lengthMenu": "Mostrar _MENU_ resultados",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay resultados disponibles",
                    "infoFiltered": "(filtrado de _MAX_ total registros)",
                    "search": '<i class="fa fa-search" aria-hidden="true"></i> Buscar',
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }

 
        });
            
    });
 

    
  </script>
   
  @endsection 

  
  @endsection 



