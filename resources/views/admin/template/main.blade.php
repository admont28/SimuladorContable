<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Título por defecto.') | Simulador Contable</title>
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap-lumen.min.css') }}" media="screen" title="no title">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" media="screen" title="no title">
    @yield('styelsheet')
  </head>
  <body>
        @include('admin.template.partials.nav')
        <!-- Begin page content -->
        <div class="container">
            <div class="page-header">
                <h1>
                    @yield('title', 'Título por defecto.')
                </h1>
            </div>
            @yield('content', '')
        </div>
        @include('admin.template.partials.footer')
    <script src="{{ asset('plugins/jquery/js/jquery-3.1.1.min.js') }}" charset="utf-8"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}" charset="utf-8"></script>
    @yield('scripts')
  </body>
</html>
