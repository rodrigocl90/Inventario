<?php 
setlocale(LC_TIME,"es_ES");
 ?>



@extends('administrador.index')

@section('headder')


    <style type="text/css">

.pagem{
  background-color: #337ab7 !important;
  color: white
}


.fl{
  

}


</style>



<meta name="csrf-token" content="{{ csrf_token() }}">


<nav aria-label="breadcrumb ">
 
  <ol class="breadcrumb arr-right bg-dark ">
 
    <li class="breadcrumb-item "><a href="#" class="text-light">Inicio</a></li>

 
    <li class="breadcrumb-item text-light active" aria-current="page">Lista de Ventas</li>

  
    <li class="breadcrumb-item text-light active" aria-current="page">Ingreso Ventas</li>
  </ol></nav>




@stop
@section('contenido')


  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>

 
<!------ Include the above in your HEAD tag ---------->

<div class="container table-bordered table-hover fl" id="container">
  <div class="row clearfix">
    <div class="col-md-12">

<div class="page-header pagem">
        <h1 align="center">
        Venta de Productos
        </h1>


        <div id="encabezado"></div>

      </div>





<div class="table-bordered table-hover" style="margin-top:20px">
<!------ Primero ---------->
<div class="container-fluid">


  <div class="row">
      

    <div class="col-md-4">


    <label class="control-label">Nombre del Cliente</label>



<select class="id_persona form-control"  name="id_persona" id="id_persona"></select>




    </div>


    <div class="col-md-4">

       <label class="control-label">Fecha de Emisión</label>
       <br>
<input type="date" class="fecha_emision form-control fecha_emision" id="fecha_emision" name="fecha_emision" />
    </div>





<div class="col-md-4">

 <label class="control-label">Tipo de pago:</label>
<br>
  <select id="tipo_pago" name="tipo_pago"  heigth="100px"      class="tipo_pago form-control">
  <option value="0" disabled selected>Selecciona un metodo de pago</option>
  <option value="1">Efectivo</option>
  <option value="2">Cheque</option>
    <option value="3">Credito</option>
</select>


</div>







    </div>
<br><br>


  </div>
</div>



<!------ Segundo---------->


<div class="container-fluid table-bordered table-hover" style="margin-top:20px">


  <div class="row">
      



    <div class="col-md-4">


 <label class="control-label">Tipo de Documento:</label>
<br>
  <select id="tipo_documento" name="tipo_documento"  heigth="100px"    class="tipo_documento form-control">
  <option value="0" disabled selected>Selecciona un metodo de pago</option>
  <option value="1">Factura</option>
  <option value="2">Boleta</option>
    
</select>
 </div>


      <div class="col-md-4">
   <div class="form-group">
            <label for="recipient-name" class="col-form-label">Número de Comprobante:</label>
            <input type="text" class="numero_documento form-control" maxlength="10" id="numero_documento" name="numero_documento" onkeyup="format(this)" onchange="format(this)">
          </div>
         
    </div>

  


<div class="col-md-4">
  <input type="text" class="tipo_operacion" maxlength="10" id="tipo_operacion" name="tipo_operacion" value="1" hidden>
    </div>



  </div>
</div>

<!------ Segundo---------->




<!------ tercero---------->


<div class="container-fluid">


  <div class="row">
      

    <div class="col-md-4">



    </div>


    <div class="col-md-4">

    </div>


<div class="col-md-4">

    </div>



  </div>
</div>


<!------ tercero---------->

<br>
<br>


</div>

<div class="container-fluid">


  <div class="row">
      

    <div class="col-md-4">
</div>
    <div class="col-md-4">
<div id="form_validation_messages"></div>

</div>
    <div class="col-md-4">
</div>
</div>

</div>



      <table class="table table-bordered table-hover responsive" id="tab_logic">
        <thead>
          <tr>
            <th class="text-center">  </th>
            <th class="text-center"> Producto </th>
            <th class="text-center"> Cantidad </th>
            <th class="text-center"> Precio </th>
            <th class="text-center"> total </th>
             <th class="text-center"> Botones </th>
          </tr>
        </thead>
        <tbody>
          <tr id='addr0'>
            <td></td>
            <td width="30%"><select class="id_producto form-control"  name="id_producto"></select></td>
            <td>  

 <div class="input-group">
<div class="input-group-prepend">
    <span class="input-group-text"><i class="fa  fa-star"></i></span>
  </div>
 <input type="text"  maxlength="7"   class="cantidad form-control" id="cantidad" placeholder="0" name="cantidad" onchange="calculo1()" onkeyup="format(this)" onchange="format(this)" />
                                       </div></td>


                        <td>
    

 <div class="input-group">
<div class="input-group-prepend">
    <span class="input-group-text"><i class="fa  fa-dollar"></i></span>
  </div>
<input type="text" maxlength="10" min="0"  name='precio'  id='precio' placeholder='0'  class="precio form-control price" onchange="calculo1()" onkeyup="format(this)" onchange="format(this)"/>
               </div>


                                     </td>
            <td>
<div class="input-group">
<div class="input-group-prepend">
    <span class="input-group-text"><i class="fa  fa-dollar"></i></span>
  </div>
<input type="text" name='total' id="total" placeholder='0' value="0" class="hidden total form-control total" readonly/>

               </div>
</td>

              <td> 
             <button class="postbutton">Agregar producto</button>
               </td>
          </tr>
          <tr id='addr1'></tr>
        </tbody>
      </table>



<div class="container-fluid">


  <div class="row">
      

    <div class="col-md-1">
</div>
    <div class="col-md-9">



<div id="temporal" class="temporal">
  

</div>

</div>
    <div class="col-md-1">
</div>
</div>

</div>









    </div>
  </div>
  



  

<!-- Editar producto !-->

<!-- Editar producto !-->










<script type="text/javascript">



function conComas(valor) {
    var nums = new Array();
    var simb = "."; //Éste es el separador
    valor = valor.toString();
    valor = valor.replace(/\D/g, "");   //Ésta expresión regular solo permitira ingresar números
    nums = valor.split(""); //Se vacia el valor en un arreglo
    var long = nums.length - 1; // Se saca la longitud del arreglo
    var patron = 3; //Indica cada cuanto se ponen las comas
    var prox = 2; // Indica en que lugar se debe insertar la siguiente coma
    var res = "";
 
    while (long > prox) {
        nums.splice((long - prox),0,simb); //Se agrega la coma
        prox += patron; //Se incrementa la posición próxima para colocar la coma
    }
 
    for (var i = 0; i <= nums.length-1; i++) {
        res += nums[i]; //Se crea la nueva cadena para devolver el valor formateado
    }
 
    return res;
}


function validate(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}





function format(input)
{
var num = input.value.replace(/\./g,'');
if(!isNaN(num)){
num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
num = num.split('').reverse().join('').replace(/^[\.]/,'');
input.value = num;
}

else{ 
input.value = input.value.replace(/[^\d\.]*/g,'');
}
}





//separador miles



 function calculo1(){


a=document.getElementById("precio").value.replace('.', '');  
b=document.getElementById("cantidad").value.replace('.', ''); 


suma=a*b;

document.getElementById("total").value=conComas(suma);


}
   $(document).ready(function(){




  $('#temporal').load("{{ route('salidas.temporal') }}");


            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        

            $(".postbutton").click(function(){
                $.ajax({
                    /* the route pointing to the post function */
                    url: "{{ route('ingreso.temporal.ventas')}}",
                    type: 'POST',
                    /* send the csrf-token and the input to the controller */
                    data: {_token: CSRF_TOKEN, message:$(".getinfo").val(),
                     precio:$(".precio").val(),
                         id_producto:$(".id_producto").val(),
                            cantidad:$(".cantidad").val(),
                             total:$(".total").val(),
                         tipo_operacion:$(".tipo_operacion").val(),   

                  },
                    dataType: 'JSON',

                        beforeSend: function () {
                        $("#form_validation_messages").html("Procesando, espere por favor...");
                },

                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) { 
                      
  $('#temporal').load("{{ route('salidas.temporal') }}");


 var html = '';
     if(data.errors)
     {
      html = '<div class="alert alert-danger center" >';
      for(var count = 0; count < data.errors.length; count++)
      {
       html += '<p align="center">*' + data.errors[count] + '</p>';
      }
      html += '</div>';
     }
      if(data.stock)
     {
      html = '<div class="alert alert-success center">QUEDAN&nbsp&nbsp '+data.stock+'&nbsp&nbsp  PRODUCTOS  <BR>//PROBLEMA DE STOCK, NO HAY MUCHOS PRODUCTOS PARA LA VENTA</div>';
     
     }
     if(data.success)
     {
           $('#form_validation_messages').hidden();

     }


     $('#form_validation_messages').html(html);
    
setTimeout(function() {
    // Declaramos la capa  mediante una clase para ocultarlo
        $("#form_validation_messages").fadeIn(1500);
    // Transcurridos 5 segundos aparecera la capa midiv2
    },5000);


                          
                    }
                }); 
            });
       });
 



 


      $('.id_persona').select2({
        placeholder: 'Ingrese cliente',
        ajax: {
          url: "{{ route('ajax_clientes') }}",

          dataType: 'json',
          processResults: function (data) {
            return {
              results:  $.map(data, function (item) {
                    return {
                        text: item.nombre,
                        id: item.id

                    }
                })
            };
          },
          cache: true
        }
      });



         $('.id_producto').select2({
        placeholder: 'Ingrese producto',
        ajax: {
          url: "{{ route('ajax1') }}",

          dataType: 'json',

          processResults: function (data) {
            return {
              results:  $.map(data, function (item) {
                    return {
                        text: item.nombre,
                        id: item.id
                    }
                })
            };
          },
          cache: true
        }
      });






</script>



@stop