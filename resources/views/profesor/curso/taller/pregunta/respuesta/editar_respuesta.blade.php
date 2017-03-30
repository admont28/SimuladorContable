@extends('profesor.template.main')

@section('title-head', 'Editar Respuesta')

@section('title', 'Editar respuesta para la pregunta: <strong>'.substr($pregunta->preg_texto,0,80).'...</strong>')

@section('active','#profesor-curso')

@section('content')
    <div class="row">
        <form class="form-horizontal" action="{{ route('profesor.curso.taller.pregunta.respuesta.editar.put',['curs_id' => $taller->curs_id, 'tall_id' => $taller->tall_id,'preg_id'=>$pregunta->preg_id, 'remu_id' => $respuesta->remu_id]) }}" method="post">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            <div class="form-group {{ $errors->has('texto_respuesta') ? ' has-error' : '' }}">
                <label for="texto_respuesta" class="col-lg-2 control-label">Texto de la respuesta:</label>
                <div class="col-lg-10">
                    <div class="input-group">
                        <input type="text" name="texto_respuesta" class="form-control" maxlength="200" placeholder="Ingrese el texto de la respuesta, máximo 200 caracteres" value="{{ $respuesta->remu_texto }}">
                        <span class="input-group-addon">
                            <span>¿Correcta?</span>
                            <input type="checkbox" id="correcta_respuesta" name="correcta_respuesta" @if ($respuesta->remu_correcta == true) {{ 'checked=checked'}} @endif>
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
                    <button type="submit" class="btn btn-primary">Editar Respuesta</button>
                </div>
            </div>
        </form>
    </div>
@endsection
