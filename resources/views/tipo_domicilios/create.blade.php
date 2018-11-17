@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Crear Tipo Domicilio
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Crear Tipo Domicilio
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'tipoDomicilios.store']) !!}

                        @include('tipo_domicilios.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
