@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Compras
@endsection

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Listado de compras</h1>
        <h1 class="pull-right">
           <a class="btn btn-success pull-right" style="margin-top: -10px;margin-bottom: 5px" href="credito/create">
              <i class="fa fa-plus"></i>
              <span class="hidden-xs hidden-sm">Agregar</span>
              
           </a>
           
        </h1>
    </section>
    <div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        
         @include('credito.search') </div>
</div>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                     <table class="table table-striped"> 
                <thead>
                    
                    <th>Fecha</th>
                    <th>Codigo de credito</th>
                    <th>Tipo de comprobante</th>
                    
                    <th>Numero del comprobante</th>
                    <th>Impuesto</th>
                    <th>Total</th> 
                    <th>Estado</th>                      
                     <th colspan="3">Acciones</th>
                </thead>
                @foreach($creditos as $credito)
                <tr>
                    
                    <td>{{$credito -> fecha_hora}}</td>
                    <td>{{$credito -> codigo}} </td>
                    <td>{{$credito -> tipo_comprobante}}</td>
                   
                    <td>{{$credito -> num_comprobante}}</td>
                    <td>{{$credito -> impuesto}}</td>
                    <td>{{$credito -> total_credito}}</td>                    
                    <td>{{$credito -> estado}}</td>                    
                    <td>
                        <a href="{{URL::action('CreditoController@show', $credito -> id)}}">
                            <button class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></button>
                        </a>
                        <a href="" data-target="#modal-delete-{{$credito -> id}}" data-toggle="modal">
                            <button class='btn btn-danger btn-xs'><i class="glyphicon glyphicon-trash"></i></button>
                        </a>
                        <a href="{{ url('credito/pdf/' . $credito->id) }}"><button class="btn btn-success btn-xs" ><i class="fa fa-file-pdf-o"></i></button>
                                
                            </a>
                    </td>
                </tr> 
                @include('credito.modal')
                @endforeach </table>
        </div>
         {{$creditos -> render()}}
    </div>
</div> 
@endsection