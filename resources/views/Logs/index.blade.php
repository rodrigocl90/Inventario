<?php ?>



@extends('administrador.index')

@section('headder')

 <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
   

   <nav aria-label="breadcrumb ">
 
  <ol class="breadcrumb arr-right bg-dark ">
 
    <li class="breadcrumb-item "><a href="#" class="text-light">Inicio</a></li>
 

    <li class="breadcrumb-item text-light" aria-current="page"><a  class="text-light">Lista Logs de Usuarios</a></li>
 
 

  </ol></nav>


@stop
@section('contenido')



@permission('user-create')

    <button  class="btn btn-danger glyphicon glyphicon-trash linea" data-toggle="modal" data-target="#myModal" title="eliminar">Eliminar Registros</button>
<br/>
<br/>
    @endpermission
@include('datatable.general.script')

<div style="overflow-x:auto;"  align="center" margin="0 auto" >

{{ $dataTable->table(['class' => 'table-responsive warning grocery-crud-table cell-border table-hover compact dataTable_width_auto table-striped', 'id' => 'table'])}}
</div>

{!! $dataTable->scripts() !!}

@include('flashy::message')







<div class="modal modal-danger fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="myModalLabel">Confirmar Eliminación Logs</h4>
      </div>
     <form class="w3-container" action="{{ route('logs.delete')}}">
          {{csrf_field()}}
        <div class="modal-body">
        <p class="text-center">
        Estás seguro de eliminar Los registros 
        </p>
          

        </div>
        <div class="modal-footer">
     
          <button type="submit" class="btn btn-warning">Sí</button>
         <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
        </div>
      </form>
    </div>
  </div>
</div>

@stop