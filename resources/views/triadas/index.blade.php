@extends('layouts.madre')

@section('title', 'Triadas')

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
        }S
        setTimeout(quitarerror, 3000);
    </script>

    <br>
        <div align="right">
            <a href="triadas/create" title="Crear registro" class="btn btn-info">
                <i class='fas fa-file-medical'></i> Crear
            </a>
        </div>
    <br>


    <table class = "table table-sm table-bordered">

        <thead class="thead-dark"  >
            <tr>
                <th style="font-size:15px; text-align:center" scope="col">Frecuencia Respiratoria</th>
                <th style="font-size:15px; text-align:center" scope="col">Frecuencia Pulso</th>
                <th style="font-size:15px; text-align:center" scope="col">Temperatura Corporaral</th>
                <th style="font-size:15px; text-align:center" scope="col">Acciones</th>
            </tr>
        </thead>

        <tbody>
        @foreach ($triadas as $n=>$triada)
            <tr>
                <td class="align-middle" style="font-size:15px">{{$triada->frecuencia_respiratoria}}</td>
                <td class="align-middle" style="font-size:15px">{{$triada->frecuencia_pulso}}</td>
                <td class="align-middle" style="font-size:15px">{{$triada->femperatura_corporaral}}</td>

                <td>
                    <form action="{{route ('triadas.destroy',$triada->id )}}" method="POST"> 
                    <a type="button" href="./triadas/{{$triada->id}}/edit" class="btn btn-info" title="Editar Carrera">
                    <i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                    @csrf
                
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @endsection 