<!-- Codigo Field -->
<div class="form-group">
     <unique-barcode-input>
                        </unique-barcode-input>
</div>
<!-- Descripcion Field -->
<div class="form-group col-sm-6">
   <label for="Descripcion">Descripcion del producto</label>
   <input type="text" class="form-control" id="Descripcion" name="Descripcion" placeholder="descripcion">
</div>

<!-- Precio Venta Field -->
<div class="form-group col-sm-6">
    <label for="PrecioVenta">Precio de Venta</label>
    <input type="text" class="form-control" id="PrecioVenta" name="PrecioVenta" placeholder="precio">
</div>
<!-- Stock Field -->
<div class="form-group col-sm-6">
    <label for="stock">Stock</label>
    <input type="text" class="form-control" id="stock" name="stock" placeholder="stock">
</div>



<!-- Marca Id Field -->
<div class="form-group col-sm-6">
    <label for="Marca">Marcas</label>
  <select  type="text" name="Marca" class="form-control" id="Marca" placeholder="marcas" >
    <option value="">--Seleccionar--</option>
    @foreach ($marca_list as $marca)
    <option value="{{ $marca->id }}">{{ $marca->descripcion }}</option>
    @endforeach
  </select>
</div>

<!-- Categoria Id Field -->
<div class="form-group col-sm-6">
    <label for="Categoria">Categorias</label>
      <select class="form-control" name="Categoria" id="Categoria" class="form-control">
    <option value="">--Seleccionar--</option>
    @foreach ($categoria_list as $categoria)
    <option value="{{ $categoria->id }}">{{ $categoria->categoria_descripcion }}</option>
    @endforeach
  </select>
</div>
<!-- Estado Field -->
<div class="form-group col-sm-6">
    <label for="estado">Estado</label>
    <input type="text" class="form-control" id="estado" name="estado" placeholder="estado">
</div>
<!-- Imagen Field -->
<div class="form-group col-sm-6">
    <label for="imagen">Imagen</label>
    <input type="file" class="form-control" id="imagen" name="imagen" placeholder="imagen">
</div>



<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('productos.index') !!}" class="btn btn-default">Cancel</a>
</div>
