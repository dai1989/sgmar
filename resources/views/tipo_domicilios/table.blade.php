<table class="table table-responsive" id="tipoDomicilios-table">
    <thead>
        <tr>
            <th>Tipo Descripcion</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($tipoDomicilios as $tipoDomicilio)
        <tr>
            <td>{!! $tipoDomicilio->tipo_descripcion !!}</td>
            <td>
                {!! Form::open(['route' => ['tipoDomicilios.destroy', $tipoDomicilio->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('tipoDomicilios.show', [$tipoDomicilio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('tipoDomicilios.edit', [$tipoDomicilio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>