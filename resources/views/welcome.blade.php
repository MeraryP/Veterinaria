@extends('layouts.madre')

@section('title', 'Inicio')


@section('content')

    <style> 
        .card {
            pisition: relative;
            isolation: isolate;
            
            background-color: #DADBDB;
            border-radius: 8px;
            
        }

        .card_image{
            border-color:black;
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: 0 20%;
            borde-radius: inherit;
            transition: transform 250ms;
            border-radius: 8px;
        }

        .card:hover .card_image{
            transform: translateY(-112px) scale(0.75);
        }

        .card_body{
            position: absolute;
            inset: 0;
            z-index: -1;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            padding: 24px;
            color: #f4c644;
        }

        .card_category{
            aling:center; 
            color:black;
            font-size: 20px;
        }

        .card_button{
            display: inline-block;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 4px;
            background-color: #f4c644;
            color: #000;
        }

        .card_icon{
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: 0 20%;
            borde-radius: inherit;
            transition: transform 250ms;
        }
    </style>

    </br></br></br></br>
    <div style="max-width: 100% !important;">
        <div class="row justify-content-center">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4" >
                <figure class="card">
                    <img src="{{asset('imagen/propietario.jpg')}}" alt="" class="card_image">
                    <figcaption class="card_body">
                        <div>
                            <a href= "/propietario" class="card_category">
                                <i style="color:red" class="fas fa-dog" aria-hidden="true"></i> Propietario
                                <h4> Registrados {{$totalmedicamento}}</h4>
                            </a>
                        </div>
                    </figcaption>
                </figure>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4" >
                <figure class="card">
                    <img src="{{asset('imagen/mascota.jpg')}}" alt="" class="card_image">
                    <figcaption class="card_body">
                        <div>
                            <a href= "/paciente" style="text-decoration: none">
                                <i style="color:red" class="fas fa-dog" aria-hidden="true"></i> Mascota
                                <h4 class="card_category"> Registrados {{$totalmedicamento}}</h4>   
                            </a>
                        </div>
                    </figcaption>
                </figure>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4" >
                <figure class="card">
                    <img src="{{asset('imagen/medicamento.jpg')}}" alt="" class="card_image">
                    <figcaption class="card_body">
                        <div>
                            <a href= "/medicamento" style="text-decoration: none">
                                <i style="color:yellow"  class="fa fa-medkit" aria-hidden="true"></i> Medicamentos
                                <h4 class="card_category"> Registrados {{$totalmedicamento}}</h4>
                            </a>
                        </div>
                    </figcaption>
                </figure>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4" >
                <figure class="card">
                    <img src="{{asset('imagen/contrasena.png')}}" alt="" class="card_image">
                    <figcaption class="card_body">
                        <div>
                            <a href= "/contrasenia" style="text-decoration: none">
                                <i style="color: purple"  class="fa fa-lock" aria-hidden="true"></i> Contrasena
                                <h4 class="card_category"> Registrados {{$totalmedicamento}}</h4>   
                            </a>
                        </div>
                    </figcaption>
                </figure>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4" >
                <figure class="card">
                    <img src="{{asset('imagen/per.png')}}" alt="" class="card_image">
                    <figcaption class="card_body">
                        <div>
                            <a href= "/usuario" style="text-decoration: none">
                                <i style="LightBlue"  class="fa fa-user" aria-hidden="true"></i> Perfil
                                <h4 class="card_category"> Registrados {{$totalmedicamento}}</h4>
                            </a>
                        </div>
                    </figcaption>
                </figure>
            </div>
        </div>
    </div>
@endsection 
