<!-- Producto Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('producto_id', 'Producto Id:') !!}
    {!! Form::number('producto_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Cantidad Actual Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cantidad_actual', 'Cantidad Actual:') !!}
    {!! Form::number('cantidad_actual', null, ['class' => 'form-control']) !!}
</div>

<!-- Cantidad Minima Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cantidad_minima', 'Cantidad Minima:') !!}
    {!! Form::number('cantidad_minima', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
    <a href="{!! route('stocks.index') !!}" class="btn btn-default">Cancelar</a>
</div>
