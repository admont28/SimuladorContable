@extends('profesor.template.main')

@section('title-head', 'Sección de Preguntas Calificadas')

@section('title', 'Calificar Pregunta')

@section('active','#profesor-curso')

@section('content')
    <div class="row">
        @if ($pregunta->preg_tipo == "abierta")
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Respuesta Abierta</h3>
                </div>
                <div class="panel-body">
                    {{ $respuesta->resp_abierta }}
                </div>
            </div>
        @elseif ($pregunta->preg_tipo == "archivo")
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Respuesta Carga De Archivo</h3>
                </div>
                <div class="panel-body">
                    <a href="{{ $respuesta->respuestaArchivo->rear_rutaarchivo }}">{{ $respuesta->respuestaArchivo->rear_nombre }}</a>
                </div>
            </div>
        @endif
    </div>
    <div class="row">
        <form class="form-horizontal" action="{{ route('profesor.curso.taller.pregunta.respuesta.calificacion.estudiante.calificar.pregunta.post',['curs_id'=>$curso->curs_id,'tall_id'=>$taller->tall_id,'usua_id'=>$usuario->usua_id,'preg_id'=>$pregunta->preg_id ,'resp_id'=>$respuesta->resp_id])}}" method="post">
            {{ csrf_field() }}
            <div class="form-group {{ $errors->has('calificacion_pregunta') ? ' has-error' : '' }}">
                <label for="calificacion_pregunta_texto" class="col-lg-2 control-label">Calificación</label>
                <div class="col-lg-10">
                    <input type="number" min="0" max="5" step="0.1" name="calificacion_pregunta" class="form-control"/>
                    @if ($errors->has('calificacion_pregunta'))
                        <span class="help-block">
                            <strong>{{ $errors->first('calificacion_pregunta') }}</strong>
                        </span>
                    @endif
                </div>
            </div>


            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <a href="{{ route('profesor.curso.taller.ver',['curs_id'=> $taller->curs_id,'tall_id'=>$taller->tall_id]) }}"  class="btn btn-default">Regresar</a>
                    <button type="submit" class="btn btn-primary">Calificar</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')

@endpush
