<?php ?>



@extends('administrador.index')

@section('headder')
 <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>

 
<nav aria-label="breadcrumb ">
 
  <ol class="breadcrumb arr-right bg-dark ">
 
    <li class="breadcrumb-item "><a href="#" class="text-light">Inicio</a></li>
 

    <li class="breadcrumb-item text-light" aria-current="page"><a href="{{ route('roles.index') }}" class="text-light">Lista Roles</a></li>
 
    <li class="breadcrumb-item text-light active" aria-current="page">Información Roles</li>
 

  </ol></nav>

@stop
@section('contenido')

<style type="text/css">
  
    .read{ background: white !important;
     }


.blue{

    border-style: 1px; solid;
  font-size: 15px;
}
.titulo{

  font-family:verdana; color:black;
    font-size: 12px !important;
  font-weight: 200px !important;
}

</style>


 <div class="container-fluid">
  <div class="row">

<div class="col-md-2 responsive">
</div>
<div class="col-md-6 responsive border" style="background: #dff0d8;">
<div class="card-body">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.3.1/css/hover-min.css">
    

        <div class="row">
            <div class="">
                <div class="panel panel-primary">
                    <div class="panel-heading"><h4 align="center">Información de rol  <b style="color:blue;">{{$role->name}}</b>
                    </h4><hr>
                    <div style="text-align:right;"> 
  <a align="right" class="btn btn-warning  btn-sm fa fa-external-link" href="{{ url('admin/roles') }}">
                                        Regresar
                                    </a>
</div>
                                  </div>

                    <div class="panel-body">
<form class="well form-horizontal">
                      <fieldset>
                               
                         
 <label class="control-label">Nombre de Rol :</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa fa-expeditedssl"></i></span>
  </div>
  <input class="form-control read" type="text" name="name"  value="{{$role->name}}" readonly>
  </div>
                                    



 <label class="control-label">Nombre rol a mostrar:</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa fa-expeditedssl"></i></span>
  </div>
  <input class="form-control read" type="text" name="name" value="{{$role->display_name}}" readonly>
    </div>


 <label class="control-label">Descripción  del Rol :</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa fa-expeditedssl"></i></span>
  </div>
  <textarea rows="4" cols="50" id="description" name="description"  class="form-control read" name="description" readonly>{{$role->description}}</textarea>
   
</div>

                         
                        <div class="form-group">
                            <label class=" control-label">Permisos:</label>
                            <div class="inputGroupContainer">
                               <div class="form-group">
                         
 @if(!empty($permissions))
<ul class="list-group" >
  <li class="list-group-item active">Nombre de Permisos</li>
     @foreach($permissions as $permission)
  <li class="list-group-item" style="background:#ecf0;"><i class="fa fa fa-key" style="color: green;"></i>&nbsp;&nbsp;<b style="color:#007bff;">{{ $permission->display_name }} </b>({{($permission->description)}})</li>
   @endforeach
</ul>
@endif




                               </div>
                            </div>
                         </div>


                      </fieldset>
                   </form>




</div>
</div>
</div>
</div>
</div>
</div>
  <div class="col-sm-3">
    

  </div>
</div>

</div>



@stop