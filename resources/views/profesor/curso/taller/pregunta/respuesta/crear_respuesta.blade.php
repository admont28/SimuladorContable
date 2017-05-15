@extends('profesor.template.main')

@section('title-head', 'Crear Respuesta')

@section('title', 'Crear respuesta para la pregunta: <strong>'.substr($pregunta->preg_texto,0,80).'...</strong>')

@section('active','#profesor-curso')

@section('content')
    <form class="form-horizontal" action="{{ route('profesor.curso.taller.pregunta.respuesta.crear.post',['curs_id'=>$curso->curs_id,'tall_id'=>$taller->tall_id, 'preg_id' => $pregunta->preg_id]) }}" method="post">
        {{ csrf_field() }}
        <div class="form-group {{ $errors->has('texto_respuesta') ? ' has-error' : '' }}">
            <label for="texto_respuesta" class="col-lg-2 control-label">Texto de la respuesta:</label>
            <div class="col-lg-10">
                <div class="input-group">
                    <input type="text" name="texto_respuesta" class="form-control" maxlength="200" placeholder="Ingrese el texto de la respuesta, máximo 200 caracteres" value="{{ old('texto_respuesta') }}" autofocus="autofocus" required="required">
                    <span class="input-group-addon">
                        <span>¿Correcta?</span>
                        <input type="checkbox" id="correcta_respuesta" name="correcta_respuesta">
                    </span>
                </div>
                @if ($errors->has('texto_respuesta'))
                    <span class="help-block">
                        <strong>{{ $errors->first('texto_respuesta') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <a href="{{ route('profesor.curso.taller.pregunta.ver',['curs_id'=> $curso->curs_id,'tall_id'=>$taller->tall_id, 'preg_id' => $pregunta->preg_id]) }}"  class="btn btn-default">Regresar</a>
                <button type="submit" class="btn btn-primary">Crear Respuesta</button>
            </div>
        </div>
    </form>
@endsection
