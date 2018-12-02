@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Crear venta
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <h3>Nueva venta</h3>
        @if (count($errors) > 0)
        <div class="alert alert-danger">
	        <ul>
	            @foreach($errors -> all() as $error)
	                <li>{{$error}}</li>
	            @endforeach
	        </ul>
        </div>
        @endif
    </div>
</div>
        {{Form::open(array('url' => 'ventas/venta', 'method' => 'POST', 'autocomplete' => 'off'))}}
        {{Form::token()}}
    <div class="row">
        <div class="col-xs-6">
             <div class="form-group">            
               <label for="nombre">Cliente:</label>
               <select name="id_cliente" id="id_cliente" class="form-control selectpicker" data-Live-search="true">
                   @foreach($personas as $persona)
                       <option value="{{$persona -> id}}">{{$persona -> nombre}} {{$persona -> apellido}}</option>
                   @endforeach
               </select>
            </div>
        </div>
          <div class="col-xs-6">
             <div class="form-group">            
               <label for="id_user">Vendedor:</label>
               <select name="id_user" id="id_user" class="form-control selectpicker" data-Live-search="true">
                   @foreach($user_list as $user)
                       <option value="{{$user -> id}}">{{$user -> name}}</option>
                   @endforeach
               </select>
            </div>
        </div>
          
        <div class="col-xs-2">
             <div class="form-group">            
               <label for="nombre">Tipo de comprobante:</label>
               <select name="tipo_comprobante" id="" class="form-control selectpicker">                  
                   <option value="Boleta">Boleta</option> 
                   <option value="Factura">Factura</option>
                   <option value="Ticket">Ticket</option>
               </select>
        </div>
        </div>
        <div class="col-xs-2">
            <div class="form-group">            
               <label for="codigo">Serie del comprobante:</label>
                <input type="text" class="form-control" name="serie_comprobante" placeholder="Serie del comprobante..."  value="{{old('serie_comprobante')}}">            
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group">            
               <label for="codigo">Numero del comprobante:</label>
                <input type="text" class="form-control" name="num_comprobante" placeholder="Numero del comprobante..."  required value="{{old('num_comprobante')}}">            
            </div>
        </div>

<div class="form-group col-sm-6">
    <label for="tipofactura_id">Tipo factura</label>
  <select  type="text" name="tipofactura_id" class="form-control" id="tipofactura_id" placeholder="tipo de factura" >
    <option value="">--Seleccionar--</option>
    @foreach ($tipofactura_list as $tipofactura)
    <option value="{{ $tipofactura->id }}">{{ $tipofactura->descripcion }}</option>
    @endforeach
  </select>
</div> 
<div class="form-group col-sm-6">
    <label for="tipopago_id">Tipo de Pago</label>
  <select  type="text" name="tipopago_id" class="form-control" id="tipopago_id" placeholder="tipo de factura" >
    <option value="">--Seleccionar--</option>
    @foreach ($tipopago_list as $tipopago)
    <option value="{{ $tipopago->id }}">{{ $tipopago->descripcionpago }}</option>
    @endforeach
  </select>
</div> 

