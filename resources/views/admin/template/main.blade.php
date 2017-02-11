<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Default') | Simulador Contable</title>
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap-lumen.min.css') }}" media="screen" title="no title">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" media="screen" title="no title">
    @yield('styelsheethead')
  </head>
  <body>
    <div id="wrap">
      @include('admin.template.partials.nav')
      @yield('content')
      <div class="page-header">
        <h1>Inicio</h1>
      </div>

      <!-- Etiqueta usada para evitar que el footer se descontrole -->
  	  <div id="push"></div>
  	<!-- Fin del div Wrap (id=wrap) -->
  	</div>
    @include('admin.template.partials.footer')
    <script src="{{ asset('plugins/jquery/js/jquery-3.1.1.min.js') }}" charset="utf-8"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}" charset="utf-8"></script>
  </body>
</html>
