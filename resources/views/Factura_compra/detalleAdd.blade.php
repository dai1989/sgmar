@extends('adminlte::layouts.app')

@section('content')
{{ session("mensaje") }} 

<form method="POST" action="{{ asset('factura_compra/' . $factura_compra->id . '/detalle/store') }}">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <a class="btn btn-info btn-lg btn-block" href="/sist_gmar/public/factura_compra/create">Nuevo comprobante</a>
  <table class="table table-bordered">
    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header">
                Comprobante # {{ str_pad ($factura_compra->id, 7, '0', STR_PAD_LEFT) }}
            </h2>
            <div class="well well-sm">
                <div class="row">
                    <div class="col-xs-6">
                        <label for="proveedor">Proveedor</label>
                        <input class="form-control typeahead" type="text" readonly value="{{ $factura_compra->proveedor->razon_social}}" />
                    </div>
                    <div class="col-xs-6">
                        <label for="cboUser">Usuario</label>
                        <input class="form-control typeahead" type="text" readonly value="{{ $factura_compra->user_id}}" />
                    </div>
                    <div class="col-xs-2">
                        <label for="fac_numero">N° Factura</label>
                        <input class="form-control" type="text" readonly value={{ $factura_compra->fac_numero }} />
                    </div>
                    <div class="col-xs-2">
                        <label for="fac_tipo">Tipo</label>
                        <input class="form-control" type="text" readonly value={{ $factura_compra->fac_tipo }} />
                    </div>
                    <div class="col-xs-2">
                        <label for="factura_fecha">Fecha</label>
                        <input class="form-control" type="text" readonly value={{ $factura_compra->fac_fecha }} />
                    </div>
                    <div class="col-xs-2">
                        <label for="cboProducto">Producto</label>
                        <select  name="cboProducto" class="form-control">
                            <option readonly value="">--Seleccionar Producto--</option><br>
                            @foreach ($productos_list as $producto)
                            <option readonly value="{{ $producto->id }}">{{ $producto->descripcion }}</option>
                            @endforeach
                        </select><br>
                    </select>
                    </div>
                    
                    <div class="col-xs-2">
                        <label for="txtCantidad">Cantidad</label>
                        <input type="number" name="txtCantidad" type="submit" class="form-control" name="Agregar" />
                        <input type="submit" name="Agregar Producto">
                    </div>
                    <div class="form-group col-xs-6">
                      <label for="precio_compra">Precio de compra*</label>
                      <input type="text" class="form-control" id="precio_compra" name="txtFacturaPrecioCompra" placeholder="precio..." >
</div>

                </div>
            </div>
        </div>
        <hr/>
        <table class="table table-bordered">
            <tr>
                <th style="width:100px;" class="info">Codigo</th>
                <th style="width:160px;" class="info">Producto</th>
                <th style="width:160px;" class="info">Precio U</th>
                <th style="width:160px;" class="info">Cantidad</th>
                <th style="width:160px;" class="info">Subtotal</th>
                
                <th style="width:30px;" class="info">Accion</th>
            </tr>
            @foreach ($detalle_list as $detalle)
            <tr>
                <td class="text-right">{{ $detalle->producto_id }}</td>
                <td class="text-right">{{ $detalle->producto->descripcion }}</td>
                <td class="text-right">${{ $detalle->precio_compra }}</td>
                <td class="text-right">{{ $detalle->cantidad }}</td>
                <td class="text-right">${{ $detalle->subtotal }}</td>
                
                <td>
                    <a href="/sistema_gmar/public/factura_compra/detalle/delete/{{$detalle->id}}"><i class='glyphicon glyphicon-trash'></i>Eliminar</a></li></a>
                </td>
            </tr>
        @endforeach
    </table>
    <br>
    <table class="table table-bordered">
        <tr>
            <td  align="center" class="active"><h4>Total de Factura más iva (21%): ${{ $factura_compra->total }}</h4></td>
        </tr>
    </table>
    <button type="button" class="btn btn-default"><a href="/sistema_gmar/public/factura_compra">Listado</a></button>

    @endsection