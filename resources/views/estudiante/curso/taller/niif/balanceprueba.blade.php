<br>
<div class="row">
    <table class="table table-striped table-bordered table-hover taller-balance-prueba">
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
            @foreach ($filas as $fila)
                <tr>
                    <td class="text-center vcenter columna_codigo" width="10%">{{ $fila->puc->puc_codigo }}</td>
                    <td class="text-center vcenter columna_cuentas" width="40%">{{ $fila->puc->puc_nombre }}</td>
                    @if ($fila->primerDigito == 1 || $fila->primerDigito == 5 || $fila->primerDigito == 6)
                        @if ($fila->valor >= 0)
                            <td class="text-center vcenter columna_debito" width="25%">{{ $fila->valor }}</td>
                            <td class="text-center vcenter columna_credito" width="25%"></td>
                        @else
                            <td class="text-center vcenter columna_debito" width="25%"></td>
                            <td class="text-center vcenter columna_credito" width="25%">{{ $fila->valor }}</td>
                        @endif
                    @elseif ($fila->primerDigito == 2 || $fila->primerDigito == 3 || $fila->primerDigito == 4 || $fila->primerDigito == 7)
                        @if ($fila->valor >= 0)
                            <td class="text-center vcenter columna_debito" width="25%"></td>
                            <td class="text-center vcenter columna_credito" width="25%">{{ $fila->valor }}</td>
                        @else
                            <td class="text-center vcenter columna_debito" width="25%">{{ $fila->valor }}</td>
                            <td class="text-center vcenter columna_credito" width="25%"></td>
                        @endif
                    @endif
                </tr>
            @endforeach
            <tr>
                <td colspan="2" class="text-center"><strong>TOTAL</strong></td>
                <td class="text-center total_debito">$ 0</td>
                <td class="text-center total_credito">$ 0</td>
            </tr>
        </tbody>
    </table>
</div>
