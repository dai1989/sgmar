@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Ventas
@endsection

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Listado de Ventas</h1>
        <h1 class="pull-right">
           <a class="btn btn-success pull-right" style="margin-top: -10px;margin-bottom: 5px" href="factura/create">
              <i class="fa fa-plus"></i>
              <span class="hidden-xs hidden-sm">Agregar</span>
              
           </a>
           
        </h1>
    </section>
    <div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        
         @include('factura.search') </div>
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
                    <th>Cliente</th>
                    <th>Tipo de comprobante</th>
                    
                    <th>Numero del comprobante</th>
                    <th>Impuesto</th>
                    <th>Total</th> 
                    
                    
                    <th>Estado</th>                      
                     <th colspan="3">Acciones</th>
                </thead>
                 @foreach($facturas as $fac)
                <tr>
                    
                    <td>{{$fac -> fecha_hora}}</td>
                    <td>{{$fac -> nombre}} {{$fac -> apellido}}</td>
                    <td>{{$fac -> tipo_comprobante}}</td>
                   
                    <td>{{$fac -> num_comprobante}}</td>
                    <td>{{$fac -> impuesto}}</td>
                    <td>{{$fac -> total_venta}}</td> 
                    
                                    
                    <td>{{$fac -> estado}}</td>                    
                    <td>
                        
                        <a href="{{URL::action('VentaController@show', $fac -> id)}}">
                            <button data-toggle="tooltip" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></button>
                        </a>
                        <a href="" data-target="#modal-delete-{{$fac -> id}}" data-toggle="modal">
                            <button class='btn btn-danger btn-xs'><i class="glyphicon glyphicon-trash"></i></button>
                        </a>
                         <a href="{{ url('factura/pdf/' . $fac->id) }}"><button class="btn btn-success btn-xs" ><i class="fa fa-file-pdf-o"></i></button>
                                
                            </a>

                    </td>
                </tr> 
                @include('factura.modal')
                @endforeach
                
               
            </table>
            </div>
              {{$facturas -> render()}}
        </div>
    </div>
@endsection


      
