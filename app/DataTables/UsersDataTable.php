<?php

namespace App\DataTables;

use App\User;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Collection as Collection;
use Carbon\Carbon;



class UsersDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
   
  public function dataTable($query)
    {
        return datatables($query)->addColumn('prueba', function ($user) {
               

  if($user->gender=='m'){
                  return clean('<img src="'.asset('img/mujer.jpg').'" class="img-circle"" width="50" height="50">');
                  ;  
            }if ($user->gender=='h') {
                

             return clean('<img src="'.asset('img/hombre.jpg').'" class="img-circle"" width="50" height="50">');
             ; 
}

        } )->addColumn('status', function ($user) {
               

  if($user->status==1){
                  return 'Activo';  
            }else{

             return 'Inactiva';  
}

        } )->filterColumn('status', function ($query, $keyword) {
                  $query->whereRaw("REPLACE(REPLACE(status, '1', 'activo'),'0','inactiva')  LIKE  ?", ["%$keyword%"]);

                })  
->addColumn('action',function ($user) {
                $nm=$user->slug;
        
       
             $action = '';

            if(\Entrust::can('user-list')){
            $action .= '  <a href="' . route('users.show',$nm).'"> <button  class="btn btn-info livicon btn-xs  fa fa fa-angellist " title="ver"></button><a>';
        }

        if(\Entrust::can('user-update')){
            $action.= '  <a href="' . route('users.edit',$nm).'">  <button  class="btn btn-warning glyphicon btn-xs fa fa-edit" title="editar"></button><a>';
        }


        if(\Entrust::can('user-delete')){
            $action.= '  <a href="' . route('users.showdelete',$nm).'"> <button  class="btn btn-danger btn-xs fa fa-eraser" title="Eliminar"></button><a>';
        }

  

       return $action;

            })->addColumn('Roles', function ($user) {
           
           
$n=User::find($user->iduser);




    $options = '';
    // here we prepare the options
    foreach ($n->roles as $role) {
        $options .= ' <li class="list-group-item" style="font-size:10px; background-color: #99c93d;
    color: #fff;">'.$role->name.'</li>';
    }


   $return = 
'
<ul class="list-group">
 '.$options.'
</ul>';
    return $return;




        } )->editColumn('created_at', function ($user) {
                return $user->created_at ? with(new Carbon($user->created_at))->format('d/m/Y H:i:s') : '';
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                  $query->whereRaw("DATE_FORMAT(created_at,'%d/%m/%Y %H:%i:%s') like ?", ["%$keyword%"]);
                })  
->editColumn('updated_at', function ($user) {
                return $user->updated_at ? with(new Carbon($user->updated_at))->format('d/m/Y H:i:s') : '';
            })
            ->filterColumn('updated_at', function ($query, $keyword) {
                  $query->whereRaw("DATE_FORMAT(updated_at,'%d/%m/%Y %H:%i:%s') like ?", ["%$keyword%"]);
                })  

            ->editColumn('last_login_at', function ($user) {
                return $user->last_login_at ? with(new Carbon($user->last_login_at))->format('d/m/Y H:i:s') : '';
            })
            ->filterColumn('last_login_at', function ($query, $keyword) {
                  $query->whereRaw("DATE_FORMAT(last_login_at,'%d/%m/%Y %H:%i:%s') like ?", ["%$keyword%"]);
                }) 
->editColumn('last_logout', function ($user) {
                return $user->last_logout ? with(new Carbon($user->last_logout))->format('d/m/Y H:i:s') : '';
            })
            ->filterColumn('last_logout', function ($query, $keyword) {
                  $query->whereRaw("DATE_FORMAT(last_logout,'%d/%m/%Y %H:%i:%s') like ?", ["%$keyword%"]);
                })->rawColumns(['action','prueba','Roles']);
    }
    
 





    public function query(User $model)
    {
       
        $user = User::query()->select([
                       'created_at', 'users.id as iduser','users.name as nombreuser','email','updated_at','status','gender','last_login_at','last_login_ip','last_logout','slug']);
               

        return $user;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns([
                  
         'prueba' => ['title' => ''],            
        'Nombre Usuario' => ['name' => 'users.name', 'data' => 'nombreuser'], 
           'Email' => ['name' => 'users.email', 'data' => 'email','width'=>'30px'],
          'Roles' => ['title' => 'Nombre Roles'],        
          'status' => ['title' => 'Estado'],
        'created_at' => ['title'=>'Fecha creación'],
         'updated_at' => ['title'=>'Fecha Última Actualización de datos','width'=>'30px',],
          'last_login_at' => ['title' => 'Fecha Último login'],
           'last_logout' => ['title' => 'fecha último logout'],
               'last_login_ip' => ['title' => 'IP de login'],
                          ])->addAction(['title' => 'Acción', 'width'=>'150px','printable' => false])
                            ->parameters([
                                  'serverSide'=> true,
                                           
                        

                        'language' => [
        'url' => url(asset('datatable/Spanish.json'))
    ],
                          'dom'          => 'Bfltip',
                       
                       
                        'buttons'      => ['export', 'print', 'reset', 'reload'],
                        
                    ]);


    }


    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
         
            
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */

    protected function filename()
    {
        return 'Users_' . date('YmdHis');
    }
}








