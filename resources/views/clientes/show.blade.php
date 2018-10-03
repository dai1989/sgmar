@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Cliente
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Cliente
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="form-group col-sm-12">
                    @include('clientes.show_fields')
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
            <a href="{!! route('clientes.index') !!}" class="btn btn-default">Regresar</a>
            </div>
        </div>
    </div>
@endsection
