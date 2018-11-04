@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Editar Autorizacion Cta Cte
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Editar Autorizacion Cta Cte
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($autorizacionCtaCte, ['route' => ['autorizacionCtaCtes.update', $autorizacionCtaCte->id], 'method' => 'patch']) !!}

                        @include('autorizacion_cta_ctes.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection