<br>
<br>

      @if(!$temporal->isEmpty())
      <h3 align="center">Productos de La operación</h3>

      <table class="table table-bordered table-hover" id="tab_logic">
        <thead>
          <tr>
            <th class="text-center"> # </th>
            <th class="text-center"> Producto </th>
            <th class="text-center"> Cantidad </th>
            <th class="text-center"> Precio Unitario</th>
            <th class="text-center"> Total </th>
            <th class="text-center"> Botones </th>
            
          </tr>
        </thead>
        <tbody>
          @else
         @endif
 @forelse ($temporal as $product)
          <tr id='addr0'>
            
            <td>{{$loop->iteration}}</td>
            <td width="30%"><input type="text" value="{{$product->productos->nombre}}" class="form-control price" name="" readonly></td>
            <td>


 <div class="input-group">
<div class="input-group-prepend">
    <span class="input-group-text"><i class="fa  fa-star"></i></span>
  </div>
<input type="text" name='price' class="form-control price" value="{{number_format($product->cantidad, 0, ',', '.')}}" readonly/>
                                       </div>
</td>



            <td>



 <div class="input-group">
<div class="input-group-prepend">
    <span class="input-group-text"><i class="fa  fa-dollar"></i></span>
  </div>

              <input type="text" name='total[]'  class="form-control total" value="{{number_format($product->precio, 0, ',', '.')}}" readonly />
                                       </div>




</td>
             <td>




 <div class="input-group">
<div class="input-group-prepend">
    <span class="input-group-text"><i class="fa  fa-dollar"></i></span>
  </div>

               <input type="text" name='total[]' class="form-control total" value="{{number_format($product->total, 0, ',', '.')}}" readonly/>
                                       </div>



            </td>
              <td>
     
      <button type="button" name="ok_button" id="ok_button" value="{{$product->id}}" onclick="eliminar(this.value)" class="btn btn-danger">X</button>

              </td>
            
          </tr>
           @empty
      <p align="center"><h1 align="center">AGREGA PRODUCTOS</h1></p>
      @endforelse
          <tr id='addr1'></tr>

        </tbody>
      </table>


 @if(!$temporal->isEmpty())




<div class="container-fluid">


  <div class="row">
      

    <div class="col-md-7 table-bordered table-hover">


           <div class="form-group">
            <label for="recipient-name" class="col-form-label">Notas:</label>
            <textarea class="form-control rounded-0 notas" id="notas" name="notas" rows="5"></textarea>
          </div>
<br>
<br>

<b>
<h4></h4>

</b>
</div>
    <div class="col-md-4">


 <div  class="row clearfix" style="margin-top:80px" >

   <table class="table table-bordered table-hover" id="tab_logic_total">
        <tbody>
          <tr>
            <th class="text-center">Neto $</th>
            <td class="text-center">
           <input type="text" value="{{number_format($neto, 0, ',', '.')}}" class="neto form-control" id="neto" name="neto" readonly=""></td>
          </tr>
          <tr>
            <th class="text-center">I.V.A 19%</th>
            <td class="text-center"><div class="input-group mb-2 mb-sm-0">
                <input type="text" value="{{number_format($iva, 0, ',', '.')}}" class="iva form-control" id="iva" name="iva" placeholder="0" readonly="">
     
              </div></td>
          </tr>
          <tr>
            <th class="text-center">Total $</th>
            <td class="text-center"><input type="text"  id="totalo" name="totalo" value="{{number_format($resultado, 0, ',', '.')}}" class="totalo form-control" readonly/></td>
          </tr>
          
        </tbody>
      </table>

 </div>

</div>

</div>
    <div class="col-md-1">


     <button class="confirmar">Confirmar Operación</button>

</div>
</div>

</div>






   @else
         @endif

<script type="text/javascript">


 function calculo(){
document.getElementById("total_amount").value = "10";

}





function eliminar(valor){



 var url = '{{ route("salidas.temporal.destroy", ":slug") }}';

url = url.replace(':slug', valor);



    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax(
    {
        url:url,
        type: 'delete', // replaced from put
        dataType: "JSON",
        data: {
           
        },
          beforeSend: function () {
                        $("#form_validation_messages").html("Procesando, espere por favor...");
                },

        success: function (response)
        {

           $('#temporal').load("{{ route('salidas.temporal') }}");
            console.log(response); // see the reponse sent
            $("#form_validation_messages").html("");
        },
        error: function(xhr) {
         console.log(xhr.responseText); // this line will save you tons of hours while debugging
        // do something here because of error
       }
    });

}















$(document).ready(function(){


            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        

            $(".confirmar").click(function(){
                $.ajax({
                    /* the route pointing to the post function */
                    url: "{{ route('ingreso.operacion.venta')}}",
                    type: 'POST',
                    /* send the csrf-token and the input to the controller */
                    data: {_token: CSRF_TOKEN, message:$(".getinfo").val(),
                     id_persona:$(".id_persona").val(),
                         fecha_emision:$(".fecha_emision").val(),
                            tipo_pago:$(".tipo_pago").val(),
                             tipo_documento:$(".tipo_documento").val(),
                              numero_documento:$(".numero_documento").val(),
                              notas:$(".notas").val(),
                                neto:$(".neto").val(),
                                 iva:$(".iva").val(),
                                total:$(".neto").val(),


                  },
                    dataType: 'JSON',

                        beforeSend: function () {
                        $("#encabezado").html("Procesando, espere por favor...");
                },

                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) { 

                      



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
     if(data.success)
     {

      location.reload();
        
html = '<div class="alert alert-success center" >Ingresado Correctamente, Puede revisar en listas de ingreso</div>';



     }


     $('#encabezado').html(html);
    
setTimeout(function() {
    // Declaramos la capa  mediante una clase para ocultarlo
        $("#encabezado").fadeIn(1500);
    // Transcurridos 5 segundos aparecera la capa midiv2
    },5000);

 $('#temporal').load("{{ route('salidas.temporal') }}");
                          
                    }
                }); 
            });

             });

</script>