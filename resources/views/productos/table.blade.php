<table class="table table-responsive" id="productos-table">
    <thead>
        <tr>
            <th>Codigo</th>
        <th>Descripcion</th>
        <th>Stock</th>
        <th>Precio Venta</th>
         <th>Categoria</th>
        <th>Marca</th>
        <th>Imagen</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($productos as $producto)
        <tr>
            <td>{!! $producto->barcode !!}</td>
            <td>{!! $producto->descripcion !!}</td>
            <td>{!! $producto->stock !!}</td>
            <td>{!! $producto->precio_venta !!}</td>
            <td>{!! $producto->categoria->categoria_descripcion !!}</td>
            <td>{!! $producto->marca->descripcion !!}</td>
             <td>
                        <img src="{{asset('imagenes/productos/'.$producto -> imagen)}}" alt="{{$producto -> nombre}}" height="100px" width="100px" class="img-thumbnail">                    
                    </td>
            <td>
                {!! Form::open(['route' => ['productos.destroy', $producto->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('productos.show', [$producto->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                     <a href="#" class="btn btn-info download"
                                            data-barcode="{{ $producto->barcode }}"
                                            data-name="{{ str_slug($producto->descripcion) }}"
                                            title="Download">
                                            <i class="fa fa-download"></i>
                                        </a>
                    <a href="{!! route('productos.edit', [$producto->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>

                {!! Form::close() !!}

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
