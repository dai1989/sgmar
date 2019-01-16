<script src="{{URL::to('/')}}/plantilla/js/jquery-2.2.3.min.js"></script>

  <!--<script src="{{ asset('js/manifest.js') }}"></script>
    <script src="{{ asset('js/vendor.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>--> 
<!-- jQuery v3.2.1 -->

<!-- jQuery 2.2.3 -->
{{--<script src="plugins/jquery-2.2.3.min.js"></script>--}}
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('bower/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{URL::to('/')}}/plantilla/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="{{URL::to('/')}}/plantilla/js/app.min.js"></script>
{{--<script src="dist/js/app.min.js"></script>--}}
<!-- AdminLTE for demo purposes -->
<script src="{{URL::to('/')}}/plantilla/js/demo.js"></script>
<!-- icheck -->
<script src="{{ asset('bower/iCheck/icheck.min.js') }}" type="text/javascript"></script>
<!-- bootstrap-toggle -->
<script src="{{ asset('bower/bootstrap-toggle/js/bootstrap-toggle.min.js') }}" type="text/javascript"></script>
 <!-- DatePicker -->
 <script src="{{URL::to('/')}}/plantilla/datepicker/bootstrap-datepicker.js" ></script>
<script src="{{URL::to('/')}}/plantilla/datepicker/bootstrap-datepicker.es.min.js" ></script>
<script src="{{URL::to('/')}}/plantilla/datepicker/datepicker.js" ></script>
<!--Plainmodal -->
<script src="{{URL::to('/')}}/plantilla/js/jquery.plainmodal.min.js" ></script>
<script src="{{URL::to('/')}}/plantilla/js/modalcliente.js" ></script>
<script src="{{URL::to('/')}}/plantilla/js/graficas.js" ></script>
<script src="{{URL::to('/')}}/plantilla/js/graficas2.js" ></script>
<script src="{{URL::to('/')}}/plantilla/js/morris.min.js" ></script>
<script src="{{URL::to('/')}}/plantilla/js/jquery.nicelabel.js" ></script>
<script src="{{URL::to('/')}}/plantilla/js/select2.js" ></script>
<script src="{{asset('/bower/toastr/toastr.min.js')}}"></script>
<script src="{{URL::to('/')}}/plantilla/js/datatables/datatables.js" ></script>
<!-- Ocultar alertas flash -->
<script>
    $('div.alert').not('.alert-important').delay({{config('app.delay_fade_out_div_alert',3000)}}).fadeOut(350);
</script>
 <script src="{{asset('ini.js')}}"></script>
    <script src="{{asset('bower_components/riot/riot.min.js')}}"></script>
    <script src="{{asset('bower_components/riot/riot+compiler.min.js')}}"></script>
    <script src="{{asset('bower_components/EasyAutocomplete//dist/jquery.easy-autocomplete.min.js')}}"></script>
     <!--select con buscador-->
      <script src="{{URL::to('/')}}/plantilla/js/bootstrap-select.min.js"></script>
   

    @yield('bottom')

    <script>
        function baseUrl(url) {
            return '{{url('')}}/' + url;
        }
    </script>




@stack('scripts')
@yield('scripts')
{{$scripts or ''}}
