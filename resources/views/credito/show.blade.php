@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Detalle
@endsection

@section('content')

        
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
             <div class="form-group">            
               <label for="nombre">Credito Cod:</label>
               <p>{{$credito -> codigo}}</p>
            </div>
        </div>
         <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
             <div class="form-group">            
               <label for="nombre">Cliente:</label>
               <p>{{$credito -> nombre}},{{$credito->apellido}}</p>
            </div>
        </div>
          
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
             <div class="form-group">            
               <label for="nombre">Tipo de comprobante:</label>
                <p>{{$credito -> tipo_comprobante}}</p>
        </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group">            
               <label for="codigo">Serie del comprobante:</label>
               <p>{{$credito -> serie_comprobante}}</p>         
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group">            
               <label for="codigo">Numero del comprobante:</label>
                <p>{{$credito -> num_comprobante}}</p>            
            </div>
        </div>
</div>
    <div class="row">
       
       <div class="panel panel-primary">
           <div class="panel-body">               
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                        <thead style="background-color: #A9D0F5">                            
                            <th>Artículo</th>
                            <th>Cantidad</th>
                            <th>Precio compra</th>                            
                            <th>Subtotal</th>
                        </thead>
                        <tfoot>                            
                            <th></th>
                            <th></th>
                            <th></th>                            
                            <th><h4 id="total">{{$credito -> total_credito}}</h4></th>
                        </tfoot>
                        <tbody>
                            @foreach($detalles as  $det)
                                <tr>
                                    <td>{{$det -> producto}}</td>
                                    <td>{{$det -> cantidad}}</td>
                                    <td>{{$det -> precio_venta}}</td>                               
                                    <td>{{$det -> cantidad * $det -> precio_venta}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
           </div>
       </div>
       
    </div>                
        
         

@endsection