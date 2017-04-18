@extends('estudiante.template.main')

@section('title-head', 'Resolver Taller')

@section('title',' Taller: <strong>'.$taller->tall_nombre.'</strong>')

@section('active','#estudiante-curso')

@section('content')
    <div class="row">
        <form class="form-horizontal" action="{{ route('estudiante.curso.ver.talleres.ver.preguntas.ver.calificacion',['curso'=>$curso,'taller'=>$taller]) }}" method="post">
            @foreach ($preguntas as $pregunta)
                <p class="lead"><strong>{{ $loop->iteration }}.</strong> {{ $pregunta->preg_texto }}</p>
                @if ($pregunta->preg_tipo== "unica-multiple")
                    @if ($pregunta->tieneRespuestaMultiple() == true)
                        @foreach ($pregunta->respuestasMultiplesUnicas as $respuesta)
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="{{ $respuesta->remu_id }}" name="{{ $respuesta->remu_id }}" > {{ $respuesta->remu_texto}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @elseif ($pregunta->preg_tipo== "abierta")
                    <div class="form-group">
                        <div class="col-lg-12">
                           <textarea class="form-control" rows="3" id="{{ $pregunta->preg_id }}" name="{{ $pregunta->preg_id }}" placeholder="Ingrese su respuesta, como máximo 500 caracteres." max="500"></textarea>
                        </div>
                    </div>
                @elseif ($pregunta->preg_tipo== "archivo")

                    <div class="form-group {{ $errors->has( $pregunta->preg_id ) ? ' has-error' : '' }}"
                        <div class="col-lg-12">
                            <input type="file" class="form-control" id="{{ $pregunta->preg_id }}" name="{{ $pregunta->preg_id }}">
                            @if ($errors->has( $pregunta->preg_id ))
                                <span class="help-block">
                                    <strong>{{ $errors->first( $pregunta->preg_id ) }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                @endif

            @endforeach
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Enviar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-lg-10">
            <a type="reset" class="btn btn-default" href="{{ route('estudiante.curso') }}">Regresar</a>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">





    </script>
@endsection
