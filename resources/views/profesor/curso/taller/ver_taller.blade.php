@extends('profesor.template.main')

@section('title-head', 'Ver taller')

@section('title', 'Sección de talleres <strong>'.$taller->tall_nombre.'</strong>')

@section('active','#profesor-taller')

@section('content')

    <div class="row">

            <div class="form-group">
                <label for="nombre_taller" class="col-lg-10 ">Nombre del taller</label>
                <div class="col-lg-2">
                    {{ $taller->tall_nombre }}
                </div>
            </div>

            <div class="form-group">
                <label for="tipo_taller" class="col-lg-10 ">Tipo</label>
                <div class="col-lg-2">
                    {{ $taller->tall_tipo }}
                </div>
            </div>
            <div class="form-group">
                <label for="tiempo_taller" class="col-lg-10">Tiempo del taller</label>
                <div class="col-lg-2">
                    <div class='input-group date ' >
                        {{ $taller->tall_tiempo }}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="taller_rutaarchivo" class="col-lg-10">Archivo</label>
                <div class="col-lg-2">
                    <a href="{{ $taller->tall_rutaarchivo }}"> {{ $taller->tall_rutaarchivo }} </a>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <a href="{{ route('profesor.curso.ver',['id' => $taller->curs_id]) }}"  class="btn btn-default">Regresar</a>
                </div>
            </div>

    </div>

    <div class="row">
        <div class="page-header">
            <h1>Preguntas del taller</h1>
        </div>
    </div>
    @include('profesor.curso.taller.pregunta.index')


    @endsection

    @push('scripts')
    <script type="text/javascript">
        $(function () {
            $('#tiempo_taller').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss',
                extraFormats: [ 'YYYY/MM/DD HH:mm:ss' ],
                sideBySide: false,
                showTodayButton: true,
                showClear: true,
                showClose: true,
                toolbarPlacement: 'top',
                minDate: new Date(),
                tooltips: {
                    today: 'Hoy',
                    clear: 'Limpiar selección',
                    close: 'Cerrar ventana',
                    selectMonth: 'Seleccionar mes',
                    prevMonth: 'Mes anterior',
                    nextMonth: 'Siguiente mes',
                    selectYear: 'Seleccionar año',
                    prevYear: 'Año anterior',
                    nextYear: 'Siguiente año',
                    selectDecade: 'Seleccionar década',
                    prevDecade: 'Década anterior',
                    nextDecade: 'Siguiente década',
                    prevCentury: 'Siglo anterior',
                    nextCentury: 'Siguiente siglo'
                }
            });
        });
    </script>
    @endpush
