@extends('adminlte::layouts.app')
{{ session("mensaje") }} 
@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <h3>Editar Articulo: {{$producto -> descripcion}}</h3>
        @if (count($errors) > 0)
        <div class="alert alert-danger">
	        <ul>
	            @foreach($errors -> all() as $error)
	                <li>{{$error}}</li>
	            @endforeach
	        </ul>
        </div>
        @endif
    </div>
</div>       
        
        {{Form::model($producto, ['method' => 'PATCH', 'route' => ['producto.update', $producto -> id_producto], 'files' => 'true'])}}
        {{Form::token()}}
        <div class="row">
        
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
             <div class="form-group">            
               <label for="categoria_descripcion">Categoria:</label>
               <select name="id_categoria" id="" class="form-control">
                  @foreach($categorias as $cat)
                      @if($cat ->id_categoria == $articulo -> id_categoria)
                           <option value="{{$cat -> id_categoria}}" selected>{{$cat -> categoria_descripcion}}</option>
                    @else
                            <option value="{{$cat -> id_categoria}}" >{{$cat -> categoria_descripcion}}</option>
                    @endif
                   @endforeach
               </select>
        </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
             <div class="form-group">            
               <label for="descripcion">marca:</label>
               <select name="id_marca" id="" class="form-control">
                  @foreach($marcas as $m)
                      @if($m ->id_marca == $articulo -> id_marca)
                           <option value="{{$m -> id_marca}}" selected>{{$m -> descripcion}}</option>
                    @else
                            <option value="{{$m -> id_marca}}" >{{$m -> descripcion}}</option>
                    @endif
                   @endforeach
               </select>
        </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group">            
               <label for="barcode">Codigo:</label>
                <input type="text" class="form-control" name="barcode"  required value="{{$producto->barcode}}">            
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
             <div class="form-group">            
               <label for="stock">Stock:</label>
                <input type="text" class="form-control" name="stock"  required value="{{$producto->stock}}">          
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
             <div class="form-group">            
               <label for="stock">Precio de venta:</label>
                <input type="text" class="form-control" name="precio_venta"  required value="{{$producto->precio_venta}}">          
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
             <div class="form-group">            
               <label for="descripcion">Descripcion:</label>
               <input type="text" class="form-control" name="descripcion" placeholder="Descripcion.." required value="{{$producto->descripcion}}">        
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
             <div class="form-group">            
               <label for="imagen">Imagen:</label>                
                <input type="file" class="form-control" name="imagen">            
                @if(($producto-> imagen) != "")
                    <img src="{{asset('imagenes/productos/'.$producto->imagen)}}" alt="imagen" style="height: 250px; width:300px; background-size: contain;">
                @endif
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
          <div class="form-group">
            <button class="btn btn-primary" type="submit">Guardar</button>
            <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>  
        </div>
    </div> 
        {{Form::close()}}

@endsection