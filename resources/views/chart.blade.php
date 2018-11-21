

@extends('adminlte::layouts.app')

@section('title','Panel de Control')

@section('content')

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Productos', 'mes'],
            @foreach ($pastel as $pastels)
              ['{{ $pastels->descripcion}}', {{ $pastels->cantidad}}],
            @endforeach
        ]);

        var options = {
          title: 'Productos mas vendidos'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
</html>


@endsection

