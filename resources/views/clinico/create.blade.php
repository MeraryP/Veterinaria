@extends('layouts.madre')

@section('title', 'Registrar Examen Clinico')

@section('content')
<!-- <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
<a href="{{ URL::previous() }}" class="nav-link">
     <div> 
       <p style="text-align: center; margin-bottom: 0px; color:black;"><i class="nav-icon fas fa-file-alt" style="margin-right: 5px;"></i>Datos generales</p>
       </div>
     </a>
  </li>
  <li class="nav-item" role="presentation">
            <a href=""class="nav-link">
                <div> 
                    <p style="text-align: center; margin-bottom: 0px; color:black;"><i class="fas fa-file-signature" style="margin-right: 5px;"></i>Examen Fisico</p>
                </div>
            </a>
        </li>

        <li class="nav-item" role="presentation">
            <a href="" class="nav-link">
                <div> 
                    <p style="text-align: center; margin-bottom: 0px; color:black;"><i class="nav-icon fas fa-syringe" style="margin-right: 5px;"></i>Vacuna</p>
                </div>
            </a>
        </li>

        <li class="nav-item" role="presentation">
            <a href=""class="nav-link">
                <div> 
                    <p style="text-align: center; margin-bottom: 0px; color:black;"><i class="nav-icon fa fa-capsules" style="margin-right: 5px;"></i>Desparacitación</p>
                </div>
            </a>
        </li>

      
        <li class="nav-item" role="presentation">
            <a href=""class="nav-link">
                <div> 
                    <p style="text-align: center; margin-bottom: 0px; color:black;"><i class="fa fa-stethoscope" style="margin-right: 5px;"></i>Examen Clínico</p>
                </div>
            </a>
        </li>
    </ul> -->


    <form action ="../clinico"  method="POST">
        @csrf
     

        <div class="mb-3">
            <label for="">Nombre de la Mascota</label>
            <select class="form-control" name="num_id"> 
              
            @foreach ($pacientes as  $paciente)
              <option value="{{$paciente->id}}">{{$paciente->nombre_mascota}}</option>
              @endforeach   
            </select>
        </div>
        <br>
        <div class="mb-3">
        <label for="" class="form-label">Sintomas de la Mascota</label>
        <textarea type="text" maxlength="1000" value="{{old('sintomas')}}"  name="sintomas"  id="sintomas"   
        class="form-control @error('sintomas') is-invalid @enderror" placeholder="Ingrese los sintomas"
        title="Ingrese los sintomas"></textarea>
        @error('sintomas')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      
      </div>

      <div class="mb-3">
        <label for="" class="form-label">Enfermedad Diagnosticada</label>
        <textarea type="text" maxlength="1000" value="{{old('enfermedad')}}"  name="enfermedad"  id="enfermedad"   
        class="form-control @error('enfermedad') is-invalid @enderror" placeholder="Ingrese la enfermedad diagnosticada"
        title="Ingrese la enfermedad diagnosticada"></textarea>
        @error('enfermedad')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      
      </div>

      <div class="mb-3">
        <label for="" class="form-label">Tratamiento de la Mascota</label>
        <textarea type="text" maxlength="1000" value="{{old('tratamiento')}}"  name="tratamiento"  id="tratamiento"   
        class="form-control @error('enfermedad') is-invalid @enderror" placeholder="Ingrese el tratamiento"
        title="Ingrese el tratamiento"></textarea>
        @error('tratamiento')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      
      </div>
    
       
 
        <link rel="stylesheet" type="text/css" href="css/fonts.css" >      
        <button type="submit"class="btn btn-outline-success" tabindex="4"style="margin-left: 350px;margin-right: 60px;"><span class="fas fa-user-plus"></span> Guardar</button> 

        <a href="../clinico" class="btn btn-outline-danger" tabindex="5"style="margin-rigth: 100px;"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
        <br>
        <br>

    </form>

@endsection
