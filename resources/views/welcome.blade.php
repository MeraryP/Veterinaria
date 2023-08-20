@extends('layouts.madre')

@section('title', 'Inicio')


@section('content')
<style>

h4{
    
  text-align: center!important;
  font-family: Open Sans, sans-serif;
  margin-bottom: 15px;
  
   
}


h5{
    
    text-align: center!important;
    font-family: Open Sans, sans-serif;
    margin-bottom: 15px;
    
     
  }
</style>
<head>
<style>
 body{
overflow:hidden;
overflow-x:hidden;overflow-y:scroll;
overflow:-moz-scrollbars-vertical;
}
</style>
</head>
<div style="max-width: 100% !important;">
<div class="row justify-content-center">
<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4" >
<div  >
    
  </div>
  <br>   
      <a href= "/propietario" style="text-decoration: none"> 
        <div class="card bg-gradient-danger" >
            <div class="card-body p-1" align ="center">
            <br> 
            <img style="width:80% ;height: 105px;" alt="Image placeholder" src="{{asset('imagen/propietario.jpg')}}">
                <div class="row" style="justify-content: center;">
                    <div class="col-8 ">
                        <div  class="number" style="color:white;" >             
                        <h4 style="color:white" >
                          Propietarios
                          <h5 style="aling:center;color:white;font-size: 20px;" > Registrados {{$totalpropietario}}</h5>
                        </h4>
                        
                        </div>
                    </div>

                </div>
            </div>
        </div>
      </a>
    </div>
   




    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4" >
    <div  align ="center">
  </div>
  <br> 
      <a href= "/paciente" style="text-decoration: none"> 
        <div class="card bg-gradient-success">
            <div class="card-body p-1" align ="center" >
            <br>
            <img style="width:80%; height:105px;" alt="Image placeholder" src="{{asset('imagen/mascota.jpg')}}">
                <div class="row" style="justify-content: center;">
                    <div class="col-8">
                        <div class="numbers" style="color: white" >
                            <h4  style="color: white" >
                              Mascotas
                              <h5 style="aling:center;color:white;font-size: 20px;" > Registrados {{$totalpaciente}}</h5>
                            </h4>
                           
                        </div>
                    </div>
                </div>
                </div>
        </div>
      </a>
    </div>

    

    
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4" >
    <div  align ="center">
  </div>
  <br> 
      <a href= "/medicamento" style="text-decoration: none"> 
        <div class="card bg-gradient-warning">
            <div class="card-body p-1" align ="center" >
              <br>
            <img style="width:80%; height: 105px;" alt="Image placeholder" src="{{asset('imagen/medicamento.jpg')}}">
                <div class="row"style="justify-content: center;">
                    <div class="col-8">
                        <div class="numbers" style="color: white" >
                       
                            <h4  style="color: white" >
                             Medicamento
                             <h5 style="aling:center;color:white;font-size: 20px;"> Registrados {{$totalmedicamento}}</h4>
                            </h4>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
      </a>
    </div>
    </div>
    <br>
    <br>
    </div>

  
    <div style="max-width:100% !important;">
<div class="row justify-content-center">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4" >
    <div  align ="center">
  </div>
  
      <a href= "/contrasenia" style="text-decoration: none"> 
        <div class="card bg-gradient-orange">
            <div class="card-body p-1"align ="center">
              <br>
            <img style="width:80%; height: 143px;" alt="Image placeholder" src="{{asset('imagen/contrasena.png')}}">
                <div class="row"style="justify-content: center;">
                    <div class="col-8">
                        <div class="numbers" style="color: white" >
                            <h4 style="color: white" >
                            Contraseña</h3>
                            <h4 class="font-weight-bolder" style="color: white" >
                              
                            </h5>
                        </div>
                    </div>
                  
                </div>
            </div>
        </div>
      </a>
    </div>
 
    

  
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4" >
    <div  align ="center">
  </div>
      <a href= "/usuario" style="text-decoration: none"> 
        <div class="card bg-gradient-purple">
            <div class="card-body p-1" align ="center">
              <br>
            <img style="width:80%; height: 143px;" alt="Image placeholder" src="{{asset('imagen/per.png')}}">
                <div class="row"style="justify-content: center;">
                    <div class="col-8">
                        <div class="numbers" style="color: white" >
                            <h4 style="color: white" >
                            Perfil
                            </h4>
                            <h5 class="font-weight-bolder" style="color: white" >
                              
                            </h5>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
      </a>
    </div>
  
 
</div>
<br> 
@endsection 
