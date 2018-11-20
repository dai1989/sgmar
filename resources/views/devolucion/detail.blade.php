@extends('adminlte::layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header">
                Nota de credito # {{ str_pad ($model->id, 7, '0', STR_PAD_LEFT) }}
            </h2>

            <div class="well well-sm">
                <div class="row">
                    <div class="col-xs-6">
                        <input class="form-control typeahead" type="text" readonly value="{{ $model->factura->persona->nombre }},{{$model->factura->persona->apellido}}" />
                    </div>
                    <div class="col-xs-2">
                        <input class="form-control" type="text" readonly value={{ $model->factura->persona->documento }} />
                    </div>
                     <div class="col-xs-2">
                        <input class="form-control" type="text" readonly value={{ $model->user->name}} />
                    </div>
                   
                   
                </div>
            </div>

            <hr />

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Producto</th>
                    <th style="width:100px;">Cantidad</th>
                    <th style="width:100px;">Observacion</th>
                    <th style="width:100px;">P.U</th>
                    <th style="width:100px;">Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach($model->detail as $d)
                <tr>
                    <td>{{$d->producto->descripcion}}</td>
                    <td class="text-right">{{$d->cantidad}}</td>
                    <td class="text-right">{{$d->observacion}}</td>
                    <td class="text-right">$ {{number_format($d->precio_venta, 2)}}</td>
                    <td class="text-right">$ {{number_format($d->total, 2)}}</td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3" class="text-right"><b>IVA</b></td>
                    <td class="text-right">$ {{ number_format($model->iva, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right"><b>Sub Total</b></td>
                    <td class="text-right">$ {{ number_format($model->subTotal, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right"><b>Total</b></td>
                    <td class="text-right">$ {{ number_format($model->total, 2) }}</td>
                </tr>
                </tfoot>
            </table>

        </div>
    </div>
</div>
@endsection