@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Crear venta
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
						 <h3>Listado de Recaudamientos {{--<a href="{{route('recaudacion.create')}}"><button class="btn btn-success">Nuevo</button></a>--}}</h3>
						@include('recaudacion.search')
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
								@foreach ($recaudacion as $ven)
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
											
											<a href="{{URL::action('RecaudacionController@show', $ven->id)}}"><button class="btn btn-primary btn-sm">Detalles</button></a>
											
											
											<a href="" data-target="#modal-delete-{{$ven->id}}" data-toggle="modal" ><button class="btn btn-danger btn-sm">Anular</button></a>
												
										</td>
									</tr>
								</tbody>
								@include('recaudacion.modal')
								@endforeach
							</table>
						</div>
						{{$recaudacion->render()}}
					</div>
				</div>
		</div>
	</div>
</section>
@endsection
