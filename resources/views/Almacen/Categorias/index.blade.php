<?php ?>



@extends('administrador.index')

@section('headder')



<nav aria-label="breadcrumb ">
 
  <ol class="breadcrumb arr-right bg-dark ">
 
    <li class="breadcrumb-item "><a href="#" class="text-light">Inicio</a></li>
 
    <li class="breadcrumb-item text-light active" aria-current="page">Lista de Categorías</li>
 
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

.modal-header {
    padding:9px 15px;
    border-bottom:1px solid #eee;
    background-color: #0480be;
    -webkit-border-top-left-radius: 5px;
    -webkit-border-top-right-radius: 5px;
    -moz-border-radius-topleft: 5px;
    -moz-border-radius-topright: 5px;
     border-top-left-radius: 5px;
     border-top-right-radius: 5px;
     color: white;text-align: left;
   border:1px solid black;
 }

.modal-bodyz{
height:200px;
background-color:;
text-align: left;
   border:1px solid black;
}
</style>

@include('flashy::message')

<meta name="csrf-token" content="{{ csrf_token() }}">

 <div align="center">
      <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm fa fa-reorder">Crear nueva categoría</button>
     </div>
<span id="form_validation_messages"></span>

<div id="formModal" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
     <h4 class="modal-title">Crear Categoría</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
         
        </div>
        <div class="modal-body">
         <span id="form_validation"></span>
         <form method="post" id="form_add" class="form-horizontal" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nombre de la Categoría:</label>
            <input type="text" class="form-control" id="nombre" name="nombre">
          </div>
         
           <div class="form-group">
            <label for="recipient-name" class="col-form-label">Decripción de la categoría:</label>
            <textarea class="form-control rounded-0" id="descripcion" name="descripcion" rows="5"></textarea>
          </div>
        
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Estado de la Categoría:</label>
          
           <select id="estado" name="estado" class="browser-default custom-select">
  <option value="" disabled selected>Selecciona un estado</option>
  <option value="1">Activo</option>
  <option value="0">Desactivado</option>
</select>


          </div>

           <br />
           <div class="form-group" align="center">
            <input type="hidden" name="action" id="action" />
            <input type="hidden" name="hidden_id" id="hidden_id" />
            <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="agregar" />
           </div>
         </form>
        </div>
     </div>
    </div>
</div>








<div id="EformModal" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header alert-warning" >
    <br>
     <h4 class="Emodal-title" align="center">Editar Categoría</h4>
           
          <span aria-hidden="true">&times;</span>
       
         



        </div>
        <div class="modal-body" >
         <span id="form_validation"></span>
         <form method="post" id="form_edit" class="form-horizontal">
           {{ csrf_field() }}
<span id="form_validation"></span>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nombre de la Categoría:</label>
            <input type="text" class="form-control" id="Enombre" name="Enombre">
          </div>
         
           <div class="form-group">
            <label for="recipient-name" class="col-form-label">Decripción de la categoría:</label>
            <textarea class="form-control rounded-0" id="Edescripcion" name="Edescripcion" rows="5"></textarea>
          </div>
        
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Estado de la Categoría:</label>
          
           <select id="tado" name="tado" class="browser-default custom-select">
  <option  disabled selected>Selecciona un estado</option>
  <option value="0" class="success">Desactivado</option>
   <option value="1">Activo</option>
</select>


          </div>

           <br />
           <div class="form-group" align="center">
            <input type="hidden" name="Eaction" id="Eaction" />
            <input type="hidden" name="Ehidden_id" id="Ehidden_id" />
            <input type="submit" name="Eaction_button" id="Eaction_button" class="btn btn-warning"/>
             <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
           </div>
         </form>
        </div>
     </div>
    </div>
</div>





















<div id="confirmModal" class="modal fade bd-example-modal-xl " role="dialog">
    <div class="modal-dialog alert-danger">
        <div class="modal-content">
            <div class="modal-headera alert-danger">
              
                    <br>
                <h2 class="modal-titles" align="center">Eliminar Categoría</h2>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            </div>
            <div class="modal-bodyz">
              <br>
              <br>
              <br>
              <br>
                <h4 align="center" style="margin:0;"> Estás seguro de borrar 
               la categoría
        <label for="recipient-name" class="alert-danger" id="Dnombre" name="Dnombre"></label> ?

            </div>
            <div class="modal-footer">
             <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">Aceptar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>







@include('datatable.general.script')

<div style="overflow-x:auto;"  align="center" margin="0 auto" >

