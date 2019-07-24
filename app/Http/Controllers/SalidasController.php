<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Entradas_temporales;
use App\Http\Requests;
use Redirect;
use Flashy;
use Illuminate\Support\Facades\Validator;
use App\Common\Utility; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use NumerosEnLetras;
use App\Operaciones;
use App\Productos;
use App\Detalle_Operaciones;
use Carbon\Carbon;
use App\Empresas;


class SalidasController extends Controller
{
    






    function index(Request $request)
    {


    $a=  \Carbon\Carbon::parse($request->from_date)->format('y/m/d');

    $b=  \Carbon\Carbon::parse($request->to_date)->format('y/m/d');
     if(request()->ajax())
     {
      if(!empty($request->frofrom_datem_date))
      {
       $data = DB::table('operaciones')
         ->select("operaciones.id as op","id_persona","operaciones.created_at","personas.nombre","operaciones.tipo_pago","operaciones.tipo_documento","id_user","numero_documento","fecha_emision","neto","iva","total","users.name","estado",'operaciones.tipo_operacion')->
       join('personas', 'personas.id', '=', 'operaciones.id_persona')->
        join('users', 'users.id', '=', 'operaciones.id_user')
        ->where('operaciones.tipo_operacion','=',1)
         ->whereBetween('fecha_emision', array($a,$b))
        ;
      }
      else
      {
         $data = DB::table('operaciones')
         ->select("operaciones.id as op" ,"id_persona","operaciones.created_at","personas.nombre","operaciones.tipo_pago","operaciones.tipo_documento","id_user","users.name","numero_documento","fecha_emision","neto","iva","total","estado",'operaciones.tipo_operacion')->
       join('personas', 'personas.id', '=', 'operaciones.id_persona')->
        join('users', 'users.id', '=', 'operaciones.id_user')->where('operaciones.tipo_operacion','=',1)
      
         ;
      }
      return datatables()->of($data)->filterColumn('operaciones.tipo_pago', function ($query, $keyword) {
                  $query->whereRaw("REPLACE(REPLACE(REPLACE(tipo_pago, '1', 'contado'),'2','credito'),'3','cheque')  LIKE  ?", ["%$keyword%"]);

                })->addColumn('pestado', function ($query) {
               

  if($query->tipo_pago==1){

                  return 'Contado';  
            } if($query->tipo_pago==2){

             return 'Credito';  
}
if($query->tipo_pago==3){

             return 'Cheque';  
}
        })->addColumn('Documento', function ($query) {
               

  if($query->tipo_documento==1){

                  return 'Boleta';  
            } if($query->tipo_documento==2){

             return 'Factura';  
}

        })
->addColumn('estadoOperacion', function ($query) {
               

  if($query->estado==1){

                  return '<span class="badge badge-pill badge-success">Aceptada</span>';  
            } if($query->estado==0){

             return '<span class="badge badge-pill badge-danger">Rechazada</span>'; 
}

        })->addColumn('action',function ($productos) {
                $nm=$productos->op;
       
             $action = '';


        if(\Entrust::can('proveedores')){
            $action.= '<button type="button" name="edit" id="'.$nm.'" class="edit tn btn-warning glyphicon btn-xs fa fa-edit" title="ver"></button>';
        }

      
           if(\Entrust::can('proveedores')){
            $action.= '   <button type="button" name="delete" id="'.$nm.'" class="delete tn btn-success glyphicon btn-xs fa fa-edit" title="cambiar estado"></button>';
        }

     if(\Entrust::can('proveedores')){
            $action.= '<button   name="ver" id="'.$nm.'" class="ver tn btn-succes glyphicon btn-xs fa fa-edit" title="Imprimir"></button>';
        }
       return $action;

            })->editColumn('created_at', function ($query) {
                return $query->created_at ? with(new Carbon($query->created_at))->format('d/m/Y H:i:s') : '';
            })
            ->editColumn('neto', function ($query) {
                      $nm= number_format($query->neto, 0, ',', '.');
                return "$$nm";
            })
             ->editColumn('iva', function ($query) {
                      $nm= number_format($query->iva, 0, ',', '.');
                return "$$nm";
            })
              ->editColumn('total', function ($query) {
                      $nm= number_format($query->total, 0, ',', '.');
                return "$$nm";
            })
            ->
            editColumn('fecha_emision', function ($query) {
                return $query->fecha_emision ? with(new Carbon($query->fecha_emision))->format('d/m/Y H:i:s') : '';
            })
        ->rawColumns(['estadoOperacion','action'])

        ->make(true);
     }
     return view('ventas.salidas.index');
    }


   


     public function create()
    {
        return view('ventas.salidas.create');
    }












 public function ajaxclientes(Request $request)
      {
    	$data = [];


        if($request->has('q')){
            $search = $request->q;
            $data = DB::table("personas")
            		->select("id","nombre")
                ->where('tipo','=',1)
            		->where('nombre','LIKE',"%$search%")
            		->get();
        }


        return response()->json($data);
    }










public function StoreTemporales(Request $request)
    {

        $id_user= Auth::user()->id;




 $messsages = array(
        'id_producto.unique'=>'Ya ingresaste este producto',
       
    );

        $rules = array(
          
             'id_producto' =>[Rule::Exists('entradas_temporales')->where(function ($query) use ($request,$id_user) {
    return $query->where('id_user', $id_user);

}), 'required'],
              'cantidad'    =>   'required|min:1|max:12',
               'precio'    =>   'required|min:1|max:12',
        );

        $error = Validator::make($request->all(), $rules, $messsages);




        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }











          $precio = str_replace(".", "", $request->precio);
          $cantidad = str_replace(".", "", $request->cantidad);
          $total = str_replace(".", "", $request->total);

     
       $datos = Productos::findOrFail( $request->id_producto);
 

