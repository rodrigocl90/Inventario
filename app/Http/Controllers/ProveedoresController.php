<?php

namespace App\Http\Controllers;


use Datatables;
use DB;
use Hash;
use App\DataTables\ProveedoresDatatable;
use Yajra\Datatables\Services\DataTable;
use Illuminate\Http\Request;
use App\Http\Requests;
use Redirect;
use Flashy;
use Illuminate\Support\Facades\Validator;
use App\Common\Utility; 
use Illuminate\Support\Facades\Auth;
use App\Personas;




class ProveedoresController extends Controller
{
    

     public function __construct()
    {
         $this->middleware('preventBackHistory');
        $this->middleware('auth');
    }
    

  
    public function index(ProveedoresDataTable $dataTable)
    {

             
        return $dataTable->render('compras.proveedores.index');
    }






 public function store(Request $request)
   
    {

        Utility::stripXSS(); 


        $rules = array(
            'nombre'    =>  'required|min:2|max:30|regex:"^[a-zA-ZñÑáéíóúÁÉÍÓÚa-zA-Z0-9\s]+$"',
            'documento' => 'required|not_in:0',
             'giro' => 'required|min:4|max:500|regex:"^[a-zA-ZñÑáéíóúÁÉÍÓÚa-zA-Z0-9,.\s]+$"',
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

    


         $proveedores = new Personas();
            $proveedores->nombre = $request->nombre;
            $proveedores->documento =$request->documento;
            $proveedores->numero = $request->numero;
             $proveedores->telefono = $request->telefono;
             $proveedores->giro = $request->giro;
              $proveedores->email = $request->email;
           $proveedores->direccion = $request->direccion;
            $proveedores->tipo = 2;
           $proveedores->save();

          
        return response()->json(['success' => 'Proveedores agregada correctamente']);
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


              $id_proveedor= $request->Ehidden_id;

            $rules = array(

       'Enombre'    =>  'required|min:2|max:30|regex:"^[a-zA-ZñÑáéíóúÁÉÍÓÚa-zA-Z0-9\s]+$"',
            'Edocumento' => 'required|not_in:0',
             'Enumero' => 'required|min:4|max:500',
              'Etelefono' => 'required|numeric|min:100000000|max:999999999',
              'Egiro' => 'required|min:2|max:500|regex:"^[a-zA-ZñÑáéíóúÁÉÍÓÚa-zA-Z0-9,.\s]+$"',
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
         $actualizar->giro = $request->input('Egiro');
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
        $completa= $nombre." Proveedor Eliminado Correctamente";
        $data->delete();

         return response()->json(['success' => $completa]);
    }



}
