<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title-head', 'Título por defecto.') | Simulador Contable</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/bootstrap/css/bootstrap-lumen.min.css') }}" media="screen" title="no title">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}" media="screen" title="no title">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/datetimepicker/css/bootstrap-datetimepicker.min.css') }}"  media="screen" title="no title">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/DataTables-1.10.13/css/dataTables.bootstrap.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/Buttons-1.2.4/css/buttons.bootstrap.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/Responsive-2.1.1/css/responsive.bootstrap.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/sweetalert2/css/sweetalert2.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/ajax-bootstrap-select/css/ajax-bootstrap-select.css') }}"/>
    @yield('styelsheet')
  </head>
  <body>
        @include('estudiante.template.partials.nav')
        <!-- Begin page content -->
        <div class="container">
            <div class="row">
                <div class="page-header">
                    <h1>
                        @yield('title', 'Título por defecto.')
                    </h1>
                </div>
                @if (session()->has('flash_notification.message'))
                    <div class="alert alert-{{ session('flash_notification.level') }}">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {!! session('flash_notification.message') !!}
                    </div>
                @endif
            </div>
            @yield('content', '')
            <br>
            <br>
        </div>
        @include('estudiante.template.partials.footer')
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
        <script type="text/javascript" src="{{ asset('vendor/datatables/buttons.server-side.js') }}" charset="utf-8"></script>
        <script type="text/javascript" src="{{ asset('plugins/sweetalert2/js/es6-promise.auto.min.js') }}" charset="utf-8"></script>
        <script type="text/javascript" src="{{ asset('plugins/sweetalert2/js/sweetalert2.min.js') }}" charset="utf-8"></script>
        <script type="text/javascript" src="{{ asset('plugins/countdown/js/jquery.countdown.min.js') }}" charset="utf-8"></script>
        <script type="text/javascript" src="{{ asset('plugins/responsivetabs/js/responsive-tabs.js') }}" charset="utf-8"></script>
		<script type="text/javascript" src="{{ asset('plugins/bootstrap-select/js/bootstrap-select.min.js') }}" charset="utf-8"></script>
        <script type="text/javascript" src="{{ asset('plugins/ajax-bootstrap-select/js/ajax-bootstrap-select.min.js') }}" charset="utf-8"></script>
        <script type="text/javascript" src="{{ asset('plugins/ajax-bootstrap-select/js/locale/ajax-bootstrap-select.es-ES.min.js') }}" charset="utf-8"></script>
        <script type="text/javascript" src="{{ asset('plugins/numeral/js/numeral.js') }}" charset="utf-8"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>

        <script type="text/javascript">
        $(document).ready(function() {
            $("@yield('active','')").addClass('active');
        });
    </script>
    @stack('scripts')
  </body>
</html>
