@extends('adminlte::layouts.app')

@section('content')
 <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Compras</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
               <div class="panel-heading">
                    
                    @can('factura_compra.create')
                    <a href="{{ route('factura_compra.create') }}" 
                    class="btn btn-sm btn-primary pull-right">
                        Crear
                    </a>
                    @endcan
                </div>

                <div class="panel-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="10px">ID</th>
                                <th>Proveedor</th>
                                <th>Usuario</th>
                                <th>Numero</th>
                                <th>Fecha</th>
                                <th>Tipo</th>
                                <th>Tipo de Pago</th>
                                <th>Total</th>
                                <th>Acciones</th>
                                <th colspan="3">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($factura_compra_list as $factura_compra)
                            <tr>
                                <td>{{ $factura_compra->id }}</td>
                                <td>{{ $factura_compra->proveedor->razon_social }}</td>
                                <td>{{ $factura_compra->user->name}}</td>
                                <td>{{ $factura_compra->fac_numero }}</td>
                                <td>{{ $factura_compra->fac_fecha }}</td>
                                <td>{{ $factura_compra->fac_tipo}}</td>
                                <td>{{ $factura_compra->tipopago->descripcion_tipopago}}</td>
                                <td>{{ $factura_compra->total}}</td>
                                <td class="text-right">
                                    <a class="btn btn-success btn-block btn-xs" href="factura_compra/{{ $factura_compra->id }}/detalle/add">
                                        <i class="fa fa-file"></i> Detalles
                                    </a>
                                </td>
                                <td class="text-right">
                                    <a class="btn btn-success btn-block btn-xs" href="#">
                                        <i class="fa fa-file-pdf-o"></i> Descargar
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection