<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Common\Utility; 

class CambiarContraseñaController extends Controller
{  public function __construct()
    {
        $this->middleware('auth');
    }
 
    public function showChangePasswordForm(){
        return view('auth.passwords.changepassword');
    }


public function changePassword(Request $request){


	  Utility::stripXSS(); 

if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
// The passwords matches
return redirect()->back()->with("error","Tu contraseña no coincide con tu clave actual. Intentalo de nuevo.");
}
if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
//Current password and new password are same
return redirect()->back()->with("error","Tu contraseña nueva no puede ser igual a que se va cambiar. Por favor ingresa una contraseña nueva.");
}

     $validator =  Validator::make($request->all(), [
             
           'current-password' => 'required',
'new-password' => 'required|string|min:8|max:128|confirmed',
        
        ], 
        [  
'new-password.required' => 'El campo nombre esta vacio',
         'new-password.required' => 'El campo contraseña nueva no puede estar vacio',
         'new-password.min' => 'El campo requiere mínimo 8 carácteres',
         'new-password.max' => 'El campo requiere máximi 128 carácteres',
         'new-password.confirmed' => 'La contraseña nueva no coincide con el campo confirmación',

    ]);

  if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput($request->input());
        //return redirect()->back()->with(Input::all());
    }


//Change Password
$user = Auth::user();
$user->password = bcrypt($request->get('new-password'));
$user->save();
return redirect()->back()->with("success","Contraseña cambiada satisfactoriamente!");
}






}
