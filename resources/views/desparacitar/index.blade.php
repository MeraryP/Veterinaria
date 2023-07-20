@extends('layouts.madre')

@section('title', 'Desparacitar')

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
            <a href="desparacitar/create" title="Crear registro" class="btn btn-info">
                <i class='fas fa-file-medical'></i> Crear
            </a>
        </div>
    <br>



@endsection 