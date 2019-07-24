<?php ?>



@extends('administrador.index')

@section('headder')


   
   <nav aria-label="breadcrumb ">
 
  <ol class="breadcrumb arr-right bg-dark ">
 
    <li class="breadcrumb-item "><a href="#" class="text-light">Inicio</a></li>
 
    <li class="breadcrumb-item text-light" aria-current="page"><a href="{{route('profile')}}" class="text-light">Mi perfil</a></li>

  <li class="breadcrumb-item text-light active" aria-current="page">Cambiar Contraseña</li>

  </ol></nav>


@stop
@section('contenido')

<style type="text/css"></style>

 <div class="container-fluid">
  <div class="row">

<div class="col-md-3 responsive">
</div>
<div class="col-md-5 responsive">
<div class="card">
  <h5 class="card-header">Cambiar Contraseña</h5>
  <div class="card-body">

  



<div class="panel-body">
@if (session('error'))
</div>
<div class="alert alert-danger">
{{ session('error') }}
</div>
@endif
@if (session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>

@endif






<form class="form-horizontal " method="POST" action="{{ route('changePassword') }}">
{{ csrf_field() }}


           

 <label class="control-label">Clave Actual :</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa fa-expeditedssl"></i></span>
  </div>
  <input class="form-control form-control{{ $errors->has('current-password') ? ' is-invalid' : '' }} " type="password" name="current-password" placeholder="ingrese contraseña actual" maxlength="128" value="{{old('current-password')}}" required>
      @if ($errors->has('current-password'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('current-password') }}</strong>
                                    </div>
                                @endif
</div>


<label class="control-label">Contraseña nueva:</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa  fa-expeditedssl"></i></span>
  </div>
  <input class="form-control form-control{{ $errors->has('new-password') ? ' is-invalid' : '' }} " type="password" name="new-password" placeholder="ingrese contraseña nueva" maxlength="128" value="" required>
      @if ($errors->has('new-password'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('new-password') }}</strong>
                                    </div>
                                @endif
</div>


<label class="control-label">Confirmar Contraseña:</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa fa fa-expeditedssl fa-fw"></i></span>
  </div>
  <input class="form-control form-control" type="password" name="new-password_confirmation" placeholder="ingrese confirmación de contraseña" maxlength="128" value="" required>
    
</div>


<button type="submit" class="btn btn-primary">Aceptar</form>

  </div>
</div>



</div>
<div class="col-md-4 responsive">
</div>
</div>

</div>

@stop