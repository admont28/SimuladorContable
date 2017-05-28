@extends('profesor.template.main')

@section('title-head', 'Editar Intentos de Respuesta de un Usuario en un Taller')

@section('title')
    {!! 'Editar intentos de respuesta para el usuario : <strong>'.$usuario->name.'</strong>' !!}
@endsection

@section('active','#profesor-curso')

@section('content')
    <div class="row">
        <form class="form-horizontal" action="{{ route('profesor.curso.taller.intentostaller.editar',['inta_id' => $intentoTaller->inta_id]) }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label class="col-sm-2 control-label">Taller:</label>
                <div class="col-sm-10">
                    <p class="form-control-static">{{ $taller->tall_nombre }}</p>
                </div>
            </div>
            <div class="form-group {{ $errors->has('cantidad_intentos') ? ' has-error' : '' }}">
                <label for="cantidad_intentos" class="col-lg-2 control-label">Cantidad de intentos:</label>
                <div class="col-lg-10">
                    <input type="number" min="1" step="1" max="2" class="form-control" id="cantidad_intentos" placeholder="Ingrese la cantidad de intentos realizados que desea asignar al usuario" name="cantidad_intentos" value="{{ old('cantidad_intentos') }}" autofocus="autofocus" required="required">
                    @if ($errors->has('cantidad_intentos'))
                        <span class="help-block">
                            <strong>{{ $errors->first('cantidad_intentos') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <a href="{{ route('profesor.curso.taller.ver',['curs_id' => $taller->curs_id, 'tall_id' => $taller->tall_id]) }}"  class="btn btn-default">Regresar</a>
                    <button type="submit" class="btn btn-primary">Editar Intentos</button>
                </div>
            </div>
        </form>
    </div>
@endsection
