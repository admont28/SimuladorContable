@extends('general.template.main')

@section('title', 'Registrarse')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('messages.registrarme') }}</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('usua_nombre') ? ' has-error' : '' }}">
                            <label for="usua_nombre" class="col-md-4 control-label">{{ trans('messages.nombre') }}</label>

                            <div class="col-md-6">
                                <input id="usua_nombre" type="text" class="form-control" name="usua_nombre" value="{{ old('usua_nombre') }}" required autofocus>

                                @if ($errors->has('usua_nombre'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('usua_nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('usua_correo') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">{{ trans('validation.attributes.usua_correo') }}</label>

                            <div class="col-md-6">
                                <input id="usua_correo" type="email" class="form-control" name="usua_correo" value="{{ old('usua_correo') }}" required>

                                @if ($errors->has('usua_correo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('usua_correo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('usua_contrasena') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">{{ trans('validation.attributes.usua_contrasena') }}</label>

                            <div class="col-md-6">
                                <input id="usua_contrasena" type="password" class="form-control" name="usua_contrasena" required>

                                @if ($errors->has('usua_contrasena'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('usua_contrasena') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="usua_contrasena-confirm" class="col-md-4 control-label">{{ trans('messages.Confirmar_Contrasena') }}</label>

                            <div class="col-md-6">
                                <input id="usua_contrasenas-confirm" type="password" class="form-control" name="usua_contrasena_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ trans('messages.registrarme') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
