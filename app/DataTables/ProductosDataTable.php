<?php

namespace App\DataTables;

use App\User;
use Yajra\DataTables\Services\DataTable;
use App\Productos;
use Carbon\Carbon;


class ProductosDataTable extends DataTable
{
  
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)  ->editColumn('created_at', function ($productos) {
                return $productos->created_at ? with(new Carbon($productos->created_at))->format('d/m/Y H:i:s') : '';
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                  $query->whereRaw("DATE_FORMAT(productos.created_at,'%d/%m/%Y %H:%i:%s') like ?", ["%$keyword%"]);
                })      
                    ->editColumn('updated_at', function ($productos) {
                return $productos->updated_at ? with(new Carbon($productos->updated_at))->format('d/m/Y H:i:s') : '';
            })
                    ->editColumn('precio', function ($productos) {

                 $base='$';
                $base.=$productos->precio;

                return $base;
            })
            ->filterColumn('updated_at', function ($query, $keyword) {
                  $query->whereRaw("DATE_FORMAT(productos.updated_at,'%d/%m/%Y %H:%i:%s') like ?", ["%$keyword%"]);
            })->addColumn('pestado', function ($productos) {
               

  if($productos->pestado==1){

                  return '<li class="list-group-item" style="font-size:10px; background-color: #99c93d;
    color: #fff;">activo</li>';  
            } if($productos->pestado==0){

             return '<li class="list-group-item" style="font-size:10px; background-color: red;
    color: #fff;">desactivado</li>';  
}

        } )->addColumn('codigobarra', function($productos) {
           $barcode=$productos->codigo;

           
return view('Almacen.productos.barcodeDataTable')->with('barcode',$barcode)->render();
            })



        ->addColumn('action', 'productosdatatable.action')->addColumn('action',function ($productos) {
                $nm=$productos->pid;
       
             $action = '';


        if(\Entrust::can('proveedores')){
            $action.= '<button type="button" name="edit" id="'.$nm.'" class="edit btn btn-info btn-sm">Editar</button>';
        }

           if(\Entrust::can('proveedores')){
            $action.= '        <button type="button" name="delete" id="'.$nm.'" class="delete btn btn-danger btn-sm">Eliminar</button>';
        }

   
       return $action;

            })
            ->rawColumns(['pestado','action','codigobarra']);
            
    
            
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Productos $model)
    {
       
        return $model->newQuery()->select('productos.id as pid','productos.nombre as pnombre','categorias.nombre','stock','productos.descripcion','codigo','imagen','productos.created_at','productos.updated_at','productos.estado as pestado','precio')->join('categorias', 'categorias.id', '=', 'productos.id_categoria');
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
                    [  'pid' =>  ['title' => 'id', 'name' => 'productos.id','data' => 'pid'], 
          'pnombre' => ['title' => 'Nombre Producto','name' => 'productos.nombre','data' => 'pnombre'],
           'productos.descripcion' => ['title' => 'Descripción','name' => 'productos.descripcion','data' => 'descripcion'],  
            'stock' => ['title' => 'Stock'],
             'precio' => ['title' => 'Precio actual'],    
               'categorias.nombre' =>  ['title' => 'Categoría','name' => 'categorias.nombre','data' => 'nombre'],
             'productos.created_at' => ['title' => 'Fecha Creación','name' => 'created_at','data' => 'created_at'],
              'productos.updated_at' => ['title' => 'Fecha Actualización','name' => 'updated_at','data' => 'updated_at'],
              'pestado' =>  ['title' => 'Estado','name' => 'productos.estado','data' => 'pestado'],
               'codigo' => ['title' => 'Código'],
            'codigobarra' => ['title' => 'Código de Barra'],
                    ])
                    ->minifiedAjax()
                    ->addAction(['width' => '700px'])
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
        return 'Productos_' . date('YmdHis');
    }
}
