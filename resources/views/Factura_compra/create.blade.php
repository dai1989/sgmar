@extends('adminlte::layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Factura de Compras</div>

                <div class="panel-body">                    
                    {{ Form::open(['route' => 'factura_compra.store']) }}

                        @include('factura_compra.partials.form')
                        
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
