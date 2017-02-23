@extends('estudiante.template.main')

@section('title', 'Iniciar Sesion')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('messages.iniciar_sesion')}}</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('usua_correo') ? ' has-error' : '' }}">
                            <label for="usua_correo" class="col-md-4 control-label">{{trans('messages.correo')}}</label>

                            <div class="col-md-6">
                                <input id="usua_correo" type="email" placeholder="Escriba su correo electronico" class="form-control" name="usua_correo" value="{{ old('usua_correo') }}" required autofocus>

                                @if ($errors->has('usua_correo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('usua_correo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">{{ trans('messages.passwd') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" placeholder="Escriba su contraseña" class="form-control"  name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> {{ trans('messages.recordar_contrasena') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                  {{ trans('messages.bt_ingresar') }}
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                  {{ trans('messages.olvidaste_contrasena') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
