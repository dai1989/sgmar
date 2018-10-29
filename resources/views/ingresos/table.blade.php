<table class="table table-responsive" id="ingresos-table">
    <thead>
        <tr>
            <th>Idproveedor</th>
        <th>Idusuario</th>
        <th>Tipo Comprobante</th>
        <th>Serie Comprobante</th>
        <th>Num Comprobante</th>
        <th>Fecha Hora</th>
        <th>Impuesto</th>
        <th>Total</th>
        <th>Estado</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($ingresos as $ingreso)
        <tr>
            <td>{!! $ingreso->idproveedor !!}</td>
            <td>{!! $ingreso->idusuario !!}</td>
            <td>{!! $ingreso->tipo_comprobante !!}</td>
            <td>{!! $ingreso->serie_comprobante !!}</td>
            <td>{!! $ingreso->num_comprobante !!}</td>
            <td>{!! $ingreso->fecha_hora !!}</td>
            <td>{!! $ingreso->impuesto !!}</td>
            <td>{!! $ingreso->total !!}</td>
            <td>{!! $ingreso->estado !!}</td>
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