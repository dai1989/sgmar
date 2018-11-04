@extends('adminlte::layouts.app')
{{ session("mensaje") }} 
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header">
                Nueva ctacte
            </h2>
            <div id="notificacion_resul_fanu"></div> 
            <div class="col-xs-6">
                <label for="user">Usuario</label>
                <input class="form-control typeahead" type="text" readonly value="{{ $user->name}}" />
            </div>

            <cuentacte></cuentacte>
        </div>
    </div>
</div>
@endsection

@section('bottom')
    <script src="{{asset('components/cuentacte.tag')}}" type="riot/tag"></script>
    <script>
        $(document).ready(function(){
            riot.mount('cuentacte');
        })
    </script>
@endsection
