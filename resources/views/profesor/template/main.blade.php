<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Título por defecto.') | Simulador Contable</title>
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap-lumen.min.css') }}" media="screen" title="no title">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" media="screen" title="no title">
    <link rel="stylesheet" href="{{ asset('plugins/datetimepicker/css/bootstrap-datetimepicker.min.css') }}"  media="screen" title="no title">
    <link rel="stylesheet" type="text/css" href="DataTables-1.10.13/css/dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="Buttons-1.2.4/css/buttons.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="Responsive-2.1.1/css/responsive.bootstrap.min.css"/>
    @yield('styelsheet')
  </head>
  <body>
        @include('profesor.template.partials.nav')
        <!-- Begin page content -->
        <div class="container">
            <div class="page-header">
                <h1>
                    @yield('title', 'Título por defecto.')
                </h1>
            </div>
            @yield('content', '')

        </div>
        @include('profesor.template.partials.footer')
    <script type="text/javascript" src="{{ asset('plugins/jquery/js/jquery-3.1.1.min.js') }}" charset="utf-8"></script>
    <script type="text/javascript" src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}" charset="utf-8"></script>
    <script type="text/javascript" src="{{ asset('plugins/moment/js/moment.js') }}" charset="utf-8"></script>
    <script type="text/javascript" src="{{ asset('plugins/moment/locale/es.js') }}" charset="utf-8"></script>
    <script type="text/javascript" src="{{ asset('plugins/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" charset="utf-8"  charset="utf-8"></script>
    <script type="text/javascript" src="{{ asset('plugins/DataTables-1.10.13/js/jquery.dataTables.min.js') }}" charset="utf-8"></script>
    <script type="text/javascript" src="{{ asset('plugins/DataTables-1.10.13/js/dataTables.bootstrap.min.js') }}" charset="utf-8"></script>
    <script type="text/javascript" src="{{ asset('plugins/Buttons-1.2.4/js/dataTables.buttons.min.js') }}" charset="utf-8"></script>
    <script type="text/javascript" src="{{ asset('plugins/Buttons-1.2.4/js/buttons.bootstrap.min.js') }}" charset="utf-8"></script>
    <script type="text/javascript" src="{{ asset('plugins/Buttons-1.2.4/js/buttons.colVis.min.js') }}" charset="utf-8"></script>
    <script type="text/javascript" src="{{ asset('plugins/Buttons-1.2.4/js/buttons.html5.min.js') }}" charset="utf-8"></script>
    <script type="text/javascript" src="{{ asset('plugins/Buttons-1.2.4/js/buttons.print.min.js') }}" charset="utf-8"></script>
    <script type="text/javascript" src="{{ asset('plugins/Responsive-2.1.1/js/dataTables.responsive.min.js') }}" charset="utf-8"></script>
    <script type="text/javascript" src="{{ asset('plugins/Responsive-2.1.1/js/responsive.bootstrap.min.js') }}" charset="utf-8"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("@yield('active','')").addClass('active');
        });
    </script>
    @yield('scripts')
  </body>
</html>
