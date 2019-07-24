<?php

namespace App\DataTables;


use Yajra\DataTables\Services\DataTable;
use App\Categorias;
use Carbon\Carbon;

class CategoriasDataTable extends DataTable
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
           ->editColumn('created_at', function ($categorias) {
                return $categorias->created_at ? with(new Carbon($categorias->created_at))->format('d/m/Y H:i:s') : '';
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                  $query->whereRaw("DATE_FORMAT(created_at,'%d/%m/%Y %H:%i:%s') like ?", ["%$keyword%"]);
                })      
                    ->editColumn('updated_at', function ($categorias) {
                return $categorias->updated_at ? with(new Carbon($categorias->updated_at))->format('d/m/Y H:i:s') : '';
            })
            ->filterColumn('updated_at', function ($query, $keyword) {
                  $query->whereRaw("DATE_FORMAT(updated_at,'%d/%m/%Y %H:%i:%s') like ?", ["%$keyword%"]);
            })->addColumn('estado', function ($categorias) {
               

  if($categorias->estado==1){

                  return '<li class="list-group-item" style="font-size:10px; background-color: #99c93d;
    color: #fff;">activo</li>';  
            }else{

             return '<li class="list-group-item" style="font-size:10px; background-color: red;
    color: #fff;">desactivado</li>';  
}

        } )->filterColumn('estado', function ($query, $keyword) {
                  $query->whereRaw("REPLACE(REPLACE(estado, '1', 'activo'),'0','desactivado')  LIKE  ?", ["%$keyword%"]);

                })->addColumn('action', 'rolesdatatable.action')->addColumn('action',function ($categorias) {
                $nm=$categorias->id;
       
             $action = '';


        if(\Entrust::can('role-update')){
            $action.= '<button type="button" name="edit" id="'.$nm.'" class="edit btn btn-info btn-sm">Editar</button>';
        }

           if(\Entrust::can('role-delete')){
            $action.= '        <button type="button" name="delete" id="'.$nm.'" class="delete btn btn-danger btn-sm">Eliminar</button>';
        }

   
       return $action;

            })->rawColumns(['estado','action']);



            ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Categorias $model)
    {
        return $model->newQuery()->select('id','nombre','descripcion','created_at', 'updated_at','estado');
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
                  
         'nombre' => ['title' => 'nombre'],            
        'descripcion' => ['title' => 'Descripción'],        
          'estado' => ['title' => 'Estado'],
        'created_at' => ['title'=>'Fecha creación'],
         'updated_at' => ['title'=>'Fecha Última Actualización de datos'],
                          ])->addAction(['title'=>'Opciones','width' => '300px'])
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
           'nombre',
           'descripcion',
           'estado',
            'created_at',
            'updated_at'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Categorias_' . date('YmdHis');
    }
}
