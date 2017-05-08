@extends('estudiante.template.main')

@section('title-head', 'Ver talleres teóricos de un curso')

@section('title',' Curso: <strong>'.$curso->curs_nombre.'</strong>')

@section('active','#estudiante-curso')

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            // load a locale
            numeral.register('locale', 'es_CO', {
                delimiters: {
                    thousands: '.',
                    decimal: ','
                },
                abbreviations: {
                    thousand: 'k',
                    million: 'm',
                    billion: 'b',
                    trillion: 't'
                },
                ordinal : function (number) {
                    return number === 1 ? 'er' : 'ème';
                },
                currency: {
                    symbol: '$ '
                }
            });
            // switch between locales
            numeral.locale('es_CO');
            // '$1,000.00'*/
        });
    </script>
@endpush

@section('content')
    <div class="row">
        <h2 class="text-center"><strong>TALLERES PRÁCTICOS</strong></h2>
    </div>
    <div class="row">
        <div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs responsive" role="tablist" id="myTabs">
                @foreach ($talleresPracticos as $tallerPractico)
                    <li role="presentation" class="@if ($loop->first) active @endif"><a href="#taller_{{ $tallerPractico->tall_id }}" role="tab" data-toggle="tab">{{ $tallerPractico->tall_nombre }}</a></li>
                @endforeach
                    <li role="presentation"><a href="#puc" role="tab" data-toggle="tab">PUC</a></li>
            </ul>
            <div class="tab-content responsive">
                @foreach ($talleresPracticos as $tallerPractico)
                    <!-- Tab panes -->
                    <div role="tabpanel" class="tab-pane fade @if ($loop->first) active in @endif" id="taller_{{ $tallerPractico->tall_id }}">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Tipo de taller</div>
                                    <div class="panel-body">
                                        <div class="fs-18"><span class="label label-default">{{ $tallerPractico->tall_tipo }}</span>@if(isset($tallerPractico->tallerAsientoContable)) <span class="label label-warning">asientos contables</span> @elseif(isset($tallerPractico->tallerNomina)) <span class="label label-info">nómina</span> @endif</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Finaliza en</div>
                                    <div class="panel-body">
                                        <div data-countdown="{{ $tallerPractico->tall_tiempo }}" class="fs-18"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Archivo asociado al taller</div>
                                    <div class="panel-body">
                                        <a href="{{ $tallerPractico->tall_rutaarchivo }}">{{ $tallerPractico->tall_nombrearchivo }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (isset($tallerPractico->tarifas) && $tallerPractico->tarifas->isNotEmpty())
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Tarifas</div>
                                        <div class="panel-body">
                                            @include('estudiante.curso.taller.tarifa.index')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (isset($tallerPractico->tallerAsientoContable))
                            <div class="row">
                                <table class="table table-striped table-bordered table-hover taller-asiento-contable" id="taller-asiento-contable">
                                    <thead>
                                        <tr>
                                            <td colspan="5" class="text-center"><strong>CONTABILIZACIÓN DE LA PROVISIÓN</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center" width="20%"><strong>CÓDIGO</strong></td>
                                            <td class="text-center" width="20%"><strong>CUENTAS</strong></td>
                                            <td class="text-center" width="25%"><strong>DÉBITO</strong></td>
                                            <td class="text-center" width="25%"><strong>CRÉDITO</strong></td>
                                            <td class="text-center" width="10%"><strong>OPCIÓN</strong></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($tallerPractico->tallerAsientoContable->respuestasTallerAsientoContableUsuario()->isEmpty())
                                            @for ($i = 0; $i < 2; $i++)
                                                <tr>
                                                    <td class="text-center vcenter" width="20%">
                                                        <select class="form-control selectpicker columna_codigo with-ajax" data-live-search="true">
                                                        </select>
                                                    </td>
                                                    <td class="text-center vcenter columna_cuentas" width="20%"></td>
                                                    <td class="text-center vcenter columna_debito" contenteditable="true" width="25%" data-toggle="tooltip" title="Presiona clic para editar.">$ 0</td>
                                                    <td class="text-center vcenter columna_credito" contenteditable="true" width="25%" data-toggle="tooltip" title="Presiona clic para editar.">$ 0</td>
                                                    <td class="text-center vcenter columna_opcion" width="10%"><button class="btn btn-xs btn-danger eliminar-fila" ><i class="glyphicon glyphicon-trash"></i> Eliminar</button></td>
                                                </tr>
                                            @endfor
                                            <tr id="sumas-iguales">
                                                <td colspan="2" class="text-center"><strong>SUMAS IGUALES</strong></td>
                                                <td class="text-center total_debito" id="total_debito">$ 0</td>
                                                <td class="text-center total_credito" id="total_credito">$ 0</td>
                                                <td class="text-center"></td>
                                            </tr>
                                        @else
                                            @foreach ($tallerPractico->tallerAsientoContable->respuestasTallerAsientoContableUsuario() as $rtac)
                                                <tr>
                                                    <td class="text-center vcenter" width="20%">
                                                        <select class="form-control selectpicker columna_codigo with-ajax" data-live-search="true">
                                                            <option value="{{ $rtac->puc_id }}" data-subtext="{{ $rtac->puc->puc_nombre }}" selected="selected">{{ $rtac->puc->puc_codigo }}</option>
                                                        </select>
                                                    </td>
                                                    <td class="text-center vcenter columna_cuentas" width="20%">{{ $rtac->puc->puc_nombre }}</td>
                                                    <td class="text-center vcenter columna_debito" contenteditable="true" width="25%" data-toggle="tooltip" title="Presiona clic para editar.">{{ $rtac->rtac_valordebito }}</td>
                                                    <td class="text-center vcenter columna_credito" contenteditable="true" width="25%" data-toggle="tooltip" title="Presiona clic para editar.">{{ $rtac->rtac_valorcredito }}</td>
                                                    <td class="text-center vcenter columna_opcion" width="10%"><button class="btn btn-xs btn-danger eliminar-fila" ><i class="glyphicon glyphicon-trash"></i> Eliminar</button></td>
                                                </tr>
                                            @endforeach
                                            <tr id="sumas-iguales">
                                                <td colspan="2" class="text-center"><strong>SUMAS IGUALES</strong></td>
                                                <td class="text-center total_debito" id="total_debito">{{ $tallerPractico->tallerAsientoContable->calcularTotalDebito() }}</td>
                                                <td class="text-center total_credito" id="total_credito">{{ $tallerPractico->tallerAsientoContable->calcularTotalCredito() }}</td>
                                                <td class="text-center"></td>
                                            </tr>
                                            @push('scripts')
                                                <script type="text/javascript">
                                                    $(document).ready(function() {
                                                        $("#taller-asiento-contable > tbody > tr > td").each(function(index, el) {
                                                            if($(el).hasClass('columna_opcion')){
                                                                return;
                                                            }
                                                            else if ($(el).hasClass('columna_debito') || $(el).hasClass('columna_credito')) {
                                                                $(el).text(numeral($(el).text()).format('$0,0'));
                                                            }
                                                        });
                                                        $("#total_debito").text(numeral($("#total_debito").text()).format('$0,0'));
                                                        $("#total_credito").text(numeral($("#total_credito").text()).format('$0,0'));
                                                    });
                                                </script>
                                            @endpush
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <button class="btn btn-default adicionar-fila-asiento-contable" id="adicionar-fila-asiento-contable">Adicionar fila</button>
                                    <button class="btn btn-primary solucionar-taller-asiento-contable" id="solucionar-taller-asiento-contable" data-ruta="{{ route('estudiante.curso.taller.solucionar.asientocontable.post', ['curs_id' => $curso->curs_id, 'tall_id' => $tallerPractico->tall_id]) }}">Guardar taller</button>
                                </div>
                            </div>
                            @push('scripts')
                                <script type="text/javascript">
                                    $(document).ready(function() {

                                    });
                                </script>
                            @endpush
                        @elseif(isset($tallerPractico->tallerNomina))
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="taller-nomina">
                                        <thead>
                                            <tr>
                                                <td rowspan="2" class="text-center vcenter"><strong>NOMBRES Y APELLIDOS</strong></td>
                                                <td rowspan="2" class="text-center vcenter"><strong>DOCUMENTO</strong></td>
                                                <td rowspan="2" class="text-center vcenter"><strong>DÍAS TRABAJADOS</strong></td>
                                                <td rowspan="2" class="text-center vcenter"><strong>SALARIO</strong></td>
                                                <td colspan="7" class="text-center vcenter"><strong>DEVENGADOS</strong></td>
                                                <td colspan="{{ $tallerPractico->tallerNomina->cantidadDeducciones() + 3 }}" class="text-center vcenter"><strong>DEDUCCIONES</strong></td>
                                                <td rowspan="2" class="text-center vcenter"><strong>NETO A PAGAR</strong></td>
                                                <td colspan="2" class="text-center vcenter" data-toggle="tooltip" title="Salario básico por la cantidad de horas extra por el porcentaje 1.25  dividido 240"><strong>HORA EXTRA DIURNA</strong></td>
                                                <td colspan="2" class="text-center vcenter" data-toggle="tooltip" title="Salario básico por la cantidad de horas extra por el porcentaje 1.75  dividido 240"><strong>HORA EXTRA NOCTURNA</strong></td>
                                                <td colspan="2" class="text-center vcenter" data-toggle="tooltip" title="Salario básico por la cantidad de horas extra por el porcentaje 0.35 dividido 240"><strong>RECARGO NOCTURNO</strong></td>
                                                <td colspan="2" class="text-center vcenter" data-toggle="tooltip" title="Salario básico por la cantidad de horas extra por el porcentaje 1.75 dividido 240"><strong>HORA FESTIVA DIURNA</strong></td>
                                                <td colspan="2" class="text-center vcenter" data-toggle="tooltip" title="Salario básico por la cantidad de horas extra por el porcentaje 2.1 dividido 240"><strong>HORA FESTIVA NOCTURNA</strong></td>
                                                <td colspan="2" class="text-center vcenter" data-toggle="tooltip" title="Salario básico por la cantidad de horas extra por el porcentaje 2.0 dividido 240"><strong>HORA EXTRA FESTIVA DIURNA</strong></td>
                                                <td colspan="2" class="text-center vcenter" data-toggle="tooltip" title="Salario básico por la cantidad de horas extra por el porcentaje 2.5 dividido 240"><strong>HORA EXTRA FESTIVA NOCTURNA</strong></td>
                                                <td rowspan="2" class="text-center vcenter" data-toggle="tooltip" title="Suma de todos los valores de las horas extras"><strong>VALOR TOTAL DE HORAS EXTRAS</strong></td>
                                                <td rowspan="2" class="text-center vcenter"><strong>OPCIÓN</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center vcenter"><strong>SALARIO BÁSICO</strong></td>
                                                <td class="text-center vcenter"><strong>HORAS EXTRAS Y RECARGOS</strong></td>
                                                <td class="text-center vcenter"><strong>COMISIONES</strong></td>
                                                <td class="text-center vcenter"><strong>BONIFICACIONES</strong></td>
                                                <td class="text-center vcenter"><strong>TOTAL DEVENGADO</strong></td>
                                                <td class="text-center vcenter"><strong>AUX DE TRANSPORTE</strong></td>
                                                <td class="text-center vcenter"><strong>TOTAL DEVENGADO CON AUXILIO DE TRANSPORTE</strong></td>
                                                <td class="text-center vcenter"><strong>SALUD</strong></td>
                                                <td class="text-center vcenter"><strong>PENSIÓN</strong></td>
                                                @if (isset($tallerPractico->tallerNomina->tano_deduccionuno) && $tallerPractico->tallerNomina->tano_deduccionuno != "")
                                                    <td class="text-center vcenter"><strong>{{ $tallerPractico->tallerNomina->tano_deduccionuno }}</strong></td>
                                                @endif
                                                @if (isset($tallerPractico->tallerNomina->tano_deducciondos) && $tallerPractico->tallerNomina->tano_deducciondos != "")
                                                    <td class="text-center vcenter"><strong>{{ $tallerPractico->tallerNomina->tano_deducciondos }}</strong></td>
                                                @endif
                                                @if (isset($tallerPractico->tallerNomina->tano_deducciontres) && $tallerPractico->tallerNomina->tano_deducciontres != "")
                                                    <td class="text-center vcenter"><strong>{{ $tallerPractico->tallerNomina->tano_deducciontres }}</strong></td>
                                                @endif
                                                <td class="text-center vcenter"><strong>TOTAL DEDUCCIONES</strong></td>
                                                <td class="text-center vcenter"><strong>CANTIDAD</strong></td>
                                                <td class="text-center vcenter"><strong>VALOR</strong></td>
                                                <td class="text-center vcenter"><strong>CANTIDAD</strong></td>
                                                <td class="text-center vcenter"><strong>VALOR</strong></td>
                                                <td class="text-center vcenter"><strong>CANTIDAD</strong></td>
                                                <td class="text-center vcenter"><strong>VALOR</strong></td>
                                                <td class="text-center vcenter"><strong>CANTIDAD</strong></td>
                                                <td class="text-center vcenter"><strong>VALOR</strong></td>
                                                <td class="text-center vcenter"><strong>CANTIDAD</strong></td>
                                                <td class="text-center vcenter"><strong>VALOR</strong></td>
                                                <td class="text-center vcenter"><strong>CANTIDAD</strong></td>
                                                <td class="text-center vcenter"><strong>VALOR</strong></td>
                                                <td class="text-center vcenter"><strong>CANTIDAD</strong></td>
                                                <td class="text-center vcenter"><strong>VALOR</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for ($i = 0; $i < 2; $i++)
                                                <tr>
                                                    <td class="text-center vcenter td-nombres-y-apellidos" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar."></td>
                                                    <td class="text-center vcenter td-documento" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar."></td>
                                                    <td class="text-center vcenter td-dias-trabajados cambiar-salario-basico numero" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">0</td>
                                                    <td class="text-center vcenter td-salario cambiar-salario-basico" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">$ 0</td>
                                                    <td class="text-center vcenter td-salario-basico cambiar-total-devengado">$ 0</td>
                                                    <td class="text-center vcenter td-horas-extras-y-recargos cambiar-total-devengado">$ 0</td>
                                                    <td class="text-center vcenter td-comisiones cambiar-total-devengado" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">$ 0</td>
                                                    <td class="text-center vcenter td-bonificaciones cambiar-total-devengado" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">$ 0</td>
                                                    <td class="text-center vcenter td-total-devengado cambiar-total-devengado-con-auxilio-de-transporte">$ 0</td>
                                                    <td class="text-center vcenter td-aux-de-transporte cambiar-total-devengado-con-auxilio-de-transporte" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">$ 0</td>
                                                    <td class="text-center vcenter td-total-devengado-con-auxilio-de-transporte cambiar-neto-a-pagar">$ 0</td>
                                                    <td class="text-center vcenter td-salud cambiar-total-deducciones" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">$ 0</td>
                                                    <td class="text-center vcenter td-pension cambiar-total-deducciones" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">$ 0</td>
                                                    @if (isset($tallerPractico->tallerNomina->tano_deduccionuno) && $tallerPractico->tallerNomina->tano_deduccionuno != "")
                                                        <td class="text-center vcenter td-deduccionuno cambiar-total-deducciones" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">$ 0</td>
                                                    @endif
                                                    @if (isset($tallerPractico->tallerNomina->tano_deducciondos) && $tallerPractico->tallerNomina->tano_deducciondos != "")
                                                        <td class="text-center vcenter td-deducciondos cambiar-total-deducciones" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">$ 0</td>
                                                    @endif
                                                    @if (isset($tallerPractico->tallerNomina->tano_deducciontres) && $tallerPractico->tallerNomina->tano_deducciontres != "")
                                                        <td class="text-center vcenter td-deducciontres cambiar-total-deducciones" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">$ 0</td>
                                                    @endif
                                                    <td class="text-center vcenter td-total-deducciones cambiar-neto-a-pagar">$ 0</td>
                                                    <td class="text-center vcenter td-neto-a-pagar">$ 0</td>
                                                    <td class="text-center vcenter td-hora-extra-diurna-cantidad actualizar-horas-extras-y-valor-total numero" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">0</td>
                                                    <td class="text-center vcenter td-hora-extra-diurna-valor">$ 0</td>
                                                    <td class="text-center vcenter td-hora-extra-nocturna-cantidad actualizar-horas-extras-y-valor-total numero" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">0</td>
                                                    <td class="text-center vcenter td-hora-extra-nocturna-valor">$ 0</td>
                                                    <td class="text-center vcenter td-recargo-nocturno-cantidad actualizar-horas-extras-y-valor-total numero" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">0</td>
                                                    <td class="text-center vcenter td-recargo-nocturno-valor">$ 0</td>
                                                    <td class="text-center vcenter td-hora-festiva-diurna-cantidad actualizar-horas-extras-y-valor-total numero" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">0</td>
                                                    <td class="text-center vcenter td-hora-festiva-diurna-valor">$ 0</td>
                                                    <td class="text-center vcenter td-hora-festiva-nocturna-cantidad actualizar-horas-extras-y-valor-total numero" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">0</td>
                                                    <td class="text-center vcenter td-hora-festiva-nocturna-valor">$ 0</td>
                                                    <td class="text-center vcenter td-hora-extra-festiva-diurna-cantidad actualizar-horas-extras-y-valor-total numero" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">0</td>
                                                    <td class="text-center vcenter td-hora-extra-festiva-diurna-valor">$ 0</td>
                                                    <td class="text-center vcenter td-hora-extra-festiva-nocturna-cantidad actualizar-horas-extras-y-valor-total numero" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">0</td>
                                                    <td class="text-center vcenter td-hora-extra-festiva-nocturna-valor">$ 0</td>
                                                    <td class="text-center vcenter td-valor-total-de-horas-extras">$ 0</td>
                                                    <td class="text-center vcenter td-opcion"><button class="btn btn-xs btn-danger eliminar-fila" ><i class="glyphicon glyphicon-trash"></i> Eliminar</button></td>
                                                </tr>
                                            @endfor
                                            <tr>
                                                <td colspan="2" class="text-center vcenter valor-total-">TOTAL</td>
                                                <td class="text-center vcenter valor-total-td-dias-trabajados numero"></td>
                                                <td class="text-center vcenter valor-total-td-salario"></td>
                                                <td class="text-center vcenter valor-total-td-salario-basico"></td>
                                                <td class="text-center vcenter valor-total-td-horas-extras-y-recargos"></td>
                                                <td class="text-center vcenter valor-total-td-comisiones"></td>
                                                <td class="text-center vcenter valor-total-td-bonificaciones"></td>
                                                <td class="text-center vcenter valor-total-td-total-devengado"></td>
                                                <td class="text-center vcenter valor-total-td-aux-de-transporte"></td>
                                                <td class="text-center vcenter valor-total-td-total-devengado-con-auxilio-de-transporte"></td>
                                                <td class="text-center vcenter valor-total-td-salud"></td>
                                                <td class="text-center vcenter valor-total-td-pension"></td>
                                                @if (isset($tallerPractico->tallerNomina->tano_deduccionuno) && $tallerPractico->tallerNomina->tano_deduccionuno != "")
                                                    <td class="text-center vcenter valor-total-td-deduccionuno"></td>
                                                @endif
                                                @if (isset($tallerPractico->tallerNomina->tano_deducciondos) && $tallerPractico->tallerNomina->tano_deducciondos != "")
                                                    <td class="text-center vcenter valor-total-td-deducciondos"></td>
                                                @endif
                                                @if (isset($tallerPractico->tallerNomina->tano_deducciontres) && $tallerPractico->tallerNomina->tano_deducciontres != "")
                                                    <td class="text-center vcenter valor-total-td-deducciontres"></td>
                                                @endif
                                                <td class="text-center vcenter valor-total-td-total-deducciones"></td>
                                                <td class="text-center vcenter valor-total-td-neto-a-pagar"></td>
                                                <td class="text-center vcenter valor-total-td-hora-extra-diurna-cantidad numero"></td>
                                                <td class="text-center vcenter valor-total-td-hora-extra-diurna-valor"></td>
                                                <td class="text-center vcenter valor-total-td-hora-extra-nocturna-cantidad numero"></td>
                                                <td class="text-center vcenter valor-total-td-hora-extra-nocturna-valor"></td>
                                                <td class="text-center vcenter valor-total-td-recargo-nocturno-cantidad numero"></td>
                                                <td class="text-center vcenter valor-total-td-recargo-nocturno-valor"></td>
                                                <td class="text-center vcenter valor-total-td-hora-festiva-diurna-cantidad numero"></td>
                                                <td class="text-center vcenter valor-total-td-hora-festiva-diurna-valor"></td>
                                                <td class="text-center vcenter valor-total-td-hora-festiva-nocturna-cantidad numero"></td>
                                                <td class="text-center vcenter valor-total-td-hora-festiva-nocturna-valor"></td>
                                                <td class="text-center vcenter valor-total-td-hora-extra-festiva-diurna-cantidad numero"></td>
                                                <td class="text-center vcenter valor-total-td-hora-extra-festiva-diurna-valor"></td>
                                                <td class="text-center vcenter valor-total-td-hora-extra-festiva-nocturna-cantidad numero"></td>
                                                <td class="text-center vcenter valor-total-td-hora-extra-festiva-nocturna-valor"></td>
                                                <td class="text-center vcenter valor-total-td-valor-total-de-horas-extras"></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <button class="btn btn-default" id="adicionar-fila-nomina">Adicionar fila</button>
                                    <button class="btn btn-primary" id="solucionar-taller-nomina">Guardar taller</button>
                                </div>
                            </div>
                            @push('scripts')
                                <script type="text/javascript">
                                    $(document).ready(function() {
                                        $('#solucionar-taller-nomina').click(function(event) {
                                            event.preventDefault();
                                            $("#solucionar-taller-nomina").attr('disabled', true).text('ENVIANDO DATOS...');
                                            $("#adicionar-fila-nomina").attr('disabled', true);
                                            var filas = [];
                                            $('#taller-nomina > tbody > tr:not(:last)').each(function(index, el) {
                                                var fila = new Object();
                                                $(el).find('td').each(function(index2, el2) {
                                                    var clase = $(el2).attr('class').split(' ')[2];
                                                    var valor = "0";
                                                    if(clase== undefined || clase == 'td-opcion'){
                                                        return;
                                                    }
                                                    else if (clase == 'td-nombres-y-apellidos' || clase == 'td-documento') {
                                                        valor = $(el2).text();
                                                        if(valor == "" && $('#taller-nomina > tbody > tr:not(:last)').length > 1){
                                                            $(el).remove();
                                                        }
                                                    }else{
                                                        valor = parseInt(numeral($(el2).text()).format('0'));
                                                    }
                                                    var variable = clase.replace(/-/g,"_");
                                                    Object.defineProperty(fila,variable,{ value: valor, writable: true, enumerable: true, configurable: true });
                                                });
                                                filas.push(fila);
                                            });
                                            var datos = new Object();
                                            datos.filas = filas;
                                            var xhr =
                                                $.ajax({
                                                    url: '{{ route('estudiante.curso.taller.solucionar.nomina.post', ['curs_id' => $curso->curs_id, 'tall_id' => $tallerPractico->tall_id]) }}',
                                                    type: 'POST',
                                                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                                                    dataType: 'JSON',
                                                    data: datos,
                                                    beforeSend: function () {
                                                    },
                                                    success: function(data) {
                                                        if(data.state == "error"){
                                                            swal({
                                                                title: '¡Error!',
                                                                text: data.message,
                                                                type: 'error'
                                                            });
                                                        }else if(data.state == "success"){
                                                            swal({
                                                                title: '¡Éxito!',
                                                                text: data.message,
                                                                type: 'success'
                                                            });
                                                        }
                                                        console.log(data);
                                                    }
                                                })
                                                .done(function() {
                                                    console.log("success");
                                                })
                                                .fail(function() {
                                                    console.log("error");
                                                })
                                                .always(function() {
                                                    console.log("complete");
                                                    $("#solucionar-taller-nomina").attr('disabled', false).text('GUARDAR TALLER');
                                                    $("#adicionar-fila-nomina").attr('disabled', false);
                                                });
                                        });
                                    });
                                </script>
                            @endpush
                        @endif
                    </div>
                @endforeach
                <!-- Tab panes -->
                <div role="tabpanel" class="tab-pane fade" id="puc">
                    @include('estudiante.curso.puc.index')
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12 text-center">
            <a type="reset" class="btn btn-default" href="{{ route('estudiante.curso.ver.talleresteorico', ['curs_id' => $curso->curs_id]) }}">Regresar</a>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            // Función para activar el contador.
            $('[data-countdown]').each(function() {
                var $this = $(this);
                var finalDate = $(this).data('countdown');
                $this.countdown(finalDate)
                    .on('update.countdown', function(event) {
                        // El contador por defecto es de color verde.
                        var format = '<span class="label label-success">%H hr</span> <span class="label label-success">%M min</span> <span class="label label-success">%S seg</span>';
                        // Se valida si se debe colocar la palabra día en plural o no.
                        if(event.offset.totalDays > 0) {
                            format = '<span class="label label-success">%-d día%!d</span> ' + format;
                        }
                        // Se valida si se debe colocar la palabra semana en plural o no.
                        if(event.offset.weeks > 0) {
                            format = '<span class="label label-success">%-w semana%!w</span> ' + format;
                        }
                        // Se coloca el contador en el html
                        $(this).html(event.strftime(format));
                        // Cuando el total de días es inferior o igual a 3, se coloca en naranja el contador.
                        if(event.offset.totalDays <= 3){
                            $(this).children("span").removeClass('label-success').addClass('label-warning');
                        }
                        // Cuando el total de días es inferior o igual a 1, se coloca en rojo el contador.
                        if(event.offset.totalDays < 1 ){
                            $(this).children("span").removeClass('label-warning').addClass('label-danger');
                        }
                    })
                    // Cuando finaliza el contador se deja el siguiente mensaje.
                    .on('finish.countdown', function(event) {
                        $(this).html('<div class="alert alert-danger" role="alert">El taller ha expirado, no es posible guardar las respuestas.</div>');
                    });
            });
            $('body').on('click', '.eliminar-fila', function(event) {
                event.preventDefault();
                var cantidadFilas = $(this).parents('tbody').find('tr').length;
                if(cantidadFilas > 2){
                    $(this).parents('tr').remove();
                }else {
                    swal(
                        '¡Cuidado!',
                        'La tabla no puede quedar con menos de una fila.',
                        'warning'
                    );
                }
                $('.columna_debito[contenteditable=true]').trigger('blur');
                $('.columna_credito[contenteditable=true]').trigger('blur');
            });
            /*
                --------------------------------------------------------------------------------
                Eventos para Taller Asiento Contable
                --------------------------------------------------------------------------------
             */
            var options = {
                    "ajax": {
                        "type": "GET",
                        "url": '{{ route('estudiante.curso.puc.buscar.ajax', ['curs_id' => $curso->curs_id]) }}',
                        "data": {
                            "q": '@{{{q}}}'
                        }
                    },
                    "locale": {
                        "emptyTitle": 'Buscar un puc por su código'
                    },
                    "log": 0,
                    preprocessData: function(data){
                        var i, l = data.length, array = [];
                        if (l) {
                            for (i = 0; i < l; i++) {
                                array.push($.extend(true, data[i], {
                                    text : data[i].puc_codigo,
                                    value: data[i].puc_id,
                                    data : {
                                        subtext: data[i].puc_nombre
                                    }
                                }));
                            }
                        }
                        // You must always return a valid array when processing data. The
                        // data argument passed is a clone and cannot be modified directly.
                        return array;
                    },
                    "preserveSelected": false
                };
            $('.selectpicker').selectpicker().filter('.with-ajax').ajaxSelectPicker(options);
            $('select').trigger('change');
            var activeTab = null;
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                activeTab = e.target;
                console.log(activeTab);
                activeTab = $(activeTab).attr('href');
                console.log(activeTab);
                console.log($('.tab-content:visible'));
                console.log($('.tab-content:visible .taller-asiento-contable'));
                console.log($('.tab-content:visible').find('.taller-asiento-contable'));
            });

            //var tab_selected = $("li.tab.ui-tabs-selected a").attr("href");
            //console.log(tab_selected);
            $('.tab-content:visible').find('.taller-asiento-contable').on('change', 'select',function(event) {
                event.preventDefault();
                console.log(this);
                // Obtengo la fila en la que se modificó el select.
                var fila = $(this).data('fila');
                // Obtengo el nombre del puc, este se encuentra en el atributo data-subtext de la opción seleccionada por el usuario.
                var nombre = $(this).find('option:selected').data('subtext');
                // Cambio el nombre de la columna CUENTAS en la fila en que se modificó el select.
                $(this).parents('tr').find('td.columna_cuentas').text(nombre);

            });
            $('.tab-content:visible').find('.taller-asiento-contable').on('blur', '.columna_debito[contenteditable=true]',function(event) {
                console.log(this);
                calcularColumnaDebito(this);
            });
            $('.tab-content:visible').find('.taller-asiento-contable').on('blur', '.columna_credito[contenteditable=true]',function(event) {
                calcularColumnaCredito(this);
            });
            function calcularColumnaDebito(elemento) {
                var valorTdActual = $(elemento).text();
                var tablaActual = $(elemento).parents('table');
                valorTdActual = parseInt(numeral(valorTdActual).format('0'));
                if(isNaN(valorTdActual)){
                    swal(
                        '¡Error!',
                        'Debes introducir un número.',
                        'error'
                    );
                    valorTdActual = 0;;
                }
                var total_debito = 0;
                console.log(tablaActual);
                tablaActual.find('.columna_debito').each(function(index, el) {
                    var number = numeral($(el).text()).format('0');
                    var valorTd = parseInt(number);
                    if(!isNaN(valorTd)){
                        total_debito += valorTd;
                    }
                });
                valorTdActual = numeral(valorTdActual).format('$0,0');
                $(elemento).text(valorTdActual);
                tablaActual.find(".total_debito").text(numeral(total_debito).format('$0,0'));
            }
            function calcularColumnaCredito(elemento) {
                var valorTdActual = $(elemento).text();
                var tablaActual = $(elemento).parents('table');
                valorTdActual = parseInt(numeral(valorTdActual).format('0'));
                if(isNaN(valorTdActual)){
                    swal(
                        '¡Error!',
                        'Debes introducir un número.',
                        'error'
                    );
                    valorTdActual = 0;;
                }
                var total_credito = 0;
                tablaActual.find('.columna_credito').each(function(index, el) {
                    var number = numeral($(el).text()).format('0');
                    var valorTd = parseInt(number);
                    if(!isNaN(valorTd)){
                        total_credito += valorTd;
                    }
                });
                valorTdActual = numeral(valorTdActual).format('$0,0');
                $(elemento).text(valorTdActual);
                tablaActual.find(".total_credito").text(numeral(total_credito).format('$0,0'));
            }
            $('.tab-content:visible').find('.adicionar-fila-asiento-contable').click(function(event) {
                event.preventDefault();
                var tabla = $(this).parents('div.tab-pane').find('table');
                var filaSumasIguales = tabla.find("tbody").children().last();
                var primerFilaClonada = tabla.find("tbody").children().first().clone(true);
                var botonEliminarClonado = tabla.find("tbody > tr > td > button.eliminar-fila").first().clone(true);
                primerFilaClonada.children('td').eq(0).text('');
                primerFilaClonada.children('td').eq(1).text('');
                primerFilaClonada.children('td').eq(2).text('$ 0');
                primerFilaClonada.children('td').eq(3).text('$ 0');
                primerFilaClonada.children('td').eq(0).append('<select class="form-control selectpicker columna_codigo with-ajax" data-live-search="true"></select>');
                filaSumasIguales.remove();
                tabla.find('tbody').append(primerFilaClonada);
                tabla.find('tbody').append(filaSumasIguales);
                $('.selectpicker').selectpicker('refresh');
                $('.selectpicker').selectpicker().filter('.with-ajax').ajaxSelectPicker(options);
            });
            $('.tab-content:visible').find('.solucionar-taller-asiento-contable').click(function(event) {
                event.preventDefault();
                var botonPulsado = $(this);
                var tabla = botonPulsado.parents('div.tab-pane').find('table');
                botonPulsado.attr('disabled', true).text('ENVIANDO DATOS...');
                botonPulsado.parents("div").find(".adicionar-fila-asiento-contable").attr('disabled', true);
                var ruta = botonPulsado.data("ruta");
                var filas = [];
                tabla.find('tbody > tr:not(:last)').each(function(index, el) {
                    var tr = $(this);
                    var codigo = tr.find('.columna_codigo option:selected').val();
                    var cuentas = tr.find('.columna_cuentas').text();
                    var debito = parseInt(numeral(tr.find('.columna_debito').text()).format('0'));
                    var credito = parseInt(numeral(tr.find('.columna_credito').text()).format('0'));
                    if((codigo == undefined || codigo == "") && tabla.find('tbody > tr:not(:last)').length > 1){
                        tr.remove();
                    }else{
                        var fila = {
                            "codigo" : codigo,
                            "cuentas" : cuentas,
                            "debito" : debito,
                            "credito" : credito
                        };
                        filas.push(fila);
                    }
                });
                var sumasIguales = {
                    "total_debito" : parseInt(numeral(tabla.find('.total_debito').text()).format('0')),
                    "total_credito" : parseInt(numeral(tabla.find('.total_credito').text()).format('0'))
                }
                var datos = new Object();
                datos.filas = filas;
                datos.sumasIguales = sumasIguales;
                var xhr =
                    $.ajax({
                        url: ruta,
                        type: 'POST',
                         headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                        dataType: 'JSON',
                        data: datos,
                        beforeSend: function () {
                        },
                        success: function(data) {
                            if(data.state == "error"){
                                swal({
                                    title: '¡Error!',
                                    text: data.message,
                                    type: 'error'
                                });
                            }else if(data.state == "success"){
                                swal({
                                    title: '¡Éxito!',
                                    text: data.message,
                                    type: 'success'
                                });
                            }
                        }
                    })
                    .done(function() {
                        console.log("success");
                    })
                    .fail(function() {
                        console.log("error");
                    })
                    .always(function() {
                        console.log("complete");
                        botonPulsado.attr('disabled', false).text('GUARDAR TALLER');
                        botonPulsado.parents("div").find(".adicionar-fila-asiento-contable").attr('disabled', false);
                    });
            });
            /*
                --------------------------------------------------------------------------------
                Eventos para Taller Nomina
                --------------------------------------------------------------------------------
             */
            $("#adicionar-fila-nomina").click(function(event) {
                event.preventDefault();
                var filaTotal = $("#taller-nomina > tbody").children('tr').last();
                var primerFilaClonada = $("#taller-nomina > tbody").children().first().clone();
                var botonEliminarClonado =  $("#taller-nomina > tbody > tr > td > button.eliminar-fila").first().clone(true);
                primerFilaClonada.find('td').text('');
                primerFilaClonada.find('td').last().append(botonEliminarClonado);
                filaTotal.remove();
                $('#taller-nomina > tbody').append(primerFilaClonada);
                $('#taller-nomina > tbody').append(filaTotal);
                darFormatoACampos();
            });
            $("#taller-nomina").on('blur', '.cambiar-salario-basico[contenteditable=true]', function(event) {
                var elemento = this;
                cambiarSalarioBasico(elemento)
                    .then(function () {
                        return cambiarTotalDevengado(elemento);
                    })
                    .then(function () {
                        return cambiarTotalDevengadoConAuxilioDeTransporte(elemento);
                    })
                    .then(function () {
                        return cambiarNetoAPagar(elemento);
                    })
                    .then(function functionName() {
                        return actualzarHorasExtrasYRecargos(elemento);
                    })
                    .then(function functionName() {
                        return darFormatoACampos(elemento);
                    })
                    .then(function () {
                        return calculatTotales();
                    });
            });
            $("#taller-nomina").on('blur', '.cambiar-total-devengado[contenteditable=true]', function(event) {
                var elemento = this;
                cambiarTotalDevengado(elemento)
                    .then(function () {
                        return cambiarTotalDevengadoConAuxilioDeTransporte(elemento);
                    })
                    .then(function () {
                        return cambiarNetoAPagar(elemento);
                    })
                    .then(function () {
                        return darFormatoACampos(elemento);
                    })
                    .then(function () {
                        return calculatTotales();
                    });
            });
            $("#taller-nomina").on('blur', '.cambiar-total-devengado-con-auxilio-de-transporte[contenteditable=true]', function(event) {
                var elemento = this;
                cambiarTotalDevengadoConAuxilioDeTransporte(elemento)
                    .then(function () {
                        return cambiarNetoAPagar(elemento);
                    })
                    .then(function () {
                        return darFormatoACampos(elemento);
                    })
                    .then(function () {
                        return calculatTotales();
                    });
            });
            $("#taller-nomina").on('blur', '.cambiar-total-deducciones[contenteditable=true]', function(event) {
                var elemento = this;
                cambiarTotalDeducciones(elemento)
                    .then(function () {
                        return cambiarNetoAPagar(elemento);
                    })
                    .then(function () {
                        return darFormatoACampos(elemento);
                    })
                    .then(function () {
                        return calculatTotales();
                    });
            });
            $("#taller-nomina").on('blur', '.actualizar-horas-extras-y-valor-total', function(event) {
                var elemento = this;
                actualzarHorasExtrasYRecargos(elemento)
                    .then(function () {
                        return cambiarTotalDevengado(elemento);
                    })
                    .then(function () {
                        return cambiarTotalDevengadoConAuxilioDeTransporte(elemento);
                    })
                    .then(function () {
                        return cambiarNetoAPagar(elemento);
                    })
                    .then(function () {
                        return darFormatoACampos(elemento);
                    })
                    .then(function () {
                        return calculatTotales();
                    });
            });
            function cambiarSalarioBasico(elemento) {
                var promise = new Promise(function (resolve, reject) {
                    var filaActual = $(elemento).parents('tr');
                    var salario = parseInt(numeral(filaActual.find($(".td-salario")).text()).format('0'));
                    var diasTrabajados = parseInt(numeral(filaActual.find($(".td-dias-trabajados")).text()).format('0'));
                    if(diasTrabajados != 0 && salario != 0){
                        var salarioBasico = (salario / 30) * diasTrabajados;
                        filaActual.children((".td-salario-basico")).text(numeral(salarioBasico).format('$0,0'));
                    }
                    resolve(elemento);
                });
                return promise;
            }
            function cambiarTotalDevengado(elemento) {
                var promise = new Promise(function (resolve, reject) {
                    var filaActual = $(elemento).parents('tr');
                    var salarioBasico = parseInt(numeral(filaActual.children(".td-salario-basico").text()).format('0'));
                    var valorTotalHorasExtras = parseInt(numeral(filaActual.children(".td-horas-extras-y-recargos").text()).format('0'));
                    var comisiones = parseInt(numeral(filaActual.children(".td-comisiones").text()).format('0'));
                    var bonificaciones = parseInt(numeral(filaActual.children(".td-bonificaciones").text()).format('0'));
                    var totalDevengado = salarioBasico + valorTotalHorasExtras + comisiones + bonificaciones;
                    filaActual.children(".td-total-devengado").text(numeral(totalDevengado).format('$0,0'));
                    resolve(elemento);
                });
                return promise;
            }
            function cambiarTotalDevengadoConAuxilioDeTransporte(elemento) {
                var promise = new Promise(function (resolve, reject) {
                    var filaActual = $(elemento).parents('tr');
                    var totalDevengado = parseInt(numeral(filaActual.children((".td-total-devengado")).text()).format('0'));
                    var auxTransporte = parseInt(numeral(filaActual.children((".td-aux-de-transporte")).text()).format('0'));
                    var totalDevengadoConAuxTransporte = totalDevengado + auxTransporte;
                    filaActual.children((".td-total-devengado-con-auxilio-de-transporte")).text(numeral(totalDevengadoConAuxTransporte).format('$0,0'));
                    resolve(elemento);
                });
                return promise;

            }
            function cambiarTotalDeducciones(elemento) {
                var promise = new Promise(function (resolve, reject) {
                    var filaActual = $(elemento).parents('tr');
                    var salud = parseInt(numeral(filaActual.children((".td-salud")).text()).format('0'));
                    var pension = parseInt(numeral(filaActual.children((".td-pension")).text()).format('0'));
                    var deduccionUno = parseInt(numeral(filaActual.children((".td-deduccionuno")).text()).format('0'));
                    var deduccionDos = parseInt(numeral(filaActual.children((".td-deducciondos")).text()).format('0'));
                    var deduccionTres = parseInt(numeral(filaActual.children((".td-deducciontres")).text()).format('0'));
                    var totalDeducciones = salud + pension + deduccionUno + deduccionDos + deduccionTres;
                    filaActual.children((".td-total-deducciones")).text(numeral(totalDeducciones).format('$0,0'));
                    resolve(elemento);
                });
                return promise;
            }
            function cambiarNetoAPagar(elemento) {
                var promise = new Promise(function (resolve, reject) {
                    var filaActual = $(elemento).parents('tr');
                    var totalDevengadoConAuxTransporte = parseInt(numeral(filaActual.children((".td-total-devengado-con-auxilio-de-transporte")).text()).format('0'));
                    var totalDeducciones = parseInt(numeral(filaActual.children((".td-total-deducciones")).text()).format('0'));
                    var netoAPagar = totalDevengadoConAuxTransporte - totalDeducciones;
                    filaActual.children((".td-neto-a-pagar")).text(numeral(netoAPagar).format('$0,0'));
                    resolve(elemento);
                });
                return promise;
            }
            function darFormatoACampos() {
                $("#taller-nomina > tbody > tr:not(:last-child) > td").each(function(index, el) {
                    if($(el).hasClass('numero')){
                        $(el).text(numeral($(el).text()).format('0'));
                    }else if ($(el).hasClass('td-nombres-y-apellidos') || $(el).hasClass('td-documento') || $(el).hasClass('td-opcion')) {
                        return; //this is equivalent of 'continue' for jQuery loop
                    }
                    else{
                        $(el).text(numeral($(el).text()).format('$0,0'));
                    }
                });
            }
            function actualzarHorasExtrasYRecargos(elemento) {
                var promise = new Promise(function (resolve, reject) {
                    cambiarHoraExtraDiurna(elemento)
                        .then(function () {
                            return cambiarHoraExtraNocturna(elemento);
                        })
                        .then(function () {
                            return cambiarRecargoNocturno(elemento);
                        })
                        .then(function () {
                            return cambiarHoraFestivaDiurna(elemento);
                        })
                        .then(function () {
                            return cambiarHoraFestivaNocturna(elemento);
                        })
                        .then(function () {
                            return cambiarHoraExtraFestivaDiurna(elemento);
                        })
                        .then(function () {
                            return cambiarHoraExtraFestivaNocturna(elemento);
                        })
                        .then(function () {
                            return cambiarValorTotalDeHorasExtras(elemento);
                        })
                        .then(function () {
                            return cambiarCeldaHorasExtrasYRecargosEnDevengados(elemento);
                        })
                        .then(function functionName() {
                            resolve(elemento);
                        });
                });
                return promise;
            }
            function cambiarHoraExtraDiurna(elemento) {
                var promise = new Promise(function (resolve, reject) {
                    var filaActual = $(elemento).parents('tr');
                    var salarioBasico = parseInt(numeral(filaActual.children((".td-salario-basico")).text()).format('0'));
                    var cantidadHorasExtra = parseInt(numeral(filaActual.children(".td-hora-extra-diurna-cantidad").text()).format('0'));
                    var total = (salarioBasico * cantidadHorasExtra * 1.25) / 240;
                    filaActual.children((".td-hora-extra-diurna-valor")).text(numeral(total).format('$0,0'));
                    resolve(elemento);
                });
                return promise;
            }
            function cambiarHoraExtraNocturna(elemento) {
                var promise = new Promise(function (resolve, reject) {
                    var filaActual = $(elemento).parents('tr');
                    var salarioBasico = parseInt(numeral(filaActual.children((".td-salario-basico")).text()).format('0'));
                    var cantidadHorasExtra = parseInt(numeral(filaActual.children(".td-hora-extra-nocturna-cantidad").text()).format('0'));
                    var total = (salarioBasico * cantidadHorasExtra * 1.75) / 240;
                    filaActual.children((".td-hora-extra-nocturna-valor")).text(numeral(total).format('$0,0'));
                    resolve(elemento);
                });
                return promise;
            }
            function cambiarRecargoNocturno(elemento) {
                var promise = new Promise(function (resolve, reject) {
                    var filaActual = $(elemento).parents('tr');
                    var salarioBasico = parseInt(numeral(filaActual.children((".td-salario-basico")).text()).format('0'));
                    var cantidadHorasExtra = parseInt(numeral(filaActual.children(".td-recargo-nocturno-cantidad").text()).format('0'));
                    var total = (salarioBasico * cantidadHorasExtra * 0.35) / 240;
                    filaActual.children((".td-recargo-nocturno-valor")).text(numeral(total).format('$0,0'));
                    resolve(elemento);
                });
                return promise;
            }
            function cambiarHoraFestivaDiurna(elemento) {
                var promise = new Promise(function (resolve, reject) {
                    var filaActual = $(elemento).parents('tr');
                    var salarioBasico = parseInt(numeral(filaActual.children((".td-salario-basico")).text()).format('0'));
                    var cantidadHorasExtra = parseInt(numeral(filaActual.children(".td-hora-festiva-diurna-cantidad").text()).format('0'));
                    var total = (salarioBasico * cantidadHorasExtra * 1.75) / 240;
                    filaActual.children((".td-hora-festiva-diurna-valor")).text(numeral(total).format('$0,0'));
                    resolve(elemento);
                });
                return promise;
            }
            function cambiarHoraFestivaNocturna(elemento) {
                var promise = new Promise(function (resolve, reject) {
                    var filaActual = $(elemento).parents('tr');
                    var salarioBasico = parseInt(numeral(filaActual.children((".td-salario-basico")).text()).format('0'));
                    var cantidadHorasExtra = parseInt(numeral(filaActual.children(".td-hora-festiva-nocturna-cantidad").text()).format('0'));
                    var total = (salarioBasico * cantidadHorasExtra * 2.1) / 240;
                    filaActual.children((".td-hora-festiva-nocturna-valor")).text(numeral(total).format('$0,0'));
                    resolve(elemento);
                });
                return promise;
            }
            function cambiarHoraExtraFestivaDiurna(elemento) {
                var promise = new Promise(function (resolve, reject) {
                    var filaActual = $(elemento).parents('tr');
                    var salarioBasico = parseInt(numeral(filaActual.children((".td-salario-basico")).text()).format('0'));
                    var cantidadHorasExtra = parseInt(numeral(filaActual.children(".td-hora-extra-festiva-diurna-cantidad").text()).format('0'));
                    var total = (salarioBasico * cantidadHorasExtra * 2.0) / 240;
                    filaActual.children((".td-hora-extra-festiva-diurna-valor")).text(numeral(total).format('$0,0'));
                    resolve(elemento);
                });
                return promise;
            }
            function cambiarHoraExtraFestivaNocturna(elemento) {
                var promise = new Promise(function (resolve, reject) {
                    var filaActual = $(elemento).parents('tr');
                    var salarioBasico = parseInt(numeral(filaActual.children((".td-salario-basico")).text()).format('0'));
                    var cantidadHorasExtra = parseInt(numeral(filaActual.children(".td-hora-extra-festiva-nocturna-cantidad").text()).format('0'));
                    var total = (salarioBasico * cantidadHorasExtra * 2.5) / 240;
                    filaActual.children((".td-hora-extra-festiva-nocturna-valor")).text(numeral(total).format('$0,0'));
                    resolve(elemento);
                });
                return promise;
            }
            function cambiarValorTotalDeHorasExtras(elemento) {
                var promise = new Promise(function (resolve, reject) {
                    var filaActual = $(elemento).parents('tr');
                    var horaExtraDiurnaValor = parseInt(numeral(filaActual.children((".td-hora-extra-diurna-valor")).text()).format('0'));
                    var horaExtraNocturnaValor = parseInt(numeral(filaActual.children(".td-hora-extra-nocturna-valor").text()).format('0'));
                    var recargoNocturnoValor = parseInt(numeral(filaActual.children((".td-recargo-nocturno-valor")).text()).format('0'));
                    var horaFestivaDiurnaValor = parseInt(numeral(filaActual.children((".td-hora-festiva-diurna-valor")).text()).format('0'));
                    var horaFestivaNocturnaValor = parseInt(numeral(filaActual.children((".td-hora-festiva-nocturna-valor")).text()).format('0'));
                    var horaExtraFestivaDiurnaValor = parseInt(numeral(filaActual.children((".td-hora-extra-festiva-diurna-valor")).text()).format('0'));
                    var horaExtraFestivaNocturnaValor = parseInt(numeral(filaActual.children((".td-hora-extra-festiva-nocturna-valor")).text()).format('0'));
                    var total = horaExtraDiurnaValor + horaExtraNocturnaValor + recargoNocturnoValor + horaFestivaDiurnaValor + horaFestivaNocturnaValor + horaExtraFestivaDiurnaValor + horaExtraFestivaNocturnaValor;
                    filaActual.children((".td-valor-total-de-horas-extras")).text(numeral(total).format('$0,0'));
                    resolve(elemento);
                });
                return promise;
            }
            function cambiarCeldaHorasExtrasYRecargosEnDevengados(elemento) {
                var promise = new Promise(function (resolve, reject) {
                    var filaActual = $(elemento).parents('tr');
                    var valorTotalDeHorasExtras = parseInt(numeral(filaActual.children(".td-valor-total-de-horas-extras").text()).format('0'));
                    filaActual.children(".td-horas-extras-y-recargos").text(numeral(valorTotalDeHorasExtras).format('$0,0'));
                    resolve(elemento);
                });
                return promise;
            }
            function calculatTotales() {
                var promise = new Promise(function (resolve, reject) {
                    $("#taller-nomina > tbody > tr:first > td").each(function(index, el) {
                        if ($(el).hasClass('td-nombres-y-apellidos') || $(el).hasClass('td-documento') || $(el).hasClass('td-opcion')) {
                            return; //this is equivalent of 'continue' for jQuery loop
                        }
                        var clase = $(el).attr('class').split(' ')[2];
                        var suma = 0;
                        $("#taller-nomina > tbody > tr > td."+clase).each(function(index2, el2) {
                            suma += parseInt(numeral($(el2).text()).format('0'));
                        });
                        if($(el).hasClass('numero')){
                            $(".valor-total-"+clase).text(numeral(suma).format('0'));
                        }else{
                            $(".valor-total-"+clase).text(numeral(suma).format('$0,0'));
                        }
                    });
                });
                return promise;
            }
            $('body').tooltip({
                'selector': '[data-toggle="tooltip"]',
                'container' : 'body'
            });
        });
    </script>
    <script type="text/javascript">
        (function($) {
            fakewaffle.responsiveTabs(['xs', 'sm']);
        })(jQuery);
    </script>
@endpush
