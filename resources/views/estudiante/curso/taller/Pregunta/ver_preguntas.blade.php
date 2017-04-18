@extends('estudiante.template.main')

@section('title-head', 'Solucionar Taller de un curso')

@section('title',' Taller: <strong>'.$taller->tall_nombre.'</strong>')

@section('active','#estudiante-curso')

@section('content')
    <div class="row">
        <div class="well text-center">
            <p class="lead"><strong>El taller finaliza en:</strong></p>
            <h2 id="clock"></h2>
        </div>
    </div>
    <div class="row">
        <form class="form-horizontal" action="" method="post">
            @foreach ($preguntas as $pregunta)
                <p class="lead"><strong>{{ $loop->iteration }}. {{ $pregunta->preg_texto }}</strong></p>
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
                    @else
                        @foreach ($pregunta->respuestasMultiplesUnicas as $respuesta)
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" id="{{ $respuesta->remu_id }}" name="{{ $pregunta->preg_id }}" > {{ $respuesta->remu_texto}}
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
                <div class="col-lg-12 text-center">
                    <button type="submit" class="btn btn-success">Enviar solución del taller</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#clock").countdown("{{ $taller->tall_tiempo }}")
                        .on('update.countdown', function(event) {
                            var format = '<span class="label label-success">%H hr</span> <span class="label label-success">%M min</span> <span class="label label-success">%S seg</span>';
                            if(event.offset.totalDays > 0) {
                                format = '<span class="label label-success">%-d día%!d</span> ' + format;
                            }
                            if(event.offset.weeks > 0) {
                                format = '<span class="label label-success">%-w semana%!w</span> ' + format;
                            }
                            $(this).html(event.strftime(format));
                            console.log(event.offset.totalDays);
                            if(event.offset.totalDays <= 3){
                                $(this).children("span").removeClass('label-success').addClass('label-warning');
                            }
                            if(event.offset.totalDays < 1 ){
                                $(this).children("span").removeClass('label-warning').addClass('label-danger');
                            }
                        })
                        .on('finish.countdown', function(event) {
                            $(this).html('<div class="alert alert-danger" role="alert">El taller ha expirado, no es posible guardar las respuestas.</div>');
                        });
            });
    </script>
@endpush
