@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Editar Producto
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Editar Producto
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($productos, ['route' => ['productos.update', $productos->id], 'method' => 'patch']) !!}

                        @include('productos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection