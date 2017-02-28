@extends('general.template.main')
@section('title', 'Cambiar Contraseña')


<!-- Main Content -->
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('messages.restablecer_contrasena') }}</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('usua_correo') ? ' has-error' : '' }}">
                            <label for="usua_correo" class="col-md-4 control-label" >{{ trans('messages.correo') }}</label>

                            <div class="col-md-6">
                                <input id="usua_correo" type="email" class="form-control" name="usua_correo" value="{{ old('usua_correo') }}" required>

                                @if ($errors->has('usua_correo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('usua_correo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                  {{ trans('messages.enviar_contrasena') }}
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
