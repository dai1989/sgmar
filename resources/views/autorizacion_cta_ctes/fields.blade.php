<!-- Persona Id Field -->
<div class="form-group col-sm-6">
   <label for="persona_id">Clientes</label>
      <select class="form-control" name="persona_id" id="persona_id" class="form-control">
    <option value="">--Seleccionar--</option><br>
    @foreach ($personas as $persona)
    <option value="{{ $persona->id }}">{{ $persona->nombre }}</option>
    @endforeach
  </select>
</div>

<!-- Fecha Alta Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_alta', 'Fecha Alta:') !!}
    {!! Form::date('fecha_alta', null, ['class' => 'form-control']) !!}
</div>

<!-- Monto Actual Field -->
<div class="form-group col-sm-6">
    {!! Form::label('monto_actual', 'Monto Actual:') !!}
    {!! Form::text('monto_actual', null, ['class' => 'form-control']) !!}
</div>

<!-- Condicion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('condicion', 'Condicion:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('condicion', false) !!}
        {!! Form::checkbox('condicion', '1', null) !!} 1
    </label>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
    <a href="{!! route('autorizacionCtaCtes.index') !!}" class="btn btn-default">Cancelar</a>
</div>
