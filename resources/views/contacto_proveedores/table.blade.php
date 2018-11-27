<table class="table table-responsive" id="contactoProveedors-table">
    <thead>
        <tr>
            <th>Descripcion</th>
        <th>Proveedor</th>
        <th>Tipo de contacto</th>
            <th colspan="3">Accion</th>
        </tr>
    </thead>
    <tbody>
    @foreach($contactoProveedors as $contactoProveedor)
        <tr>
            <td>{!! $contactoProveedor->contac_descripcion !!}</td>
            <td>{!! $contactoProveedor->proveedor->razonsocial !!}</td>
            <td>{!! $contactoProveedor->tipocontacto->contacto_descripcion !!}</td>
            <td>
                {!! Form::open(['route' => ['contacto_proveedores.destroy', $contactoProveedor->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('contacto_proveedores.show', [$contactoProveedor->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('contacto_proveedores.edit', [$contactoProveedor->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>