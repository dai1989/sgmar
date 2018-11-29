@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Editar Persona
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Editar Persona
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($persona, ['route' => ['personas.update', $persona->id], 'method' => 'patch']) !!}

                        @include('personas.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection