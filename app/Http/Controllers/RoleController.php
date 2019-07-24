<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Role;
use App\Permission;
use DB;
use App\DataTables\RolesDataTable;
use Yajra\Datatables\Services\DataTable;
use Illuminate\Support\Facades\Validator;
use App\Common\Utility; 
use Illuminate\Support\Facades\Auth;
use Flashy;


class RoleController extends Controller
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
    public function index(RolesDataTable $dataTable)
    {
          return $dataTable->render('roles.index');
   
  return view('roles.index', compact('set'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
             $permissions = Permission::get();
        return view('roles.create',compact('permissions')); //return the view with the list of permissions passed as an array
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
             
            'name' => 'required|unique:roles,name|min:4|max:100|regex:"^[a-zA-ZñÑáéíóúÁÉÍÓÚa-zA-Z0-9\s]+$"',
            'display_name' => 'required|min:4|max:70|regex:"^[a-zA-ZñÑáéíóúÁÉÍÓÚa-zA-Z0-9,.\s]+$"',
            'description' => 'required|min:4|max:255|regex:"^[a-zA-ZñÑáéíóúÁÉÍÓÚa-zA-Z0-9,.\s]+$"',
            'permissions' => 'required|array',
        
        ], 
        [  
          'name.regex' => 'El campo nombre no puede contener guión, ni guión bajo, ni caracteres que no sean letras y números',
         'name.required' => 'El campo nombre esta vacio',
         'description.required' => 'El campo description esta vacio',
         'name.unique' => 'El campo nombre ya existe',
          

    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput($request->input());
        //return redirect()->back()->with(Input::all());
    }




        //create the new role
        $role = new Role();
        $role->name = $request->input('name');
        $role->display_name = $request->input('display_name');
        $role->description = $request->input('description');
        $role->save();
        //attach the selected permissions
        foreach ($request->input('permissions') as $key => $value) {
            $role->attachPermission($value);
        }

              Flashy::success('Rol creado correctamente');
        return redirect()->route('roles.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($slug)
    {
         $role = Role::findBySlugOrFail($slug);
        //Get the permissions linked to the role
        $permissions =
            Permission::join("permission_role","permission_role.permission_id","=","permissions.id")
            ->where("permission_role.role_id",$role->id)
            ->get();
        //return the view with the role info and its permissions
        return view('roles.show',compact('role','permissions'));
    }



    public function showdelete($slug)
    {
        $role = Role::findBySlugOrFail($slug);
        //Get the permissions linked to the role
        $permissions =
            Permission::join("permission_role","permission_role.permission_id","=","permissions.id")
            ->where("permission_role.role_id",$role->id)
            ->get();
        //return the view with the role info and its permissions
        return view('roles.delete',compact('role','permissions'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($slug)
    {

         Utility::stripXSS(); 

        $role = Role::findBySlugOrFail($slug);
        $permission = Permission::get(); //get all permissions
        //Get the permissions ids linked to the role
        $rolePermissions =
//            DB::table("permission_role")
//                ->where("permission_role.role_id",$id)
//                ->pluck('permission_role.permission_id','permission_role.permission_id')
//                ->toArray();
            DB::table("permission_role")
                ->where("role_id",$role->id)
                ->pluck('permission_id')
                ->toArray();
        return view('roles.edit',compact('role','permission','rolePermissions'));
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
             
           'name' => 'required|min:4|max:50|regex:"^[a-zA-ZñÑáéíóúÁÉÍÓÚa-zA-Z0-9\s]+$"|unique:roles,name,'.$id,
            'description' => 'required|min:4|max:70|regex:"^[a-zA-ZñÑáéíóúÁÉÍÓÚa-zA-Z0-9,.\s]+$"',
            'display_name' => 'required|min:4|max:255|regex:"^[a-zA-ZñÑáéíóúÁÉÍÓÚa-zA-Z0-9,.\s]+$"',
             'permission' =>  'required|array',
        
        ], 
        [  
         'name.regex' => 'El campo nombre no puede contener guión, ni guión bajo, ni caracteres que no sean letras y números',
         'name.required' => 'El campo nombre esta vacio',
         'description.required' => 'El campo description esta vacio',
         'name.unique' => 'El campo nombre ya existe',
          

    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput($request->input());
        //return redirect()->back()->with(Input::all());
    }









        //Find the role and update its details
        $role = Role::find($id);
         $role->name = $request->input('name');
        $role->display_name = $request->input('display_name');
        $role->description = $request->input('description');
        $role->save();
        //delete all permissions currently linked to this role
        DB::table("permission_role")->where("role_id",$id)->delete();
        //attach the new permissions to the role
        foreach ($request->input('permission') as $key => $value) {
            $role->attachPermission($value);
        }

              Flashy::warning('Rol Actualizado correctamente');
        return redirect()->route('roles.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
   public function destroy($slug)
    {

 $role = Role::findBySlugOrFail($slug);

$empleado =  DB::table("role_user")->select('role_id')->where('role_id',$role->id)->get();



if ($empleado->isEmpty()) {

 DB::table("roles")->where('slug',$slug)->delete();
        
         Flashy::error('Rol Eliminado correctamente');
        return redirect()->route('roles.index');


}else{

 
     Flashy::error('No se puede Eliminar si hay usuarios con este rol');
        return redirect()->route('roles.index');


    }}
}