@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Editar Autorizacion
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Editar Autorizacion
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($autorizacion, ['route' => ['autorizacions.update', $autorizacion->id], 'method' => 'patch']) !!}

                        @include('autorizacions.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection