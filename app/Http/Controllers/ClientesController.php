<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Datatables;
use DB;
use Hash;
use App\DataTables\ClientesDataTable;
use Yajra\Datatables\Services\DataTable;
use App\Http\Requests;
use Redirect;
use App\Common\Utility; 
use Illuminate\Support\Facades\Validator;
use App\Personas;


class ClientesController extends Controller
{
    
     public function __construct()
    {
         $this->middleware('preventBackHistory');
        $this->middleware('auth');
    }
    


    public function index(ClientesDataTable $dataTable)
    {

             
        return $dataTable->render('ventas.clientes.index');
    }




 public function store(Request $request)
   
    {

        Utility::stripXSS(); 


        $rules = array(
            'nombre'    =>  'required|min:2|max:30|regex:"^[a-zA-ZñÑáéíóúÁÉÍÓÚa-zA-Z0-9\s]+$"',
            'documento' => 'required|not_in:0',
             'numero' => 'required|min:4|max:500',
              'telefono' => 'required|numeric|min:100000000|max:999999999',
               'direccion' => 'required|min:4|max:500|regex:"^[a-zA-ZñÑáéíóúÁÉÍÓÚa-zA-Z0-9,.\s]+$"',
               'email' => 'required|email|max:255',
             
  );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all(),'errores' => $error->errors()->all()]);
        }

    


         $clientes = new Personas();
            $clientes->nombre = $request->nombre;
            $clientes->documento =$request->documento;
            $clientes->numero = $request->numero;
             $clientes->telefono = $request->telefono;
            $clientes->email = $request->email;
            $clientes->direccion = $request->direccion;
            $clientes->tipo = 1;
            $clientes->save();

          
        return response()->json(['success' => 'Cliente agregado correctamente']);
    }





 public function edit($id)
    {
        if(request()->ajax())
        {
            $data = Personas::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }





public function update(Request $request)
    {     

         Utility::stripXSS(); 


              $id= $request->Ehidden_id;

            $rules = array(

    
            'Enombre'=>'required|min:3|max:30|regex:"^[a-zA-ZñÑáéíóúÁÉÍÓÚa-zA-Z0-9\s]+$"|unique:personas,nombre,'. $id.'id',
          'Edocumento' => 'required|not_in:0',
             'Enumero' => 'required|min:4|max:500',
              'Etelefono' => 'required|numeric|min:100000000|max:999999999',
               'Edireccion' => 'required|min:4|max:500|regex:"^[a-zA-ZñÑáéíóúÁÉÍÓÚa-zA-Z0-9,.\s]+$"',
               'Eemail' => 'required|email|max:255',

            );
            $error = Validator::make($request->all(), $rules);
           
          
            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }

        $actualizar= Personas::findOrFail( $request->input('Ehidden_id'));
        $actualizar->nombre = $request->input('Enombre');
        $actualizar->telefono = $request->input('Etelefono');
        $actualizar->documento = $request->input('Edocumento');
        $actualizar->numero = $request->input('Enumero');
        $actualizar->email = $request->input('Eemail');
        $actualizar->direccion = $request->input('Edireccion');
        $actualizar->save();




           

             if($actualizar->getChanges()){
      return response()->json(['success' => 'Datos guardados correctamente']);
}else{return response()->json(['success' => 'No se Realizaron cambios']);}



    }



    public function destroy($id)
    {
        
        $data = Personas::findOrFail($id);

        $nombre= $data->nombre;
        $completa= $nombre." Cliente Eliminado Correctamente";
        $data->delete();

         return response()->json(['success' => $completa]);
    }



}
