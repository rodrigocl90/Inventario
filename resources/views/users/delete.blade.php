<?php ?>



@extends('administrador.index')

@section('headder')
 <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>




<nav aria-label="breadcrumb ">
 
  <ol class="breadcrumb arr-right bg-dark ">
 
    <li class="breadcrumb-item "><a href="#" class="text-light">Inicio</a></li>
 

    <li class="breadcrumb-item text-light" aria-current="page"><a href="{{ route('users.index') }}" class="text-light">Lista Usuarios</a></li>
 
    <li class="breadcrumb-item text-light active" aria-current="page">Borrar Usuario</li>
 

  </ol></nav>

@stop
@section('contenido')



<style type="text/css">
tbody{
background:#FFBFBF;

 }


</style>


<div class="container">
  <div class="row">
    <div class="col-md-3">
      @if ($user->gender==='h')
                   
                    <img src="{{asset('img/hombre1.png')}}" class="avatar rounded " alt="User Image">
                  @endif
                  @if ($user->gender==='m')
                  
                    <img src="{{asset('img/mujer1.jpg')}}" class="avatar rounded" alt="User Image">
                  @endif   

<h3 align="center"><span style="background:#337ab7;" class="badge badge-pill badge-secondary">{{$user->name}}</span></h3>
    </div>
    <div class="col-md-8">
      

 <div>
<table class="table table-bordered">
  <thead class="" style="background:red;color: white; border:1; font-style: italic;">
    <tr>
      <th align="center"><h3 align="center">Información Usuario</h3></th>
      <th >
             
                        <a class="btn btn-warning btn-xs fa   fa fa-close" style="display: inline-block" href="{{ url('admin/users') }}">
                                        Cancelar
                                    </a>
                                    &nbsp &nbsp
                                     <button  class="btn btn-danger btn-xs fa fa-eraser" data-toggle="modal" data-target="#myModal" title="eliminar">Eliminar</button>

</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Nombre Usuario :</td>
      <td><span style="color: blue;" class="fa fa-user fa-fw"></span>&nbsp&nbsp{{$user->name}}</td>
    </tr>
    <tr>
      <td>Nombres del Usuario :</td>
      <td><span style="color: blue;"  class="fa fa-user fa-fw"></span>&nbsp&nbsp{{$user->first_name}}</td>
    </tr>
    <tr>
      <td>Apellidos del Usuario :</td>
      <td><span style="color: blue;"  class="fa fa-user fa-fw"></span>&nbsp&nbsp{{$user->last_name}}</td>
    </tr>
     <tr>
      <td>Email del Usuario :</td>
      <td><span style="color: blue;" class="fa fa-envelope fa-fw"></span>&nbsp&nbsp{{$user->email}}</td>
    </tr>
     <tr>
      <td>Nº Móvil del Usuario :</td>
      <td><span style="color: orange;"  class="fa fa-phone fa-fw"></span>&nbsp&nbsp{{$user->phone}}</td>
    </tr>
        <tr>
      <td>Estado de la Cuenta :</td>
      <td>



       @if($user->status===0)
     <h6 style="color:red;">    <span class="fa fa-power-off  fa-fw fa-fw"></span>                      
          &nbsp&nbsp      Inactiva
                               <h6>
                            @endif

                             @if($user->status===1 )
                <h6 style="color:green;">    <span class="fa fa-power-off  fa-fw fa-fw"></span>                      
           &nbsp&nbsp    Activa
                               <h6>   
                            @endif
                            </td>
    </tr>
      <tr>
      <td>Fecha de Creación :</td>
      <td><i style="color: red;" class="fa fa-calendar" aria-hidden="true"></i>&nbsp&nbsp {{date_format($user->created_at, 'd/m/Y H:i:s')}}</td>
    </tr>
    <tr>

      <td>Fecha de Modificación :</td>
      <td><i style="color: red;" class="fa fa-calendar" aria-hidden="true"></i>&nbsp&nbsp {{date_format($user->updated_at, 'd/m/Y H:i:s')}}</td>
    </tr>
     <tr>
      <td>Roles del Usuario :</td>
      <td><i style="color:blue;"  class="fa fa-eye" aria-hidden="true"></i>  
       @if(!empty($user->roles))
                                @foreach($user->roles as $role)
  
                        <span class="badge badge-success"> &nbsp&nbsp {{$role->display_name}} </span> 
                          @endforeach
                            @endif</td>
    </tr>
  </tbody>
</table>


    </div>
    <div class="col-md-1">
    
    </div>
  </div>
</div>





 
    <div  id="myModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog alert-danger" role="document">
           <form class="w3-container" action="{{ url('admin/users/'.$user->slug) }}" onKeypress="if(event.keyCode == 13) event.returnValue = false;" method="POST">
                {{method_field('delete')}}
          {{csrf_field()}}
                <div class="modal-content">
                    <div class="modal-header" style="background:red;">
                        <h4 class="modal-title">Eliminar Usuario</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                       <h5> <p class="text-center">
        Estás seguro de eliminar al usuario:
        <span style="background:#337ab7;" class="badge badge-pill badge-secondary">{{$user->name}}</span></p></h5>
      <h5><p class="text-center">(no se recuperará)</p></h5>
                    </div>
                    <div class="modal-footer">
                     <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancelar</button>
          <button type="submit" class="btn btn-warning">Sí, Eliminar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>






@stop
