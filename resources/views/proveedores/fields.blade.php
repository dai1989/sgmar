<!-- Razon Social Field -->
<div class="form-group col-sm-6">
    {!! Form::label('razon_social', 'Razon Social:') !!}
    {!! Form::text('razon_social', null, ['class' => 'form-control']) !!}
</div>

<!-- Cuit Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cuit', 'Cuit:') !!}
    {!! Form::text('cuit', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
    <a href="{!! route('proveedores.index') !!}" class="btn btn-default">Cancelar</a>
</div>
