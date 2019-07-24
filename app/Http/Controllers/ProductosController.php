<?php

namespace App\Http\Controllers;


use Datatables;
use DB;
use Hash;
use App\DataTables\ProductosDatatable;
use Yajra\Datatables\Services\DataTable;
use Illuminate\Http\Request;
use App\Http\Requests;
use Redirect;
use Flashy;
use Illuminate\Support\Facades\Validator;
use App\Common\Utility; 
use Illuminate\Support\Facades\Auth;
use App\Productos;
use App\Categorias;


class ProductosController extends Controller
{
      public function __construct()
    {
         $this->middleware('preventBackHistory');
        $this->middleware('auth');
    }
    

  
    public function index(ProductosDataTable $dataTable)
    {

      $categorias = Categorias::where('estado',1)->pluck('nombre','id')->prepend('Selecciona una Categoría', '0');
        
        return $dataTable->render('Almacen.productos.index',compact('categorias', $categorias));
    }


public function store(Request $request)
    {
        $rules = array(
            'nombre'    =>   'required|min:2|max:30|regex:"^[a-zA-ZñÑáéíóúÁÉÍÓÚa-zA-Z0-9\s]+$"|unique:productos,nombre',
            'descripcion'     =>  'required|min:4|max:255|regex:"^[a-zA-ZñÑáéíóúÁÉÍÓÚa-zA-Z0-9,.\s]+$"',
            'imagen'         =>  'required|image|max:2048',
              'stock'    =>   'required|numeric|min:0|max:9999999',
               'precio'    =>   'required|numeric|min:0|max:9999999',
            'estado'     =>  'required|not_in:3|integer',
            'id_categoria' =>  'required|not_in:0|integer',
              'codigo' =>  'required|min:2|max:30|regex:"^[a-zA-ZñÑáéíóúÁÉÍÓÚa-zA-Z0-9\s]+$"|unique:productos,codigo',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $image = $request->file('imagen');

        $new_name = rand() . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('images'), $new_name);

     
            $productos = new Productos();
            $productos->nombre = $request->nombre;
            $productos->descripcion =$request->descripcion;
            $productos->stock = $request->stock;
             $productos->estado =$request->estado;
             $productos->id_categoria =$request->id_categoria;
              $productos->imagen =$new_name;
                 $productos->precio =$request->precio;
                  $productos->codigo =$request->codigo;

           $productos->save();


        return response()->json(['success' => 'Producto creado satisfactoriamente']);
    }



 public function edit($id)
    {
        if(request()->ajax())
        {
            $data = Productos::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }















public function update(Request $request)
    {     

         Utility::stripXSS(); 


              $id_producto= $request->Ehidden_id;

            $rules = array(

    
       


                'Enombre'    =>   'required|min:2|max:30|regex:"^[a-zA-ZñÑáéíóúÁÉÍÓÚa-zA-Z0-9\s]+$"|unique:productos,nombre,'. $id_producto.'id',
            'Edescripcion'     =>  'required|min:4|max:255|regex:"^[a-zA-ZñÑáéíóúÁÉÍÓÚa-zA-Z0-9,.\s]+$"',
              'Estock'    =>   'required|numeric|min:1|max:9999999',
            'Eestado'     =>  'required|not_in:3|integer',
             'Eprecio'    =>   'required|numeric|min:0|max:9999999',
            'Eid_categoria' =>  'required|not_in:0|integer',
              'Ecodigo' =>  'required|min:2|max:30|regex:"^[a-zA-ZñÑáéíóúÁÉÍÓÚa-zA-Z0-9\s]+$"|unique:productos,codigo,'. $id_producto.'id',


            );
            $error = Validator::make($request->all(), $rules);
           
          
            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }


 $actualizar= Productos::findOrFail( $request->input('Ehidden_id'));



if (!empty($request->file('Eimagen'))) {

$image = $request->file('Eimagen');

        $new_name = rand() . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('images'), $new_name);


      $actualizar->imagen = $new_name;


}else{}

       

       
        $actualizar->nombre = $request->input('Enombre');
        $actualizar->descripcion = $request->input('Edescripcion');
        $actualizar->stock = $request->input('Estock');
        $actualizar->id_categoria = $request->input('Eid_categoria');
        $actualizar->codigo = $request->input('Ecodigo');
        $actualizar->estado = $request->input('Eestado');
        $actualizar->precio = $request->input('Eprecio');
  





        $actualizar->save();




           

             if($actualizar->getChanges()){
      return response()->json(['success' => 'Datos guardados correctamente']);
}else{return response()->json(['success' => 'No se Realizaron cambios']);}



    }










 public function barcode($barcode)
    {
    
         
          

return view('Almacen.productos.barcode')->with('barcode',$barcode)->render();


}



public function destroy($id)
    {
        
        $data = Productos::findOrFail($id);

        $nombre= $data->nombre;
        $completa= $nombre." Producto Eliminado Correctamente";
        $data->delete();

         return response()->json(['success' => $completa]);
    }








}