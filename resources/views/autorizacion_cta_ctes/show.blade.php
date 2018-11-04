@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Autorizacion Cta Cte
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Autorizacion Cta Cte
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="form-group col-sm-12">
                    @include('autorizacion_cta_ctes.show_fields')
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
            <a href="{!! route('autorizacionCtaCtes.index') !!}" class="btn btn-default">Regresar</a>
            </div>
        </div>
    </div>
@endsection
