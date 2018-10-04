@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Stocks
@endsection

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Stock</h1>
        <h1 class="pull-right">
          
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('stock.table')
            </div>
        </div>
    </div>
@endsection

