@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Crear venta
@endsection

@section('content')
<style>
	.rect-checkbox{float:left;margin-left:130px;}
	.span {margin-left: -161px;}
</style>
	<section class="content">
	  <div class="box">
	    <div class="box-header with-border">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<h3>Recaudamiento</h3>
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
						{!! Form::open(array('url' => 'recaudamiento', 'method'=>'POST', 'autocomplete' => 'off'))!!}
						{{Form::token()}}
				<div class="">
					<div class="panel panel-primary">
						<div class="panel-body">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
								<div class="form-group">
									<label>Producto</label>
									<select name="pid_producto" class="form-control selectpicker" id="pid_produto" data-live-search="true">
									<option value="0"></option>
									@foreach($productos as $producto)
									<option value="{{$producto->id}}_{{$producto->stock}}_{{$producto->precio_venta}}">{{$producto->producto}}</option>
									@endforeach
									</select>
								</div>
							</div>
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<div class="form-group">
									<label for="cantidad">Cantidad</label>
									<input type="number" name="pcantidad" id="pcantidad" class="form-control">
								</div>
							</div>
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<div class="form-group">
									<label for="stock">Stock</label>
									<input type="number" disabled name="pstock" id="pstock" class="form-control" >
								</div>
							</div>

							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<div class="form-group">
									<label for="precio_venta">Precio Venta</label>
									<input type="number" disabled name="pprecio_venta" id="pprecio_venta" class="form-control">
								</div>
							</div>
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<div class="form-group">
									<label for="descuento">Descuento</label>
									<input type="number" name="pdescuento" id="pdescuento" class="form-control" placeholder="Precio Compra">
								</div>
							</div>
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<div class="form-group">
									<button type="button" id="bt-add" class="btn btn-primary">Agregar</button>
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
									<thead style="background-color: #A9D0F5">
										<th>Opciones</th>
										<th>Productos</th>
										<th>Cantidad</th>
										<th>Precio Venta</th>
										<th>Descuento</th>
										<th>Subtotal</th>
									</thead>
									<tfoot>
										<th>TOTAL</th>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th><h4 id="total">$ 0.00</h4><input type="hidden" name="total_venta" id="total_venta"></th>
									</tfoot>
									<tbody>

									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="guardar">
						<div class="form-group">
							<input type="hidden" name="_token" value="{{csrf_token()}}"></input>
							<button class="btn btn-primary" type="submit">Guardar</button>
							<button class="btn btn-danger" type="reset">Cancelar</button>
						</div>
					</div>
				</div>
				<input type="hidden" name="idusuario" value="{{Auth::user()->id}}">


						{!!Form::close()!!}

			@push('scripts')
				<script>
					$(document).ready(function(){
						$('#bt-add').click(function(){
							agregar();
						});
					});
					var cont=0;
					total=0;
					subtotal=[];
					total=0;
					$("#guardar").hide();
					$("#pid_producto").change(mostrarValores);

					function mostrarValores(){
						datosProducto=document.getElementById('pid_producto').value.split('_');
						$("#pprecio_venta").val(datosProducto[2]);
						$("#pstock").val(datosProducto[1]);
					}

					function agregar(){

						var id_producto=datosProducto[0];
						var producto=$("#pid_producto option:selected").text();
						var cantidad=$("#pcantidad").val();
						var descuento=$("#pdescuento").val();
						var precio_venta= parseFloat($("#pprecio_venta").val());
						var stock=$("#pstock").val();
						var stock_numero = parseInt(stock);
						var stock_cantidad = parseInt(cantidad);

							if (id_producto!="" && cantidad!="" && cantidad>0 && pdescuento!="" && precio_venta!="")
							{
								if (stock_numero>=stock_cantidad)
								{
								subtotal[cont]=(cantidad*precio_venta-descuento);
								total=total+subtotal[cont];
								var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-danger btn-xs" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="id_producto[]" value="'+id_producto+'">'+producto+'</td><td><input type="number" readonly name="cantidad[]" value="'+cantidad+'"></td><td><input type="number" readonly name="precio_venta[]" value="'+precio_venta+'"></td><td><input readonly type="number" name="descuento[]" value="'+descuento+'"></td><td>'+subtotal[cont]+'</td></tr>';
								cont++;
								limpiar();
								$('#total').html("$ " + total);
								$('#total_venta').val(total);
								evaluar();
								$('#detalles').append(fila);
								}
								else
								{
									alert('La cantidad a vender supera el stock');
								}

							}
							else
							{
								alert("Error al ingresar el detalle de la venta, revise los datos del artículo");
							}
					}
					function limpiar(){
						$('#pcantidad').val("");
						$('#pstock').val("");
						$('#pdescuento').val("");
						$('#pprecio_venta').val("");
						$('#pid_producto').selectpicker('val', '0');
					}
					function evaluar()
					{
						if (total>0)
						{
							$("#guardar").show();
						}
						else
						{
							$("#guardar").hide();
						}
					}
					function eliminar(index){
						total=total-subtotal[index];
						$("#total").html("$ " + total);
						$('#total_venta').val(total);
						$("#fila" + index).remove();
						evaluar();
					}
				</script>
			@endpush
		</div>
	</div>
</section>
@endsection
