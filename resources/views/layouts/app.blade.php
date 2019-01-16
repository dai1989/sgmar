
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  @if (isset($config) == false)
    <title>Inicio</title>
  @else
    <title>{{$config->nombre}}</title>
  @endif

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{URL::to('/')}}/plantilla/css/bootstrap.min.css">
  <!--select con buscador-->
  <link rel="stylesheet" href="{{URL::to('/')}}/plantilla/css/bootstrap-select.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{URL::to('/')}}/plantilla/css/font-awesome.min.css">
  <!-- Ionicons -->
  
  <!-- Theme style -->
  <link rel="stylesheet" href="{{URL::to('/')}}/plantilla/css/AdminLTE.min.css">
  <!-- DatePicker -->
  <link rel="stylesheet" href="{{URL::to('/')}}/plantilla/datepicker/bootstrap-datepicker3.min.css" ></link>
  <link rel="stylesheet" href="{{URL::to('/')}}/plantilla/datepicker/bootstrap-datepicker3.standalone.css" ></link>
  <!-- AdminLTE Skins. Choose a skin from the css/skins
  folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{URL::to('/')}}/plantilla/css/_all-skins.min.css">
  <link rel="stylesheet" href="{{URL::to('/')}}/plantilla/css/breadcrumb.css">
  {{-- tickes  --}}
  <link rel="stylesheet" href="{{URL::to('/')}}/plantilla/css/ticket.css">
  {{-- modal de clientes --}}
  <link rel="stylesheet" href="{{URL::to('/')}}/plantilla/css/jquery-nicelabel.css">

  <link rel="stylesheet" href="{{URL::to('/')}}/plantilla/css/select2.css">
  <link rel="stylesheet" href="{{URL::to('/')}}/plantilla/js/datatables/datatables.css">
  {{-- <link rel="stylesheet" href="{{URL::to('/')}}/plantilla/css/manual.css"> --}}
  <style>
  .code{
    height: 60px !important;
  }
  </style>
  <style media="screen">
  #tamañomodal{
    width: 90% !important;
  }
  .modal-content  {
    -webkit-border-radius: 0px !important;
    -moz-border-radius: 0px !important;
    border-radius: 5px !important;
  }
  .text-derecha{
    text-align: right !important;
  }
  </style>
</head>

