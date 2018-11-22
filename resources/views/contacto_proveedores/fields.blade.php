<!-- Persona Id Field -->
<div class="form-group col-sm-6">
   <label for="proveedor_id">Clientes</label>
      <select class="form-control" name="proveedor_id" id="proveedor_id" class="form-control">
    <option value="">--Seleccionar--</option><br>
    @foreach ($proveedores as $proveedor)
    <option value="{{ $proveedor->id }}">{{ $proveedor->razonsocial }}</option>
    @endforeach
  </select><br>
</div>

<!-- Tipocontacto Id Field -->
<div class="form-group col-sm-6">
   <label for="tipocontacto_id">Tipo de Contacto</label>
  <select  type="text" name="tipocontacto_id" class="form-control" id="tipocontacto_id" placeholder="tipo de contacto" >
    <option value="">--Seleccionar--</option><br>
    @foreach ($tipocontactos as $tipo_contacto)
    <option value="{{ $tipo_contacto->id }}">{{ $tipo_contacto->contacto_descripcion }}</option>
    @endforeach
  </select><br>
</div>
<!-- Contac Descripcion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contac_descripcion', 'Contac Descripcion:') !!}
    {!! Form::text('contac_descripcion', null, ['class' => 'form-control']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
    <a href="{!! route('contacto_proveedores.index') !!}" class="btn btn-default">Cancelar</a>
</div>
