<table class="table table-responsive" id="autorizacionCtaCtes-table">
    <thead>
        <tr>
            <th>Codigo</th>
            <th>Cliente</th>
        <th>Fecha Alta</th>
        <th>Monto Actual</th>
        <th>Condicion</th>
            <th colspan="3">Accion</th>
        </tr>
    </thead>
    <tbody>
    @foreach($autorizacionCtaCtes as $autorizacionCtaCte)
        <tr>
            <td>{!! $autorizacionCtaCte->codigo !!}</td>
            <td>{!! $autorizacionCtaCte->persona->nombre !!},{!! $autorizacionCtaCte->persona->apellido !!}</td>
            <td>{!! $autorizacionCtaCte->fecha_alta !!}</td>
            <td>{!! $autorizacionCtaCte->monto_actual !!}</td>
            <td>{!! $autorizacionCtaCte->condicion !!}</td>
            <td>
                {!! Form::open(['route' => ['autorizacionCtaCtes.destroy', $autorizacionCtaCte->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('autorizacionCtaCtes.show', [$autorizacionCtaCte->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('autorizacionCtaCtes.edit', [$autorizacionCtaCte->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>