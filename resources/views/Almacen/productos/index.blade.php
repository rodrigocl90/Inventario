<?php ?>



@extends('administrador.index')

@section('headder')



<nav aria-label="breadcrumb ">
 
  <ol class="breadcrumb arr-right bg-dark ">
 
    <li class="breadcrumb-item "><a href="#" class="text-light">Inicio</a></li>
 
    <li class="breadcrumb-item text-light active" aria-current="page">Productos</li>
 
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


      .modal-xl {
         height: 1200px !important;
        width: 100% !important;
       max-width:1400px !important;
       max-height: :1400px !important;
      }
    
.modal-body{
 height: 80% !important;

}


.modal-header{
background-color:#FFA500 !important;
}


.modal-headeredit{
background-color:#009688 !important;
color: white !important;
}

</style>


<meta name="csrf-token" content="{{ csrf_token() }}">
  
<span id="form_resulta"></span>



<span id="form_validation_messages"></span>

<div id="formModal" class="modal fade bd-example-modal-xl"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" role="dialog" data-backdrop="static" >
 <div class="modal-dialog modal-xl">
  <div class="modal-content">
   <div class="modal-header">
     <h4 class="modal-title">Crear Producto</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="CerrarAddModal()">
          <span aria-hidden="true">&times;</span>
        </button>
         
        </div>
        <div class="modal-body">
         <span id="form_validation"></span>
         <form method="post" id="form_add" class="form-horizontal" enctype="multipart/form-data">
          {{ csrf_field() }}
   
     <div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
    </div>
  </div>
  <div class="row">



    <div class="col-md-6">



        <div class="form-group">
    <label class="control-label">Nombre del producto :</label>
                 <div class="input-group">

  <div class="input-group-prepend">

    <span class="input-group-text"><i class="fa  fa-star"></i></span>
  </div>

  <input class="form-control form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }} " type="text" id="nombre" name="nombre" placeholder="ingrese nombre productos" maxlength="30" value="{{ old('nombre') }}" required>
    </div>
</div>


<div class="form-group">
 <label class="control-label">Descripción  del Producto :</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa  fa fa-user-circle-o"></i></span>
  </div>
 
   <textarea class="form-control rounded-0" id="descripcion" name="descripcion" rows="5"></textarea>

</div>
</div>



<div class="form-group">
 <label class="control-label">Precio de productos :</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa  fa-shopping-cart"></i></span>
  </div>
 
  <input class="form-control form-control{{ $errors->has('precio') ? ' is-invalid' : '' }} " type="text" id="precio" name="precio" placeholder="ingrese precio del Producto" maxlength="30" value="{{ old('precio') }}" required>

</div>
</div>




<div class="form-group">
 <label class="control-label">Stock de productos :</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa  fa-shopping-cart"></i></span>
  </div>
 
  <input class="form-control form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }} " type="text" id="stock" name="stock" placeholder="ingrese número de stock" maxlength="30" value="{{ old('nombre') }}" required>

</div>
</div>




    </div>
    <div class="col-md-6">



        <div class="form-group">

    <label class="control-label">Categoría del producto :</label>
                 <div class="input-group">

  <div class="input-group-prepend">

    <span class="input-group-text"><i class="fa fa-chain"></i></span>
  </div>
{{Form::select('id_categoria', $categorias, null, ['class' => 'form-control'])}}

    </div>
</div>





<div class="form-group">
 <label class="control-label">Estado :</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa  fa  fa-check-square"></i></span>
  </div>
   
           <select id="estado" name="estado" class="browser-default custom-select">
  <option value="3" disabled selected>Selecciona un estado</option>
  <option value="1">Activo</option>
  <option value="0">Desactivado</option>
</select>


</div>
</div>

<div class="form-group">
            <label class="control-label col-md-4">Cambiar Imagen del Producto: </label>
            <div class="col-md-8">
             <input type="file" name="imagen" id="imagen" />
             <span id="store_image"></span>
            </div>

</div>



          </div>



    </div>


     <div


      class="row">



    <div class="modal-footer">
    <div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
 <div class="form-group col-md-6 ">
    <label class="control-label">código del producto :</label>
                 <div class="input-group">

  <div class="input-group-prepend">

    <span class="input-group-text"><i class="fa fa-barcode"></i></span>
  </div>

  <input class="form-control form-control{{ $errors->has('codigo') ? ' is-invalid' : '' }} " type="text" id="codigo" name="codigo" placeholder="ingrese codigo" maxlength="30" value="{{ old('codigo') }}"  onkeyup="return validar(this.value)"; required>
    </div>
