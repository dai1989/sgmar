<!-- Tipo Descripcion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo_descripcion', 'Tipo Descripcion:') !!}
    {!! Form::text('tipo_descripcion', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
    <a href="{!! route('tipoDomicilios.index') !!}" class="btn btn-default">Cancelar</a>
</div>