</div>
    <div class="row">
       
       <div class="panel panel-primary">
           <div class="panel-body">
               <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="">Producto</label>
                        <select class="form-control selectpicker" name="pid_producto" id="pid_producto" data-Live-search="true">
                            @foreach($productos as $producto)
                                <option value="{{$producto -> id_producto}}_{{$producto -> stock}}_{{$producto -> precio_venta}}">{{$producto -> producto}}</option>
                            @endforeach
                        </select>
                    </div>
               </div>
                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-1">
                    <div class="form-group">            
                       <label for="cantidad">Stock:</label>
                        <input type="number" class="form-control" name="pstock" id="pstock"  readonly>            
                    </div>
                </div>
                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                    <div class="form-group">            
                       <label for="cantidad">Precio de venta:</label>
                        <input type="number" class="form-control" name="pprecio_venta" id="pprecio_venta"readonly>            
                    </div>
                </div>
                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                    <div class="form-group">            
                       <label for="cantidad">Descuento:</label>
                        <input type="number" class="form-control" name="pdescuento" id="pdescuento" placeholder="Descuento...">            
                    </div>
                </div>  
                             
               <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                    <div class="form-group">            
                       <label for="cantidad">Cantidad:</label>
                        <input type="number" class="form-control" name="pcantidad" id="pcantidad" placeholder="cantidad">            
                    </div>
                </div>                                
                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                    <div class="form-group">            
                       <button type="button" id="bt_add" class="btn btn-primary">Agregar</button>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                        <thead style="background-color: #A9D0F5">
                            <th>Opciones</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio venta</th>
                            <th>Descuento</th>
                            
                            <th>Subtotal</th>
                        </thead>
                        <tfoot>
                            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group">            
               <label for="codigo">entrega:</label>
                <input type="text" class="form-control" name="entrega" placeholder="entrega..."  required value="{{old('entrega')}}">            
            </div>
        </div>
                        </tfoot>
                        <tfoot>
                            <th>TOTAL</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th><h4 id="total">S/. 0.00</h4> <input type="text" name="total_venta" id="total_venta"></th>
                        </tfoot>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
           </div>
       </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="guardar">
          <div class="form-group">
              <input name="_token" value="{{csrf_token()}}" type="hidden"></input>
            <button class="btn btn-primary" type="submit">Guardar</button>
            <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>  
        </div>
    </div>                
        {{Form::close()}}
        
@push('scripts')
<script>
    $(document).ready(function(){
         
        $('#bt_add').click(function(){
            agregar();
           
        })
        mostrarValores();
        
    });
    
    //variables
    var cont =0;
    total = 0;
    subtotal=[];
    $('#guardar').hide();
    
    //cada vez que se cambie el producto se ejecuta
    $('#pid_producto').change(mostrarValores);
    
    function mostrarValores(){
        datosProducto = document.getElementById('pid_producto').value.split('_');
        $('#pprecio_venta').val(datosProducto[2]);
        $('#pstock').val(datosProducto[1]);
    }
    
    function agregar(){
        
        datosProducto = document.getElementById('pid_producto').value.split('_');
        
        id_producto = datosProducto[0];
        producto = $('#pid_producto option:selected').text();
        cantidad = $('#pcantidad').val();
        precio_venta = $('#pprecio_venta').val();
        descuento = $('#pdescuento').val();
        stock = $('#pstock').val();
        
        
        if(id_producto != "" && cantidad != "" && cantidad > 0 && precio_venta != "" && descuento != "")
        {
            
            if(stock >= cantidad)
            {
            subtotal[cont] = (cantidad * precio_venta  - descuento);
            total = total  + subtotal[cont] ;
            
            
            var fila = '<tr class="selected" id="fila'+cont+'"><td><button class"btn btn-danger" type"button" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="id_producto[]" value="'+id_producto+'">'+producto+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td><td><input type="number" name="precio_venta[]" value="'+precio_venta+'" readonly></td><td><input type="number" name="descuento[]" value="'+descuento+'"></td> <td>'+subtotal[cont]+'</td></tr>';
            
            //aumentar el contador
            cont++;
            
            //limpiar los controles
            limpiar();
                                 
            //indicar el subtotal
            $('#total').html('s/. '+total);
            $('#total_venta').val(total);
            //mostrar los botones de guardar y cancelar
            evaluar();
            
            //agregar la fila a la tabla
            $('#detalles').append(fila);
                
             cantidad=0;
            stock=0;
            precio_venta=0;
                
            }
            else
            {
                alert('La cantidad a vender supera el stock de: ' + stock );
            }
        }
        else
        {
            alert('Error al ingresar la venta, revise los datos del producto');    
        }
        
    }
    
    
    function limpiar(){
        $('#pcantidad').val('');
        $('#pprecio_venta').val('');
        $('#pdescuento').val('');
        
        
    }
    
    function evaluar(){
        if (total > 0)
        {
            $('#guardar').show();
        }
        else
        {
            $('#guardar').hide();
        }
    }
    
    function eliminar(index){
        total = total- subtotal[index];
        $('#total').html('s/. '+total);
        $('#total_venta').val(total);
        $('#fila' + index).remove();
        evaluar();
    }
</script>
@endpush       

@endsection