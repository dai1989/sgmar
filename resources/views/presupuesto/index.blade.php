@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Crear Persona
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
						 <h3>Listado de Recaudamientos {{--<a href="{{route('presupuesto.create')}}"><button class="btn btn-success">Nuevo</button></a>--}}</h3>
						@include('presupuesto.search')
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-condensed table-hover">
								<thead>
									<th>Fecha</th>
									<th>Total</th>
									<th>Estado</th>
									<th>Opciones</th>
								</thead>
								@foreach ($presupuesto as $ven)
								<tbody>
									<tr>
										<td>{{ date("d-m-Y", strtotime($ven->fecha_hora))}}</td>
										<td><strong>{{ $ven->total_venta}}</strong></td>
										<td>@if($ven->estado == "Revisado")
											<span class="label label-info">{{ $ven->estado}}</span>
											@else
											<span class="label label-danger">{{ $ven->estado}}</span>
											@endif
										</td>
										<td>
											
											<a href="{{URL::action('PresupuestoController@show', $ven->id)}}"><button class="btn btn-primary btn-sm">Detalles</button></a>
											
											<a href="" data-target="#modal-delete-{{$ven->id}}" data-toggle="modal" ><button class="btn btn-danger btn-sm">Anular</button></a>
												
										</td>
									</tr>
								</tbody>
								@include('presupuesto.modal')
								@endforeach
							</table>
						</div>
						{{$presupuesto->render()}}
					</div>
				</div>
		</div>
	</div>
</section>
@endsection
