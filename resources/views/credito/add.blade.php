@extends('adminlte::layouts.app')
{{ session("mensaje") }} 
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header">
                Nuevo ctacte
            </h2>
           

            <credito></credito>
        </div>
    </div>
</div>
@endsection

@section('bottom')
    <script src="{{asset('components/credito.tag')}}" type="riot/tag"></script>
    <script>
        $(document).ready(function(){
            riot.mount('credito');
        })
    </script>
@endsection
