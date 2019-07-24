<?php ?>



@extends('administrador.index')

@section('headder')
 <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
<style type="text/css">

.intro { 
font-weight: bold;

}

.imgc {
    width: 100%;
    height: auto;
}

.invalid-feedback {
  display: block;
}

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


<nav aria-label="breadcrumb ">
 
  <ol class="breadcrumb arr-right bg-dark ">
 
    <li class="breadcrumb-item "><a href="#" class="text-light">Inicio</a></li>
 
 
    <li class="breadcrumb-item text-light active" aria-current="page">Respaldo de base de Datos</li>
 

  </ol></nav>


@stop
@section('contenido')
@include('alert::bootstrap')
<div class="page-header">
  <h1>Administración de backup</h1>
</div>


 <div class="container -body-block pb-5">
      
           
                    <a class="btn btn-warning fa fa-database"  href="{{ url('admin/backup/create') }}">
                            <i class="fa backup"></i>Crear Nuevo respaldo</a>  
                
        
    </div>
 @if (count($backups))

    <table class="table table-striped table-bordered">
        <thead class="">
            <tr>
                <th>Archivo sql</th>
                <th>Tamaño</th>
                <th>Fecha</th>
                <th style="width:300px;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($backups as $backup)
                <tr>
                    <td>{{ $backup['file_name'] }}</td>
                    <td>{{ $backup['file_size'] }}</td>
                    <td>
                        {{ date('d/m/y  [g:ia]', strtotime($backup['last_modified'])) }}
                    </td>
                    <td class="">
                        <a class="btn btn-primary fa fa-database" href="{{ url('admin/backup/download/'.$backup['file_name']) }}">
                            <i class="fas fa-cloud-download"></i> Descargar</a>
                        <a class="btn btn-danger fa fa-trash" data-button-type="delete" href="{{ url('admin/backup/delete/'.$backup['file_name']) }}">
                           
                            Eliminar
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <div class="text-center py-5">
        <h1 class="text-muted">No existen backups</h1>
    </div>
@endif
@stop