@extends('adminlte::layouts.app')

@section('htmlheader_title')
  Crear Categoria
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <h3>Editar Articulo: {{$articulo -> descripcion}}</h3>
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
        
        {{Form::model($articulo, ['method' => 'PATCH', 'route' => ['articulo.update', $articulo -> id_articulo], 'files' => 'true'])}}
        {{Form::token()}}
        <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
             <div class="form-group">            
               <label for="descripcion">Nombre:</label>
                <input type="text" class="form-control" name="descripcion" placeholder="Nombre..." required value="{{$articulo -> descripcion}}">            
            </div>
        </div>
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
               <label for="descripcion">Marca:</label>
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
                <input type="text" class="form-control" name="barcode"  required value="{{$articulo->barcode}}">            
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
             <div class="form-group">            
               <label for="stock">Stock:</label>
                <input type="text" class="form-control" name="stock"  required value="{{$articulo->stock}}">          
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
             <div class="form-group">            
               <label for="stock">Precio de venta:</label>
                <input type="text" class="form-control" name="precio_venta"  required value="{{$articulo->precio_venta}}">          
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
             <div class="form-group">            
               <label for="imagen">Imagen:</label>                
                <input type="file" class="form-control" name="imagen">            
                @if(($articulo-> imagen) != "")
                    <img src="{{asset('imagenes/productos/'.$articulo->imagen)}}" alt="imagen" style="height: 250px; width:300px; background-size: contain;">
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