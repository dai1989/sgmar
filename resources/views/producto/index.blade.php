@extends('adminlte::layouts.app')
{{ session("mensaje") }} 
@section('content')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Listado de articulos <a href="producto/create"><button class="btn btn-success">Nuevo</button></a></h3>
         @include('producto.search') </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Codigo</th>
                    <th>Categoria</th>
                    <th>Stock</th>
                    <th>Precio de venta</th>
                    <th>Imagen</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </thead>
                @foreach($productos as $prod)
                <tr>
                    <td>{{$prod -> id_producto}}</td>
                    <td>{{$prod -> descripcion}}</td>
                    <td>{{$prod -> barcode}}</td>
                    <td>{{$prod -> categoria}}</td>
                    <td>{{$prod -> marca}}</td>
                    <td>{{$prod -> stock}}</td>
                    <td>{{$prod -> precio_venta}}</td>
                    <td>
                        <img src="{{asset('imagenes/productos/'.$prod -> imagen)}}" alt="{{$prod -> descripcion}}" height="100px" width="100px" class="img-thumbnail">                    
                    </td>
                    <td>{{$prod -> estado}}</td>
                    <td>
                        <a href="{{URL::action('ProductoController@edit', $prod -> id_producto)}}">
                            <button class="btn btn-info">Editar</button>
                        </a>
                        <a href="" data-target="#modal-delete-{{$prod -> id_producto}}" data-toggle="modal">
                            <button class="btn btn-danger">Eliminar</button>
                        </a>
                    </td>
                </tr> 
                @include('producto.modal')
                @endforeach </table>
        </div>
        {{$productos -> render()}}
    </div>
</div> 
@endsection