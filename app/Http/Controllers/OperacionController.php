<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Redirect;
use Flashy;
use Illuminate\Support\Facades\Validator;
use App\Common\Utility; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Operaciones;
use App\Entradas_temporales;
use App\Detalle_operaciones;
use App\Productos;


class OperacionController extends Controller
{
  




public function entradastore(Request $request){



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
             $operacion->tipo_operacion = 2;
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
$sumas=$Productos->stock+$detalle_datos->cantidad;
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



 return response()->json(['success' => 'Datos guardados correctamente']);
    


    }








}
