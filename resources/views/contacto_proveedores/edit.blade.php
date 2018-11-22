@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Editar Contacto Proveedor
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Editar Contacto Proveedor
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($contacto_proveedores, ['route' => ['contacto_proveedores.update', $contacto_proveedores->id], 'method' => 'patch']) !!}

                        @include('contacto_proveedores.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection