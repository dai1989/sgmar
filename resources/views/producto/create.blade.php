@extends('adminlte::layouts.app')
{{ session("mensaje") }} 
@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <h3>Nuevo Articulo</h3>
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
        {{Form::open(array('url' => 'producto', 'method' => 'POST', 'autocomplete' => 'off', 'files' => 'true'))}}
        {{Form::token()}}
    <div class="row">
        
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
             <div class="form-group">            
               <label for="categoria_descripcion">Categoria:</label>
               <select name="id_categoria" id="" class="form-control">
                  @foreach($categorias as $cat)
                   <option value="{{$cat -> id_categoria}}">{{$cat -> categoria_descripcion}}</option>
                   @endforeach
               </select>
        </div>
        </div>
         <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
             <div class="form-group">            
               <label for="descripcion">marca:</label>
               <select name="id_marca" id="" class="form-control">
                  @foreach($marcas as $m)
                   <option value="{{$m -> id_marca}}">{{$m -> descripcion}}</option>
                   @endforeach
               </select>
        </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group">            
               <label for="barcode">Codigo:</label>
                <input type="text" class="form-control" name="barcode" placeholder="Codigo..." required value="{{old('barcode')}}">            
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
             <div class="form-group">            
               <label for="stock">Stock:</label>
                <input type="text" class="form-control" name="stock" placeholder="Stock..." required value="{{old('stock')}}">            
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
             <div class="form-group">            
               <label for="stock">Precio de venta:</label>
                <input type="text" class="form-control" name="precio_venta" placeholder="Precio venta..." required value="{{old('precio_venta')}}">            
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
             <div class="form-group">            
               <label for="descripcion">Descripcion:</label>
               <input type="text" class="form-control" name="descripcion" placeholder="Descripcion..." required value="{{old('descripcion')}}">            
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
             <div class="form-group">            
               <label for="imagen">Imagen:</label>                
                <input type="file" class="form-control" name="imagen">            
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