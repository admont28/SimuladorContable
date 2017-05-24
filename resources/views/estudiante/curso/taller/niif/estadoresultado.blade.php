<br>
<div class="row">
    <table class="table table-striped table-bordered table-hover taller-estado-resultados tabla-niif">
        <thead>
            <tr>
                <td colspan="3" class="text-center"><strong>{{ $tallerNiif->tani_nombreempresa }}</strong></td>
            </tr>
            <tr>
                <td colspan="3" class="text-center"><strong>ESTADO DE RESULTADOS</strong></td>
            </tr>
            <tr>
                <td colspan="3" class="text-center"><strong>{{ $tallerNiif->tani_periodo }}</strong></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="3" class="text-left"><strong>INGRESOS OPERACIONALES</strong></td>
            </tr>
            <tr>
                <td></td>
                <td class="text-left">Ingresos operacionales</td>
                <td class="text-right formato_pesos">{{ $estadoResultado->esre_ingresosoperacionales }}</td>
            </tr>
            <tr>
                <td colspan="2" class="text-left"><strong>TOTAL INGRESOS OPERACIONALES</strong></td>
                <td class="text-right formato_pesos">{{ $estadoResultado->esre_totalingresosoperacionales }}</td>
            </tr>
            <tr>
                <td colspan="3" class="text-left"></td>
            </tr>
            <tr>
                <td colspan="2" class="text-left"><strong>COSTO VENTA</strong></td>
                <td class="text-right formato_pesos">{{ $estadoResultado->esre_costoventa }}</td>
            </tr>
            <tr>
                <td colspan="3" class="text-left"></td>
            </tr>
            <tr>
                <td colspan="2" class="text-left"><strong>UTILIDAD BRUTA</strong></td>
                <td class="text-right formato_pesos">{{ $estadoResultado->esre_utilidadbruta }}</td>
            </tr>
            <tr>
                <td colspan="3" class="text-left"></td>
            </tr>
            <tr>
                <td colspan="3" class="text-left"><strong>GASTOS OPERACIONALES</strong></td>
            </tr>
            <tr>
                <td></td>
                <td class="text-left">Gastos de personal</td>
                <td class="text-right formato_pesos">{{ $estadoResultado->esre_gastospersonal }}</td>
            </tr>
            <tr>
                <td colspan="2" class="text-left"><strong>RESULTADO DE EXPLOTACIÓN</strong></td>
                <td class="text-right formato_pesos">{{ $estadoResultado->esre_resultadoexplotacion }}</td>
            </tr>
            <tr>
                <td></td>
                <td class="text-left">Ingresos financieros</td>
                <td class="text-right formato_pesos">{{ $estadoResultado->esre_ingresosfinancieros }}</td>
            </tr>
            <tr>
                <td></td>
                <td class="text-left">Gastos financieros</td>
                <td class="text-right formato_pesos">{{ $estadoResultado->esre_gastosfinancieros }}</td>
            </tr>
            <tr>
                <td colspan="2" class="text-left"><strong>UTILIDAD ANTES IMPUESTOS</strong></td>
                <td class="text-right formato_pesos">{{ $estadoResultado->esre_utilidadantesimpuestos }}</td>
            </tr>
            <tr>
                <td colspan="3" class="text-left"></td>
            </tr>
            <tr>
                <td colspan="2" class="text-left"><strong>IMPUESTO SOBRE GANANCIAS 34%</strong></td>
                <td class="text-right formato_pesos">{{ $estadoResultado->esre_impuestosobreganancias }}</td>
            </tr>
            <tr>
                <td colspan="3" class="text-left"></td>
            </tr>
            <tr>
                <td colspan="2" class="text-left"><strong>UTILIDAD LIQUIDA</strong></td>
                <td class="text-right formato_pesos">{{ $estadoResultado->esre_utilidadliquida }}</td>
            </tr>
            <tr>
                <td colspan="3" class="text-left"></td>
            </tr>
            <tr>
                <td colspan="2" class="text-left"><strong>RESERVA LEGAL</strong></td>
                <td class="text-right formato_pesos">{{ $estadoResultado->esre_reservalegal }}</td>
            </tr>
            <tr>
                <td colspan="3" class="text-left"></td>
            </tr>
            <tr>
                <td colspan="2" class="text-left"><strong>UTILIDAD NETA DEL EJERCICIO</strong></td>
                <td class="text-right formato_pesos">{{ $estadoResultado->esre_utilidadnetaejercicio }}</td>
            </tr>
        </tbody>
    </table>
</div>
