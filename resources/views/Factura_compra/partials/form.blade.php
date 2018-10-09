<div class="form-row">
    <div class="form-group col-md-6">
      <label for="txtFacturaNumero">Codigo de Producto</label>
      <input type="text" class="form-control" id="txtFacturaNumero" name="txtFacturaNumero" placeholder="numero">
    </div>
    <div class="form-group col-md-6">
      <label for="txtFacturaTipo">Tipo de factura</label>
      <select class="form-control" name="txtFacturaTipo" class="form-control">
        <option value="">--Seleccionar--</option><br>
        <option value="A" >A</option>
        <option value="B" >B</option>
        <option value="C" >C</option>
      </select>
    </div>
    <div class="form-group col-md-6">
      <label for="txtFacturaFecha">Fecha</label>
      <input type="date" class="form-control" id="txtFacturaFecha" name="txtFacturaFecha"    placeholder="fecha...">
    </div>
    <div class="form-group col-md-6">
      <label for="cboProveedor">Proveedores</label>
      <select class="form-control" name="cboProveedor" id="cboProveedor" class="form-control">
    <option value="">--Seleccionar--</option><br>
    @foreach ($proveedores_list as $proveedor)
    <option value="{{ $proveedor->id }}">{{ $proveedor->razon_social }}</option>
    @endforeach
  </select><br>
</div>
<div class="form-group col-md-6">
  <label for="cboUser">Usuario</label>
  <select  type="text" name="cboUser" class="form-control" id="cboUser" placeholder="vendedor" >
    <option value="">--Seleccionar--</option><br>
    @foreach ($users_list as $user)
    <option value="{{ $user->id }}">{{ $user->name }}</option>
    @endforeach
  </select><br>
</div>
<div class="form-group col-md-6">
  <label for="cboTipoPago">Tipo de Pago</label>
  <select  name="cboTipoPago" class="form-control" id="cboTipoPago" placeholder="tipo de pago">
    <option value="">--Seleccionar--</option><br>
    @foreach ($tipopagos_list as $tipo_pago)
    <option value="{{ $tipo_pago->id }}">{{ $tipo_pago->descripcion_tipopago }}</option>
    @endforeach
  </select><br>
</div>
<div class="form-group">
  {{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
  
</div>
</div>