<!-- Persona Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('persona_id', 'Persona Id:') !!}
    {!! Form::number('persona_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Codigo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('codigo', 'Codigo:') !!}
    {!! Form::text('codigo', null, ['class' => 'form-control']) !!}
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
    <a href="{!! route('autorizaciones.index') !!}" class="btn btn-default">Cancelar</a>
</div>
