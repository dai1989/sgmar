@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Productos
@endsection

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Productos</h1>
        <h1 class="pull-right">
           <a class="btn btn-success pull-right" style="margin-top: -10px;margin-bottom: 5px" href="producto/create">
              <i class="fa fa-plus"></i>
              <span class="hidden-xs hidden-sm">Agregar</span>
           </a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('producto.table')

            </div>
        </div>
    </div>
    <div class="hidden">
    <canvas id="canvas"></canvas>
</div>

<script>
    window.onload = function() {
        window.downloadBarcode.default.init();
    };
</script>
@endsection