</div>
    </div>
        <div class="col-md-12">
<div class="form-group">
<a class="btn btn-primary btn-lg disabled generarCodigo" id="generarCodigo" href='javascript:;' onclick='generarcodigo();'role="button">Generar código del Producto</a> 
</div>
    </div>
        <div class="col-md-12">
<div id="barcode_mensaje" class="form-group">

    </div>
  </div>
</div>

  



</div>




        </div>
  </div>
  </div>
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
        <p>Tú quieres borrar el producto  <label for="recipient-name" class="alert-danger" id="Dnombre" name="Dnombre"></label> ? Esto no puede ser regresado.</p>
      </div>
      <div class="modal-footer">
           <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">Aceptar</button>
        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
     
      </div>
    </div>
  </div>
</div>














<!-- Editar producto -->


















<div id="formModalEdit"  class="modal fade bd-example-modal-xl"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" role="dialog" data-backdrop="static" >
 <div class="modal-dialog modal-xl">
  <div class="modal-content">
   <div class="modal-headeredit ">
     <h4 class="modal-title" align="center">Editar Producto</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="CerrarAddModal()">
          <span aria-hidden="true">&times;</span>
        </button>
         
        </div>
        <div class="modal-body">
      
        <span id="form_validate_edit"></span>
             <form method="post" id="form_edit" class="form-horizontal"  enctype="multipart/form-data">
          {{ csrf_field() }}

     <div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
    </div>
  </div>
  <div class="row">



    <div class="col-md-6">



        <div class="form-group">
    <label class="control-label">Nombre del producto :</label>
                 <div class="input-group">

  <div class="input-group-prepend">

    <span class="input-group-text"><i class="fa  fa-star"></i></span>
  </div>

  <input class="form-control form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }} " type="text" id="Enombre" name="Enombre" placeholder="ingrese nombre productos" maxlength="30" value="{{ old('Enombre') }}" required>
    </div>
</div>


<div class="form-group">
 <label class="control-label">Descripción  del Producto :</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa  fa fa-user-circle-o"></i></span>
  </div>
 
   <textarea class="form-control rounded-0" id="Edescripcion" name="Edescripcion" rows="5"></textarea>

</div>
</div>




<div class="form-group">
 <label class="control-label">Precio de productos :</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa  fa-shopping-cart"></i></span>
  </div>
 
  <input class="form-control form-control{{ $errors->has('Eprecio') ? ' is-invalid' : '' }} " type="text" id="Eprecio" name="Eprecio" placeholder="ingrese precio del Producto" maxlength="30" value="{{ old('Eprecio') }}" required>

</div>
</div>



<div class="form-group">
 <label class="control-label">Stock de productos :</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa  fa-shopping-cart"></i></span>
  </div>
 
  <input class="form-control form-control{{ $errors->has('Estock') ? ' is-invalid' : '' }} " type="text" id="Estock" name="Estock" placeholder="ingrese número de stock" maxlength="30" value="{{ old('Estock') }}" required>

</div>
</div>











    </div>
    <div class="col-md-6">



        <div class="form-group">

    <label class="control-label">Categoría del producto :</label>
                 <div class="input-group">

  <div class="input-group-prepend">

    <span class="input-group-text"><i class="fa fa-chain"></i></span>
  </div>
{{Form::select('Eid_categoria', $categorias, null, ['id'=>'Eid_categoria','class' => 'form-control'])}}

    </div>
</div>





<div class="form-group">
 <label class="control-label">Estado :</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa  fa  fa-check-square"></i></span>
  </div>
   
           <select id="Eestado" name="Eestado" class="browser-default custom-select">
  <option value="3" disabled selected>Selecciona un estado</option>
  <option value="1">Activo</option>
  <option value="0">Desactivado</option>
</select>


</div>
</div>

<div class="form-group">
            <label class="control-label">Selecciona una imagen del producto: </label>
            <div class="col-md-8">
           
             <input type="file" name="Eimagen" id="Eimagen" />
              <br>
              <br>

  <span id="store_imagen"></span>
            </div>

