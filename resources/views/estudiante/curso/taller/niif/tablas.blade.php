<div class="tablas-niif">
    @if ($tallerPractico->tallerNiif->respuestaTallerNiifUsuarioAutenticado() !== null)
        @include('estudiante.curso.taller.niif.balanceprueba', ['balancesPruebas' => $tallerPractico->tallerNiif->respuestaTallerNiifUsuarioAutenticado()->balancesPruebas, 'tallerNiif' => $tallerPractico->tallerNiif])
        @include('estudiante.curso.taller.niif.estadoresultado', ['estadoResultado' => $tallerPractico->tallerNiif->respuestaTallerNiifUsuarioAutenticado()->estadoResultado, 'tallerNiif' => $tallerPractico->tallerNiif])
    @endif
</div>
<br>
<div class="row">
    <div class="col-lg-12 text-center">
        <button class="btn btn-primary generar-tablas-niif" data-ruta="{{ route('estudiante.curso.taller.generartablasniif', ['curs_id' => $curso->curs_id, 'tall_id' => $tallerPractico->tall_id]) }}">Generar Tabla Balance de Prueba</button>
    </div>
</div>
