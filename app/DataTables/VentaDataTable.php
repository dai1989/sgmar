<?php

namespace App\DataTables;

use App\Models\Venta;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class VentaDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'venta.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Venta $model)
    {
        return $model->with('cliente','producto','user','tipofactura','tipopago');
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
            'Fecha' => ['name' => 'fecha_hora', 'data' => 'fecha_hora'],
            'Cliente' => ['name' => 'cliente.nombre', 'data' => 'cliente.nombre'],
            'Usuario' => ['name' => 'user.name', 'data' => 'user.name'],
            'Impuesto' => ['name' => '.impuesto', 'data' => '.impuesto'],
            'total_venta' => ['name' => 'total_venta', 'data' => 'total_venta']
             
            
            
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ventadatatable_' . time();
    }
}