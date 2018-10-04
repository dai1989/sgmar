

<!-- Cantidad Actual Field -->
<div class="form-group col-sm-6">
      {!! Form::text('cantidad_actual', null, ['placeholder'=>'cantidad actual','class'=>'form-control']) !!}
</div>

<!-- Cantidad Minima Field -->
<div class="form-group col-sm-6">
     {!! Form::text('cantidad_minima', null, ['placeholder'=>'cantidad_minima','class'=>'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
    <a href="{!! route('stock.index') !!}" class="btn btn-default">Cancelar</a>
</div>
