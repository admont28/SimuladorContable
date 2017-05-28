@extends('profesor.template.main')

@section('title-head', 'Respuesta de taller NIIF')

@section('title')
    {!! 'Taller NIIF - Respuesta del usuario: <strong>'.$usuario->name.'</strong>' !!}
@endsection

@section('active','#profesor-curso')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Respuesta del usuario - Carga de archivo</h3>
                </div>
                <div class="panel-body">
                    @if (isset($respuestaTallerNiif->respuestaArchivo))
                        <a href="{{ $respuestaTallerNiif->respuestaArchivo->rear_rutaarchivo }}">{{ $respuestaTallerNiif->respuestaArchivo->rear_nombre }}</a>
                    @else
                        <p>EL usuario no cargó algún archivo.</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Respuesta del usuario - Tabla NIIF</h3>
                </div>
                <div class="panel-body">
                    @if ($respuestaTallerNiif->balancesPruebas != null && $respuestaTallerNiif->balancesPruebas->isNotEmpty())
                        @include('profesor.curso.taller.niif.balanceprueba', ['balancesPruebas' => $respuestaTallerNiif->balancesPruebas])
                    @endif
                    @if ($respuestaTallerNiif->estadoResultado != null)
                        @include('profesor.curso.taller.niif.estadoresultado', ['estadoResultado' => $respuestaTallerNiif->estadoResultado])
                    @endif
                    @if ($respuestaTallerNiif->estadoSituacionFinanciera != null)
                        @include('profesor.curso.taller.niif.estadosituacionfinanciera', ['estadoSituacionFinanciera' => $respuestaTallerNiif->estadoSituacionFinanciera])
                    @endif
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12 text-center">
            <a href="{{ route('profesor.curso.taller.ver', ['curs_id' => $curso->curs_id, 'tall_id' => $taller->tall_id]) }}" class="btn btn-default">Regresar</a>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".tabla-niif > tbody > tr > td").each(function(index, el) {
                if ($(el).hasClass('formato_pesos')) {
                    $(el).text(numeral($(el).text()).format('$0,0'));
                }
            });
        });
    </script>
@endpush
