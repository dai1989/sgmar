<!-- Categoria Descripcion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('categoria_descripcion', 'Categoria Descripcion:') !!}
    {!! Form::text('categoria_descripcion', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
    <a href="{!! route('categorias.index') !!}" class="btn btn-default">Cancelar</a>
</div>
