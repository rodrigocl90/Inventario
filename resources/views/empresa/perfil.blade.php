<?php ?>

<?php ?>



@extends('administrador.index')

@section('headder')
 <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>

<nav aria-label="breadcrumb ">
 
  <ol class="breadcrumb arr-right bg-dark ">
 
    <li class="breadcrumb-item "><a href="#" class="text-light">Inicio</a></li>
 
 
    <li class="breadcrumb-item text-light active" aria-current="page">Perfil de La Empresa</li>
 

  </ol></nav>


@stop
@section('contenido')

@include('flashy::message')




<div class="container">
  <div class="row">
    <div class="col-md-3">
      <div class="responsive">
  <img src="{{ URL::to('/') }}/images/{{$empresa->imagen}}"   width="200px" height="200px" class="user-image imgc" alt="User Image">

    </div>

    </div>
    
    <div class="col-md-8 border">
   
    <div class="col-md-12">
    
   
         
            
            <div class="tile-body">

</div>

              

      

  {{ csrf_field() }}



 
<table class="table table-bordered">
  <thead class= "font-style: italic;">
    <tr bgcolor="#009688" style="color:#FFFFFF";>
      <th align="center"><h3 align="center">Información de la  Empresa</h3></th>
      <th ><a class="btn btn-warning" href="{{ url('admin/empresa/edit') }}">
                                       Editar Datos
                                    </a>


                 </div>
</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Nombre Empresa :</td>
      <td><span style="color: #009688;" class="fa  fa-building  fa-fw"></span>&nbsp&nbsp{{$empresa->nombre}}</td>
    </tr>
    <tr>
      <td>Rut de empresa :</td>
      <td><span style="color: #009688;"  class="fa  fa-clipboard fa-fw"></span>&nbsp&nbsp{{$empresa->rut}}</td>
    </tr>
     <tr>
      <td>ciudad :</td>
      <td><span style="color: #009688;" class="fa fa-map-marker fa-fw"></span>&nbsp&nbsp{{$empresa->ciudad}}</td>
    </tr>
     <tr>
      <td>Domicilio :</td>
      <td><span style="color: #009688;" class="fa fa-photo fa-fw"></span>&nbsp&nbsp{{$empresa->domicilio}}</td>
    </tr>
     <tr>
      <td>Giro de la Empresa :</td>
      <td><span style="color: #009688;" class="fa  fa-star  fa-fw"></span>&nbsp&nbsp{{$empresa->giro}}</td>
    </tr>
     <tr>
      <td>Teléfono de la  Empresa :</td>
      <td><span style="color: #009688;" class="fa fa-phone fa-fw"></span>&nbsp&nbsp{{$empresa->telefono}}</td>
    </tr>
     <tr>
      <td>código postal :</td>
      <td><span style="color: #009688;" class="fa fa-fax fa-fw"></span>&nbsp&nbsp{{$empresa->codigo_postal}}</td>
    </tr>
     <tr>
      <td>Fax Empresa :</td>
      <td><span style="color: #009688;" class="fa fa-fax fa-fw"></span>&nbsp&nbsp{{$empresa->fax}}</td>
    </tr>
     <tr>
      <td>Email de la  Empresa :</td>
      <td><span style="color: #009688;" class="fa fa-truck fa-fw"></span>&nbsp&nbsp{{$empresa->email}}</td>
    </tr>
   
    <tr>
  
    </tr>
  </tbody>
</table>






 </div>
</div>

    <div class="col-md-3">
    
    </div>
  </div>
</div>



@stop