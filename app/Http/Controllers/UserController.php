<?php
namespace App\Http\Controllers;

use App\User;
use App\Role;
use Datatables;
use DB;
use Hash;
use App\DataTables\UsersDatatable;
use Yajra\Datatables\Services\DataTable;
use Illuminate\Http\Request;
use App\Http\Requests;
use Redirect;
use Flashy;
use Illuminate\Support\Facades\Validator;
use App\Common\Utility; 
use Illuminate\Support\Facades\Auth;



class UserController extends Controller
{

     public function __construct()
    {
         $this->middleware('preventBackHistory');
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
  
       public function index(UsersDatatable $dataTable)
    {
            
        return $dataTable->render('users.index'); 
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
       $roles = Role::pluck('name','id');
        return view('users.create')->with('roles',$roles); //return the view with the list of roles passed as an array
    }



    public function profile()
    {
       
        return view('users.profile'); //return the view with the list of roles passed as an array
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {

          Utility::stripXSS(); 

       $validator =  Validator::make($request->all(), [
             
            'name' => 'required|min:3|max:30|regex:"^[a-zA-ZñÑáéíóúÁÉÍÓÚa-zA-Z0-9\s]+$"|unique:users,name',
            'first_name' => 'required|min:3|max:120|regex:/^[\pL\s\-]+$/u',
            'last_name' => 'required|min:3|max:120|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required||min:8|max:128|confirmed',
            'roles' => 'required|array',
             'roles.*'  => 'required|integer|distinct',
             'status' => 'required|not_in:9|integer',
              'gender' => 'required|in:h,m',
             'phone' => 'required|numeric|min:100000000|max:999999999',
        ], 
        [
             'name.regex' => 'El campo nombre no puede contener guión, ni guión bajo, ni caracteres que no sean letras y números',
            'roles*.not_in' => 'Selecciona uno de los roles',
         'status.not_in' => 'Selecciona un estado usuario',
        'gender.in' => 'Selecciona un genero',
         'phone.required' => 'Teléfono vacio',
         'first_name.regex' => 'El campo nombre debe contener solo letras',
         'last_name.regex' => 'El campo apellido debe contener solo letras',
         'phone.min' => 'Numero de teléfono móvil inválido',
         'phone.max'=>'Numero de teléfono móvil inválido',
   

    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput($request->all());
        //return redirect()->back()->with(Input::all());
    }


        $input = $request->only('name', 'email', 'password','gender','status','phone','first_name','last_name');
        $input['password'] = Hash::make($input['password']); //Hash password
        $user = User::create($input); //Create User table entry
        //Attach the selected Roles
        foreach ($request->input('roles') as $key => $value) {
            $user->attachRole($value);
        }

         Flashy::success('Usuario creado correctamente');
        return redirect()->route('users.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */


    
    public function show($slug)
    {
        $user = User::findBySlugOrFail($slug);
        return view('users.show',compact('user'));
    }

    public function showdelete($slug)
    {
        $user = User::findBySlugOrFail($slug);
        return view('users.delete',compact('user'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($slug)
  {
        $user = User::findBySlugOrFail($slug);
        $roles = Role::get(); //get all roles
        $userRoles = $user->roles->pluck('id')->toArray();
        return view('users.edit',compact('user','roles','userRoles'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {

       
    
          Utility::stripXSS(); 

       $validator =  Validator::make($request->all(), [
            'name' => 'required|min:3|max:30|regex:"^[a-zA-ZñÑáéíóúÁÉÍÓÚa-zA-Z0-9\s]+$"|unique:users,name,'.$id,
             'first_name' => 'required|min:3|max:120|regex:/^[\pL\s\-]+$/u',
            'last_name' => 'required|min:3|max:120|regex:/^[\pL\s\-]+$/u',
           'password' => 'confirmed|min:8|max:128',
           'email' => 'required|email|unique:users,email,'.$id,
            'roles' => 'required|array',
             'roles.*'  => 'required|integer|distinct',
             'status' => 'required|not_in:9|integer',
              'gender' => 'required|in:h,m',
                 'phone' => 'required|numeric|min:100000000|max:999999999',
        ], 
        [
             'name.regex' => 'El campo nombre no puede contener guión, ni guión bajo, ni caracteres que no sean letras y números',
            'roles*.not_in' => 'Selecciona uno de los roles',
         'status.not_in' => 'Selecciona un estado usuario',
        'gender.in' => 'Selecciona un genero',
         'phone.required' => 'Teléfono vacio',
        'phone.min' => 'Teléfono debe tener minímo 7 digítos',
         'first_name.regex' => 'El campo nombre debe contener solo letras',
         'last_name.regex' => 'El campo apellido debe contener solo letras',
          'phone.min' => 'Numero de teléfono móvil inválido',
         'phone.max'=>'Numero de teléfono móvil inválido',
   

    ]);



if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput($request->input());
        //return redirect()->back()->with(Input::all());
    }








        $input = $request->only('name', 'email', 'password','gender','status','phone','first_name','last_name');
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']); //update the password
        }else{
            $input = array_except($input,array('password')); //remove password from the input array
        }
        $user = User::find($id);
        $user->update($input); //update the user info
        //delete all roles currently linked to this user
        DB::table('role_user')->where('user_id',$id)->delete();
        //attach the new roles to the user
        foreach ($request->input('roles') as $key => $value) {
            $user->attachRole($value);
        }

         Flashy::warning('Usuario actualizado correctamente');
        return redirect()->route('users.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */


  public function destroy($slug)
    {
        DB::table("users")->where('slug',$slug)->delete();
        
         Flashy::error('Usuario Eliminado correctamente');
        return redirect()->route('users.index');
    }


}