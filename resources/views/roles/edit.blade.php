<?php ?>



@extends('administrador.index')

@section('headder')
 <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
   


<nav aria-label="breadcrumb ">
 
  <ol class="breadcrumb arr-right bg-dark ">
 
    <li class="breadcrumb-item "><a href="#" class="text-light">Inicio</a></li>
 

    <li class="breadcrumb-item text-light" aria-current="page"><a href="{{ route('roles.index') }}" class="text-light">Lista Roles</a></li>
 
    <li class="breadcrumb-item text-light active" aria-current="page">Editar Roles</li>
 

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
                    <div class="panel-heading"><h4 align="center">Editar Rol Administrativo</h4></div>

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

                             <form class="form-horizontal" role="form" method="POST"
                              action="{{ url('admin/roles/'.$role->id) }}">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}




 <label class="control-label">Nombre de Rol :</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa fa-user-circle-o"></i></span>
  </div>
  <input class="form-control form-control{{ $errors->has('name') ? ' is-invalid' : '' }} " type="text" name="name" placeholder="ingrese nombre del rol" maxlength="100" value="{{old('name',$role->name)}}" required>
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
  <input class="form-control form-control{{ $errors->has('display_name') ? ' is-invalid' : '' }} " type="text" name="display_name" placeholder="ingrese nombre del rol" maxlength="70" value="{{old('display_name',$role->display_name)}}" required>
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
 
{{ Form::textarea('description',Input::old('description',$role->display_name),['class' => ($errors->has('description')) ? 'form-control is-invalid' : 'form-control','required','rows' => 4, 'cols' => 50, 'placeholder' => 'ingresa descripción']) }}

</div>
   @if ($errors->has('description'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </div>
                                @endif






                        
                     <div class="form-control form-control{{ $errors->has('permission') ? ' is-invalid' : '' }}" style="background:#EFFBF5;"

                              >
            <strong>Permisos Asignados:</strong>
            <br/> <br/>
            @foreach($permission as $value)
                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('')) }}
                <b style="color: red;">{{$value->display_name}}</b> ({{($value->description)}})<hr></label>
            <br/>
            @endforeach


                                    @if ($errors->has('permission'))
                                    <br>
                                    <br>
                                        <span style="color: red;">
                                        <strong>{{ $errors->first('permission') }}</strong>
                                    </span>
                                    @endif
                                </div>




        </div>

                  <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                   
                            <div class="form-group">
                     









 
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog alert-danger" role="document">
              <form class="w3-container"  onKeypress="if(event.keyCode == 13) event.returnValue = false;">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="modal-content">
                    <div class="modal-header" style="background:orange;">
                        <h4 class="modal-title">Estas seguro de Guardar los cambios</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                       <h5> <p>(se guardaran los cambios de la cuenta del rol)</p></h5>
                    </div>
                    <div class="modal-footer">
                          {{ Form::submit('Guardar', ['class' => 'btn btn-info']) }}
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

















                                    
<button class="btn btn-success glyphicon" data-toggle="modal" data-target="#myModal" title="guardar">Guardar  Cambios</button>

                                    <a class="btn btn-warning" href="{{ url('admin/roles') }}">
                                        Cancelar
                                    </a>
                       
                            </div>
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