@if (isset($config) == false)
  <body class="hold-transition skin-blue sidebar-mini">
  @else
    @if ($config->menu_mini == '1')
      <body class="skin-blue sidebar-mini sidebar-collapse">
      @else
        <body class="hold-transition skin-blue sidebar-mini">
        @endif
      @endif
      <div class="wrapper">
        <header class="main-header">

    <!-- Logo -->
    <a href="{{ url('/home') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b><i class="fa fa-home"></i></b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>{{config('app.name')}}</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">{{ trans('adminlte_lang::message.togglenav') }}</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                {{--<!-- Messages: style can be found in dropdown.less-->--}}
                {{--<li class="dropdown messages-menu">--}}
                    {{--<!-- Menu toggle button -->--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
                        {{--<i class="fa fa-envelope-o"></i>--}}
                        {{--<span class="label label-success">4</span>--}}
                    {{--</a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li class="header">{{ trans('adminlte_lang::message.tabmessages') }}</li>--}}
                        {{--<li>--}}
                            {{--<!-- inner menu: contains the messages -->--}}
                            {{--<ul class="menu">--}}
                                {{--<li><!-- start message -->--}}
                                    {{--<a href="#">--}}
                                        {{--<div class="pull-left">--}}
                                            {{--<!-- User Image -->--}}
                                            {{--<img src="{{ $user->email ? Gravatar::get($user->email) : asset('img/avatar_none.png') }}" class="img-circle" alt="User Image"/>--}}
                                        {{--</div>--}}
                                        {{--<!-- Message title and timestamp -->--}}
                                        {{--<h4>--}}
                                            {{--{{ trans('adminlte_lang::message.supteam') }}--}}
                                            {{--<small><i class="fa fa-clock-o"></i> 5 mins</small>--}}
                                        {{--</h4>--}}
                                        {{--<!-- The message -->--}}
                                        {{--<p>{{ trans('adminlte_lang::message.awesometheme') }}</p>--}}
                                    {{--</a>--}}
                                {{--</li><!-- end message -->--}}
                            {{--</ul><!-- /.menu -->--}}
                        {{--</li>--}}
                        {{--<li class="footer"><a href="#">c</a></li>--}}
                    {{--</ul>--}}
                {{--</li><!-- /.messages-menu -->--}}

                {{--<!-- Notifications Menu -->--}}
                {{--<li class="dropdown notifications-menu">--}}
                    {{--<!-- Menu toggle button -->--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
                        {{--<i class="fa fa-bell-o"></i>--}}
                        {{--<span class="label label-warning">10</span>--}}
                    {{--</a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li class="header">{{ trans('adminlte_lang::message.notifications') }}</li>--}}
                        {{--<li>--}}
                            {{--<!-- Inner Menu: contains the notifications -->--}}
                            {{--<ul class="menu">--}}
                                {{--<li><!-- start notification -->--}}
                                    {{--<a href="#">--}}
                                        {{--<i class="fa fa-users text-aqua"></i> {{ trans('adminlte_lang::message.newmembers') }}--}}
                                    {{--</a>--}}
                                {{--</li><!-- end notification -->--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                        {{--<li class="footer"><a href="#">{{ trans('adminlte_lang::message.viewall') }}</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}

                {{--<!-- Tasks Menu -->--}}
                {{--<li class="dropdown tasks-menu">--}}
                    {{--<!-- Menu Toggle Button -->--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
                        {{--<i class="fa fa-flag-o"></i>--}}
                        {{--<span class="label label-danger">9</span>--}}
                    {{--</a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li class="header">{{ trans('adminlte_lang::message.tasks') }}</li>--}}
                        {{--<li>--}}
                            {{--<!-- Inner menu: contains the tasks -->--}}
                            {{--<ul class="menu">--}}
                                {{--<li><!-- Task item -->--}}
                                    {{--<a href="#">--}}
                                        {{--<!-- Task title and progress text -->--}}
                                        {{--<h3>--}}
                                            {{--{{ trans('adminlte_lang::message.tasks') }}--}}
                                            {{--<small class="pull-right">20%</small>--}}
                                        {{--</h3>--}}
                                        {{--<!-- The progress bar -->--}}
                                        {{--<div class="progress xs">--}}
                                            {{--<!-- Change the css width attribute to simulate progress -->--}}
                                            {{--<div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">--}}
                                                {{--<span class="sr-only">20% {{ trans('adminlte_lang::message.complete') }}</span>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</a>--}}
                                {{--</li><!-- end task item -->--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                        {{--<li class="footer">--}}
                            {{--<a href="#">{{ trans('adminlte_lang::message.alltasks') }}</a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</li>--}}

                <!-- User Account Menu -->
                <li class="dropdown user user-menu" id="user_menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            @if($user->uimages->count()>0)
                                @foreach($user->uimages as $key => $image)
                                    <img src="{{srcImgBynary($image)}}" alt="{{$image->name}}" class="user-image">
                                @endforeach
                            @else
                                <img src="{{ $user->email ? Gravatar::get($user->email) : asset('img/avatar_none.png') }}" class="user-image" alt="User Image"/>
                            @endif
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                @if($user->uimages->count()>0)
                                    @foreach($user->uimages as $key => $image)
                                        <img src="{{srcImgBynary($image)}}" alt="{{$image->name}}" class="img-circle">
                                    @endforeach
                                @else
                                    <img src="{{ $user->email ? Gravatar::get($user->email) : asset('img/avatar_none.png') }}" class="img-circle" alt="User Image" />
                                @endif
                                <p>
                                    {{ Auth::user()->name }}
{{--                                    <small>{{ trans('adminlte_lang::message.login') }} Nov. 2012</small>--}}
                                </p>
                            </li>
                            <!-- Menu Body -->
                            {{--<li class="user-body">--}}
                                {{--<div class="col-xs-4 text-center">--}}
                                    {{--<a href="#">{{ trans('adminlte_lang::message.followers') }}</a>--}}
                                {{--</div>--}}
                                {{--<div class="col-xs-4 text-center">--}}
                                    {{--<a href="#">{{ trans('adminlte_lang::message.sales') }}</a>--}}
                                {{--</div>--}}
                                {{--<div class="col-xs-4 text-center">--}}
                                    {{--<a href="#">{{ trans('adminlte_lang::message.friends') }}</a>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{ route('user.edit.profile',Auth::user()->id) }}" class="btn btn-default btn-flat">{{ trans('adminlte_lang::message.profile') }}</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ url('/logout') }}" class="btn btn-default btn-flat" id="logout"
                                       onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                        {{ trans('adminlte_lang::message.signout') }}
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                        <input type="submit" value="logout" style="display: none;">
                                    </form>

                                </div>
                            </li>
                        </ul>
                    </li>

                {{--<!-- Control Sidebar Toggle Button -->--}}
                {{--<li>--}}
                    {{--<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>--}}
                {{--</li>--}}
            </ul>
        </div>
    </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        {{--<!-- Sidebar user panel (optional) -->--}}
        {{--@if (! Auth::guest())--}}
            {{--<div class="user-panel">--}}
                {{--<div class="pull-left image">--}}
                    {{--<img src="{{ Gravatar::get($user->email) }}" class="img-circle" alt="User Image" />--}}
                {{--</div>--}}
                {{--<div class="pull-left info">--}}
                    {{--<p>{{ Auth::user()->name }}</p>--}}
                    {{--<!-- Status -->--}}
                    {{--<a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--@endif--}}

        {{--<!-- search form (Optional) -->--}}
        {{--<form action="#" method="get" class="sidebar-form">--}}
            {{--<div class="input-group">--}}
                {{--<input type="text" name="q" class="form-control" placeholder="{{ trans('adminlte_lang::message.search') }}..."/>--}}
              {{--<span class="input-group-btn">--}}
                {{--<button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>--}}
              {{--</span>--}}
            {{--</div>--}}
        {{--</form>--}}
        {{--<!-- /.search form -->--}}

        <!-- Sidebar Menu -->
            <ul class="sidebar-menu">
                <!-- Optionally, you can add icons to the links -->
                <li class=""><a href="{{ url('home') }}"><i class='fa fa-dashboard'></i> <span>{{ trans('adminlte_lang::message.dashboard') }}</span></a></li>
            </ul><!-- /.sidebar-menu -->
            {{--Si el usuario logueado contiene el rol con id 1=administrador--}}
            @useradmin
                {!! Menu::render(OptionMenu::orderBy('orden')->get()) !!}
            @else
                {!! Menu::render(Auth::user()->opciones()->orderBy('orden')->get()) !!}
            @enduseradmin
    </section>
    <!-- /.sidebar -->
</aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Main content -->
          <section class="content-header">
            <br>
           
          </section>
          <section class="content">
            @yield('content')
          </section>
          <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @include('adminlte::layouts.partials.footer')
        <div class="control-sidebar-bg"></div>
      </div>
      <!-- ./wrapper -->
      <!-- jQuery 2.2.3 -->
      <script src="{{URL::to('/')}}/plantilla/js/jquery-2.2.3.min.js"></script>
      @stack('scripts')
      <!-- Bootstrap 3.3.6 -->
      <script src="{{URL::to('/')}}/plantilla/js/bootstrap.min.js"></script>
      <!--select con buscador-->
      <script src="{{URL::to('/')}}/plantilla/js/bootstrap-select.min.js"></script>
      <!-- FastClick -->
      <script src="{{URL::to('/')}}/plantilla/js/fastclick.min.js"></script>
      <!-- AdminLTE App -->
      <script src="{{URL::to('/')}}/plantilla/js/app.min.js"></script>
      <!-- AdminLTE for demo purposes -->
      <script src="{{URL::to('/')}}/plantilla/js/demo.js"></script>
      <!-- DatePicker -->
      <script src="{{URL::to('/')}}/plantilla/datepicker/bootstrap-datepicker.js" ></script>
      <script src="{{URL::to('/')}}/plantilla/datepicker/bootstrap-datepicker.es.min.js" ></script>
      <script src="{{URL::to('/')}}/plantilla/datepicker/datepicker.js" ></script>
      <script src="{{URL::to('/')}}/plantilla/js/jquery.plainmodal.min.js" ></script>
      <script src="{{URL::to('/')}}/plantilla/js/modalcliente.js" ></script>
      <script src="{{URL::to('/')}}/plantilla/js/graficas.js" ></script>
      <script src="{{URL::to('/')}}/plantilla/js/graficas2.js" ></script>
      <script src="{{URL::to('/')}}/plantilla/js/morris.min.js" ></script>
      <script src="{{URL::to('/')}}/plantilla/js/jquery.nicelabel.js" ></script>
      <script src="{{URL::to('/')}}/plantilla/js/select2.js" ></script>
      <script src="{{URL::to('/')}}/plantilla/js/datatables/datatables.js" ></script>
      @yield('js')
    </body>
    </html>
