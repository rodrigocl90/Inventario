<?php ?>



@extends('administrador.index')

@section('headder')
 <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>

     
   
<nav aria-label="breadcrumb ">
 
  <ol class="breadcrumb arr-right bg-dark ">
 
    <li class="breadcrumb-item "><a href="#" class="text-light">Inicio</a></li>
 

    <li class="breadcrumb-item text-light" aria-current="page"><a href="{{ route('roles.index') }}" class="text-light">Lista Roles</a></li>
 
    <li class="breadcrumb-item text-light active" aria-current="page">Crear Roles</li>
 

  </ol></nav>


@stop


<style type="text/css">
    .red{
    color: red;
}

</style>




@section('contenido')


 <div class="container-fluid">
  <div class="row">

<div class="col-md-1 responsive">
</div>
<div class="col-md-8 responsive">
    <div class="card">
  <h5 class="card-header">Admninistración de roles</h5>
  <div class="card-body">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.3.1/css/hover-min.css">
    

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading"><h4 align="center">Crear nuevo Rol Administrativo</h4></div>

                    <div class="panel-body">
                        <!-- Display Validation Errors -->
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Problemas!</strong> Algunos campos no están correctos <br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('admin/roles/store') }}">
                            {{ csrf_field() }}

                           






 <label class="control-label">Nombre de Rol :</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa fa-user-circle-o"></i></span>
  </div>
  <input class="form-control form-control{{ $errors->has('name') ? ' is-invalid' : '' }} " type="text" name="name" placeholder="ingrese nombre del rol" maxlength="100" value="{{old('name')}}" required>
      @if ($errors->has('name'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </div>
                                @endif
</div>




 <label class="control-label">Nombre a desplegar :</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa  fa-user-circle-o"></i></span>
  </div>
  <input class="form-control form-control{{ $errors->has('display_name') ? ' is-invalid' : '' }} " type="text" name="display_name" placeholder="ingrese nombre del rol" maxlength="70" value="{{old('display_name')}}" required>
      @if ($errors->has('display_name'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('display_name') }}</strong>
                                    </div>
                                @endif
</div>



 <label class="control-label">Descripción  del Rol :</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa  fa fa-user-circle-o"></i></span>
  </div>
 
   
{{ Form::textarea('description',Input::old('description'),['class' => ($errors->has('description')) ? 'form-control is-invalid' : 'form-control','required','rows' => 4, 'cols' => 50, 'placeholder' => 'ingrese descripción del rol']) }}

</div>
   @if ($errors->has('description'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </div>
                                @endif






                        
                     <div class="form-control form-control{{ $errors->has('permissions') ? ' is-invalid' : '' }}" style="background:#EFFBF5;"

                                <div class="">
                                   

   <h5><b>Asignar Permisos:</b></h5>
    <div class='form-group'>
        @foreach ($permissions as $permission)
            {{ Form::checkbox('permissions[]',  $permission->id ) }}
            <b style="color: red;">{{$permission->display_name}}</b> ({{($permission->description)}})<hr>
        @endforeach
    </div>





                                    @if ($errors->has('permissions'))
                                    <br>
                                    <br>
                                        <span style="color: red;">
                                        <strong>{{ $errors->first('permissions') }}</strong>
                                    </span>
                                    @endif
                                </div>
</div>



                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                       Guardar
                                    </button>

                                    <a class="btn btn-warning" href="{{ url('admin/roles') }}">
                                        Cancelar
                                    </a>
                                </div>
                            </div>
                            
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>





</div>
</div>
</div>
<div class="col-md-3 responsive">
</div>


@stop