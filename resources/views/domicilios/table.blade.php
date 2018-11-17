<table class="table table-responsive" id="domicilios-table">
    <thead>
        <tr>
            <th>Calle</th>
        <th>N°</th>
        <th>Descripcion</th>
        <th>Tipo de domicilio</th>
        <th>Cliente</th>
        <th>Localidad </th>
        <th>Provincia</th>
            <th colspan="3">Accion</th>
        </tr>
    </thead>
    <tbody>
    @foreach($domicilios as $domicilio)
        <tr>
            <td>{!! $domicilio->calle !!}</td>
            <td>{!! $domicilio->calle_numero !!}</td>
            <td>{!! $domicilio->descripcion !!}</td>
            <td>{!! $domicilio->tipodomicilio_id !!}</td>
            <td>{!! $domicilio->persona->nombre !!},{!!$domicilio->persona->apellido!!}</td>
            <td>{!! $domicilio->localidad->localidad_descripcion !!}</td>
            <td>{!! $domicilio->provincia->descripcion!!}</td>
            <td>
                {!! Form::open(['route' => ['domicilios.destroy', $domicilio->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('domicilios.show', [$domicilio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('domicilios.edit', [$domicilio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>