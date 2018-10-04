@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Crear Producto
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Crear Producto
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'productos.store']) !!}

                        @include('productos.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
     <script src="{{ asset('js/manifest.js') }}"></script>
    <script src="{{ asset('js/vendor.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
