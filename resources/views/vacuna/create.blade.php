@extends('layouts.madre')

@section('title', 'Registrar vacuna')


@section('content')
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
<a href="../paciente.edit" class="nav-link">
     <div> 
       <p style="text-align: center; margin-bottom: 0px;"><i class="nav-icon fas fa-file-alt" style="margin-right: 5px;"></i>Datos generales</p>
       </div>
     </a>
  </li>
  <li class="nav-item" role="presentation">
   <a href="{{ route('vacuna.index') }}" class="nav-link">
     <div> 
       <p style="text-align: center; margin-bottom: 0px;"><i class="nav-icon fas fa-syringe" style="margin-right: 5px;"></i>Vacuna</p>
       </div>
     </a>
  </li>
  <li class="nav-item" role="presentation">
  <a href="{{ route('desparacitar.index') }}"class="nav-link">
     <div> 
       <p style="text-align: center; margin-bottom: 0px;"><i class="nav-icon fa fa-capsules" style="margin-right: 5px;"></i>Desparacitación</p>
       </div>
     </a>
      </li>

      <li class="nav-item" role="presentation">
  <a href="{{ route('examen.index') }}"class="nav-link">
     <div> 
       <p style="text-align: center; margin-bottom: 0px;"><i class="fas fa-file-signature" style="margin-right: 5px;"></i>Examen Fisico</p>
       </div>
     </a>
      </li>
  
</ul>


<form action ="../vacuna"  method="POST">
    @csrf
   
 <br>


    




      <div class="mb-3">
      <label for="">Numero de expediente</label>
      <select class="form-control" name="num_id"> 
       @foreach ($pacientes as  $paciente)
        <option value="{{$paciente->id}}">{{$paciente->numero_expediente}}</option>
        @endforeach   
      </select>
      </div>


      <div class="mb-3">
        <label for="" class="form-label">Nombre de la proxima vacuna</label> 
        <select onfocus="this.blur();"value="{{old('nombre_proximavacuna')}}" name="nombre_proximavacuna"  id="nombre_proximavacuna"  class="form-control @error('nombre_proximavacuna') is-invalid @enderror" placeholder="Ingrese la nombre_proximavacuna" 
        title="Ingrese la nombre de la proxima vacuna" >
        <option>Rabia</option> 
        <option>Tos MSD</option> 
        <option>Quintuple</option>  
        <option>Helmican Suspension</option> 
        <option>Cuadruple</option>   
      </select>

      
        @error('nombre_proximavacuna')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>

   

    

      <div class="mb-3">
        <label for="">Fecha de la proxima dosis</label>
        <input type="date"value="{{old('fecha_proximadosis')}}"  name="fecha_proximadosis"  id="fecha_proximadosis" 
        class="form-control @error('fecha_proximadosis') is-invalid @enderror"   placeholder="Ingrese la fecha de la proxima dosis"
        title="Ingrese la fecha de la proxima dosis ">
      
        @error('fecha_proximadosis')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>

      
  
      
      
    

      
<link rel="stylesheet" type="text/css" href="css/fonts.css" >     
<button type="submit"class="btn btn-outline-success" tabindex="4"><span class="fas fa-user-plus"></span> Guardar</button> 

<a href="../vacuna" class="btn btn-outline-danger" tabindex="5"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
<br>
<br>


</form>


@endsection
