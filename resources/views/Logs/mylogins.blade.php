<?php ?>



@extends('administrador.index')

@section('headder')
 <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>

   <nav aria-label="breadcrumb ">
 
  <ol class="breadcrumb arr-right bg-dark ">
 
    <li class="breadcrumb-item "><a  class="text-light">Inicio</a></li>
 
<li class="breadcrumb-item "><a href="{{route('profile')}}" class="text-light">Mi perfil</a></li>

    <li class="breadcrumb-item text-light" aria-current="page"><a class="text-light">Mis Inicios de Sesiones</a></li>
 
 

  </ol>
</nav>

@stop
@section('contenido')
    <style type="text/css">
tr:nth-child(even) {background-color: #f2f2f2;}
    table{text-align: center;}
 th {
color: white;
border: black 1px solid;
   text-align: center;
   background-color:#ff7101;
    }
}
 table, td {
	
border: orange 5px solid;
   text-align: left;
   border:1px solid black;

}

</style>



@include('datatable.general.script')

<div style="overflow-x:auto;"  align="center" margin="0 auto" >

{{ $dataTable->table(['class' => 'table-responsive warning grocery-crud-table cell-border table-hover compact dataTable_width_auto table-striped', 'id' => 'table'])}}
</div>

{!! $dataTable->scripts() !!}

@include('flashy::message')







@stop