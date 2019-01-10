<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <div class="form-group">
      <label for="nombre">Nombre</label>
      <input type="text" value="{{old('nombre')}}" name="nombre" class="form-control" placeholder="Nombre...">
    </div>
  </div>
  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <div class="form-group">
      <label for="apellido">Apellido</label>
      <input type="text" value="{{old('apellido')}}" name="apellido" class="form-control" placeholder="Apellido...">
    </div>
  </div>
  
  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <div class="form-group">
      <label>Documento</label>
      <select name="tipo_documento" class="form-control">
        <option value="DNI">DNI</option>
        <option value="PASAPORTE">PASAPORTE</option>
        <option value="LIBRETA CIVICA">LIBRETA CIVICA</option>
      </select>
    </div>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
      <label for="documento">Número documento</label>
      <input type="text" value="{{old('documento')}}" name="documento" class="form-control" placeholder="Número de documento...">
    </div>
  </div>
   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
      <label for="fecha_nacimiento">Fecha de nacimiento</label>
      <input type="date" value="{{old('fecha_nacimiento')}}" name="fecha_nacimiento" class="form-control" placeholder="Fecha de nacimiento...">
    </div>
  </div>
  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <div class="form-group">
     <label for="genero">Genero</label>
    <select class="form-control" name="genero" id="genero" class="form-control">
    <option value="">--Seleccionar--</option><br>
    <option value="Masculino">M</option>
    <option value="Femenino">F</option>
      </select>
    </div>
  </div>
  
  
</div>
