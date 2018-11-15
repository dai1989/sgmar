<table class="table table-responsive" id="ingresos-table">
    <thead>
        <tr>
            <th>Cliente</th>
        <th>Usuario</th>
        <th>Concepto</th>
        <th>Entrega</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($ingresos as $ingreso)
        <tr>
            <td>{!! $ingreso->autorizacion->persona->nombre !!}</td>
            <td>{!! $ingreso->user->name !!}</td>
            <td>{!! $ingreso->concepto !!}</td>
            <td>{!! $ingreso->entrega !!}</td>
            <td>
                {!! Form::open(['route' => ['ingresos.destroy', $ingreso->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('ingresos.show', [$ingreso->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('ingresos.edit', [$ingreso->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>