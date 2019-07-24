<?php

namespace App\DataTables;


use Yajra\DataTables\Services\DataTable;
use App\Login;
use Carbon\Carbon;
use Auth;


class LoginsUsersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */



       public function dataTable($query)
    {
        return datatables($query)
             ->editColumn('login_at', function ($user) {
                return $user->login_at ? with(new Carbon($user->login_at))->format('d/m/Y H:i:s') : '';
            })
            ->filterColumn('login_at', function ($query, $keyword) {
                  $query->whereRaw("DATE_FORMAT(login_at,'%d/%m/%Y %H:%i:%s') like ?", ["%$keyword%"]);
                })      
                    ->editColumn('logout_at', function ($user) {
                return $user->logout_at ? with(new Carbon($user->logout_at))->format('d/m/Y H:i:s') : '';
            })
            ->filterColumn('logout_at', function ($query, $keyword) {
                  $query->whereRaw("DATE_FORMAT(logout_at,'%d/%m/%Y %H:%i:%s') like ?", ["%$keyword%"]);
            });
            
    }


    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
      public function query(Login $model)
    {

        if ( empty(Auth::id())) { 
     abort(403, 'Unauthorized action.'); 
    } 
$idusuarioabuscar= Auth::user()->id;

         return $model->newQuery()->select('users.name','user_id','user_agent', 'session_token', 'ip_address','login_at','logout_at')->join('users', 'users.id', '=', 'logins.user_id')->where('logins.user_id','=',$idusuarioabuscar)->orderBy('login_at', 'desc');
    }


    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
     public function html()
   {
        return $this->builder()
                    ->columns(
                    [   'users.name' => ['title' => 'Usuario','name' => 'users.name','data' => 'name'],
                        'logins.ip_address' => ['title' => 'Ip de Usuario','name' => 'logins.ip_address','data' => 'ip_address'],
                    'logins.user_agent' => ['title' => 'Navegador web','name' => 'logins.user_agent','data' => 'user_agent'],
                           'login_at' => ['title' => 'Fecha de Inicio de Sesión'],
                        'logout_at' => ['title' => 'fecha de término'],
                                'logins.session_token' => ['title' => 'Token de sesión','name' => 'logins.session_token','data' => 'session_token'],
                    ])
                  ->parameters([
                           'processing'=>' true',
                         'serverSide'=>'true',
                         'bAutoWidth' => 'true',
                   
                        

                        'language' => [
        'url' => url(asset('datatable/Spanish.json'))
    ],
                    ]);;
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
        return 'LoginsUsers_' . date('YmdHis');
    }
}
