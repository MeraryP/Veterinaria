@extends('layouts.madre')

@section('title', 'Inicio')

@section('content')

<style>
 .container {
  display: flex;
  flex-wrap: wrap;
}

.card {
  width: 10em;
  height: 4em;
  margin: .5em;
  padding: .5em;
  color: white;
  background: #0298cf;
}

.card:nth-child(4n + 1) {
  background: #0298cf;
}

.card:nth-child(4n + 2) {
  background: #9b479f;
}

.card:nth-child(4n + 3) {
  background: #4e484e;
}

.card:nth-child(4n + 4) {
  background: #f70d1a;
}
}
script{
  font-family: Open Sans, sans-serif;
}


</style>

<!DOCTYPE html>
<html>
<body>
    <script src="{{ asset("JS/sweetalert2.all.min.js") }}"></script>
    <script src="{{ asset("JS/app.js") }}"></script>
    <script src="{{asset('JS/plotly-latest.min.js')}}"></script>
    <script src="{{asset('JS/chart.js')}}"></script>
    
<br>
<br>
<br>

    <div class="container" style="width: 100%" >
  <div class="card bg-info" style="width: 20%;height: 100px;margin-left:170px;" >
    <div class="card-values">
      <div class="p-x">
      <a href="/propietario"  tabindex="5" style="margin-rigth: 100px;color:black;font-size: 25px;"><i style="color:pink" class="fa fa-id-card" aria-hidden="true"></i> Propietarios
        <h4 style="aling:center;color:white;font-size: 20px;" > Registrados {{$totalpropietario}}</h4>
        </a>
      </div>
    </div>
  </div>
  <div class="card bg-info" style="width: 20%;height: 100px;">
    <div class="card-values">
      <div class="p-x">
      <a href="/paciente"  tabindex="5" style="margin-rigth: 100px;color:black;font-size: 25px;"><i style="color:green"  class="fas fa-dog" aria-hidden="true"></i> Mascotas
      <h4 style="aling:center;color:white;font-size: 20px;" > Registrados {{$totalpaciente}}</h4></a>
      </div>
    </div>
  </div>
  <div class="card bg-info" style="width: 20%;height: 100px;">
    <div class="card-values">
      <div class="p-x">
      <a href="/medicamento"  tabindex="5" style="margin-rigth: 100px;color:black;font-size: 25px;"><i style="color:yellow"  class="fa fa-medkit" aria-hidden="true"></i> Medicamentos
      <h4 style="aling:center;color:white;font-size: 20px;"> Registrados {{$totalmedicamento}}</h4></a>
      </div>
    </div>
  </div>
  
  <div class="card bg-info" style="width: 20%;height: 100px;margin-left:280px;">
    <div class="card-values">
      <div class="p-x">
      <a href="/usuario"  tabindex="5" style="margin-rigth: 100px;color:black;font-size: 25px;"><i style="color:LightBlue" class="fa fa-user" aria-hidden="true"></i> Perfil</a>
      <h4 style="aling:center;color:pink;font-size: 20px;"></h4>
      </div>
    </div>
  </div>
  <div class="card bg-info" style="width: 20%;height: 100px;">
    <div class="card-values">
      <div class="p-x">
      <a href="/contrasenia"  tabindex="5" style="margin-rigth: 100px;color:black;font-size: 20px;"><i style="color:purple" class="fa fa-lock" aria-hidden="true"></i> Cambiar Contraseña</a>
      <h4 style="aling:center;color:pink;font-size: 20px;"> </h4>
      </div>
    </div>
  </div>

 
  






@stop







