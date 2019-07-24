<?php

namespace App\DataTables;

use App\User;
use Yajra\DataTables\Services\DataTable;
use App\Role;
use Carbon\Carbon;

class RolesDataTable extends DataTable
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
        ->editColumn('created_at', function ($query) {
                return $query->created_at ? with(new Carbon($query->created_at))->format('d/m/Y H:i:s') : '';
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                  $query->whereRaw("DATE_FORMAT(created_at,'%d/%m/%Y %H:%i:%s') like ?", ["%$keyword%"]);
                })      
                    ->editColumn('updated_at', function ($query) {
                return $query->updated_at ? with(new Carbon($query->updated_at))->format('d/m/Y H:i:s') : '';
            })
            ->filterColumn('updated_at', function ($query, $keyword) {
                  $query->whereRaw("DATE_FORMAT(updated_at,'%d/%m/%Y %H:%i:%s') like ?", ["%$keyword%"]);
            })
            ->addColumn('action', 'rolesdatatable.action')->addColumn('action',function ($role) {
                $nm=$role->slug;
       
             $action = '';

            if(\Entrust::can('role-list')){
            $action .= '  <a href="' . route('roles.show',$nm).'"> <button  class="btn btn-info" title="ver">Visualizar</button><a>';
        }

        if(\Entrust::can('role-update')){
            $action.= '  <a href="' . route('roles.edit',$nm).'">  <button  class="btn btn-warning glyphicon glyphicon-edit linea" title="editar">Actualizar</button><a>';
        }

           if(\Entrust::can('role-delete')){
            $action.= '  <a href="' . route('roles.showdelete',$nm).'">  <button  class="btn btn-danger  glyphicon glyphicon-trash linea" title="Eliminar">Eliminar</button><a>';
        }

   
       return $action;

            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Role $model)
    {
        return $model->newQuery()->select('id','name','display_name','description','created_at','updated_at','slug');
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
                    [  'id' => ['title' => 'id'],   
          'name' => ['title' => 'Nombre'],  
           'display_name' => ['title' => 'Nombre para mostrar'],  
            'description' => ['title' => 'Descripción'],  
             'created_at' => ['title' => 'Fecha de Creación'],  
              'updated_at' => ['title' => 'Fecha de Actualización'],
                    ])
                    ->minifiedAjax()
                    ->addAction(['width' => '300px'])
                  ->parameters([
                           'processing'=>' true',
                         'serverSide'=>'true',
                         'bAutoWidth' => 'true',
                   
                        

                        'language' => [
        'url' => url(asset('datatable/Spanish.json'))
    ],
                          'dom'          => 'Bfltip',
                       
                       
                        'buttons'      => ['export', 'print', 'reset', 'reload'],
                        
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
        return 'Roles_' . date('YmdHis');
    }
}
