@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Crear Marca
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Crear Marca
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'marcas.store']) !!}

                        @include('marcas.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
