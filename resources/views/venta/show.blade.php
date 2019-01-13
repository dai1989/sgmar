@extends('adminlte::layouts.app')

@section('htmlheader_title')
    venta
@endsection

@section('content')

        
   <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label for="persona_id">Cliente</label>
                            <p>{{$venta->nombre}},{{$venta->apellido}}</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label for="fecha_hora">Fecha</label>
                            <p>{{date("d-m-Y", strtotime($venta->fecha_hora))}}</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label for="fecha_hora">Vendedor</label>
                            <p>{{$user->name}}</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label>Tipo Comprobante</label>
                            <p>{{$venta->tipo_comprobante}}</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label for="num_comprobante">Número Comprobante</label>
                            <p>{{$venta->num_comprobante}}</p>
                        </div>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  table-responsive">
                            <table  class="table table-bordered">
                             <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color: #A9D0F5">
                                    <th>DD-MM-AAAA</th>
                                    <th>Productos</th>
                                    <th>Cantidad</th>
                                    <th>Precio Venta</th>
                                    <th>Descuento</th>
                                    <th>Subtotal</th>
                                </thead>
                                <tbody>
                                    @foreach($detalles as $det)
                                        <tr>
                                            <td>{{date("d-m-Y", strtotime($venta->fecha_hora))}}</td>
                                            <td>{{$det->producto}}</td>
                                            <td class="text-derecha">{{$det->cantidad}}</td>
                                            <td class="text-derecha">{{$det->precio_venta}}</td>
                                            <td class="text-derecha">{{number_format($det->descuento, 2, '.', '')}}</td>
                                            <td class="text-derecha">{{number_format($det->cantidad*$det->precio_venta-$det->descuento, 2, '.', '')}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tbody>
                                    <th>TOTAL</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th class="text-derecha" ><h4>{{number_format($venta->total_venta, 2, '.', '')}}</h4></th>
                                </tbody>
                                <tbody>
                                    <th>PAGA</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th class="text-derecha" ><h4>{{$venta->entrega}}</h4></th>
                                </tbody>
                                <tbody>
                                    <th>CAMBIO</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th class="text-derecha"><h4>{{number_format($venta->entrega - $venta->total_venta, 2, '.', '')}}</h4></th>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div>
                    <a href="#"><button class="btn btn-info ">Descargar PDF</button></a>
                </div>
            </div>
        </div>
    </section>
    {!!Form::close()!!}

@endsection