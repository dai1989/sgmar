<div class="form-row">
   <div class="form-group col-md-6">
      <label for="fecha">Fecha</label>
      <input type="date" class="form-control" id="fecha" name="fecha"    placeholder="fecha...">
    </div>
   
  
   
    <div class="form-group col-md-6">
      <label for="autorizacionctacte">Clientes</label>
      <select class="form-control" name="autorizacionctacte" id="autorizacionctacte" class="form-control">
    <option value="">--Seleccionar--</option><br>
    @foreach ($autorizacionctacte_list as $autorizacionctacte)
    <option value="{{ $autorizacionctacte->id }}">{{ $autorizacionctacte->persona->nombre }},{{$autorizacionctacte->persona->apellido}}</option>
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