@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Crear pedido
@endsection

@section('content')
<div class="row">
	<div class="col-lg-6 col-md-6 col-dm-12 col-xs-12">
	<h3>Nuevo Pedido</h3>
	@if(count($errors)>0)
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors-> all() as $error)
					<li>
					{{$error}}
					</li>
				@endforeach
			</ul>
		</div>
		@endif
	</div>
</div>
		{!!Form::open(array('url'=>'pedidos','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
<div class="row">	
<div class="col-lg-6 col-md-6 col-dm-12 col-xs-12">
	<div class="form-group">            
               <label for="razonsocial">Proveedor:</label>
               <select name="id_proveedor" id="id_proveedor" class="form-control selectpicker" data-Live-search="true">
                   @foreach($proveedores as $proveedor)
                       <option value="{{$proveedor -> id}}">{{$proveedor -> razonsocial}} {{$proveedor -> cuit}}</option>
                   @endforeach
               </select>
            </div>
</div>
<div class="col-lg-3 col-md-4 col-dm-12 col-xs-12">
	<div class="form-group">
			<label for="serie_comprobante">Serie Comprobante</label>
			<input type="text" name="serie_comprobante" readonly value= "<?php echo date("Y-m-d");?>{{$ipedido}}" class="form-control" placeholder="Serie de comprobante...">
	</div>
</div>
</div>

<div class="row">
<div class="panel panel-primary">
<div class="panel-body">
<div class="col-lg-2 col-md-2 col-dm-12 col-xs-12">
	 <div class="form-group">
                        <label for="">Producto</label>
                        <select class="form-control selectpicker" name="pid_producto" id="pid_producto" data-Live-search="true">
                            @foreach($productos as $producto)
                                <option value="{{$producto -> id}}">{{$producto -> productos}}</option>
                            @endforeach
                        </select>
                    </div>
	</div>	

	
	
	<div class="col-lg-2 col-md-2 col-dm-12 col-xs-12">
		<div class="form-group">
		<label for="cantidad">Cantidad</label>
		<input type="number" name="pcantidad" id="pcantidad" class="form-control" placeholder="Cantidad">
		</div>
	</div>


	<div class="col-lg-2 col-md-2 col-dm-12 col-xs-12">
		<div class="form-group">
		<label for="stock">Stock</label>
		<input type="number" name="pstoc" id="pstock" readonly class="form-control" placeholder="en bodega">
		</div>
	</div>

	<div class="col-lg-2 col-md-2 col-dm-12 col-xs-12">
		<div class="form-group">
		<label for="precio_venta">Precio de compra</label>
		<input type="number" readonly name="pprecio_venta" id="pprecio_venta" class="form-control" placeholder="precio de compra">
		</div>
	</div>

	<div class="col-lg-12 col-md-12 col-dm-12 col-xs-12">
		<div class="form-group">
		<button class="btn btn-primary" type="button"  id="bt_agregar" onclick="agregar()">Agregar</button>
		</div>
	</div>

	<div class="col-lg-12 col-md-12 col-dm-12 col-xs-12">
		  <div class="table-responsive">
		<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
			<thead style="background-color:#caf5a9">
			<th>Opcciones</th>
			<th>Articulo</th>
			<th>Cantidad</th>
			<th>Precio Venta</th>
			<th>Subtotal</th>
		</thead>
			<tfoot>
				<th>Total</th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th><h4 id="total">$/. 0.00</h4> <input type="hidden" name="total_venta" id="total_venta">
				</th>
			</tfoot>
		<tbody></tbody>
		</table>
		</div>
	</div>
	</div>
	</div>
	<div class="col-lg-12 col-md-12 col-dm-12 col-xs-12">
		<div class="form-group">
		<label for="condiciones">Condiciones del Servicio</label>
		<textarea type="text" name="condiciones" id="condiciones" class="form-control" placeholder="condiciones"></textarea>
	</div>
</div>
		<div class="col-lg-6 col-md-6 col-dm-6 col-xs-12" id="guardar1">
					<div class="form-group">
				<input name="_token" value="{{ csrf_token() }}" type="hidden"></input>
						<button class="btn btn-primary" id="guardar"  type="submit">Guardar</button>
						<button class="btn btn-danger" type="reset">Restablecer</button>
						<a class="btn btn-primary" href="/pedidos" role="button">Cancelar</a>
		
					</div>
				</div>
		</div>
   		{!!Form::close()!!}  
         @push ('scripts')
		<script>
		var total=0;
		cont=0;
		total=0;
		subtotal=[];
		$("#pid_producto").change(mostrarValores);
		$("#guardar").hide();

		$(document).on('ready',function(){
		$('select[name=id_proveedor]').val(1);	
		$('select[name=pid_producto]').val(1);
		$('.selectpicker').selectpicker('refresh')
			mostrarValores();
		});
		
		function mostrarValores()
		{
			datosProducto=document.getElementById('pid_producto').value.split('_');
			$("#pprecio_venta").val(datosProducto[1]);
			
			$("#pstock").val(datosProducto[2]);

		}

function evaluar()
	{
		var indice = document.getElementById('id_proveedor').selectedIndex
		if(total>0)
	 {		
		if(indice<=0)
			{
				alert("Debe seleccionar un cliente")
			}
			else
			{
				$("#guardar").show();
			}
		}
		else
		{
			$("#guardar").hide();
		}	
	}	

function agregar()
		{
			datosProducto=document.getElementById('pid_producto').value.split('_');
			id_producto=datosProducto[0];
			producto=$("#pid_producto option:selected").text();
			stock=$("#pstock").val();
			cantidad=$("#pcantidad").val();
			precio_venta=$("#pprecio_venta").val();
			
			  if (id_producto!="" && cantidad!="" && cantidad>0 && precio_venta!="")
		{
			subtotal[cont]=(cantidad*precio_venta);
			total=total+subtotal[cont];

			var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="id_producto[]" value="'+id_producto+'">'+articulo+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"><td><input type="number" name="precio_venta[]" value="'+precio_venta+'"></td><td>'+subtotal[cont]+'</td></tr>';
			cont++;
		    $('#total').html("$/ " + total);
		    $('#total_venta').val(total);
			evaluar();
		  	$('#detalles').append(fila);
		  	limpiar();
		  	$('select[name=pid_producto]').val(1);
			$('.selectpicker').selectpicker('refresh')
			mostrarValores();
		}
	else
	{
		alert("Error al ingresar el detalle de la venta, revise los datos del articulo");
	}
		}


	function limpiar()
			 {
			    $("#pcantidad").val("");
				$("#pprecio_venta").val("");
				$("#pstock").val("");
			 }


	function eliminar(index){
	total=total-subtotal[index];
	$('#total').html("$/. "+total);
	$('#total_venta').val(total);
	$('#fila'+index).remove();
	evaluar();
		}
</script>
@endpush
@endsection