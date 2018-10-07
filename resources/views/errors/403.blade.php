@extends('adminlte::layouts.errors')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.pagenotfound') }}
@endsection

@section('main-content')

    <div class="error-page">
        <h2 class="headline text-yellow"> 403</h2>
        <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i> Oops! No tiene autorización para acceder!! Comuniquese con el Administrador</h3>
            <p>
                
                Vuelva al <a href='{{ url('/home') }}'>Inicio</a>
            </p>
           
        </div><!-- /.error-content -->
    </div><!-- /.error-page -->
@endsection