{{ $dataTable->table(['class' => 'warning grocery-crud-table cell-border table-hover compact dataTable_width_auto table-striped', 'id' => 'table'])}}
</div>

{!! $dataTable->scripts() !!}














<script type="text/javascript">


$(document).ready(function(){
var token = $("meta[name='csrf-token']").attr("content");
 
 $('#create_record').click(function(){
  $('.modal-title').text("Nueva Categoría");
     $('#action_button').val("agregar");
     $('#action').val("agregar");
     $('#formModal').modal('show');
 });



  //PARA AGREGAR


 $('#form_add').on('submit', function(event){
  event.preventDefault();
  if($('#action').val() == 'agregar')
  {
   $.ajax({
    url:"{{ route('categorias.store') }}",
    method:"POST",
    data: new FormData(this),
    contentType: false,
    cache:false,
    processData: false,
    dataType:"json",
    success:function(data)
    {
     var html = '';
     if(data.errors)
     {
      html = '<div class="alert alert-danger">';
      for(var count = 0; count < data.errors.length; count++)
      {
       html += '<p>*' + data.errors[count] + '</p>';
      }
      html += '</div>';
     }
     if(data.success)
     {
    
      $('#form_add')[0].reset();  
         $('#formModal').modal('hide');
            var table = $('#table').DataTable();
                table.ajax.reload();

                  carga = '<div class="alert alert-success">' + data.success + '<button type="button" class="close" data-dismiss="alert">×</button></div>';
                $('#form_validation_messages').html(carga);

     }
     $('#form_validation').html(html);
    
    }
   })
  }
   });

  //PARA AGREGAR



//PARA EDITAR

 $('#form_edit').on('submit', function(event){
  event.preventDefault();
  if($('#Eaction').val() == "Edit")
  {
   $.ajax({
   url:"{{ route('categorias.update') }}",
    method:"POST",
    data: new FormData(this),
    contentType: false,
    cache:false,
    processData: false,
    dataType:"json",
    success:function(data)
    {
     var html = '';
     if(data.errors)
     {
      html = '<div class="alert alert-danger">';
      for(var count = 0; count < data.errors.length; count++)
      {
       html += '<p>*' + data.errors[count] + '</p>';
      }
      html += '</div>';
     }
     if(data.success)
     {
    
      $('#form_add')[0].reset();  
         $('#EformModal').modal('hide');
            var table = $('#table').DataTable();
                table.ajax.reload();

                  carga = '<div class="alert alert-warning">' + data.success + '<button type="button" class="close" data-dismiss="alert">×</button></div>';
               
  $('#form_validation_messages').html(carga);
     }
       $('#form_validation').html(html);
    
    }
   })
  }
   });









 $(document).on('click', '.edit', function(){
  var id = $(this).attr('id');
  $('#form_validation').html('');
  $.ajax({
   url:"categorias/ccrud/edit/"+id,
   dataType:"json",
   success:function(html){
    $('#Enombre').val(html.data.nombre);
    $('#Edescripcion').val(html.data.descripcion);
     $('#Ehidden_id').val(id);
    document.getElementById('tado').value =html.data.estado;
    $('.Emodal-title').text("Editar categoría");
    $('#Eaction_button').val("Editar");
    $('#Eaction').val("Edit");
    $('#EformModal').modal('show');
   }
  })
 });

 var user_id;




 //PARA EDITAR


 //PARA ELIMINAR

 $(document).on('click', '.delete', function(){
 

   
  user_id = $(this).attr('id');

  $.ajax({
   url:"categorias/ccrud/edit/"+user_id,
   dataType:"json",
   success:function(html){
 
   document.querySelector('#Dnombre').innerText =html.data.nombre;
   }
  })



   setTimeout(function(){
       $('#confirmModal').modal('show');
   }, 1500);



 });

 $('#ok_button').click(function(){
  $.ajax({
     type: 'DELETE',
        data: {
           
            "_token": token,
        },
 url:"categorias/ccrud/destroy/"+user_id,
  
   
   success:function(data)
   {
     

cargas = '<div class="alert alert-danger">' + data.success + '<button type="button" class="close" data-dismiss="alert">×</button></div>';
                $('#form_validation_messages').html(cargas);


     var table = $('#table').DataTable();
                table.ajax.reload();
       $('#confirmModal').modal('hide');
       $('#ok_button').text('Aceptar');
   }
  })
 });

});

//PARA ELIMINAR
</script>

@stop