</div>



          </div>



    </div>


     <div


      class="row">



    <div class="modal-footer">
    <div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
 <div class="form-group col-md-6 ">
    <label class="control-label">código del producto :</label>
                 <div class="input-group">

  <div class="input-group-prepend">

    <span class="input-group-text"><i class="fa fa-barcode"></i></span>
  </div>

  <input class="form-control form-control{{ $errors->has('Ecodigo') ? ' is-invalid' : '' }} " type="text" id="Ecodigo" name="Ecodigo" placeholder="ingrese codigo" maxlength="30" value="{{ old('Ecodigo') }}"  onkeyup="return validaredit(this.value)"; required>
    </div>
</div>
    </div>
        <div class="col-md-12">
<div class="form-group">
<a class="btn btn-primary btn-lg Egenerarcodigoedit" id="Egenerarcodigoedit" href='javascript:;' onclick='generarcodigoedit();'role="button">Generar código del Producto</a> 
</div>
    </div>
        <div class="col-md-12">
<div id="barcode_mensaje_edit" class="form-group">

    </div>
  </div>
</div>

  



</div>




        </div>
  </div>
  </div>
          </div>

           <br />
           <div class="form-group" align="center">
          <input type="hidden" name="action" id="action" />
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






















<!-- Editar producto -->








 <div align="center">
      <button type="button" name="create_record" id="create_record" class="btn btn-warning btn-sm fa fa-smile-o">Crear Nuevo Productos</button>
</div>

@include('datatable.general.script')

<div style="overflow-x:auto;"  align="center" margin="0 auto" >

{{ $dataTable->table(['class' => 'responsive warning grocery-crud-table cell-border table-hover compact dataTable_width_auto table-striped', 'id' => 'table'])}}
</div>

{{$dataTable->scripts()}}









<script type="text/javascript">




  //PARA AGREGAR


$(document).ready(function(){
var token = $("meta[name='csrf-token']").attr("content");
 
 $('#create_record').click(function(){
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
    url:"{{ route('productos.store') }}",
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
       document.getElementById("barcode_mensaje").innerHTML="";
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
   url:"{{ route('productos.update') }}",
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
                      
  $('#form_validation_messages').html(carga);

     }
  $('#form_validation').html(html);
    
    }
   })
  }
   });









 $(document).on('click', '.edit', function(){
  var id = $(this).attr('id');
  $.ajax({
   url:"productos/prcrud/edit/"+id,
   dataType:"json",
   success:function(html){
   $('#Enombre').val(html.data.nombre);
    $('#Edescripcion').val(html.data.descripcion);
      $('#Ecodigo').val(html.data.codigo);
        $('#Estock').val(html.data.stock);
        $('#Eprecio').val(html.data.precio);
       document.getElementById('Eid_categoria').value =html.data.id_categoria;
    document.getElementById('Eestado').value =html.data.estado;
       $('#store_imagen').html("<img src={{ URL::to('/') }}/images/" + html.data.imagen+ " style='max-width:100%;width:auto;height:auto;'/>");
    $('#store_imagen').append("<input type='hidden' name='hidden_image' value='"+html.data.imagen+"' />");
 $('#Ehidden_id').val(id);


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
 

   
  producto_id = $(this).attr('id');

  $.ajax({
   url:"productos/prcrud/edit/"+producto_id,
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
 url:"productos/prcrud/destroy/"+producto_id,

  
   
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



function generarcodigo() {

var barcode= document.getElementById('codigo').value;

$('#barcode_mensaje').load('productos/prcrud/barcode/'+barcode);
      
 

}



function generarcodigoedit() {

var barcode= document.getElementById('Ecodigo').value;

$('#barcode_mensaje_edit').load('productos/prcrud/barcode/'+barcode);
      
 

}


function CerrarAddModal() {

   $('#form_add')[0].reset();  
       document.getElementById("barcode_mensaje").innerHTML="";
}



function validar(val)
{
if (val==null || val=="") {  $('#generarCodigo').addClass('disabled');}
else
if (val!=null || val!="") { $('#generarCodigo').removeClass('disabled');}

}


function validaredit(val)
{


if (val==null || val=="") {  $('#Egenerarcodigoedit').addClass('disabled');}
else
if (val!=null || val!="") { $('#Egenerarcodigoedit').removeClass('disabled');}
}


</script>
@stop