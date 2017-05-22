<br>
<div class="row">
    <table class="table table-striped table-bordered table-hover taller-balance-prueba">
        <thead>
            <tr>
                <td colspan="4" class="text-center"><strong>{{ $tallerPractico->tallerNiif->tani_nombreempresa }}</strong></td>
            </tr>
            <tr>
                <td colspan="4" class="text-center"><strong>BALANCE DE PRUEBA</strong></td>
            </tr>
            <tr>
                <td colspan="4" class="text-center"><strong>{{ $tallerPractico->tallerNiif->tani_periodo }}</strong></td>
            </tr>
            <tr>
                <td class="text-center" width="20%"><strong>CÓDIGO</strong></td>
                <td class="text-center" width="20%"><strong>CUENTA</strong></td>
                <td class="text-center" width="25%"><strong>DÉBITO</strong></td>
                <td class="text-center" width="25%"><strong>CRÉDITO</strong></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center vcenter" width="20%"></td>
                <td class="text-center vcenter columna_cuentas" width="20%"></td>
                <td class="text-center vcenter columna_debito" contenteditable="true" width="25%" data-toggle="tooltip" title="Presiona clic para editar." data-valor-antiguo="0">$ 0</td>
                <td class="text-center vcenter columna_credito" contenteditable="true" width="25%" data-toggle="tooltip" title="Presiona clic para editar." data-valor-antiguo="0">$ 0</td>
            </tr>
            <tr>
                <td colspan="2" class="text-center"><strong>TOTAL</strong></td>
                <td class="text-center total_debito">$ 0</td>
                <td class="text-center total_credito">$ 0</td>
            </tr>
        </tbody>
    </table>
</div>
<div class="row">
    <div class="col-lg-12 text-center">
        <button class="btn btn-primary generar-tablas-niif" data-ruta="{{ route('estudiante.curso.taller.generartablasniif', ['curs_id' => $curso->curs_id, 'tall_id' => $tallerPractico->tall_id]) }}">Generar Tabla Balance de Prueba</button>
    </div>
</div>
<br>
