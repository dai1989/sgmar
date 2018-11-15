<table class="table table-responsive" id="autorizacions-table">
    <thead>
        <tr>
            <th>Persona Id</th>
        <th>Codigo</th>
        <th>Fecha Alta</th>
        <th>Monto Actual</th>
        <th>Condicion</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($autorizacions as $autorizacion)
        <tr>
            <td>{!! $autorizacion->persona_id !!}</td>
            <td>{!! $autorizacion->codigo !!}</td>
            <td>{!! $autorizacion->fecha_alta !!}</td>
            <td>{!! $autorizacion->monto_actual !!}</td>
            <td>{!! $autorizacion->condicion !!}</td>
            <td>
                {!! Form::open(['route' => ['autorizacions.destroy', $autorizacion->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('autorizacions.show', [$autorizacion->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('autorizacions.edit', [$autorizacion->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>