<!-- Descripcion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Nombre', 'Nombre Completo:') !!}
    {!! Form::text('Nombre', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('Apellido', 'Apellido:') !!}
    {!! Form::text('Apellido', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('Documento', 'Documento:') !!}
    {!! Form::text('Documento', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('FechaNacimiento', 'Fecha de nacimiento:') !!}
    {!! Form::date('FechaNacimiento', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    <label for="Genero">Genero</label>
    <select class="form-control" name="Genero" id="Genero" class="form-control">
    <option value="">--Seleccionar--</option><br>
    <option value="Masculino">M</option>
    <option value="Femenino">F</option>
</select><br>
</div>
<div class="form-group col-sm-6">
    <label for="tipodocumento">Tipo de documento</label>
    <select class="form-control" name="tipodocumento" id="tipodocumento" class="form-control">
    <option value="">--Seleccionar--</option><br>
    <option value="DNI">DNI</option>
    <option value="PASAPORTE">PASAPORTE</option>
    <option value="C.I PY">CI PY</option>
</select><br>
</div>
<div class="form-group col-sm-6">
    <label for="tipopersona">Tipo de persona</label>
    <select class="form-control" name="tipopersona" id="tipopersona" class="form-control">
    <option value="">--Seleccionar--</option><br>
    <option value="CLIENTE">CLIENTE</option>
    <option value="PROVEEDOR">PROVEEDOR</option>
    
</select><br>
</div>



<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
    <a href="{!! route('clientes.index') !!}" class="btn btn-default">Cancelar</a>
</div>