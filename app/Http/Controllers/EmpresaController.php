<?php

namespace App\Http\Controllers;


use App\Empresas;
use Illuminate\Http\Request;
use App\Http\Requests;
use Redirect;
use Flashy;
use Illuminate\Support\Facades\Validator;
use App\Common\Utility; 
use Illuminate\Support\Facades\Auth;
use App\Proveedores;


class EmpresaController extends Controller
{
    public function index()
    {


 $empresa = Empresas::findOrFail(1);


        return view('Empresa.perfil')->with('empresa',$empresa);
    }


    public function edit()
    {


 $empresa = Empresas::findOrFail(1);


        return view('Empresa.edit')->with('empresa',$empresa);
    }





    public function update(Request $request)
    {
                 $id=1;     




          Utility::stripXSS(); 

       $validator =  Validator::make($request->all(), [
             
           'nombre' => 'required|min:4|max:50|regex:"^[a-zA-ZñÑáéíóúÁÉÍÓÚa-zA-Z0-9\s]+$"|unique:empresas,nombre,'.$id,
            'rut' => 'required|min:4|max:70"',
            'domicilio' => 'required|min:4|max:255|regex:"^[a-zA-ZñÑáéíóúÁÉÍÓÚa-zA-Z0-9,.\s]+$"',
            'giro' => 'required|min:4|max:50|regex:"^[a-zA-ZñÑáéíóúÁÉÍÓÚa-zA-Z0-9\s]+$"|unique:empresas,giro,'.$id,
            'ciudad' => 'required|min:4|max:50|regex:"^[a-zA-ZñÑáéíóúÁÉÍÓÚa-zA-Z0-9\s]+$"',
            'telefono' => 'required|numeric|min:100000000|max:9999999999',
            'email' => 'required|email|max:255',
        ], 
        [  
       
         'nombre.unique' => 'El campo nombre ya existe',
          

    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput($request->input());
        //return redirect()->back()->with(Input::all());
    }




        
        $empresa = Empresas::find(1);

if (!empty($request->file('Eimagen'))) {

$image = $request->file('Eimagen');

        $new_name = rand() . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('images'), $new_name);


      $empresa->imagen = $new_name;


}else{}



         $empresa->nombre = $request->input('nombre');
        $empresa->domicilio = $request->input('domicilio');
        $empresa->rut = $request->input('rut');
        $empresa->fax = $request->input('fax');
        $empresa->codigo_postal = $request->input('codigo_postal');
        $empresa->telefono = $request->input('telefono');
        $empresa->email = $request->input('email');
        $empresa->giro = $request->input('giro');
        $empresa->ciudad = $request->input('ciudad');
        $empresa->save();
      
              Flashy::warning('Perfil empresa Actualizado correctamente');


        return redirect()->route('empresa.index');
    }

}
