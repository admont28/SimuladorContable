<br>
<div class="row">
    <table class="table table-striped table-bordered table-hover taller-estado-situacion-financiera tabla-niif">
        <thead>
            <tr>
                <td colspan="3" class="text-center"><strong>{{ $tallerNiif->tani_nombreempresa }}</strong></td>
            </tr>
            <tr>
                <td colspan="3" class="text-center"><strong>ESTADO DE SITUACIÓN FINANCIERA</strong></td>
            </tr>
            <tr>
                <td colspan="3" class="text-center"><strong>{{ $tallerNiif->tani_periodo }}</strong></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="3" class="text-left"><strong>ACTIVOS</strong></td>
            </tr>
            <tr>
                <td></td>
                <td class="text-left">Efectivo y quivalentes</td>
                <td class="text-right formato_pesos">{{ $estadoSituacionFinanciera->essf_efectivoequivalentes }}</td>
            </tr>
            <tr>
                <td></td>
                <td class="text-left">Deudores</td>
                <td class="text-right formato_pesos">{{ $estadoSituacionFinanciera->essf_deudores }}</td>
            </tr>
            <tr>
                <td></td>
                <td class="text-left">Anticipo de impuesto</td>
                <td class="text-right formato_pesos">{{ $estadoSituacionFinanciera->essf_anticipoimpuesto }}</td>
            </tr>
            <tr>
                <td></td>
                <td class="text-left">Inventario</td>
                <td class="text-right formato_pesos">{{ $estadoSituacionFinanciera->essf_inventario }}</td>
            </tr>
            <tr>
                <td colspan="2" class="text-left"><strong>CORRIENTE</strong></td>
                <td class="text-right formato_pesos"><strong>{{ $estadoSituacionFinanciera->essf_activocorriente }}</strong></td>
            </tr>
            <tr>
                <td></td>
                <td class="text-left">Construcciones y edificaciones</td>
                <td class="text-right formato_pesos">{{ $estadoSituacionFinanciera->essf_construccionesedificaciones }}</td>
            </tr>
            <tr>
                <td></td>
                <td class="text-left">Equipos de oficina</td>
                <td class="text-right formato_pesos">{{ $estadoSituacionFinanciera->essf_equiposoficina }}</td>
            </tr>
            <tr>
                <td></td>
                <td class="text-left">Equipo de computación y comunicación</td>
                <td class="text-right formato_pesos">{{ $estadoSituacionFinanciera->essf_equipocomputacioncomunicacion }}</td>
            </tr>
            <tr>
                <td></td>
                <td class="text-left">Flota y equipo de transporte</td>
                <td class="text-right formato_pesos">{{ $estadoSituacionFinanciera->essf_flotaequipotransporte }}</td>
            </tr>
            <tr>
                <td colspan="2" class="text-left"><strong>NO CORRIENTE</strong></td>
                <td class="text-right formato_pesos"><strong>{{ $estadoSituacionFinanciera->essf_activonocorriente }}</strong></td>
            </tr>
            <tr>
                <td colspan="2" class="text-left"><strong>TOTAL ACTIVOS</strong></td>
                <td class="text-right formato_pesos"><strong>{{ $estadoSituacionFinanciera->essf_totalactivos }}</strong></td>
            </tr>
            <tr>
                <td colspan="3" class="text-left"></td>
            </tr>
            <tr>
                <td colspan="3" class="text-left"><strong>PASIVOS</strong></td>
            </tr>
            <tr>
                <td></td>
                <td class="text-left">Proveedores</td>
                <td class="text-right formato_pesos">{{ $estadoSituacionFinanciera->essf_proveedores }}</td>
            </tr>
            <tr>
                <td></td>
                <td class="text-left">Retención en la fuente</td>
                <td class="text-right formato_pesos">{{ $estadoSituacionFinanciera->essf_retencionfuente }}</td>
            </tr>
            <tr>
                <td></td>
                <td class="text-left">Retención y aportes de nómina</td>
                <td class="text-right formato_pesos">{{ $estadoSituacionFinanciera->essf_retencionaportesnomina }}</td>
            </tr>
            <tr>
                <td></td>
                <td class="text-left">Acreedores varios</td>
                <td class="text-right formato_pesos">{{ $estadoSituacionFinanciera->essf_acreedoresvarios }}</td>
            </tr>
            <tr>
                <td></td>
                <td class="text-left">Iva generado</td>
                <td class="text-right formato_pesos">{{ $estadoSituacionFinanciera->essf_ivagenerado }}</td>
            </tr>
            <tr>
                <td></td>
                <td class="text-left">Obligaciones laborales</td>
                <td class="text-right formato_pesos">{{ $estadoSituacionFinanciera->essf_obligacioneslaborales }}</td>
            </tr>
            <tr>
                <td></td>
                <td class="text-left">Impuestos sobre las ventas por pagar</td>
                <td class="text-right formato_pesos">{{ $estadoSituacionFinanciera->essf_impuestossobrelasventasporpagar }}</td>
            </tr>
            <tr>
                <td colspan="2" class="text-left"><strong>CORRIENTE</strong></td>
                <td class="text-right formato_pesos"><strong>{{ $estadoSituacionFinanciera->essf_pasivocorriente }}</strong></td>
            </tr>
            <tr>
                <td></td>
                <td class="text-left">Obligaciones financieras</td>
                <td class="text-right formato_pesos">{{ $estadoSituacionFinanciera->essf_obligacionesfinancieras }}</td>
            </tr>
            <tr>
                <td colspan="2" class="text-left"><strong>NO CORRIENTE</strong></td>
                <td class="text-right formato_pesos"><strong>{{ $estadoSituacionFinanciera->essf_pasivonocorriente }}</strong></td>
            </tr>
            <tr>
                <td colspan="2" class="text-left"><strong>TOTAL PASIVOS</strong></td>
                <td class="text-right formato_pesos"><strong>{{ $estadoSituacionFinanciera->essf_totalpasivos }}</strong></td>
            </tr>
            <tr>
                <td colspan="3" class="text-left"></td>
            </tr>
            <tr>
                <td colspan="3" class="text-left"><strong>PATRIMONIO</strong></td>
            </tr>
            <tr>
                <td></td>
                <td class="text-left">Aportes sociales</td>
                <td class="text-right formato_pesos">{{ $estadoSituacionFinanciera->essf_aportessociales }}</td>
            </tr>
            <tr>
                <td></td>
                <td class="text-left">Utilidad del ejercicio</td>
                <td class="text-right formato_pesos">{{ $estadoSituacionFinanciera->essf_utilidadejercicio }}</td>
            </tr>
            <tr>
                <td></td>
                <td class="text-left">Reservas obligatorias</td>
                <td class="text-right formato_pesos">{{ $estadoSituacionFinanciera->essf_reservasobligatorias }}</td>
            </tr>
            <tr>
                <td colspan="2" class="text-left"><strong>TOTAL PATRIMONIO</strong></td>
                <td class="text-right formato_pesos"><strong>{{ $estadoSituacionFinanciera->essf_totalpasivos }}</strong></td>
            </tr>
            <tr>
                <td colspan="3" class="text-left"></td>
            </tr>
            <tr>
                <td colspan="2" class="text-left"><strong>TOTAL PASIVO Y PATRIMONIO</strong></td>
                <td class="text-right formato_pesos"><strong>{{ $estadoSituacionFinanciera->essf_totalpasivopatrimonio }}</strong></td>
            </tr>
        </tbody>
    </table>
</div>
