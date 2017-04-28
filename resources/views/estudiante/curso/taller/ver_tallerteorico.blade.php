@extends('estudiante.template.main')

@section('title-head', 'Ver talleres teóricos de un curso')

@section('title',' Curso: <strong>'.$curso->curs_nombre.'</strong>')

@section('active','#estudiante-curso')

@section('content')
    <div class="row">
        <h2 class="text-center"><strong>TALLERES TEÓRICOS</strong></h2>
    </div>
    <div class="row">
        <div id="accordion" class="panel-group">
            @foreach ($talleresTeoricos as $tallerTeorico)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse-{{ $tallerTeorico->tall_id }}">{{ $tallerTeorico->tall_nombre }}</a>
                        </h4>
                    </div>
                    <div id="collapse-{{ $tallerTeorico->tall_id }}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="col-lg-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Tipo de taller</div>
                                    <div class="panel-body">
                                        <div class="fs-18"><span class="label label-warning">{{ $tallerTeorico->tall_tipo }}</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Finaliza en</div>
                                    <div class="panel-body">
                                        <div data-countdown="{{ $tallerTeorico->tall_tiempo }}" class="fs-18"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Archivo asociado al taller</div>
                                    <div class="panel-body">
                                        <a href="{{ $tallerTeorico->tall_rutaarchivo }}">{{ $tallerTeorico->tall_nombrearchivo }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <br>
                            <div class="col-lg-12 text-center">
                                <a href="{{ route('estudiante.curso.ver.talleres.ver.preguntas',['curs_id'=>$curso->curs_id,'tall_id'=>$tallerTeorico->tall_id]) }}" class="btn btn-primary solucionar-taller">Solucionar Taller</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 text-center">
            <a type="reset" class="btn btn-default" href="{{ route('estudiante.curso.ver.talleresdiagnostico', ['curs_id' => $curso->curs_id]) }}">Regresar</a>
            @if ($talleresTeoricosCompletos)
                <a type="reset" class="btn btn-primary" href="{{ route('estudiante.curso.ver.tallerespractico', ['curs_id' => $curso->curs_id]) }}">Continuar con los talleres prácticos</a>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            // Función para activar el contador.
            $('[data-countdown]').each(function() {
                var $this = $(this);
                var finalDate = $(this).data('countdown');
                $this.countdown(finalDate)
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
            $('.solucionar-taller').click(function(event) {
                event.preventDefault();
                //accedemos a la ruta del boton que se dio click
                var hrefBoton = $(this).attr('href');
                swal({
                    title: '¿Está seguro de esta acción?',
                    text: 'Si continúa a solucionar el taller se le contará como el primer intento de solución, usted posee 2 intentos como máximo. Por favor confirme.',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, continuar',
                    cancelButtonText: 'No, cancelar'
                }).then(function (option) {
                    if(option === true){
                        window.location.href = hrefBoton;
                        return true;
                    }else{
                        return false;
                    }
                })
            });
        });
    </script>
@endpush
