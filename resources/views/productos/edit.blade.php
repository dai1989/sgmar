@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Editar Producto
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Editar Producto
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($productos, ['route' => ['productos.update', $productos->id], 'method' => 'patch']) !!}

                       
                  <!-- Descripcion Field -->
                  <div class="form-group col-sm-6">
                    <label for="barcode">Codigo</label>
                    <input type="text" class="form-control" id="barcode" name="barcode" value="{{$productos->barcode}}"  placeholder="codigo">
                  </div>
                  <!-- Descripcion Field -->
                  <div class="form-group col-sm-6">
                    <label for="Descripcion">Descripcion del producto</label>
                    <input type="text" class="form-control" id="Descripcion" name="Descripcion" value="{{$productos->descripcion}}"  placeholder="descripcion">
                  </div>
                  <!-- Precio Venta Field -->
                  <div class="form-group col-sm-6">
                    <label for="PrecioVenta">Precio de Venta</label>
                    <input type="text" class="form-control" id="PrecioVenta" name="PrecioVenta" value="{{$productos->precio_venta}}" placeholder="precio">
                  </div>
                   <!-- Stock Field -->
                  <div class="form-group col-sm-6">
                    <label for="stock">Stock</label>
                    <input type="text" class="form-control" id="stock" name="stock" value="{{$productos->stock}}" placeholder="stock">
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
                  <!-- Submit Field -->
                  <div class="form-group col-sm-12">
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    <a href="{!! route('productos.index') !!}" class="btn btn-default">Cancel</a>
                  </div>

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection