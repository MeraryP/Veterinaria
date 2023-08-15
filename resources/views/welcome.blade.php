@extends('layouts.madre')

@section('title', 'Inicio')

@section('content')

<style>

</style>

<!DOCTYPE html>
<html>
<body>
<br>
<br>

<br>
<br>
<div class="container"  style="text-align:center;height: 100px;width: 85%;"  >
  <div class="row"  style="background:#F3EB6F;vertical-align:middle;" >
    <div class="col order-last" >
    <a href="/medicamento"  tabindex="5" style="margin-rigth: 100px;color:black;font-size: 25px;"><i style="color:yellow"  class="fa fa-medkit" aria-hidden="true"></i> Medicamentos
      <h4 style="aling:center;color:white;font-size: 20px;"> Registrados {{$totalmedicamento}}</h4></a>
    </div>
    <div class="col" style="background:#65AFA0">
    <a href="/paciente"  tabindex="5" style="margin-rigth: 100px;color:black;font-size: 25px;"><i style="color:green"  class="fas fa-dog" aria-hidden="true"></i> Mascotas
      <h4 style="aling:center;color:white;font-size: 20px;" > Registrados {{$totalpaciente}}</h4></a>
    </div>
    <div class="col order-first" style="background:#DE7A86;vertical-align:middle;" >
    <a href="/propietario"  tabindex="5" style="margin-rigth: 100px;color:black;font-size: 25px;"><i style="color:pink" class="fa fa-id-card" aria-hidden="true"></i> Propietarios
        <h4 style="aling:center;color:white;font-size: 20px;" > Registrados {{$totalpropietario}}</h4>
        </a>
    </div>
  </div>
<br>

  <div class="row"  style="margin-left: 220px;background:purple;height: 70px;width: 50%;" >
    
    <div class="col" style="background:#CE9EF7;">
    <a href="/contrasenia"  tabindex="5" style="margin-rigth: 100px;color:black;font-size: 20px;"><i style="color:purple" class="fa fa-lock" aria-hidden="true"></i> Cambiar Contraseña</a>
    </div>
    <div class="col order-first" style="background:#72A0E1;">
    <a href="/usuario"  tabindex="5" style="margin-rigth: 100px;color:black;font-size: 25px;"><i style="color:LightBlue" class="fa fa-user" aria-hidden="true"></i> Perfil</a>
    </div>
  </div>

</div>
 
  




  






@stop







