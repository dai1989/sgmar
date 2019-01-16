@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Compras
@endsection

@section('content')
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <div class="container-fluit">
                    @include('flash::message')
                </div>
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <h3>Listado de Ingreso
                           
                            <a href="{{route('ingreso.create')}}"><button class="btn btn-success">Nuevo</button></a>
                            
                        </h3>
                        @include('ingreso.search')
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-condensed table-hover">
                                <thead>
                                    <th>Fecha</th>
                                    <th>Proveedor</th>
                                    <th>Comprobante</th>
                                    <th>Impuesto</th>
                                    <th>Total</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </thead>
                                @foreach ($ingresos as $ing)
                                    <tbody>
                                        <tr>
                                            <td>{{ date("d-m-Y", strtotime($ing->fecha_hora))}}</td>
                                            <td id="toggle-button-{{$ing->proveedor_id}}"><a href="#">{{ $ing->razonsocial}}</a></td>
                                            <td>{{ $ing->tipo_comprobante.': '. $ing->num_comprobante}}</td>
                                            <td>{{ $ing->impuesto}}</td>
                                            <td>{{number_format( $ing->total, 2, '.', '')}}</td>
                                            <td>@if($ing->estado == "Cancelada")
                                                <span class="label label-info">{{ $ing->estado}}</span>
                                                @else
                                                <span class="label label-danger">{{ $ing->estado}}</span>
                                                @endif
                                            </td>

                                                    <td>
                                                      
                                                        <a href="{{URL::action('IngresoController@show', $ing->idingreso)}}"><button class="btn btn-primary">Detalles</button></a>
                                                       
                                                        <a href="" data-target="#modal-delete-{{$ing->idingreso}}" data-toggle="modal" ><button class="btn btn-danger">Anular</button></a>
                                                       
                                                    </td>
                                                </tr>
                                            </tbody>
                                            @include('ingreso.modal')
                                            @include('ingreso.modalproveedor')
                                        @endforeach
                                    </table>
                                </div>
                                {{$ingresos->render()}}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
@endsection