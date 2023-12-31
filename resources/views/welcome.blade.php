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


        h6{
    font-family: Open Sans, sans-serif;
    margin-bottom: 15px;
    
     
  }

    </style>

    </br></br></br></br>

    <div style="max-width: 100% !important;">
        <div class="row justify-content-center" >
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4" >
                <figure class="card" style="background:#F994AA">
                    <img style="width:100% ;height: 170px;border-style:solid;border-width: 3px;border-radius:.375rem;border-color:#F84C76;"  src="{{asset('imagen/prop.jpg')}}" alt="" class="card_image">
                    <figcaption class="card_body">
                        <div>
                            <a href= "/propietario" class="card_category">
                                <i  style="color:white;font-size:px" class="fa fa-id-card" aria-hidden="true"></i> <h7 style="color:white;font-size:px" >Propietarios</h7>
                                <h6  style="color:white;font-size:px" > Registrados {{$totalmedicamento}}</h6>
                            </a>
                        </div>
                    </figcaption>
                </figure>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4" >
                <figure class="card" style="background:#86F779">
                    <img style="width:100% ;height: 170px;border-style:solid;border-width: 3px;border-radius:.375rem;border-color:#2CF550;"  src="{{asset('imagen/mascota.jpg')}}" alt="" class="card_image">
                    <figcaption class="card_body">
                        <div>
                            <a href= "/paciente" class="card_category">
                                <i style="color:white;font-size:px" class="fas fa-dog" aria-hidden="true"></i> <h7 style="color:white;font-size:px" >Mascota</h7>
                                <h6 style="color:white;font-size:px"> Registrados {{$totalmedicamento}}</h6>   
                            </a>
                        </div>
                    </figcaption>
                </figure>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4" >
                <figure class="card"   style="background:#F7F771" >
                    <img style="width:100% ;height: 170px;border-style:solid;border-width: 3px;border-radius:.375rem;border-color:#F9FC24;"   src="{{asset('imagen/medicamento.jpg')}}" alt="" class="card_image">
                    <figcaption class="card_body">
                        <div>
                            <a href= "/medicamento" class="card_category">
                                <i style="color:white"  class="fa fa-medkit" aria-hidden="true"></i> <h7 style="color:white;font-size:px" >Medicamentos</h7>
                                <h6  style="color:white;font-size:px" > Registrados {{$totalmedicamento}}</h6>
                            </a>
                        </div>
                    </figcaption>
                </figure>
            </div>
        </div>
        <br>
        <div class="row justify-content-center">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4" >
                <figure class="card"  style="background:#FC95DF"  align ="center">
                    <img style="width:100% ;height: 170px;border-style:solid;border-width: 3px;border-radius:.375rem;border-color:#F84C76;"  src="{{asset('imagen/datos.jpg')}}" alt="" class="card_image">
                    <figcaption class="card_body">
                        <div>
                            <a href= "/usuario" class="card_category">
                                <i style="color:white"  class="fa fa-address-card" aria-hidden="true"></i> <h7 style="color:white;font-size:px" >Perfil</h7>
                            </a>
                        </div>
                    </figcaption>
                </figure>
            </div>
          
        @if(Auth::user()->id == 1)
      
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4" >
                <figure class="card" style="background:#FBA371;width:100% ;height: 170px;">
                    <img style="width:100% ;height: 170px;border-style:solid;border-width: 3px;border-radius:.375rem;border-color:#FAC00A;"  src="{{asset('imagen/usuarios.jpg')}}" alt="" class="card_image">
                    <figcaption class="card_body" >
                        <div>
                            <a href= "/listausuarios"class="card_category">
                                <i style="color:white"  class="fa fa-user" aria-hidden="true"></i><h7 style="color:white;font-size:px" > Usuarios</h7>
                            </a>
                        </div>
                    </figcaption>
                </figure>
                @endif
            </div>
  
        
            
       
    </div>
@endsection 
