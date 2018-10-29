<!-- Codigo Field -->
<div class="form-group">
    <ingreso></ingreso>
</div>
<!-- Idproveedor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('idproveedor', 'Idproveedor:') !!}
    {!! Form::number('idproveedor', null, ['class' => 'form-control']) !!}
</div>

<!-- Idusuario Field -->
<div class="form-group col-sm-6">
    {!! Form::label('idusuario', 'Idusuario:') !!}
    {!! Form::number('idusuario', null, ['class' => 'form-control']) !!}
</div>

<!-- Tipo Comprobante Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo_comprobante', 'Tipo Comprobante:') !!}
    {!! Form::text('tipo_comprobante', null, ['class' => 'form-control']) !!}
</div>

<!-- Serie Comprobante Field -->
<div class="form-group col-sm-6">
    {!! Form::label('serie_comprobante', 'Serie Comprobante:') !!}
    {!! Form::text('serie_comprobante', null, ['class' => 'form-control']) !!}
</div>

<!-- Num Comprobante Field -->
<div class="form-group col-sm-6">
    {!! Form::label('num_comprobante', 'Num Comprobante:') !!}
    {!! Form::text('num_comprobante', null, ['class' => 'form-control']) !!}
</div>

<!-- Fecha Hora Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_hora', 'Fecha Hora:') !!}
    {!! Form::date('fecha_hora', null, ['class' => 'form-control']) !!}
</div>

<!-- Impuesto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('impuesto', 'Impuesto:') !!}
    {!! Form::number('impuesto', null, ['class' => 'form-control']) !!}
</div>

<!-- Total Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total', 'Total:') !!}
    {!! Form::number('total', null, ['class' => 'form-control']) !!}
</div>

<!-- Estado Field -->
<div class="form-group col-sm-6">
    {!! Form::label('estado', 'Estado:') !!}
    {!! Form::text('estado', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
    <a href="{!! route('ingresos.index') !!}" class="btn btn-default">Cancelar</a>
</div>
