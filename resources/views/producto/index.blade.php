@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Productos
@endsection

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Productos</h1>
        <h1 class="pull-right">
           <a class="btn btn-success pull-right" style="margin-top: -10px;margin-bottom: 5px" href="producto/create">
              <i class="fa fa-plus"></i>
              <span class="hidden-xs hidden-sm">Agregar</span>
               
           </a>
        </h1>
    </section>
    <div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        
         @include('producto.search') </div>
</div>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                   <table class="table table-responsive" id="productos-table">
    <thead>
        <tr>
            <th>Descripcion</th>
        <th>Precio Venta</th>
        <th>Barcode</th>
        <th>Stock</th>
        <th>Marca</th>
        <th>Categoria</th>
        <th>Imagen</th>
        <th>Estado</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($productos as $prod)
        <tr>
            <td>{!! $prod->descripcion !!}</td>
            <td>{!! $prod->precio_venta !!}</td>
            <td>{!! $prod->barcode !!}</td>
            <td>{!! $prod->stock !!}</td>
            <td>{!! $prod->marca !!}</td>
            <td>{!! $prod->categoria !!}</td>
             <td>
                <img src="{{asset('imagenes/productos/'.$prod -> imagen)}}" alt="{{$prod -> descripcion}}" height="100px" width="100px" class="img-thumbnail">
            </td>
            <td>{!! $prod->estado !!}</td>
            <td>
                {!! Form::open(['route' => ['producto.destroy', $prod->id_producto], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('producto.show', [$prod->id_producto]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('producto.edit', [$prod->id_producto]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                     <a href="#" class="btn btn-info download"
                                            data-barcode="{{ $prod->barcode }}"
                                            data-name="{{ str_slug($prod->descripcion) }}"
                                            title="Download">
                                            <i class="fa fa-download"></i>
                                        </a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
            </div>
        </div>
    </div>
    <div class="hidden">
    <canvas id="canvas"></canvas>
</div>

<script>
    window.onload = function() {
        window.downloadBarcode.default.init();
    };
</script>
  <script src="{{ asset('js/manifest.js') }}"></script>
    <script src="{{ asset('js/vendor.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
@endsection

