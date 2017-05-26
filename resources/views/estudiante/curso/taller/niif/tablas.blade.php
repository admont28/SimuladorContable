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
        <div class="form-group">
            <label for="archivo_taller_niif" class="col-lg-2 control-label">Archivo</label>
            <div class="col-lg-10">
                <input type="file" class="form-control" placeholder="ruta del archivo" name="archivo_taller_niif">
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        @if (isset($tallerPractico->tallerNiif->respuestaTallerNiifUsuarioAutenticado()->rear_id))
            <div class="alert alert-info" role="alert">
                <p>Usted ya ha cargado el siguiente archivo: <strong><a class="alert-link" target="_blank" href="{{ $tallerPractico->tallerNiif->respuestaTallerNiifUsuarioAutenticado()->respuestaArchivo->rear_rutaarchivo }}">{{ $tallerPractico->tallerNiif->respuestaTallerNiifUsuarioAutenticado()->respuestaArchivo->rear_nombre }}</a>.</strong> Si selecciona otro archivo, el archivo existente será reemplazado.</p>
            </div>
        @endif
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12 text-center">
        <button class="btn btn-primary generar-tablas-niif" data-ruta="{{ route('estudiante.curso.taller.generartablasniif', ['curs_id' => $curso->curs_id, 'tall_id' => $tallerPractico->tall_id]) }}">Generar Tabla Balance de Prueba</button>
    </div>
</div>
