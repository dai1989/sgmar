@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Producto
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Producto
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="form-group col-sm-12">



<!-- Descripcion Field -->
{!! Form::label('descripcion', 'Descripcion:') !!}
{!! $producto->descripcion !!}<br>


<!-- Precio Venta Field -->
{!! Form::label('precio_venta', 'Precio Venta:') !!}
{!! $producto->precio_venta !!}<br>


<!-- Barcode Field -->
{!! Form::label('barcode', 'Barcode:') !!}
{!! $producto->barcode !!}<br>


<!-- Stock Field -->
{!! Form::label('stock', 'Stock:') !!}
{!! $producto->stock !!}<br>


<!-- Imagen Field -->
<img src="{{asset('imagenes/productos/'.$producto -> imagen)}}" alt="{{$producto -> descripcion}}" height="100px" width="100px" class="img-thumbnail">


<!-- Estado Field -->
{!! Form::label('estado', 'Estado:') !!}
{!! $producto->estado !!}<br>


<!-- Id Marca Field -->
{!! Form::label('id_marca', 'Marca:') !!}
{!! $producto->id_marca !!}<br>


<!-- Id Categoria Field -->
{!! Form::label('id_categoria', 'Categoria:') !!}
{!! $producto->id_categoria!!}<br>






                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
            <a href="{!! route('producto.index') !!}" class="btn btn-default">Regresar</a>
            </div>
        </div>
    </div>
@endsection
