<?php ?>



@extends('administrador.index')

@section('headder')

 <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>

<nav aria-label="breadcrumb ">
 
  <ol class="breadcrumb arr-right bg-dark ">
 
    <li class="breadcrumb-item "><a href="#" class="text-light">Inicio</a></li>
 
    <li class="breadcrumb-item text-light active" aria-current="page">Lista Usuarios</li>
 
  </ol></nav>




@stop
@section('contenido')


    <style type="text/css">

    btn{
    margin-bottom: 10%;
}

tr:nth-child(even) {background-color: #f2f2f2;}
    table{text-align: center;
      font-size: 12px;}
 th {

color: white;
border: black 1px solid;
   text-align: center;
   background-color:#12bbad;
    }
}
 table, td {
	
border: orange 5px solid;
   text-align: left;
   border:1px solid black;

}


</style>



@permission('user-create')
<a href="{{ route('users.create') }}"><button class="btn btn-success">  Nuevo Usuario</button></a> 

<br/>
<br/>
    @endpermission
@include('datatable.general.script')

<div style="overflow-x:auto;"  align="center" margin="0 auto" >

{{ $dataTable->table(['class' => 'table-responsive warning grocery-crud-table cell-border table-hover compact dataTable_width_auto table-striped', 'id' => 'table'])}}
</div>

{!! $dataTable->scripts() !!}

@include('flashy::message')



</script>
@stop