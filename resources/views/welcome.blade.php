<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Simple invoice html template</title>
</head>
<body>

<style>
    @import "https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,600i,700";html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,img,ins,kbd,q,s,samp,small,strike,strong,sub,sup,tt,var,b,u,i,center,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,embed,figure,figcaption,footer,header,hgroup,menu,nav,output,ruby,section,total,time,mark,audio,video{margin:0;padding:0;border:0;font-size:100%;font:inherit;vertical-align:baseline}article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section{display:block}body{line-height:1}ol,ul{list-style:none}blockquote,q{quotes:none}blockquote:before,blockquote:after,q:before,q:after{content:'';content:none}table{}body{height:840px;width:592px;margin:auto;font-family:'Open Sans',sans-serif;font-size:12px}strong{font-weight:700}#container{position:relative;padding:4%}#header{height:80px}#header > #reference{text-align:right}#header > #reference h3{margin:0}#header > #reference h4{margin:0;font-size:85%;font-weight:600}#header > #reference p{margin:0;margin-top:2%;font-size:85%}#header > #logo{width:50%;float:left}#fromto{height:160px}#fromto > #from,#fromto > #to{width:45%;min-height:90px;font-size:10%;padding:1.5%;line-height:120%}#fromto > #from{float:left;width:45%;background:#efefef;margin-top:30px;font-size:85%;padding:1.5%}#fromto > #to{float:right;border:solid grey 1px}#items{margin-top:10px}#items > p{font-weight:700;text-align:right;margin-bottom:1%;font-size:65%}#items > table{width:100%;font-size:85%;#items > table th:first-child{text-align:left}#items > table th{font-weight:400;padding:1px 4px}#items > table td{padding:1px 4px}#items > table th:nth-child(2),#items > table th:nth-child(4){width:45px}#items > table th:nth-child(3){width:60px}#items > table th:nth-child(5){width:80px}#items > table tr td:not(:first-child){text-align:right;padding-right:1%}#items table td{}#items table tr td{padding-top:3px;padding-bottom:3px;height:10px}#items table tr:nth-child(1){}#items table tr th{padding:3px}#items table tr:nth-child(2) > td{padding-top:8px}#summary{height:170px;margin-top:30px}#summary #note{float:left}#summary #note h4{font-size:10px;font-weight:600;font-style:italic;margin-bottom:4px}#summary #note p{font-size:10px;font-style:italic}#summary #total table{font-size:85%;width:260px;float:right}#summary #total table td{padding:3px 4px}#summary #total table tr td:last-child{text-align:right}#summary #total table tr:nth-child(3){background:#efefef;font-weight:600}#footer{margin:auto;position:absolute;left:4%;bottom:4%;right:4%;border-top:solid grey 1px}#footer p{margin-top:1%;font-size:65%;line-height:140%;text-align:center}










tr:nth-child(even) {}
    table{
      font-size: 10px;}
 th {


border: black 1px solid;

  
    }
 td {

  
border: none !important;
 border-top: 0px !important;
   border-bottom: 0px !important;
    }


#bb{   width: 710px;
            height: 420px; /* Ancho y alto fijo */
            overflow: hidden; /* Se oculta el contenido desbordado */

            border: 2px solid #b2b2b2;}

#td1{   width: 300px !important;
         }

#td2{ width: 5% !important; }

#td3{width: 15% !important; }

#td4{ width: 300px !important;  }


</style>


<div id="container">
    <div id="header">
        <div id="logo">
           
        </div>
        <div id="reference">
            <h3><strong>{{$documentoTipo}}</strong></h3>
            <h4>Número Documento. : {{$Operaciones->numero_documento}}</h4>
            <p>Fecha de Emisión   : {{$Operaciones->created_at}}</p>
        </div>
    </div>

    <div id="fromto">
        <div id="from">
            <p>
                <strong>Proveedor</strong><br>
               {{$Operaciones->Personas->nombre}}<br>
                Giro: {{$Operaciones->Personas->giro}} <br>
              Dirección  {{$Operaciones->Personas->direccion}} <br>
                Tél.: {{$Operaciones->Personas->telefono}} <br>
                Email:{{$Operaciones->Personas->email}}<br>

                
            </p>
        </div>
        <div id="to">
            <p>
                Método de pago:{{$tipo_pago}}<br>
              Creada por :  {{$Operaciones->Personas->nombre}}<br>
              Fecha Creación :  {{$Operaciones->created_at}}<br>
        
            </p>
        </div>
    </div>

    <div id="items" class="items">
        <p></p>
        <table id="bb" class="bb responsive">
            <tr>
                <th>Productos</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Total</th>
                
            </tr>
            @foreach($Detalle as $detalle)
            <tr style="border: 0">
                <td class="td1" id="td1" style="font-size: 11px;">{{$detalle->productos->nombre}}</td>
                <td class="td2"  id="td2" >{{number_format($detalle->cantidad, 0, ',', '.')}}</td>
                <td class="td3"   id="td3" >${{number_format($detalle->precio_unitario, 0, ',', '.')}}</td>
                <td class="td4" id=td4"   > <?php  $b=$detalle->cantidad*$detalle->precio_unitario;   ?>

    ${{number_format($b, 0, ',', '.')}}

</td>
                
            </tr>
            @endforeach
        </table>
    </div>

    <div id="summary">
        <div id="note">
            <h4>Note :</h4>
            <p>{{$Operaciones->notas}}</p>
        </div>
        <div id="total">
            <table >
                <tr>
                    <td>Neto</td>
                    <td>${{number_format($Operaciones->neto, 0, ',', '.')}}</td>
                </tr>
                <tr>
                    <td>Total IVA 19%</td>
                    <td>${{number_format($Operaciones->iva, 0, ',', '.')}}</td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>${{number_format($Operaciones->total, 0, ',', '.')}}</td>
                </tr>
            </table>
        </div>
    </div>

    <div id="footer">
        <p><br>
            Plataforma</p>
    </div>
</div>

</body>
</html>