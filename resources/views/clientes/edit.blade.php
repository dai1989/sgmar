@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Editar Cliente
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Editar Cliente
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($cliente, ['route' => ['clientes.update', $cliente->id], 'method' => 'patch']) !!}

                       <!-- Descripcion Field -->
<div class="form-group col-sm-6">
     <label for="Nombre">Nombre</label>
     <input type="text" class="form-control" id="Nombre" name="Nombre" 
     value="{{$cliente->persona->nombre}}"  placeholder="nombre completo">
</div>
<div class="form-group col-sm-6">
    <label for="Apellido">Apellido</label>
    <input type="text" class="form-control" id="Apellido" name="Apellido"
     value="{{$cliente->persona->apellido}}"  placeholder="apellido">
</div>
<div class="form-group col-sm-6">
   <label for="Documento">Documento</label>
   <input type="text" class="form-control" id="Documento" name="Documento" 
   value="{{$cliente->persona->documento}}" placeholder="documento">
</div>
<div class="form-group col-sm-6">
    <label for="FechaNacimiento">Fecha de Nacimento</label>
    <input type="text" class="form-control" id="FechaNacimiento" name="FechaNacimiento" value="{{$cliente->persona->fecha_nacimiento}}"  placeholder="fecha de nacimiento">
</div>
<div class="form-group col-sm-6">
   <label for="Genero">Genero</label>
 <input class="form-control" name="Genero" id="Genero" 
 value="{{$cliente->persona->genero}}" class="form-control">
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
    <a href="{!! route('clientes.index') !!}" class="btn btn-default">Cancelar</a>
</div>

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection