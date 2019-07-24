<?php 
setlocale(LC_TIME,"es_ES");
 ?>



@extends('administrador.index')

@section('headder')


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" charset="UTF-8" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" charset="UTF-8" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>



 </head>
 <body>

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

<nav aria-label="breadcrumb ">
 
  <ol class="breadcrumb arr-right bg-dark ">
 
    <li class="breadcrumb-item "><a href="#" class="text-light">Inicio</a></li>
 
    <li class="breadcrumb-item text-light active" aria-current="page">Lista de Ventas</li>
 
  </ol></nav>


  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>




  <meta name="csrf-token" content="{{ csrf_token() }}">

  <div class="container">    
     <br />
     <h3 align="center">Operaciones de Venta</h3>


<span id="form_resultado"></span>

     <br />
            <br />
            <div class="row input-daterange">
                <div class="col-md-4">
                    <input type="text" name="from_date" id="from_date" class="form-control" placeholder="Comienzo" readonly />
                </div>
                <div class="col-md-4">
                    <input type="text" name="to_date" id="to_date" class="form-control" placeholder="Termino" readonly />
                </div>
                <div class="col-md-4">
                    <button type="button" name="filter" id="filter" class="btn btn-primary">Buscar</button>
                    <button type="button" name="refresh" id="refresh" class="btn btn-default">Refrescar</button>
                </div>
            </div>
            <br />
   <div class="table-responsive">
    <table class="table-responsive order_table table-bordered table-striped" name="order_table" id="order_table">
           <thead>
            <tr>
                <th>Proveedor</th>
                <th>Tipo pago</th>
                <th>Tipo Documento</th>
                <th>Número  Documento</th>
                  <th>Fecha de Emisión</th>
                  <th>Neto</th>
                  <th>Iva</th>
                  <th>Total</th>
                  <th>Estado</th>
                  <th>Creador</th>
                  <th>Fecha Creación</th>
                  <th>BotonesOpciones</th>

            </tr>
           </thead>
       </table>
   </div>
  </div>
 </body>
</html>








<div id="confirmModal" class="modal fade" aria-hidden="true">
  <div class="modal-dialog modal-confirm">
    <div class="modal-content">
      <div class="modal-header">
        <div class="icon-box">
          <i class="material-icons"></i>
         
        </div>        
        <h4 class="modal-title">Estás Seguro Cambiar Estado de la Operación</h4>  
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        <p> Esto no puede ser regresado a menos que seas administrador.</p>
      </div>
      <div class="modal-footer">
           <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">Aceptar</button>
        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
     
      </div>
    </div>
  </div>
</div>





<!-- Modal -->
<div class="modal fade bd-example-modal-xl" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Datos de la Operación de entrada</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
<div id="div_cuerpo" class="form-group">

    </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>











<script>
$.fn.datepicker.dates['es'] = {
  days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
  daysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
  daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sá"],
  months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
  monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
  today: "Hoy",
  clear: "Borrar",
  format: "dd/mm/yyyy",
  titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
  weekStart: 0
};





 $(document).on('click', '.edit', function(){
  var id = $(this).attr('id');




 
 var url = '{{ route("salidas.cuerpo", ":slug") }}';

url = url.replace(':slug', id);


 $('#div_cuerpo').load(url);
   setTimeout(function(){



       $('#exampleModal').modal('show');
   }, 2000);  
 });









$(document).ready(function(){
 $('.input-daterange').datepicker({
  todayBtn:'linked',
  format:'dd-mm-yyyy',
   language: 'es',
  autoclose:true
 });

 load_data();





 function load_data(from_date = '', to_date = '')
 {
  $('#order_table').DataTable({
    dom: 'lBfrtip',
      "bLengthChange" : true, //thought this line could hide the LengthMenu
    "bInfo":true,    
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        buttons: 
           [
'copy', 'csv', 'excel', 'pdf','print'
],
    language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }
    },
   processing: true,
   serverSide: true,

   ajax: {
    url:'{{ route("salidas.index") }}',
    data:{from_date:from_date, to_date:to_date}
   },
   columns: [
    {
     data:'nombre',
     name:'personas.nombre'

    },
    {
     data:'pestado',
     name:'pestado'
    },
    {
     data:'Documento',
     name:'Documento'
    },
     {
     data:'numero_documento',
     name:'numero_documento'
    },
     {
     data:'fecha_emision',
     name:'fecha_emision'
    },
    {
     data:'neto',
     name:'neto'
    },
    {
     data:'iva',
     name:'iva'
    },
    {
     data:'total',
     name:'total'
    },
     {
     data:'estadoOperacion',
     name:'estadoOperacion'
    },
     {
     data:'name',
     name:'users.name'
    },
      {
     data:'created_at',
     name:'operaciones.created_at'
    },
     {
     data:'action',
     name:'action',
    }
   ]
  });
 }

 $('#filter').click(function(){
  var from_date = $('#from_date').val();
  var to_date = $('#to_date').val();
  if(from_date != '' &&  to_date != '')
  {
   $('#order_table').DataTable().destroy();
   load_data(from_date, to_date);
  }
  else
  {
   alert('Fechas son requeridas');
  }
 });

 $('#refresh').click(function(){
  $('#from_date').val('');
  $('#to_date').val('');
  $('#order_table').DataTable().destroy();
  load_data();
 });

});




 var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');


 $(document).on('click', '.delete', function(){
 

   id = $(this).attr('id');


       setTimeout(function(){
       $('#confirmModal').modal('show');
   }, 2000);


 });

   

 $(document).on('click', '.ver', function(){

  id = $(this).attr('id');


 
 var url = '{{ route("imprimir_salida", ":slug") }}';

url = url.replace(':slug', id);


       window.open(url);

 });


    $('#ok_button').click(function(){
                $.ajax({
                    /* the route pointing to the post function */
                   url:  "{{ route('entradas.operacion.estado') }}",          
                    type: 'POST',
                    /* send the csrf-token and the input to the controller */
                    data: {_token: CSRF_TOKEN, message:$(".getinfo").val(),
                    dato1:ido
                    ,
                
                               

                  },
                    dataType: 'JSON',

                        beforeSend: function () {
                        $("#form_resultado").html("Procesando, espere por favor...");
                },

                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) { 
                      
 cargas = '<div class="alert alert-success">' + data.success + '<button type="button" class="close" data-dismiss="alert">×</button></div>';
              $('#form_resultado').html(cargas);

 var table = $('#order_table').DataTable();
                table.ajax.reload();
       $('#confirmModal').modal('hide');
       $('#ok_button').text('Aceptar');

    


                          
                    }
                }); 
            });


</script>

@stop