@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Crear Persona
@endsection

@section('content')
  @php
    $date = Carbon\Carbon::now('America/Argentina/Mendoza');
  @endphp
<section class="content">
  <div class="box">
    <div class="box-header with-border">
				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
							<label for="fecha_hora">Fecha</label>
							<p>{{$venta->fecha_hora}}</p>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
							<label for="fecha_hora">Vendedor</label>
							<p>{{$user->name}}</p>
						</div>
					</div>
				</div>

					<div class="panel panel-primary">
						<div class="panel-body">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
									<thead style="background-color: #A9D0F5">
										<th>DD-MM-AAAA</th>
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
										<th class="text-derecha"><h4 id="total">{{$venta->total_venta}}</h4></th>
									</tfoot>
									<tbody>

									@foreach($detalles as $det)
										<tr>
											<td>{{$det->created_at=$date->format('d-m-Y')}}</td>
                      <td>{{$det->producto}}</td>
											<td class="text-derecha">{{$det->cantidad}}</td>
											<td class="text-derecha">{{$det->precio_venta}}</td>
											<td class="text-derecha">{{number_format($det->descuento, 2, '.', '')}}</td>
											<td class="text-derecha">{{number_format($det->cantidad*$det->precio_venta-$det->descuento, 2, '.', '')}}
                      </td>
										</tr>
									@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div>
							<a href="{{URL::action('PDFController@presupuesto', $venta->id)}}"><button class="btn btn-info ">Descargar PDF</button></a>
					</div>


			{!!Form::close()!!}
		</div>
	</div>
</section>
@endsection
