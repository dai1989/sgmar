@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Crear Stock
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Crear Stock
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'stocks.store']) !!}

                        @include('stocks.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
