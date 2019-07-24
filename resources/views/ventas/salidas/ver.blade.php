<?php 
setlocale(LC_TIME,"es_ES");
 ?>


<div class="container">
  <div class="card">
<div class="card-header">
Fecha Creación
<strong>{{\Carbon\Carbon::parse($Operaciones->created_at)->format('d/m/Y')}} </strong> 
  <span class="float-right"> <strong>Creador:</strong>{{$Operaciones->Users->name}}</span>

</div>
<div class="card-body">
<div class="row mb-4">
<div class="col-sm-6">
<h2 class="mb-3">{{$documentoTipo}}</h2>
<div>
<strong>Número Documento:</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$Operaciones->numero_documento}}
</div>
<div><strong>Nombre cliente:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{$Operaciones->Personas->nombre}}</div>
<div><strong>Giro Proveedor:</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$Operaciones->Personas->giro}}</div>
<div><strong>Email:</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$Operaciones->Personas->email}}</div>
<div><strong>Teléfono:</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$Operaciones->Personas->telefono}}</div>
</div>

<div class="col-sm-6">
<h6 class="mb-3"></h6>
<div>
<strong></strong>
</div>
<br/>
<br/>
<div><strong>Dirección:</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$Operaciones->Personas->direccion}}</div>
<div><strong>Método de pago:</strong>&nbsp;&nbsp;&nbsp;{{$tipo_pago}}</div>
<div><strong>Fecha Emisión:</strong> &nbsp;&nbsp;&nbsp;&nbsp;{{\Carbon\Carbon::parse($Operaciones->fecha_emision)->format('d/m/Y')}} </div>
<div></div>
</div>



</div>

<div class="table-responsive-sm">
<table class="table table-striped">
<thead>
<tr>
<th class="center">#</th>
<th>Producto</th>
<th>Cantidad</th>

<th class="right">Precio Unitario</th>
  <th class="center">Total</th>

</tr>
</thead>
<tbody>
	@foreach($Detalle as $detalle)
<tr>
<td class="center">{{$loop->iteration}}</td>
<td class="left strong">{{$detalle->productos->nombre}}</td>
<td class="left">{{number_format($detalle->cantidad, 0, ',', '.')}}</td>

<td class="right">${{number_format($detalle->precio_unitario, 0, ',', '.')}}</td>
  <td class="center">
<?php  $b=$detalle->cantidad*$detalle->precio_unitario;   ?>

  	${{number_format($b, 0, ',', '.')}}


  </td>
</tr>
   @endforeach
</tbody>
</table>
</div>
<div class="row">
<div class="col-lg-4 col-sm-5">

</div>

<div class="col-lg-4 col-sm-5 ml-auto">
<table class="table table-clear">
<tbody>
<tr>
<td class="left">
<strong>Neto</strong>
</td>
<td class="right">{{number_format($Operaciones->neto, 0, ',', '.')}}</td>
</tr>
<tr>

<td class="left">
<strong>I.V.A 19%</strong>
</td>
<td class="right">${{number_format($Operaciones->iva, 0, ',', '.')}}</td>
</tr>
<tr>
<td class="left">
 <strong>Total</strong>
</td>
<td class="right">${{number_format($Operaciones->total, 0, ',', '.')}}</td>
</tr>

</tbody>
</table>

</div>

</div>

</div>
</div>
</div>

