<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ url('') }}">{{ trans('messages.simulador_contable') }}</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li id="profesor-index" ><a href="{{ route('profesor.index') }}">{{ trans('messages.inicio') }}</a></li>
            <li id="profesor-taller"><a href="{{ route('profesor.taller') }}">{{ trans('messages.taller') }}</a></li>
            <li class="dropdown">
                <a href="{{ route('profesor.curso') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {!! trans('messages.curso') !!}  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="{{ route('profesor.curso') }}"> {{ trans('messages.curso') }}</a>
                    </li>

                    <li>
                        <a href="{{ route('profesor.crearcurso') }}"> {{ trans('messages.crear_curso') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('profesor.curso.ver') }}"> {{ trans('messages.ver_cursos') }}</a>
                    </li>
                    <li role="separator" class="divider"></li>
                    <li>
                        <a href="{{ route('profesor.tema') }}"> {{ trans('messages.tema') }}</a>
                    </li>

                </ul>
            </li>
        </ul>
        <!-- Right Side Of Navbar -->
        <ul class="nav navbar-nav navbar-right">
            <!-- Authentication Links -->
            @if (Auth::guest())
                <li><a href="{{ url('/login') }}">{{ trans('messages.iniciar_sesion') }}</a></li>
                <li><a href="{{ url('/register') }}">{{ trans('messages.registrarme') }}</a></li>
            @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->usua_nombre }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="{{ route(Auth::user()->usua_rol.'.index') }}"> {{ trans('messages.perfil') }}</a>
                        </li>
                        <li>
                            <a href="{{ url('/logout') }}"
                              onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                              {{ trans('messages.logout') }}
                            </a>

                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                              {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
