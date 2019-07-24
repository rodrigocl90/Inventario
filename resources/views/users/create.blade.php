<?php ?>



@extends('administrador.index')

@section('headder')
 <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>

 
<style type="text/css">

.intro { 
font-weight: bold;

}

.imgc {
    width: 100%;
    height: auto;
}

.invalid-feedback {
  display: block;
}
}
</style>


<nav aria-label="breadcrumb ">
 
  <ol class="breadcrumb arr-right bg-dark ">
 
    <li class="breadcrumb-item "><a href="#" class="text-light">Inicio</a></li>
 

    <li class="breadcrumb-item text-light" aria-current="page"><a href="{{ route('users.index') }}" class="text-light">Lista Usuarios</a></li>
 
    <li class="breadcrumb-item text-light active" aria-current="page">Crear Usuarios</li>
 

  </ol></nav>


@stop
@section('contenido')
  <div class="container-fluid">
  <div class="row">
    <div class="col-md-4 responsive">
  <img src="{{asset('img/usuarios.png')}}" width="200px" height="200px" class="user-image imgc" alt="User Image">

    </div>
    <div class="col-md-6">
    
     <div >
          <div class="tile">
            <h5 class="tile-title">Crear Usuario</h5>
            <div class="tile-body">

                  @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Problemas!</strong> Problemas al ingresar datos.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

              

     {{Form::open(['route'=>'users.store','method'=>'POST'])}}

  {{ csrf_field() }}

           

 <label class="control-label">Nombre usuario :</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa fa-user fa-fw"></i></span>
  </div>
  <input class="form-control form-control{{ $errors->has('name') ? ' is-invalid' : '' }} " type="text" id="name" name="name" placeholder="ingrese nombre Usuario" maxlength="30" value="{{ old('name') }}" required>
      @if ($errors->has('name'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </div>
                                @endif
</div>


 <label class="control-label">Nombres del usuario :</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa fa-user fa-fw"></i></span>
  </div>
  <input class="form-control form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" type="text" id="first_name" name="first_name" placeholder="ingrese nombres del Usuario" maxlength="120" value="{{ old('first_name') }}" required>
      @if ($errors->has('first_name'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </div>
                                @endif
</div>




 <label class="control-label">Apellidos del usuario :</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa fa- fa-user fa-fw"></i></span>
  </div>
  <input class="form-control form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" type="text" id="last_name" name="last_name" placeholder="ingrese Apellidos del Usuario" maxlength="120" value="{{ old('last_name') }}" required>
      @if ($errors->has('first_name'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </div>
                                @endif
</div>


 <label class="control-label">Email del usuario :</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa fa- fa-envelope fa-fw"></i></span>
  </div>
  <input class="form-control form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="text" id="email" name="email" placeholder="ingrese email del Usuario" maxlength="191" value="{{ old('email') }}" required>
      @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </div>
                                @endif
</div>


 <label class="control-label">Contraseña :</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa fa- fa-lock fa-fw"></i></span>
  </div>
  <input class="form-control form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" id="password" name="password" placeholder="ingrese contraseña del Usuario" maxlength="128" value="{{ old('password') }}" required>
      @if ($errors->has('password'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </div>
                                @endif
</div>


 <label class="control-label">Repetir Contraseña :</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa fa- fa-lock fa-fw"></i></span>
  </div>
  <input class="form-control form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" type="password" id="password_confirmation" name="password_confirmation" placeholder="ingrese contraseña del Usuario" maxlength="128" value="{{old('password_confirmation') }}" required>
      @if ($errors->has('password_confirmation'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </div>
                                @endif
</div>


 <label class="control-label">Nº móvil :</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa fa- fa-phone fa-fw"></i></span>
  </div>
  <input  class="form-control form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" type="text" id="phone" name="phone" placeholder="ingrese Nº móvil del Usuario" maxlength="9" value="{{old('phone') }}" required>
      @if ($errors->has('phone'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </div>
                                @endif
</div>





  <div class="control-label">
          <div class="input-group mb-3 form-group{{ $errors->has('roles') ? 'has-error' :'' }}">
                          {{ Form::label('lroles', 'Roles a asginar:', ['class' => 'control-label']) }}
            
                <div class="input-group">
                 
    
      {{Form::select('roles[]',$roles,null,array('class'=>'form-control intro','title'=>'Precione ctrl y click para seleccionar roles', 'multiple'=>'multiple'))}}
                </div>
                    @if ($errors->has('roles'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('roles') }}</strong>
                                    </div>
                                @endif
              
              </div>
            </div>
          




 <label class="control-label">Sexo :</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa fa fa-venus-mars fa-fw"></i></span>
  </div>
  {{Form::select('gender', [ '0'=>'elige un sexo','m' => 'mujer', 'h' => 'hombre'], null, ['class' => ($errors->has('gender')) ? 'form-control is-invalid' : 'form-control','required'])}}

      @if ($errors->has('gender'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </div>
                                @endif
</div>




 <label class="control-label">Estado de Cuenta :</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa fa-power-off  fa-fw"></i></span>
  </div>
    {{Form::select('status', ['9' => 'selecciona un estado de cuenta','0' => 'Inactiva','1' => 'Activo'], null, ['class' => ($errors->has('gender')) ? 'form-control is-invalid' : 'form-control'])}}

      @if ($errors->has('status'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </div>
                                @endif
</div>




            


<div class="input-group mb-3">

{{ Form::submit('Guardar', ['class' => 'btn btn-info']) }}


                                    <a class="btn btn-warning" href="{{ url('admin/users') }}">
                                        Cancelar
                                    </a>
                                  </div>
{{ Form::close() }}
</div>
</div>
</div>












    </div>
    <div class="col-md-2">
    </div>
  </div>
</div>




  




@stop