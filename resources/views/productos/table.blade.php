<table class="table table-responsive" id="productos-table">
    <thead>
        <tr>
            <th>Descripcion</th>
        <th>Precio Venta</th>
        <th>Barcode</th>
        <th>Stock</th>
        <th>Imagen</th>
        <th>Estado</th>
        <th>Id Marca</th>
        <th>Id Categoria</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($productos as $producto)
        <tr>
            <td>{!! $producto->descripcion !!}</td>
            <td>{!! $producto->precio_venta !!}</td>
            <td>{!! $producto->barcode !!}</td>
            <td>{!! $producto->stock !!}</td>
            <td>{!! $producto->imagen !!}</td>
            <td>{!! $producto->estado !!}</td>
            <td>{!! $producto->id_marca !!}</td>
            <td>{!! $producto->id_categoria !!}</td>
            <td>
                {!! Form::open(['route' => ['productos.destroy', $producto->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('productos.show', [$producto->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('productos.edit', [$producto->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>