<?php ?>



@extends('administrador.index')

@section('headder')



<nav aria-label="breadcrumb ">
 
  <ol class="breadcrumb arr-right bg-dark ">
 
    <li class="breadcrumb-item "><a href="#" class="text-light">Inicio</a></li>
 
    <li class="breadcrumb-item text-light active" aria-current="page">Lista de Clientes</li>
 
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


<meta name="csrf-token" content="{{ csrf_token() }}">

<span id="form_resulta"></span>






<div id="confirmModal" class="modal fade" aria-hidden="true">
  <div class="modal-dialog modal-confirm">
    <div class="modal-content">
      <div class="modal-header">
        <div class="icon-box">
          <i class="material-icons"></i>
        </div>        
        <h4 class="modal-title">Estás Seguro?</h4>  
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        <p>Tú quieres borrar el Cliente   <label for="recipient-name" class="alert-danger" id="Dnombre" name="Dnombre"></label> ? Esto no puede ser regresado.</p>
      </div>
      <div class="modal-footer">
           <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">Aceptar</button>
        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
     
      </div>
    </div>
  </div>
</div>






<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header alert-success" >
                <h3 class="modal-title">Cliente</h1>
            </div>
            <div class="modal-body">
                 <span id="form_result"></span>
             <form method="post" id="form_add" class="form-horizontal" >
          {{ csrf_field() }}

          <div class="form-group">
    <label class="control-label">Nombre del Cliente</label>
                 <div class="input-group">

  <div class="input-group-prepend">

    <span class="input-group-text"><i class="fa fa-user fa-fw"></i></span>
  </div>

  <input class="form-control form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }} " type="text" id="nombre" name="nombre" placeholder="ingrese nombre Usuario" maxlength="30" value="{{ old('nombre') }}" required>
    </div>
</div>

<div class="form-group">
   
 <label class="control-label">Tipo de Documento :</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa  fa-book"></i></span>
  </div>
  <select id="documento" name="documento" class="browser-default custom-select">
  <option value="0" disabled selected>Selecciona un estado</option>
  <option value="DNI">DNI</option>
  <option value="CEDULA">CEDULA</option>
    <option value="RUC">RUC</option>
</select>

</div>
</div>



         <div class="form-group">
    <label class="control-label">Número de documento</label>
                 <div class="input-group">

  <div class="input-group-prepend">

    <span class="input-group-text"><i class="fa fa-user fa-fw"></i></span>
  </div>

<input  class="form-control form-control{{ $errors->has('numero') ? ' is-invalid' : '' }}" type="text" id="numero" name="numero" placeholder="ingrese Número de Documento" maxlength="20" value="{{old('numero') }}" required>
    </div>
</div>




        <label class="control-label">Nº móvil :</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa fa- fa-phone fa-fw"></i></span>
  </div>
  <input  class="form-control form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" type="text" id="telefono" name="telefono" placeholder="ingrese Nº móvil del Usuario" maxlength="9" value="{{old('telefono') }}" required>
     
</div>


 <label class="control-label">Email del cliente :</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa fa- fa-envelope fa-fw"></i></span>
  </div>
  <input class="form-control form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="text" id="email" name="email" placeholder="ingrese email del Usuario" maxlength="191" value="{{ old('email') }}" required>
      @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </div>
                                @endif
</div>

          <div class="form-group">
    <label class="control-label">Dirección</label>
                 <div class="input-group">

  <div class="input-group-prepend">

    <span class="input-group-text"><i class="fa fa-map-marker"></i></span>
  </div>

  <input class="form-control form-control{{ $errors->has('direccion') ? ' is-invalid' : '' }} " type="text" id="direccion" name="direccion" placeholder="ingrese Dirección del Proveedor" maxlength="500" value="{{ old('direccion') }}" required>
    </div>
</div>

                    

                    <div class="form-group">
                       <input type="hidden" name="action" id="action" />
            <input type="hidden" name="hidden_id" id="hidden_id" />
            <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="agregar" />
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->














<div class="modal fade" id="formModalEdit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header alert-success">
                <h3>Editar Clientes</h3>
            </div>
            <div class="modal-body">
                 <span id="form_validate_edit"></span>
             <form method="post" id="form_edit" class="form-horizontal" >
          {{ csrf_field() }}

          <div class="form-group">
    <label class="control-label">Nombre del Cliente</label>
                 <div class="input-group">

  <div class="input-group-prepend">

    <span class="input-group-text"><i class="fa fa-user fa-fw"></i></span>
  </div>

  <input class="form-control form-control{{ $errors->has('Enombre') ? ' is-invalid' : '' }} " type="text" id="Enombre" name="Enombre" placeholder="ingrese nombre Usuario" maxlength="30" value="{{ old('Enombre') }}" required>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Tipo de Documento :</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa  fa-book"></i></span>
  </div>
  <select id="Edocumento" name="Edocumento" class="browser-default custom-select">
  <option value="0" disabled selected>Selecciona un estado</option>
  <option value="DNI">DNI</option>
  <option value="CEDULA">CEDULA</option>
    <option value="RUC">RUC</option>
