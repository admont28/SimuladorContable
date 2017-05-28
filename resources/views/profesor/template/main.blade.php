<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title-head', 'Título por defecto.') | Simulador Contable</title>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap-lumen.min.css') }}" media="screen" title="no title">
        <link rel="stylesheet" href="{{ asset('css/main.css') }}" media="screen" title="no title">
        <link rel="stylesheet" href="{{ asset('plugins/datetimepicker/css/bootstrap-datetimepicker.min.css') }}"  media="screen" title="no title">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/DataTables-1.10.13/css/dataTables.bootstrap.min.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/Buttons-1.2.4/css/buttons.bootstrap.min.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/Responsive-2.1.1/css/responsive.bootstrap.min.css') }} "/>
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/sweetalert2/css/sweetalert2.min.css') }} "/>
        @yield('styelsheet')
        <!-- Scripts -->
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
    </head>
    <body>
        @include('profesor.template.partials.nav')
        <!-- Begin page content -->
        <div class="container">
            <div class="row">
                <div class="page-header">
                    <h1>
                        @yield('title', 'Título por defecto.')
                    </h1>
                </div>
                @include('flash::message')
            </div>
            @yield('content', '')
            <br>
            <br>
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
        <script type="text/javascript" src="{{ asset('vendor/datatables/buttons.server-side.js') }}" charset="utf-8"></script>
        <script type="text/javascript" src="{{ asset('plugins/sweetalert2/js/es6-promise.auto.min.js') }}" charset="utf-8"></script>
        <script type="text/javascript" src="{{ asset('plugins/sweetalert2/js/sweetalert2.min.js') }}" charset="utf-8"></script>
        <script type="text/javascript" src="{{ asset('plugins/countdown/js/jquery.countdown.min.js') }}" charset="utf-8"></script>
        <script type="text/javascript" src="{{ asset('plugins/responsivetabs/js/responsive-tabs.js') }}" charset="utf-8"></script>
        <script type="text/javascript" src="{{ asset('plugins/numeral/js/numeral.js') }}" charset="utf-8"></script>
        <script type="text/javascript" src="{{ asset('plugins/idletimer/js/idle-timer.min.js') }}" charset="utf-8"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                // load a locale
                numeral.register('locale', 'es_CO', {
                    delimiters: {
                        thousands: '.',
                        decimal: ','
                    },
                    abbreviations: {
                        thousand: 'k',
                        million: 'm',
                        billion: 'b',
                        trillion: 't'
                    },
                    ordinal : function (number) {
                        return number === 1 ? 'er' : 'ème';
                    },
                    currency: {
                        symbol: '$ '
                    }
                });
                // switch between locales
                numeral.locale('es_CO');
                // '$1,000.00'*/
                // idleTimer() takes an optional numeric argument that defines just the idle timeout
                // timeout is in milliseconds
                // Cerrar sesión después de 10 minutos de inactividad.
                $( document ).idleTimer(600000);
                $( document ).on( "idle.idleTimer", function(event, elem, obj){
                    // function you want to fire when the user goes idle
                    $('#logout-form').submit();
                });
                $("@yield('active','')").addClass('active');
            });
        </script>
        <script>
            $('#flash-overlay-modal').modal();
        </script>
        @stack('scripts')
    </body>
</html>
