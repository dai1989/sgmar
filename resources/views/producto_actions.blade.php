 
                {!! Form::open(['route' => ['producto.destroy', $prod->id_producto], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('producto.show', [$prod->id_producto]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('producto.edit', [$prod->id_producto]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                     <a href="#" class="btn btn-info download"
                                            data-barcode="{{ $prod->barcode }}"
                                            data-name="{{ str_slug($prod->descripcion) }}"
                                            title="Download">
                                            <i class="fa fa-download"></i>
                                        </a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            