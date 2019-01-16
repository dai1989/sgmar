@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection


@section('content')
	<div class="content">
		@include('flash::message')

		<div class="row">
			<div class="col-md-12">

				<!-- Default box -->
				<div class="box box-primary ">
					<div class="box-body">
						<h3 class="box-title">
							Bienvenido
							<b class="text-primary">{{Auth::user()->name}}</b>
							@usernoops
							<small>No tiene ninguna opción asignada, pida a un administrador que le asigne</small>
							@endusernoops
						</h3>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
		</div>
		 <div class="container-fluit">
    @include('flash::message')
  </div>
  <div class="box box-danger">
    <div class="box-header with-border">
      <h3 class="box-title">Productos Faltantes</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
      @foreach ($aviso as $avisos)
        @if ( $avisos->stock <= 5)
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 " style="width: 270px;
    height: 200px;">
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-ban"></i> Atención!</h4>
              @if ( $avisos->stock == 0)
                <h5>No quedan productos de <abbr title="{{$avisos->descripcion}}"><strong>{{$avisos->descripcion}}</abbr></strong></h5>
                  <img src="{{asset('imagenes/productos/'.$avisos->imagen)}}" alt="{{$avisos->descripcion}}" height="100px" width="100px" class="img-thumbnail">
              @else
                <h5>Quedan {{$avisos->stock}} del producto {{$avisos->descripcion}}</h5>
                  <img src="{{asset('imagenes/productos/'.$avisos->imagen)}}" alt="{{$avisos->descripcion}}" height="100px" width="100px" class="img-thumbnail">
              @endif
            </div>
          </div>
        @elseif ($avisos->stock <= 20)
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 " style="width: 270px;
    height: 200px;">
            <div class="alert alert-info alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-ban"></i> Atención!</h4>
                  <h5>Quedan {{$avisos->stock}} productos de <abbr title="{{$avisos->descripcion}}"><strong>{{$avisos->descripcion}}</abbr></strong></h5>
                  <img src="{{asset('imagenes/productos/'.$avisos->imagen)}}" alt="{{$avisos->descripcion}}" height="100px" width="100px" class="img-thumbnail">
            </div>
          </div>
        @endif
      @endforeach
    </div>
    <!-- /.box-body -->
  </div>

  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">Productos más vendidos</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
      <div class="chart">
        <div id="donutchart" style="width: 900px; height: 500px;"></div>
      </div>
    </div>
  </div>

    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Productos con mayor recaudación</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="chart">
          <div id="donutchart2" style="width: 900px; height: 500px;"></div>
        </div>
      </div>
    </div>

    <div class="box box-info">
      <div class="box-header with-border">
        @php
          $cont=0
        @endphp
        @foreach ($promedioventa as $promedioventas)
          @php
            $cont=$cont + $promedioventas->total_venta
          @endphp
        @endforeach
        <h3 class="box-title">Recaudación de los ultimos 7 días ($@php echo $cont;  @endphp)</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body chart-responsive">
        <div class="chart" id="line-chart" ></div>
      </div>
      <!-- /.box-body -->
    </div>
{{-- <td align="right" width="98"><a href="#" onclick="window.open('{{pagina.html}}','TITULO','width =550,height=400');"> <IMG SRC="http://127.0.0.1/sis_gmar/public/imagenes/productos/image.jpg" WIDTH=47 HEIGHT=96 ALT=""></a></td> --}}

@endsection

@section('js')
  <script type="text/javascript">
  $("#myModalNorm").modal({
    backdrop: 'static',
    keyboard: false,
    show: true
   });
   function control(f){
    var ext=['gif','jpg','jpeg','png'];
    var v=f.value.split('.').pop().toLowerCase();
    for(var i=0,n;n=ext[i];i++){
        if(n.toLowerCase()==v)
            return
    }
    var t=f.cloneNode(true);
    t.value='';
    f.parentNode.replaceChild(t,f);
    alert('Debe ser de tipo imagen');
    }

    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Task', 'Hours per Day'],
        @foreach ($estadistica as $estadisticas)
        ['{{$estadisticas->descripcion}}', {{$estadisticas->cantidad}}],
        @endforeach
      ]);

      var options = {
        title: '',
        pieHole: 0.4,
      };

      var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
      chart.draw(data, options);
    }
  </script>
  <script type="text/javascript">
  google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Task', 'Hours per Day'],
        @foreach ($estadistica as $estadisticas)
        ['{{$estadisticas->descripcion}}', {{$estadisticas->precio_venta}}],
        @endforeach
      ]);

      var options = {
        pieHole: 0.4,
      };

      var chart = new google.visualization.PieChart(document.getElementById('donutchart2'));
      chart.draw(data, options);
    }
  </script>

  <script type="text/javascript">
    var line = new Morris.Line({
      element: 'line-chart',
      resize: true,
      data: [
        @foreach ($promedioventa as $promedioventas)
            {x: '{{$promedioventas->fecha_hora}}', item1: {{$promedioventas->total_venta}}},
        @endforeach
      ],
      xkey: 'x',
      ykeys: ['item1'],
      labels: ['Entradas'],
      lineColors: ['#3c8dbc'],
      hideHover: 'auto',
    });
  </script>
	</div>
	 

@endsection
