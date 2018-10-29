@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Editar Ingreso
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Editar Ingreso
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($ingreso, ['route' => ['ingresos.update', $ingreso->id], 'method' => 'patch']) !!}

                        @include('ingresos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection