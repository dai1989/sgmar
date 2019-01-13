@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Crear presupuesto
@endsection

@section('content')
	<section class="content">
		<div class="box">
			<div class="box-header with-border">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						@if (count($errors)>0)
							<div class="alert alert-danger alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{$error}}</li>
									@endforeach
								</ul>
							</div>
						@endif
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
							<label for="fecha_hora">Fecha</label>
							<p>{{$estimacion->fecha_hora}}</p>
						</div>
					</div>
					{!! Form::open(array('url' => 'crearventa', 'method'=>'POST', 'autocomplete' => 'off'))!!}
					{{Form::token()}}
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
						<div class="form-group">
							<label for="persona_id">Cliente</label>
							<select name="persona_id" required class="form-control selectpicker" id="persona_id" data-live-search="true">
								<option></option>
								@foreach($personas as $persona)
									<option value="{{$persona->id}}">{{$persona->nombre}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<input type="hidden" name="id" value="{{$estimacion->id}}">
					<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
							<label>Tipo Comprobante</label>
							<select name="tipo_comprobante" class="form-control">
								<option value="Factura A">Factura A</option>
								<option value="Factura B">Factura B</option>
								<option value="Ticket">Ticket</option>
							</select>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="tipofactura_id">Tipo de Factura</label>
                            <select name="tipofactura_id" class="form-control selectpicker" id="tipofactura_id" data-live-search="true">
                                <option></option>
                                @foreach($tipofactura_list as $tipofactura)
                                    <option value="{{$tipofactura->id}}">{{$tipofactura->descripcion}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="tipopago_id">Tipo de Pago</label>
                        <select  type="text" name="tipopago_id" class="form-control" id="tipopago_id" placeholder="tipo de factura" >
                            <option value="">--Seleccionar--</option>@foreach ($tipopago_list as $tipopago)
                            <option value="{{ $tipopago->id }}">{{ $tipopago->descripcionpago }}</option>@endforeach
                        </select>
                    </div>
                    </div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
							<label for="num_comprobante">Número Comprobante</label>
							@if ($ven == '1')
								<input type="text" readonly  value="0-0" name="num_comprobante" class="form-control" placeholder="Numero Comprobante">
							@else
								<input type="text" readonly  value="0-{{$ven->id}}" name="num_comprobante" class="form-control" placeholder="Numero Comprobante">
							@endif
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
							<label for="entrega">Paga</label>
							<input type="number" step=".01"  required  name="entrega" class="form-control" placeholder="Con cuanto paga?">
						</div>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-body">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
								<thead style="background-color: #A9D0F5">
									<th>AAAA-MM-DD HH:MM:SS</th>
									<th>Artículos</th>
									<th>Cantidad</th>
									<th>Precio Venta</th>
									<th>Descuento</th>
									<th>Subtotal</th>
								</thead>
								<tfoot>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th class="text-derecha"><h4 id="total">{{$estimacion->total_venta}}</h4></th>
								</tfoot>
								<tbody>
									@foreach($detalles as $detalle)
										<tr>
											<td>{{$detalle->created_at}}</td>
											<td>{{$detalle->producto}}</td>
											<td class="text-derecha">{{$detalle->cantidad}}</td>
											<td class="text-derecha">{{$detalle->precio_venta}}</td>
											<td class="text-derecha">{{$detalle->descuento}}</td>
											<td class="text-derecha">{{number_format( $detalle->cantidad*$detalle->precio_venta-$detalle->descuento, 2, '.', '')}}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<button class="btn btn-primary" type="submit">Guardar</button>
				{{Form::token()}}
				{{-- <a href="#"><button class="btn btn-info ">Descargar PDF</button></a> --}}
			</div>
		</div>
	</section>
	{!!Form::close()!!}
@endsection
