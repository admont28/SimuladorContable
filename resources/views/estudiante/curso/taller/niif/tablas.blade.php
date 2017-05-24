<div class="tablas-niif">
    @if ($tallerPractico->tallerNiif->respuestaTallerNiifUsuarioAutenticado() !== null)
        @if ($tallerPractico->tallerNiif->respuestaTallerNiifUsuarioAutenticado()->balancesPruebas != null && $tallerPractico->tallerNiif->respuestaTallerNiifUsuarioAutenticado()->balancesPruebas->isNotEmpty())
            @include('estudiante.curso.taller.niif.balanceprueba', ['balancesPruebas' => $tallerPractico->tallerNiif->respuestaTallerNiifUsuarioAutenticado()->balancesPruebas, 'tallerNiif' => $tallerPractico->tallerNiif, 'respuestaTallerNiif' => $tallerPractico->tallerNiif->respuestaTallerNiifUsuarioAutenticado()])
        @endif
        @if ($tallerPractico->tallerNiif->respuestaTallerNiifUsuarioAutenticado()->estadoResultado != null)
            @include('estudiante.curso.taller.niif.estadoresultado', ['estadoResultado' => $tallerPractico->tallerNiif->respuestaTallerNiifUsuarioAutenticado()->estadoResultado, 'tallerNiif' => $tallerPractico->tallerNiif])
        @endif
        @if ($tallerPractico->tallerNiif->respuestaTallerNiifUsuarioAutenticado()->estadoSituacionFinanciera != null)
            @include('estudiante.curso.taller.niif.estadosituacionfinanciera', ['estadoSituacionFinanciera' => $tallerPractico->tallerNiif->respuestaTallerNiifUsuarioAutenticado()->estadoSituacionFinanciera, 'tallerNiif' => $tallerPractico->tallerNiif])
        @endif
    @endif
</div>
<br>
<div class="row">
    <div class="col-lg-12 text-center">
        <button class="btn btn-primary generar-tablas-niif" data-ruta="{{ route('estudiante.curso.taller.generartablasniif', ['curs_id' => $curso->curs_id, 'tall_id' => $tallerPractico->tall_id]) }}">Generar Tabla Balance de Prueba</button>
    </div>
</div>
