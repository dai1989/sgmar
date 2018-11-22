@extends('adminlte::layouts.app')
{{ session("mensaje") }} 
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header">
                Nueva Factura de Compra
            </h2>

            <compra></compra>
        </div>
    </div>
</div>
@endsection

@section('bottom')
    <script src="{{asset('components/compra.tag')}}" type="riot/tag"></script>
    <script>
        $(document).ready(function(){
            riot.mount('compra');
        })
    </script>
@endsection