 $cantidads=$datos->stock;
 $stock=$cantidads-$cantidad;
  if($stock<0){
       

 return response()->json(['stock' =>$cantidads]);  }




            $productos = new Entradas_temporales();
            $productos->precio=$precio;
            $productos->cantidad=$cantidad;
            $productos->id_producto =$request->id_producto;
            $productos->tipo_operacion =1;
            $productos->total =$total;
            $productos->id_user=Auth::user()->id;

           $productos->save();
 return response()->json(['success' => 'Datos guardados correctamente']);
    


    }






 public function cargas()
    {
    

$id= Auth::user()->id;
 $neto=0;              
$temporal = Entradas_temporales::where('id_user', $id)->where('tipo_operacion',"=", 1)->get();


foreach ($temporal as $p) {
$iterador=$p->total;
$neto=$neto+$iterador;
}


$iva=0.19*$neto;

$resultado=$neto+$iva;

$palabras=NumerosEnLetras::convertir($resultado);

return view('ventas.salidas.eftemporal', ['temporal' =>$temporal, 'neto'=> $neto,'iva'=> $iva,'resultado'=> $resultado,'palabras'=> $palabras])->render();


}








public function ingreso(Request $request){



        $id_user= Auth::user()->id;




 $messsages = array(
        'numero_documento'=>'Ya ingresaste este producto',
       
    );

        $rules = array(
          
              'id_persona'    =>   'required|not_in:0|integer',
               'fecha_emision'    =>   'required',
                 'tipo_pago'    =>   'required',
               'numero_documento'    =>   'required',
                'tipo_documento'    =>   'required',
             

        );

        $error = Validator::make($request->all(), $rules, $messsages);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

       
 $numerodocumento = str_replace(".", "", $request->numero_documento);
 $iva = str_replace(".", "", $request->iva);
 $neto= str_replace(".", "", $request->neto);
 $total= str_replace(".", "", $request->total);



             $operacion = new Operaciones();
             $operacion->tipo_documento = $request->tipo_documento;
             $operacion->numero_documento =$numerodocumento;
             $operacion->tipo_operacion = 1;
             $operacion->fecha_emision =$request->fecha_emision;
             $operacion->id_persona =$request->id_persona;
             $operacion->id_user =$id_user;
             $operacion->tipo_pago =$request->tipo_pago;
             $operacion->estado = 1;
             $operacion->notas =$request->notas;
             $operacion->iva =$iva;
             $operacion->total =$total;
             $operacion->neto =$neto;
             $operacion->save();

          $idAreaRecienGuardada = $operacion->id;


$detalle=  Entradas_temporales::where('id_user', $id_user)->get();


foreach ($detalle as $detalle_datos){
   $operacionsave = new Detalle_operaciones();
   
$Productos=  Productos::findOrFail($detalle_datos->id_producto);
$sumas=$Productos->stock-$detalle_datos->cantidad;
$Productos->stock=$sumas;
$Productos->save();


   $operacionsave->id_producto=$detalle_datos->id_producto;
     $operacionsave->cantidad=$detalle_datos->cantidad;
   $operacionsave->precio_unitario=$detalle_datos->precio;
  $operacionsave->tipo_operacion=1;
   $operacionsave->id_operacion= $idAreaRecienGuardada;
   $operacionsave->save();

}


Entradas_temporales::where('id_user', $id_user)->delete();



 return response()->json(['success' => 'Venta guardada correctamente']);
    


    }





public function destroy($id)
    {
        
        $data = Entradas_temporales::findOrFail($id);
        $data->delete();

         return response()->json();
    }






 public function cuerpo($id)
    {

           $Operaciones=  Operaciones::findOrFail($id);
           $Detalle    =  Detalle_operaciones::where('id_operacion', $Operaciones->id)->get();


          $tipo_pago="";
          $documentoTipo="";


          $comprobarpago=$Operaciones->tipo_pago;
          $comprobartipodocumento=$Operaciones->tipo_documento;

           if($comprobarpago==1){

            $tipo_pago="Contado";
          }

         if($comprobarpago==2){

            $tipo_pago="Crédito";
          }
        if($comprobarpago==3){

            $tipo_pago="Cheque";
          }



           if($comprobartipodocumento==1){

            $documentoTipo="FACTURA";
          }

         if($comprobartipodocumento==2){

            $documentoTipo="BOLETA";
          }
    






return view('ventas.salidas.ver',['Operaciones'=>  $Operaciones,   'Detalle' =>$Detalle,
'tipo_pago' => $tipo_pago,'documentoTipo' => $documentoTipo
])->render();

}




public function imprimir($id)
    {


$empresa=Empresas::findOrFail(1);

 $Operaciones=  Operaciones::findOrFail($id);
           $Detalle    =  Detalle_operaciones::where('id_operacion', $Operaciones->id)->get();


          $tipo_pago="";
          $documentoTipo="";


          $comprobarpago=$Operaciones->tipo_pago;
          $comprobartipodocumento=$Operaciones->tipo_documento;

           if($comprobarpago==1){

            $tipo_pago="Contado";
          }

         if($comprobarpago==2){

            $tipo_pago="Crédito";
          }
        if($comprobarpago==3){

            $tipo_pago="Cheque";
          }



           if($comprobartipodocumento==1){

            $documentoTipo="FACTURA";
          }

         if($comprobartipodocumento==2){

            $documentoTipo="BOLETA";
          }
    



  $pdf = \PDF::loadView('ventas.salidas.print',['Operaciones'=>  $Operaciones,   'Detalle' =>$Detalle,
'tipo_pago' => $tipo_pago,'documentoTipo' => $documentoTipo,'empresa' => $empresa
]);
     return $pdf->download('ejemplo.pdf');
    }






}
