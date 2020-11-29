<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="api-base-url" content="{{ route('home') }}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Technocrafts Admin') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/loader.css') }}" rel="stylesheet">
</head>
<body id='body' class="sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div id="loader">
    <div class="infinity">
      <div>
        <span></span>
      </div>
      <div>
        <span></span>
      </div>
      <div>
        <span></span>
      </div>
    </div>
  </div>
  <div id="app">
    <div class="wrapper">

      @include('admin/components/topbar')
      
      @include('admin/components/sidebar')
      
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" style="min-height: 151px;">

        <!-- Main content -->
        <div class="content">
          <div class="container-fluid">
             <main class="py-4">
                @yield('content')
            </main>
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      @include('admin/components/footer')
    </div>
  </div>
</body>
<script>
 window.addEventListener("load",
function(){
  let loader=document.getElementById('loader');
  loader.style.display='none';
 });
</script>
</html>