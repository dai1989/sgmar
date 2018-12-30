@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Crear compra
@endsection

@section('content')
<div class="row">
  <div class="col-lg-6 col-md-6 col-dm-12 col-xs-12">
  <h3>Nuevo Ingreso</h3>
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
    {!!Form::open(array('url'=>'ingreso','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
              <div class="box-body">
        <div class="well well-sm">
            <div class="box-body">
    <div class="row">
      <div class="col-xs-6">
        <label for="razonsocial">Proveedor</label>
             <select name="id_proveedor" id="id_proveedor" class="form-control selectpicker" data-live-search="true">
              @foreach($proveedores as $proveedor)
              <option value="{{$proveedor->id}}">{{$proveedor->razonsocial}} {{$proveedor -> cuit}}</option>
              @endforeach
            </select>
          </div>
      <div class="col-xs-6">
        <label for="id_user">Vendedor:</label>
        <select name="id_user" id="id_user" class="form-control selectpicker" data-Live-search="true">
          @foreach($user_list as $user)
          <option value="{{$user -> id}}">{{$user -> name}}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-sm-6"> 
      <label>Tipo de Comprobante</label>
      <select name="tipo_comprobante" class="form-control">
        <option value="Factura"> Factura </option>
        <option value="Boleta"> Boleta </option>
        <option value="Ticket"> Ticket </option>
      </select>
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
  <label for="codigo">Serie del comprobante:</label>
                <input type="text" class="form-control" name="serie_comprobante" placeholder="Serie del comprobante..."  value="{{old('serie_comprobante')}}">
              </div>
              <div class="form-group col-sm-6">          
               <label for="codigo">Numero del comprobante:</label>
                <input type="text" class="form-control" name="num_comprobante" placeholder="Numero del comprobante..."  required value="{{old('num_comprobante')}}">
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
          </div>
        </div>
      </div>
     <div class="box-body">
      <div class="panel panel-primary">
        <div class="panel-body">
          <div class="row">
              <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <div class="form-group">
                         <label for="">Producto</label>
                        <select class="form-control selectpicker" name="pid_producto" id="pid_producto" data-Live-search="true">
                            @foreach($productos as $producto)
                                <option value="{{$producto -> id}}">{{$producto -> producto}}</option>
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
    <label for="precio_compra">Precio de Compra</label>
    <input type="number" name="pprecio_compra" id="pprecio_compra" class="form-control" placeholder="precio de compra">
      </div>
  </div>
   <div class="col-lg-2 col-md-2 col-dm-12 col-xs-12">
    <div class="form-group">
    <label for="precio_venta">Precio de venta</label>
    <input type="number" name="pprecio_venta" id="pprecio_venta" class="form-control" placeholder="precio de venta">
      </div>
  </div>
  <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                    <div class="form-group">            
                       <button type="button" id="bt_add" class="btn btn-primary">Agregar</button>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-dm-12 col-xs-12">
      <div class="table-responsive">
    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
      <thead style="background-color:#caf5a9">
      <th>Opciones</th>
      <th>Producto</th>
      <th>Cantidad</th>
      
      <th>Precio Compra</th>
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
        <th><h4 id="total">$/. 0.00</h4></th>
      </tfoot>
    <tbody></tbody>
    </table>
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
        </div>
      </div>
    </div>
  

      {!!Form::close()!!}  
         @push ('scripts')
   <script>
    $(document).ready(function(){
        
        $('#bt_add').click(function(){
            agregar();
        })
    });
    
    //variables
    var cont =0;
    total = 0;
    subtotal=[];
    $('#guardar').hide();
    
    
    function agregar(){
        id_producto = $('#pid_producto').val();
        producto = $('#pid_producto option:selected').text();
        cantidad = $('#pcantidad').val();
        precio_compra = $('#pprecio_compra').val();
        precio_venta=$("#pprecio_venta").val();
        if (id_producto!="" && cantidad!="" && cantidad>0 && precio_compra!="" && precio_venta!="")
        
        {
            subtotal[cont] = (cantidad * precio_compra);
            total = total + subtotal[cont];
            
            var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="id_producto[]"  value="'+id_producto+'">'+producto+'</td><td><input type="number" name="cantidad[]" readonly value="'+cantidad+'"></td><td><input type="number" name="precio_compra[]" readonly value="'+precio_compra+'"></td><td><input type="number"name="precio_venta[]" readonly value="'+precio_venta+'"></td><td>'+subtotal[cont]+'</td></tr>';
            
            //aumentar el contador
            cont++;
            
            //limpiar los controles
            limpiar();
                      
            //indicar el subtotal
            $('#total').html('s/. '+total);
            
            //mostrar los botones de guardar y cancelar
            evaluar();
            
            //agregar la fila a la tabla
            $('#detalles').append(fila);
        }
        else
        {
            alert('Error al ingresar el detalle del ingreso, revise los datos del articulo');    
        }
        
    }
    
    
    function limpiar(){
        $('#pcantidad').val('');
        $('#pprecio_compra').val('');
        $('#pprecio_venta').val('');
        
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
        $('#total').html('$/. '+total);
        $('#fila' + index).remove();
        evaluar();
    }
</script>
@endpush
@endsection

