

<!-- Descripcion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
</div>
<!-- LocalidadId Field -->
<div class="form-group col-sm-6">
    <label for="localidad_id">Localidad</label>
  <select  type="text" name="localidad_id" class="form-control" id="localidad_id" placeholder="localidad" >
    <option value="">--Seleccionar--</option>
    @foreach ($localidades as $localidad)
    <option value="{{ $localidad->id }}">{{ $localidad->localidad_descripcion }}</option>
    @endforeach
  </select>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
    <a href="{!! route('provincias.index') !!}" class="btn btn-default">Cancelar</a>
</div>
