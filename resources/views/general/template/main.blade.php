<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Título por defecto.') | Simulador Contable</title>
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap-lumen.min.css') }}" media="screen" title="no title">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" media="screen" title="no title">
    <link rel="stylesheet" href="{{ asset('plugins/datetimepicker/css/bootstrap-datetimepicker.min.css') }}"  media="screen" title="no title">
    @yield('styelsheet')
  </head>
  <body>
        @include('general.template.partials.nav')
        <!-- Begin page content -->
        <div class="container">
            <div class="page-header">
                <h1>
                    @yield('title', 'Título por defecto.')
                </h1>
            </div>
            @yield('content', '')
        </div>
        @include('general.template.partials.footer')
    <script src="{{ asset('plugins/jquery/js/jquery-3.1.1.min.js') }}" charset="utf-8"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}" charset="utf-8"></script>
    <script src="{{ asset('plugins/moment/js/moment.js') }}" charset="utf-8"></script>
    <script src="{{ asset('plugins/moment/locale/es.js') }}" charset="utf-8"></script>
    <script src="{{ asset('plugins/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" charset="utf-8"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("@yield('active','')").addClass('active');
        });
    </script>
    @yield('scripts')
  </body>
</html>
