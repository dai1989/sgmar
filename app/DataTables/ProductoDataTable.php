<?php

namespace App\DataTables;

use App\Models\Producto;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class ProductoDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'producto.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Producto $model)
    {
        return $model->with('marca','categoria');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '80px','printable' => false])
            ->parameters([
                'dom'     => 'Bfrtip',
                'order'   => [[0, 'desc']],
                'language' => ['url' => asset('js/SpanishDataTables.json')],
                'scrollX' => false,
                'responsive' => true,
                'buttons' => [
                    'create',
                    'export',
                    'print',
                    'reset',
                    'reload',
                ],
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
            'Cod.Producto' => ['name' => 'barcode', 'data' => 'barcode'],
            'Descripcion' => ['name' => 'descripcion', 'data' => 'descripcion'],
            'Marca' => ['name' => 'marca.descripcion', 'data' => 'marca.descripcion'],
            'Categoria' => ['name' => 'categoria.categoria_descripcion', 'data' => 'categoria.categoria_descripcion'],
            'precio_venta' => ['name' => 'precio_venta', 'data' => 'precio_venta'],
             'Stock' => ['name' => 'stock', 'data' => 'stock'],
             'imagen' => ['name' => 'imagen', 'data' => 'imagen', 'render' => '"<img src=\"imagenes/productos/"+data+"\" height=\"100\"/>"'],
             'estado'
            
            
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'productodatatable_' . time();
    }
}