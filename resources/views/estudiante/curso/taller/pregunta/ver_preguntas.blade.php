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
        <div class="bs-callout bs-callout-danger">
            <h4><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ¡Atención Estudiante!</h4>
            <p class="lead">Tenga en cuenta que debe responder todas las preguntas antes de presionar el botón 'Enviar solución del taller'. Si no envía la solución del taller antes de que el taller finalice, sus respuestas no serán guardadas. Por favor no espere hasta el último segundo para enviar las respuestas ya que el sistema se puede demorar en realizar las validaciones necesarias y guardar las respuestas.</p>
        </div>
    </div>
    <div class="row">
        <form class="form-horizontal" action="{{ route('estudiante.curso.taller.solucionar.post', ['curs_id' => $curso->curs_id, 'tall_id' => $taller->tall_id]) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @if($errors->any())
               @foreach ($errors->all() as $error)
                  <div>{{ $error }}</div>
              @endforeach
            @endif
            @foreach ($preguntas as $pregunta)
                <p class="lead"><strong>{{ $loop->iteration }}. {{ $pregunta->preg_texto }}</strong></p>
                @if ($pregunta->preg_tipo== "unica-multiple")
                    @if ($pregunta->tieneRespuestaMultiple() == true)
                        <div class="{{ $errors->has('r_p_'.$pregunta->preg_id) ? ' has-error' : '' }}">
                            @if ($errors->has('r_p_'.$pregunta->preg_id))
                               <span class="help-block">
                                   <strong>{{ $errors->first('r_p_'.$pregunta->preg_id) }}</strong>
                               </span>
                            @endif
                            @foreach ($pregunta->respuestasMultiplesUnicas as $respuesta)
                                <div class="form-group {{ $errors->has('r_p_'.$pregunta->preg_id) ? ' has-error' : '' }}">
                                    <div class="col-lg-12">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" id="{{ $respuesta->remu_id }}" name="r_p_{{ $pregunta->preg_id }}_o_{{ $respuesta->remu_id }}" @if(old('r_p_'.$pregunta->preg_id.'_o_'.$respuesta->remu_id)) {{'checked=checked'}} @endif> {{ $respuesta->remu_texto}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="{{ $errors->has('r_p_'.$pregunta->preg_id) ? ' has-error' : '' }}">
                            @if ($errors->has('r_p_'.$pregunta->preg_id))
                               <span class="help-block">
                                   <strong>{{ $errors->first('r_p_'.$pregunta->preg_id) }}</strong>
                               </span>
                            @endif
                            @foreach ($pregunta->respuestasMultiplesUnicas as $respuesta)
                                <div class="form-group {{ $errors->has('r_p_'.$pregunta->preg_id) ? ' has-error' : '' }}">
                                    <div class="col-lg-12">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" id="{{ $respuesta->remu_id }}" name="r_p_{{ $pregunta->preg_id }}" value="{{ $respuesta->remu_id }}" @if(old('r_p_'.$pregunta->preg_id) == $respuesta->remu_id) {{'checked=checked'}} @endif> {{ $respuesta->remu_texto}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                @elseif ($pregunta->preg_tipo == "abierta")
                    <div class="form-group {{ $errors->has('r_p_'.$pregunta->preg_id) ? ' has-error' : '' }}">
                        <div class="col-lg-12">
                            <textarea class="form-control" rows="3" id="{{ $pregunta->preg_id }}" name="r_p_{{ $pregunta->preg_id }}" placeholder="Ingrese su respuesta, como máximo 500 caracteres." max="500">{{ old('r_p_'.$pregunta->preg_id) }}</textarea>
                            @if ($errors->has('r_p_'.$pregunta->preg_id))
                               <span class="help-block">
                                   <strong>{{ $errors->first('r_p_'.$pregunta->preg_id) }}</strong>
                               </span>
                            @endif
                        </div>
                    </div>
                @elseif ($pregunta->preg_tipo == "archivo")
                    <div class="form-group {{ $errors->has('r_p_'.$pregunta->preg_id) ? ' has-error' : '' }}">
                        <div class="col-lg-12">
                            <input type="file" class="form-control" id="{{ $pregunta->preg_id }}" name="r_p_{{ $pregunta->preg_id }}">
                            @if ($errors->has('r_p_'.$pregunta->preg_id))
                                <span class="help-block">
                                    <strong>{{ $errors->first('r_p_'.$pregunta->preg_id) }}</strong>
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
            // Función para activar el contador.
            $("#clock").countdown("{{ $taller->tall_tiempo }}")
                        .on('update.countdown', function(event) {
                            // El contador por defecto es de color verde.
                            var format = '<span class="label label-success">%H hr</span> <span class="label label-success">%M min</span> <span class="label label-success">%S seg</span>';
                            // Se valida si se debe colocar la palabra día en plural o no.
                            if(event.offset.totalDays > 0) {
                                format = '<span class="label label-success">%-d día%!d</span> ' + format;
                            }
                            // Se valida si se debe colocar la palabra semana en plural o no.
                            if(event.offset.weeks > 0) {
                                format = '<span class="label label-success">%-w semana%!w</span> ' + format;
                            }
                            // Se coloca el contador en el html
                            $(this).html(event.strftime(format));
                            // Cuando el total de días es inferior o igual a 3, se coloca en naranja el contador.
                            if(event.offset.totalDays <= 3){
                                $(this).children("span").removeClass('label-success').addClass('label-warning');
                            }
                            // Cuando el total de días es inferior o igual a 1, se coloca en rojo el contador.
                            if(event.offset.totalDays < 1 ){
                                $(this).children("span").removeClass('label-warning').addClass('label-danger');
                            }
                        })
                        // Cuando finaliza el contador se deja el siguiente mensaje.
                        .on('finish.countdown', function(event) {
                            $(this).html('<div class="alert alert-danger" role="alert">El taller ha expirado, no es posible guardar las respuestas.</div>');
                        });
        });
        // Mensjae cuando el usuario intenta abandonar la página.
        $(window).on('beforeunload', function(){
            swal(
                '¡Cuidado!',
                'Intentaste abandonar esta pagina. Si abandonas la página de igual forma se contará como un intento de solución del taller.',
                'warning'
            );
            return "Intentaste abandonar esta pagina. Si abandonas la página de igual forma se contará como un intento de solución del taller.";
        });
    </script>
@endpush
