<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use DB;
use Hash;
use App\DataTables\CategoriasDataTable;
use App\DataTables\LoginsUsersDataTable;
use Yajra\Datatables\Services\DataTable;
use App\Http\Requests;
use Redirect;
use Flashy;
use App\Common\Utility; 
use Illuminate\Support\Facades\Validator;
use App\Categorias;
use App\Productos;

class CategoriasController extends Controller
{

     public function __construct()
    {
         $this->middleware('preventBackHistory');
        $this->middleware('auth');
    }
    
  
    
    public function index(CategoriasDataTable $dataTable)
    {

             
        return $dataTable->render('Almacen.Categorias.index');
    }


 public function store(Request $request)
   
    {

        Utility::stripXSS(); 


        $rules = array(
            'nombre'    =>  'required|min:3|max:30|regex:"^[a-zA-ZñÑáéíóúÁÉÍÓÚa-zA-Z0-9\s]+$"|unique:categorias,nombre',
            'descripcion' => 'required|min:4|max:255|regex:"^[a-zA-ZñÑáéíóúÁÉÍÓÚa-zA-Z0-9,.\s]+$"',
              'estado' => 'required|not_in:9|integer',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

    


         $categorias = new Categorias();
            $categorias->nombre = $request->nombre;
            $categorias->descripcion =$request->descripcion;
            $categorias->estado = $request->estado;

           $categorias->save();

          
        return response()->json(['success' => 'Categoría agregada correctamente']);
    }


 public function edit($id)
    {
        if(request()->ajax())
        {
            $data = Categorias::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }






public function update(Request $request, Categorias $cato)
    {     

         Utility::stripXSS(); 


              $id_categoria= $request->Ehidden_id;

            $rules = array(

    
            'Enombre'=>'required|min:3|max:30|regex:"^[a-zA-ZñÑáéíóúÁÉÍÓÚa-zA-Z0-9\s]+$"|unique:categorias,nombre,'. $id_categoria.'id',
            'Edescripcion' => 'required|min:4|max:255|regex:"^[a-zA-ZñÑáéíóúÁÉÍÓÚa-zA-Z0-9,.\s]+$"',
              'tado' => 'required|not_in:9|integer',
            );
            $error = Validator::make($request->all(), $rules);
           
          
            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }

        $actualizar= Categorias::findOrFail( $request->input('Ehidden_id'));
        $actualizar->nombre = $request->input('Enombre');
        $actualizar->descripcion = $request->input('Edescripcion');
        $actualizar->estado = $request->input('tado');
        $actualizar->save();




           

             if($actualizar->getChanges()){
      return response()->json(['success' => 'Datos guardados correctamente']);
}else{return response()->json(['success' => 'No se Realizaron cambios']);}



    }





     public function destroy($id)
    {
        
        $categorias= Categorias::findOrFail($id);

$productos =  DB::table("productos")->select('id_categoria')->where('id_categoria',$categorias->id)->get();



if ($productos->isEmpty()) {

  $data = Categorias::findOrFail($id);

        $nombre= $data->nombre;
        $completa= $nombre." Eliminado correctamente";
        $data->delete();

         return response()->json(['success' => $completa]);

}else{

 
     $completa="No se puede eliminar por que hay productos con la Categoría";
              return response()->json(['success' => $completa]);



    }
}



    

}
