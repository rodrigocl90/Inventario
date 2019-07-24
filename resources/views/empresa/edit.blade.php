<?php ?>



@extends('administrador.index')

@section('headder')
 <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>

 
<style type="text/css">

.intro { 
font-weight: bold;

}

.imgc {
    width: 100% !important;
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
 

    <li class="breadcrumb-item text-light" aria-current="page"><a href="{{ route('empresa.index') }}" class="text-light">Perfil empresa </a></li>
 
    <li class="breadcrumb-item text-light active" aria-current="page">Modificar perfil Empresa</li>
 

  </ol></nav>


@stop
@section('contenido')







  <div class="container-fluid">
  <div class="row">
    <div class="col-md-3 responsive">
  <img src="{{ URL::to('/') }}/images/{{$empresa->imagen}}"  class="user-image imgc" alt="User Image">

    </div>
    <div class="col-md-8">
    
     <div >
          <div class="tile">
            <h5 class="tile-title">Modificar perfil de Empresa</h5>
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

           

      {!!Form::model($empresa,['route'=>['empresa.update'],'method'=>'patch','files' => 'true'])!!}

  {{ csrf_field() }}



     <div class="container-fluid">
  <div class="row">
   <div class="col-md-6">




 <label class="control-label">Nombre De la  empresa:</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa fa-building  fa-fw"></i></span>
  </div>
  <input class="form-control form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }} " type="text" id="nombre" name="nombre" placeholder="ingrese nombre de la empresa" maxlength="300" value="{{old( 'nombre', $empresa->nombre) }}" required>
      @if ($errors->has('name'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </div>
                                @endif
</div>




 <label class="control-label">rut de la empresa :</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa fa-building  fa-fw"></i></span>
  </div>
  <input class="form-control form-control{{ $errors->has('rut') ? ' is-invalid' : '' }}" type="text" id="rut" name="rut" placeholder="ingrese rut del Usuario" maxlength="15" value="{{old( 'rut', $empresa->rut) }}" required>
      @if ($errors->has('rut'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('rut') }}</strong>
                                    </div>
                                @endif
</div>






<label>Ciudad de la empresa :</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa fa-building  fa-fw"></i></span>
  </div>
  <input class="form-control form-control{{ $errors->has('ciudad') ? ' is-invalid' : '' }}" type="text" id="ciudad" name="ciudad" placeholder="ingrese ciudad de la empresa" maxlength="120" value="{{old( 'ciudad', $empresa->ciudad) }}" required>
      @if ($errors->has('ciudad'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('ciudad') }}</strong>
                                    </div>
                                @endif
</div>






 <label class="control-label">Giro de la empresa :</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa fa-building  fa-fw"></i></span>
  </div>
  <input class="form-control form-control{{ $errors->has('giro') ? ' is-invalid' : '' }}" type="text" id="giro" name="giro" placeholder="ingrese giro de la empresa" maxlength="120" value="{{old( 'giro', $empresa->giro) }}" required>
      @if ($errors->has('giro'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('giro') }}</strong>
                                    </div>
                                @endif
</div>




    



</div>
            



<div class="col-md-6">





 <label class="control-label">Domicilio de la empresa :</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa fa- fa-building  fa-fw"></i></span>
  </div>
  <input class="form-control form-control{{ $errors->has('domicilio') ? ' is-invalid' : '' }}" type="text" id="domicilio" name="domicilio" placeholder="ingrese Apellidos del Usuario" maxlength="120" value="{{old( 'domicilio', $empresa->domicilio) }}" required>
      @if ($errors->has('domicilio'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('domicilio') }}</strong>
                                    </div>
                                @endif
</div>


 <label class="control-label">Email del usuario :</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa fa- fa-building fa-fw"></i></span>
  </div>
  <input class="form-control form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="text" id="email" name="email" placeholder="ingrese email del Usuario" maxlength="191" value="{{old( 'email', $empresa->email)}}" required>
      @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </div>
                                @endif
</div>



 <label class="control-label">Nº móvil :</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa fa- fa-building fa-fw"></i></span>
  </div>
  <input  class="form-control form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" type="text" id="telefono" name="telefono" placeholder="ingrese Nº móvil del Usuario" maxlength="9" value="{{old( 'telefono', $empresa->telefono) }}" required>
      @if ($errors->has('telefono'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('telefono') }}</strong>
                                    </div>
                                @endif
</div>






 <label class="control-label">fax:</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa fa-building  fa-fw"></i></span>
  </div>
  <input class="form-control form-control{{ $errors->has('fax') ? ' is-invalid' : '' }} " type="text" id="fax" name="fax" placeholder="ingrese fax de la empresa" maxlength="30" value="{{old( 'name', $empresa->fax) }}" required>
      @if ($errors->has('fax'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('fax') }}</strong>
                                    </div>
                                @endif
</div>




 <label class="control-label">Código Postal:</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa fa-building  fa-fw"></i></span>
  </div>
  <input class="form-control form-control{{ $errors->has('codigo_postal') ? ' is-invalid' : '' }} " type="text" id="codigo_postal" name="codigo_postal" placeholder="ingrese código postal de la empresa" maxlength="30" value="{{old( 'codigo_postal', $empresa->codigo_postal) }}" required>
      @if ($errors->has('codigo_postal'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('codigo_postal') }}</strong>
                                    </div>
                                @endif
</div>










 <label class="control-label">Cambiar Logo empresa:</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa fa-building  fa-fw"></i></span>
  </div>
    <div class="col-md-8">
             <input type="file" name="Eimagen" id="Eimagen" />
             <span id="store_image"></span>
            </div>

</div>



 
    <div  id="myModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog alert-danger" role="document">
              <form class="w3-container"  onKeypress="if(event.keyCode == 13) event.returnValue = false;">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="modal-content">
                    <div class="modal-header" style="color: #009688;" bgcolor='blue'>
                        <h4 class="modal-title">Estás seguro de Guardar los cambios</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                       <h5> <p>(se guardaran los cambios de perfil empresa)</p></h5>
                    </div>
                    <div class="modal-footer">
                          {{ Form::submit('Guardar', ['class' => 'btn btn-info']) }}
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
      
    </div>



</div>
</div>






  <div class="input-group mb-3 ">
       
<button class="btn btn-success glyphicon n" data-toggle="modal" data-target="#myModal" title="guardar">Guardar  Cambios</button>
 &nbsp &nbsp
                                    <a class="btn btn-warning" href="{{ url('admin/empresa') }}">
                                        Cancelar
                                    </a>
</div>

   

{{ Form::close() }}






 </div>
</div>

    <div class="col-md-1">
    
    </div>
  </div>
</div>



@stop