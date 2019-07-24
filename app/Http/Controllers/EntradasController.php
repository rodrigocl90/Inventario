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


class EntradasController extends Controller

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
         ->select("operaciones.id as op","id_persona","operaciones.created_at","personas.nombre","operaciones.tipo_pago","operaciones.tipo_documento","id_user","numero_documento","fecha_emision","neto","iva","total","users.name","estado","Operaciones.tipo_operacion")->
       join('personas', 'personas.id', '=', 'operaciones.id_persona')->
        join('users', 'users.id', '=', 'operaciones.id_user')->where('operaciones.tipo_operacion','=',2)
      ->whereBetween('fecha_emision', array($a,$b))
        ;
      }
      else
      {
         $data = DB::table('operaciones')
         ->select("operaciones.id as op" ,"id_persona","operaciones.created_at","personas.nombre","operaciones.tipo_pago","operaciones.tipo_documento","id_user","users.name","numero_documento","fecha_emision","neto","iva","total","estado","operaciones.tipo_operacion")->
       join('personas', 'personas.id', '=', 'operaciones.id_persona')->
        join('users', 'users.id', '=', 'operaciones.id_user')->where('operaciones.tipo_operacion','=',2)
      
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
            $action.= '<a  name="print" href="imprimir/'.$nm.'" target="_blank"> <button class="tn btn-succes glyphicon btn-xs fa fa-edit" title="Imprimir"></button></a>';
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
     return view('compras.entradas.index');
    }


     public function create()
    {
        return view('compras.entradas.create');
    }



 public function ajax(Request $request)
    {
    	$data = [];


        if($request->has('q')){
            $search = $request->q;
            $data = DB::table("personas")
            		->select("id","nombre")
                ->where('tipo','=',2)
            		->where('nombre','LIKE',"%$search%")
            		->get();
        }


        return response()->json($data);
    }





 public function ajax1(Request $request)
    {
    	$data = [];


        if($request->has('q')){
            $search = $request->q;
            $data = DB::table("productos")
            		->select("id","nombre")
                    ->where("estado","=",1)
            		->where('nombre','LIKE',"%$search%")
            		->get();
        }


        return response()->json($data);
    }


 public function temporale()
    {
    

$id= Auth::user()->id;
 $neto=0;              
$temporal = Entradas_temporales::where('id_user', $id)->where('tipo_operacion',"=", 2)->get();

foreach ($temporal as $p) {
$iterador=$p->total;
$neto=$neto+$iterador;
}


$iva=0.19*$neto;

$resultado=$neto+$iva;

$palabras=NumerosEnLetras::convertir($resultado);

return view('compras.entradas.eftemporal', ['temporal' =>$temporal, 'neto'=> $neto,'iva'=> $iva,'resultado'=> $resultado,'palabras'=> $palabras])->render();


}




public function storetemporales(Request $request)
    {

        $id_user= Auth::user()->id;




 $messsages = array(
        'id_producto.unique'=>'Ya ingresaste este producto',
       
    );

        $rules = array(
          
             'id_producto' =>[Rule::unique('entradas_temporales')->where(function ($query) use ($request,$id_user) {
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

     
            $productos = new Entradas_temporales();
            $productos->precio=$precio;
            $productos->cantidad=$cantidad;
            $productos->id_producto =$request->id_producto;
            $productos->tipo_operacion =2;
            $productos->total =$total;
            $productos->id_user=Auth::user()->id;

           $productos->save();
 return response()->json(['success' => 'Datos guardados correctamente']);
    


    }







public  function estado(Request $request)
    {

 $id_user= Auth::user()->id;


       $Actualizar= Operaciones::findOrFail($request->dato1);
       
       


     if($Actualizar->id_user==$id_user){


 
$detalle=  Detalle_operaciones::where('id_operacion', $Actualizar->id)->get();


foreach ($detalle as $detalle_datos){

$Productos=  Productos::findOrFail($detalle_datos->id_producto);
$sumas=$Productos->stock-$detalle_datos->cantidad;
$Productos->stock=$sumas;
$Productos->save();



}




         $Actualizar->estado=0;
            $Actualizar->save();
           return response()->json(['success' => 'Cambio Realizado Correctamente']);
    }




return response()->json(['success' => 'No es el creador de la factura para realizar esta operacion']);

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
    






return view('compras.entradas.cuerpo_operacion',['Operaciones'=>  $Operaciones,   'Detalle' =>$Detalle,
'tipo_pago' => $tipo_pago,'documentoTipo' => $documentoTipo
])->render();



    }



public function imprimir($id)
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
    



  $pdf = \PDF::loadView('compras.entradas.print',['Operaciones'=>  $Operaciones,   'Detalle' =>$Detalle,
'tipo_pago' => $tipo_pago,'documentoTipo' => $documentoTipo
]);
     return $pdf->download('ejemplo.pdf');
    }





}


