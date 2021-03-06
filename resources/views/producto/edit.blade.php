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
                    {{Form::model($producto, ['method' => 'PATCH', 'route' => ['producto.update', $producto -> id], 'files' => 'true'])}}
        {{Form::token()}}

                   <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
             <div class="form-group">            
               <label for="descripcion">Nombre:</label>
                <input type="text" class="form-control" name="descripcion" placeholder="Nombre..." required value="{{$producto -> descripcion}}">            
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
             <div class="form-group">            
               <label for="categoria_descripcion">Categoria:</label>
               <select name="categoria_id" id="" class="form-control">
                  @foreach($categorias as $cat)
                      @if($cat ->id == $producto -> categoria_id)
                           <option value="{{$cat -> id}}" selected>{{$cat -> categoria_descripcion}}</option>
                    @else
                            <option value="{{$cat -> id}}" >{{$cat -> categoria_descripcion}}</option>
                    @endif
                   @endforeach
               </select>
        </div>
        </div>
         <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
             <div class="form-group">            
               <label for="descripcion">Marca:</label>
               <select name="marca_id" id="" class="form-control">
                  @foreach($marcas as $m)
                      @if($m ->id == $producto -> marca_id)
                           <option value="{{$m -> id}}" selected>{{$m -> descripcion}}</option>
                    @else
                            <option value="{{$m -> id}}" >{{$m -> descripcion}}</option>
                    @endif
                   @endforeach
               </select>
        </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group">            
               <label for="barcode">Codigo:</label>
                <input type="text" class="form-control" name="barcode" readonly required value="{{$producto->barcode}}">            
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
               <label for="imagen">Imagen:</label>                
                <input type="file" class="form-control" name="imagen">            
                @if(($producto-> imagen) != "")
                    <img src="{{asset('imagenes/productos/'.$producto->imagen)}}" alt="imagen" style="height: 250px; width:300px; background-size: contain;">
                @endif
            </div>
        </div>
        
                  <!-- Submit Field -->
                  <div class="form-group col-sm-12">
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    <a href="{!! route('producto.index') !!}" class="btn btn-default">Cancel</a>
                  </div>

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection