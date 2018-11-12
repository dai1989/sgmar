@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Crear Provincia
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Crear Provincia
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'provincias.store']) !!}

                        @include('provincias.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
