@extends('adminlte::layouts.app')

@section('htmlheader_title')
  Crear Producto
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Crear Producto
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {{Form::open(array('url' => 'producto', 'method' => 'POST', 'autocomplete' => 'off', 'files' => 'true'))}}
        {{Form::token()}}

                        <div class="form-group col-sm-6">           
               <label for="categoria_descripcion">Categoria:</label>
               <select name="id_categoria" id="" class="form-control">
                  @foreach($categorias as $cat)
                   <option value="{{$cat -> id}}">{{$cat -> categoria_descripcion}}</option>
                   @endforeach
               </select>
        </div>
        
         
             <div class="form-group col-sm-6">           
               <label for="descripcion">marca:</label>
               <select name="id_marca" id="" class="form-control">
                  @foreach($marcas as $m)
                   <option value="{{$m -> id}}">{{$m -> descripcion}}</option>
                   @endforeach
               </select>
        </div>
        
        <div class="form-group">
          <unique-barcode-input>
                        </unique-barcode-input>
                      </div>
                      
        
            <div class="form-group col-sm-6">           
               <label for="stock">Stock:</label>
                <input type="text" class="form-control" name="stock" placeholder="Stock..." required value="{{old('stock')}}">            
            </div>
        
        
             <div class="form-group col-sm-6">           
               <label for="stock">Precio de venta:</label>
                <input type="text" class="form-control" name="precio_venta" placeholder="Precio venta..." required value="{{old('precio_venta')}}">            
            </div>
        
        
             <div class="form-group col-sm-6">           
               <label for="descripcion">Descripcion:</label>
               <input type="text" class="form-control" name="descripcion" placeholder="Descripcion..." required value="{{old('descripcion')}}">            
            </div>
        
        
             <div class="form-group col-sm-6">            
               <label for="imagen">Imagen:</label>                
                <input type="file" class="form-control" name="imagen">            
            </div>
        
        
          <div class="form-group col-sm-12">
            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('producto.index') !!}" class="btn btn-default">Cancelar</a>
  </div>
</div>                

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
  <script src="{{ asset('js/manifest.js') }}"></script>
    <script src="{{ asset('js/vendor.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script> 
@endsection
