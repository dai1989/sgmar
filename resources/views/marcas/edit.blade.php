@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Editar Marca
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Editar Marca
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($marca, ['route' => ['marcas.update', $marca->id], 'method' => 'patch']) !!}

                        @include('marcas.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection