<?php

namespace App\DataTables;

use App\User;
use Yajra\DataTables\Services\DataTable;
use App\Personas;
use Carbon\Carbon;


class ClientesDataTable extends DataTable
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
            ->addColumn('action', 'Personasdatatable.action')->addColumn('action',function ($clientes) {
                $nm=$clientes->id;
       
             $action = '';


        if(\Entrust::can('clientes')){
            $action.= '<button type="button" name="edit" id="'.$nm.'" class="edit btn btn-info btn-sm">Editar</button>';
        }

           if(\Entrust::can('clientes')){
            $action.= '        <button type="button" name="delete" id="'.$nm.'" class="delete btn btn-danger btn-sm">Eliminar</button>';
        }

   
       return $action;

            })->rawColumns(['estado','action']);
            
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Personas $model)
    {
       
        return $model->newQuery()->select('id','nombre','documento','numero','telefono','email','created_at','updated_at','direccion')->where('tipo','=',1);
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
          'nombre' => ['title' => 'Nombre'],  
           'documento' => ['title' => 'Documento'],  
            'numero' => ['title' => 'numero'],  
            'telefono' => ['title' => 'telefono'],  
            'email' => ['title' => 'email'],
                      'direccion' => ['title' => 'Dirección'],
             'created_at' => ['title' => 'Fecha de Creación'],  
              'updated_at' => ['title' => 'Fecha de Actualización'],
                    ])
                    ->minifiedAjax()
                    ->addAction(['title' => 'Opciones','width' => '300px'])
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
            'id',
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
        return 'Personas_' . date('YmdHis');
    }
}
