 
                {!! Form::open(['route' => ['producto.destroy', $prod->idproducto], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('producto.show', [$prod->idproducto]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('producto.edit', [$prod->idproducto]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                   
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            <div class="hidden">
    <canvas id="canvas"></canvas>
</div>

<script>
    window.onload = function() {
        window.downloadBarcode.default.init();
    };
</script>