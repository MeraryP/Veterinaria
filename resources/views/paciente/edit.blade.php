@extends('layouts.madre')

@section('title', 'Expediente de '.$nombre_mascotas)



@section('content')



<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li  class="nav-item" role="presentation">
<a  href="{{ route('paciente.edit', ['paciente' => $paciente->id]) }}" class="nav-link">
     <div   > 
       <p style="text-align: center; margin-bottom: 0px; color:black;"><i class="nav-icon fas fa-file-alt" style="color:blue;margin-right: 5px;"></i>Datos generales</p>
       </div>
     </a>
  </li>
  <li class="nav-item" role="presentation">
  <a href="{{ route('examenMascota',['id'=>$idMascota])}}"class="nav-link">
     <div> 
       <p style="text-align: center; margin-bottom: 0px; color:black;"><i class="fas fa-file-signature" style="color:green;margin-right: 5px;"></i>Examen Fisico</p>
       </div>
     </a>
      </li>
  
  <li class="nav-item" role="presentation">
   <a href="{{ route('vacunaMascota',['id'=>$idMascota])}}" class="nav-link">
     <div> 
       <p style="text-align: center; margin-bottom: 0px; color:black;"><i class="nav-icon fas fa-syringe" style="color:orange;margin-right: 5px;"></i>Vacuna</p>
       </div>
     </a>
  </li>
  <li class="nav-item" role="presentation">
  <a href="{{ route('desparacitacionMascota',['id'=>$idMascota])}}"class="nav-link">
     <div> 
       <p style="text-align: center; margin-bottom: 0px; color:black;"><i class="nav-icon fa fa-capsules" style="color:purple;margin-right: 5px;"></i>Desparacitación</p>
       </div>
     </a>
      </li>

      <li class="nav-item" role="presentation">
            <a href="{{ route('clinicoMascota',['id'=>$idMascota])}}"class="nav-link">
                <div> 
                    <p style="text-align: center; margin-bottom: 0px; color:black;"><i class="fa fa-stethoscope" style="color:red;margin-right: 5px;"></i>Examen Clínico</p>
                </div>
            </a>
        </li>
  
</ul>


<br>


<form  method="POST" action="{{ route('paciente.update',['id'=>$paciente->id])}}" enctype="multipart/form-data">
    @method('put')
    @csrf

    
    
    <div class="container text-center">
  <div class="row">
    <div class="col-6 col-sm-5">
    <label class="form-label" style="margin-left: 0px;position: absolute;top: 0px;margin-left: 200px;">Foto actual:</label>
    <img src="/image/{{ $paciente->filename }}"  style="max-width: 200px;margin-left: 150px;margin-right: 90px;margin-top: 50px;">
    </div>
    <div class="col-6 col-sm-5">
    <button type="button" id="cargar-imagen-btn" class="btn btn-outline-primary" style="margin-left: 215px;">Agregar Nueva Foto</button> 
    
    
         <input type="file" name="imagen" id="imagen" class="form-control @error('imagen') is-invalid @enderror  " style="max-width: 400px;display:none !important;">
         @error('imagen')
             <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
             </span>
         @enderror
         
         <img id="imagen-preview" src="#" alt="Vista previa de la imagen" style="display: none; max-width: 200px; max-height: 200px;margin-left: 200px;margin-top: 15px;object-fit: cover;">
    </div>

   
    <div class="w-100"></div>

    <div class="col-6 col-sm-3">
        
   </div>
    <div class="col-6 col-sm-3"></div>
  </div>
</div>

    
    
 <br>
 
<br>

<div class="mb-3">
        <label for="" class="form-label">Nombre de la Mascota</label>
        <input type="text" name="nombre_mascota"  id="nombre_mascota"  class="form-control @error('nombre_mascota') is-invalid @enderror"   
        placeholder="Nombre Completo de la Mascota" value="{{ $paciente->nombre_mascota }}"
        title="Ingrese el nombre de la mascota">
        @error('nombre_mascota')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>

      <div class="mb-3">
            <label for="">Nombre del propietario</label>
            <select class="form-control" name="pro_id">
            <option style="display:none" value="{{$paciente->pro_id}}"> {{$paciente->propietario->nombre}}</option> 
                @foreach ($propietarios as $propietario)
                <option value="{{$propietario->id}}">{{$propietario->nombre}}</option>
                @endforeach      
            </select>
        </div> 


        <div class="mb-3">
            <label for="">Especie</label>
            <select class="form-control" name="especie_id">
            <option style="display:none" value="{{$paciente->especie_id}}"> {{$paciente->especie->nombre_especie}}</option> 
                @foreach ($especies as $especie)
                <option value="{{$especie->id}}">{{$especie->nombre_especie}}</option>
                @endforeach      
            </select>
        </div> 


       

      <div class="for-group">
        <label for="">Género</label>
        <select class="form-control" name="genero_id">
        <option style="display:none" value="{{$paciente->genero_id}}"> {{$paciente->genero_mascota->name}}</option>    
        @foreach ($genero_mascotas as $genero_mascota)
        <option value="{{$genero_mascota->id}}">{{$genero_mascota->name}}</option>
        @endforeach      
      </select>
      </div>

      <div class="mb-3">
        <label for="" class="form-label">Raza</label>
        <input type="text" name="raza"  id="raza"  class="form-control @error('raza') is-invalid @enderror"   placeholder="" value="{{ $paciente->raza }}"
        title="Ingrese la raza">
        @error('raza')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>

   
     
      <div class="mb-3">
        <label for="" class="form-label">Fecha de Nacimiento</label>
        <input type="date" name="fecha_nacimiento"  id="fecha_nacimiento"  class="form-control @error('fecha_nacimiento') is-invalid @enderror" placeholder="0000-00-00" value="{{ $paciente->fecha_nacimiento}}"
        title="Ingrese la fecha de nacimiento ">
        @error('fecha_nacimiento')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>


    

     



      
<button type="submit" class="btn btn-outline-success" tabindex="4"style="margin-left: 300px;margin-right: 60px;"><span class="fas fa-user-plus"></span> Guardar cambios</button>     
<a href="/paciente" class="btn btn-outline-danger" tabindex="5"> <i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>

<br>
<br>



</form>

<script>
    
    document.getElementById('cargar-imagen-btn').addEventListener('click', function () {
        document.getElementById('imagen').click();
    });
</script>

<script>
    document.getElementById('imagen').addEventListener('change', function () {
        var reader = new FileReader();

        reader.onload = function (e) {
            document.getElementById('imagen-preview').setAttribute('src', e.target.result);
            document.getElementById('imagen-preview').style.display = 'block';
        }

        var file = this.files[0];
        if (file) {
            reader.readAsDataURL(file);
        }
    });

   
</script>




@endsection 