<table class="table table-responsive" id="stocks-table">
    <thead>
        <tr>
            <th>Codigo</th>
            <th>Producto</th>
        <th>Cantidad Actual</th>
        <th>Cantidad Minima</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($stock_list as $stock)
        <tr>
            <td>{!! $stock->producto->barcode !!}</td>
            <td>{!! $stock->producto->descripcion !!}</td>
            <td>{!! $stock->cantidad_actual !!}</td>
            <td>{!! $stock->cantidad_minima !!}</td>
            <td>
                {!! Form::open(['route' => ['stock.destroy', $stock->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('stock.show', [$stock->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('stock.edit', [$stock->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>