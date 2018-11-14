@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Crear Autorizacion Cta Cte
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Crear Autorizacion Cta Cte
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'autorizacionCtaCtes.store']) !!}

                        @include('autorizacion_cta_ctes.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
