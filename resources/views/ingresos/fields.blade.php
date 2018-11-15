
<!-- Autorizacion cliente  -->
<div class="form-group col-sm-6">
    <label for="autorizacion_id">Cliente</label>
  <select  type="text" name="autorizacion_id" class="form-control" id="autorizacion_id" placeholder="marcas" >
    <option value="">--Seleccionar--</option>
    @foreach ($autorizacion_list as $autorizacion)
    <option value="{{ $autorizacion->id }}">{{ $autorizacion->persona->nombre }},{{$autorizacion->persona->apellido}}</option>
    @endforeach
  </select>
</div>

<!-- Vendedor  -->
<div class="form-group col-sm-6">
    <label for="user_id">Usuario</label>
  <select  type="text" name="user_id" class="form-control" id="user_id" placeholder="marcas" >
    <option value="">--Seleccionar--</option>
    @foreach ($user_list as $user)
    <option value="{{ $user->id }}">{{ $user->name }}</option>
    @endforeach
  </select>
</div>


<!-- Concepto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('concepto', 'Concepto:') !!}
    {!! Form::text('concepto', null, ['class' => 'form-control']) !!}
</div>

<!-- Entrega Field -->
<div class="form-group col-sm-6">
    {!! Form::label('entrega', 'Entrega:') !!}
    {!! Form::number('entrega', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
    <a href="{!! route('ingresos.index') !!}" class="btn btn-default">Cancelar</a>
</div>
