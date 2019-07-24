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
<div class="col-md-6 responsive border" style="background: #f2dede;">
<div class="card-body">





 
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog danger" role="document">
              <form class="w3-container" action="{{ url('admin/roles/'.$role->slug) }}" method="POST">
          {{method_field('delete')}}
          {{csrf_field()}}
                <div class="modal-content">
                    <div class="modal-header" style="background:red;">
                        <h4 class="modal-title" style="color: white;">Eliminar Rol </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                          <p >
        Estás seguro de eliminar al Rol con nombre:<h4><span class="badge badge-primary">{{$role->display_name}}</span><h4><hr>
        </p>
                    </div>
                    <div class="modal-footer">
                          {{ Form::submit('Aceptar', ['class' => 'btn btn-info']) }}
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>






    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.3.1/css/hover-min.css">
    

        <div class="row">
          @if (Session::has('flash_notification.message'))
  <div class="{{ Session::get('flash_notification.level') }}">
    {{ Session::get('flash_notification.message') }}
  </div>
@endif
            <div class="">
                <div class="panel panel-primary">
                    <div class="panel-heading"><h4 align="center">Información de rol  <b style="color:blue;">{{$role->name}}</b> a Eliminar
                    </h4><hr>
                    <div style="text-align:right;"> 



     <a href="{{ url('admin/roles') }}"><button  class="btn btn-warning fa fa-eraser">Regresar</button></a>
                                      
        

    <button  class="btn btn-danger fa fa-eraser" data-toggle="modal" data-target="#myModal" title="eliminar">Eliminar</button>                      
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