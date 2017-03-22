@extends('profesor.template.main')

@section('title', 'ver taller <strong>'.$taller->tall_nombre.'</strong>')

@section('active','#profesor-taller')

@section('content')

    <div class="row">

                <div class="col-lg-2">
                    <strong>Nombre del taller </strong>
                </div>
                <div class="col-lg-10 text-justify">
                    {{ $taller->tall_nombre }}
                </div>

                <div class="col-lg-2">
                    <strong>Tipo</strong>
                </div>
                <div class="col-lg-10 text-justify">
                    {{ $taller->tall_tipo }}
                </div>

                <div class="col-lg-2">
                    <strong> Tiempo del taller </strong>
                </div>
                <div class="col-lg-10 text-justify">
                    <div class='input-group date ' >
                        {{ $taller->tall_tiempo }}
                    </div>
                </div>

                <div class="col-lg-2">
                    <strong> Archivo </strong>
                </div>
                <div class="col-lg-10 text-justify">
                    <a href="{{ $taller->tall_rutaarchivo }}"> {{ $taller->tall_rutaarchivo }} </a>
                </div>

                <br>
                <div class="col-lg-10 col-lg-offset-2 text-center">
                    <a href="{{ route('profesor.curso.ver',['tall_id' => $taller->tall_id,'curs_id'=>$taller->curs_id]) }}"  class="btn btn-default">Regresar</a>
                    <a href="{{ route('profesor.curso.taller.editar',['curs_id'=>$taller->curs_id,'tall_id' => $taller->tall_id]) }}"  class="btn btn-default">Editar taller</a>
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