</select>

</div>
</div>



         <div class="form-group">
    <label class="control-label">Número de documento</label>
                 <div class="input-group">

  <div class="input-group-prepend">

    <span class="input-group-text"><i class="fa fa-user fa-fw"></i></span>
  </div>

<input  class="form-control form-control{{ $errors->has('Enumero') ? ' is-invalid' : '' }}" type="text" id="Enumero" name="Enumero" placeholder="ingrese Número de Documento" maxlength="20" value="{{old('Enumero') }}" required>
    </div>
</div>




        <label class="control-label">Nº móvil :</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa fa- fa-phone fa-fw"></i></span>
  </div>
  <input  class="form-control form-control{{ $errors->has('Etelefono') ? ' is-invalid' : '' }}" type="text" id="Etelefono" name="Etelefono" placeholder="ingrese Nº móvil del Usuario" maxlength="9" value="{{old('Etelefono') }}" required>
     
</div>


 <label class="control-label">Email del Cliente:</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa fa- fa-envelope fa-fw"></i></span>
  </div>
  <input class="form-control form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="text" id="Eemail" name="Eemail" placeholder="ingrese email del Usuario" maxlength="191" value="{{ old('Eemail') }}" required>
     
</div>

          <div class="form-group">
    <label class="control-label">Dirección</label>
                 <div class="input-group">

  <div class="input-group-prepend">

    <span class="input-group-text"><i class="fa fa-map-marker"></i></span>
  </div>

  <input class="form-control form-control{{ $errors->has('Edireccion') ? ' is-invalid' : '' }} " type="text" id="Edireccion" name="Edireccion" placeholder="ingrese Dirección del Proveedor" maxlength="500" value="{{ old('Edireccion') }}" required>
    </div>
</div>

                    

                    <div class="form-group">
                       <input type="hidden" name="action" id="action" />
             <input type="hidden" name="Eaction" id="Eaction" />
            <input type="hidden" name="Ehidden_id" id="Ehidden_id" />
            <input type="submit" name="Eaction_button" id="Eaction_button" class="btn btn-warning"/>
             <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




















 <div align="center">
      <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm fa  fa-check-square">Crear Nuevo Cliente</button>
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
  $('.modal-title').text("Nuevo Cliente");
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
    url:"{{ route('clientes.store') }}",
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
                $('#form_resulta').html(carga);

     }
     $('#form_result').html(html);
    
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
   url:"{{ route('clientes.update') }}",
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
    
      $('#form_edit')[0].reset();  
         $('#formModalEdit').modal('hide');
            var table = $('#table').DataTable();
                table.ajax.reload();

                  carga = '<div class="alert alert-warning">' + data.success + '<button type="button" class="close" data-dismiss="alert">×</button></div>';
                $('#form_resulta').html(carga);

     }
     $('#form_validate_edit').html(html);
    
    }
   })
  }
   });









 $(document).on('click', '.edit', function(){
  var id = $(this).attr('id');
  $.ajax({
   url:"clientes/clcrud/edit/"+id,
   dataType:"json",
   success:function(html){
    $('#Enombre').val(html.data.nombre);
    $('#Enumero').val(html.data.numero);
      $('#Edireccion').val(html.data.direccion);
        $('#Etelefono').val(html.data.telefono);
          $('#Eemail').val(html.data.email);
     $('#Ehidden_id').val(id);
       document.getElementById('Edocumento').value =html.data.documento;
    $('.Emodal-title').text("Editar categoría");
    $('#Eaction_button').val("Editar");
    $('#Eaction').val("Edit");
    $('#formModalEdit').modal('show');
   }
  })
 });

 var user_id;




 //PARA EDITAR


 //PARA ELIMINAR

 $(document).on('click', '.delete', function(){
 

   
  user_id = $(this).attr('id');

  $.ajax({
   url:"clientes/clcrud/edit/"+user_id,
   dataType:"json",
   success:function(html){
 
   document.querySelector('#Dnombre').innerText =html.data.nombre;
   }
  })


  $('#confirmModal').modal('show');


 });

 $('#ok_button').click(function(){
  $.ajax({
     type: 'DELETE',
        data: {
           
            "_token": token,
        },
 url:"clientes/clcrud/destroy/"+user_id,
  
   
   success:function(data)
   {
     

cargas = '<div class="alert alert-danger">' + data.success + '<button type="button" class="close" data-dismiss="alert">×</button></div>';
                $('#form_resulta').html(cargas);


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