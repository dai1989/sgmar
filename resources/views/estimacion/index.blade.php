@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Crear credito
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
						<h3>Listado de Presupuesto
							
							<a href="{{route('estimacion.create')}}"><button class="btn btn-success">Nuevo</button></a>
							
						</h3>
						@include('estimacion.search')
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-condensed table-hover">
								<thead>
									<th>Fecha</th>
									<th>Impuesto</th>
									<th>Total</th>
									<th>Estado</th>
									<th>Opciones</th>
								</thead>
								@foreach ($estimacion as $est)
									<tbody>
										<tr>
											<td>{{date("d-m-Y", strtotime($est->fecha_hora))}}</td>
											<td>{{ $est->impuesto}}
												<td>{{ $est->total_venta}}
													<td>@if($est->estado == "Venta Realizada")
														<span class="label label-info">{{ $est->estado}}</span>
													@else
														<span class="label label-danger">{{ $est->estado}}</span>
													@endif
												</td>
												<td>
													
													<a href="{{URL::action('EstimacionController@show', $est->idestimacion)}}"><button class="btn btn-primary">Detalles</button></a>
													
													<a href="{{URL::action('EstimacionController@estimacionventa', $est->idestimacion)}}"><button class="btn btn-success">Realizar Venta</button></a>
													
												</td>
											</tr>
										</tbody>
									@endforeach
								</table>
							</div>
							{{$estimacion->render()}}
						</div>
					</div>
				</div>
			</div>
		</section>
	@endsection
