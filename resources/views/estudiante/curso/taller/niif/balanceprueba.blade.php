<br>
<div class="row">
    <table class="table table-striped table-bordered table-hover taller-balance-prueba tabla-niif">
        <thead>
            <tr>
                <td colspan="4" class="text-center"><strong>{{ $tallerNiif->tani_nombreempresa }}</strong></td>
            </tr>
            <tr>
                <td colspan="4" class="text-center"><strong>BALANCE DE PRUEBA</strong></td>
            </tr>
            <tr>
                <td colspan="4" class="text-center"><strong>{{ $tallerNiif->tani_periodo }}</strong></td>
            </tr>
            <tr>
                <td class="text-center" width="10%"><strong>CÓDIGO</strong></td>
                <td class="text-center" width="40%"><strong>CUENTA</strong></td>
                <td class="text-center" width="25%"><strong>DÉBITO</strong></td>
                <td class="text-center" width="25%"><strong>CRÉDITO</strong></td>
            </tr>
        </thead>
        <tbody>
            @foreach ($balancesPruebas as $bp)
                <tr>
                    <td class="text-center vcenter columna_codigo" width="10%">{{ $bp->bapr_codigo }}</td>
                    <td class="text-center vcenter columna_cuentas" width="40%">{{ $bp->bapr_cuenta }}</td>
                    <td class="text-center vcenter columna_debito formato_pesos" width="25%">{{ $bp->bapr_debito }}</td>
                    <td class="text-center vcenter columna_credito formato_pesos" width="25%">{{ $bp->bapr_credito }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="2" class="text-center"><strong>TOTAL</strong></td>
                <td class="text-center total_debito formato_pesos">$ 0</td>
                <td class="text-center total_credito formato_pesos">$ 0</td>
            </tr>
        </tbody>
    </table>
</div>
