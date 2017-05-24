@extends('profesor.template.main')

@section('title-head', 'Respuesta de taller de nómina')

@section('title')
    {!! 'Taller de nómina - Respuesta del usuario: <strong>'.$usuario->name.'</strong>' !!}
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
                    @if (isset($respuestaTallerNomina->respuestaArchivo))
                        <a href="{{ $respuestaTallerNomina->respuestaArchivo->rear_rutaarchivo }}">{{ $respuestaTallerNomina->respuestaArchivo->rear_nombre }}</a>
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
                    <h3 class="panel-title">Respuesta del usuario - Tabla de nómina</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover taller-nomina" id="taller-nomina">
                            <thead>
                                <tr>
                                    <td rowspan="2" class="text-center vcenter"><strong>NOMBRES Y APELLIDOS</strong></td>
                                    <td rowspan="2" class="text-center vcenter"><strong>DOCUMENTO</strong></td>
                                    <td rowspan="2" class="text-center vcenter"><strong>DÍAS TRABAJADOS</strong></td>
                                    <td rowspan="2" class="text-center vcenter"><strong>SALARIO</strong></td>
                                    <td colspan="7" class="text-center vcenter"><strong>DEVENGADOS</strong></td>
                                    <td colspan="{{ $tallerNomina->cantidadDeducciones() + 3 }}" class="text-center vcenter"><strong>DEDUCCIONES</strong></td>
                                    <td rowspan="2" class="text-center vcenter"><strong>NETO A PAGAR</strong></td>
                                    <td colspan="2" class="text-center vcenter" data-toggle="tooltip" title="Salario básico por la cantidad de horas extra por el porcentaje 1.25  dividido 240"><strong>HORA EXTRA DIURNA</strong></td>
                                    <td colspan="2" class="text-center vcenter" data-toggle="tooltip" title="Salario básico por la cantidad de horas extra por el porcentaje 1.75  dividido 240"><strong>HORA EXTRA NOCTURNA</strong></td>
                                    <td colspan="2" class="text-center vcenter" data-toggle="tooltip" title="Salario básico por la cantidad de horas extra por el porcentaje 0.35 dividido 240"><strong>RECARGO NOCTURNO</strong></td>
                                    <td colspan="2" class="text-center vcenter" data-toggle="tooltip" title="Salario básico por la cantidad de horas extra por el porcentaje 1.75 dividido 240"><strong>HORA FESTIVA DIURNA</strong></td>
                                    <td colspan="2" class="text-center vcenter" data-toggle="tooltip" title="Salario básico por la cantidad de horas extra por el porcentaje 2.1 dividido 240"><strong>HORA FESTIVA NOCTURNA</strong></td>
                                    <td colspan="2" class="text-center vcenter" data-toggle="tooltip" title="Salario básico por la cantidad de horas extra por el porcentaje 2.0 dividido 240"><strong>HORA EXTRA FESTIVA DIURNA</strong></td>
                                    <td colspan="2" class="text-center vcenter" data-toggle="tooltip" title="Salario básico por la cantidad de horas extra por el porcentaje 2.5 dividido 240"><strong>HORA EXTRA FESTIVA NOCTURNA</strong></td>
                                    <td rowspan="2" class="text-center vcenter" data-toggle="tooltip" title="Suma de todos los valores de las horas extras"><strong>VALOR TOTAL DE HORAS EXTRAS</strong></td>
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
                                    @if (isset($tallerNomina->tano_deduccionuno) && $tallerNomina->tano_deduccionuno != "")
                                        <td class="text-center vcenter"><strong>{{ $tallerNomina->tano_deduccionuno }}</strong></td>
                                    @endif
                                    @if (isset($tallerNomina->tano_deducciondos) && $tallerNomina->tano_deducciondos != "")
                                        <td class="text-center vcenter"><strong>{{ $tallerNomina->tano_deducciondos }}</strong></td>
                                    @endif
                                    @if (isset($tallerNomina->tano_deducciontres) && $tallerNomina->tano_deducciontres != "")
                                        <td class="text-center vcenter"><strong>{{ $tallerNomina->tano_deducciontres }}</strong></td>
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
                                @foreach ($respuestaTallerNomina->filasTallerNomina as $fitn)
                                    <tr>
                                        <td class="text-center vcenter td-nombres-y-apellidos">{{ $fitn->fitn_nombresyapellidos }}</td>
                                        <td class="text-center vcenter td-documento">{{ $fitn->fitn_documento }}</td>
                                        <td class="text-center vcenter td-dias-trabajados cambiar-salario-basico numero">{{ $fitn->fitn_diastrabajados }}</td>
                                        <td class="text-center vcenter td-salario cambiar-salario-basico">{{ $fitn->fitn_salario }}</td>
                                        <td class="text-center vcenter td-salario-basico cambiar-total-devengado">{{ $fitn->fitn_salariobasico }}</td>
                                        <td class="text-center vcenter td-horas-extras-y-recargos cambiar-total-devengado">{{ $fitn->fitn_horasextrasyrecargos }}</td>
                                        <td class="text-center vcenter td-comisiones cambiar-total-devengado">{{ $fitn->fitn_comisiones }}</td>
                                        <td class="text-center vcenter td-bonificaciones cambiar-total-devengado">{{ $fitn->fitn_bonificaciones }}</td>
                                        <td class="text-center vcenter td-total-devengado cambiar-total-devengado-con-auxilio-de-transporte">{{ $fitn->fitn_totaldevengado }}</td>
                                        <td class="text-center vcenter td-aux-de-transporte cambiar-total-devengado-con-auxilio-de-transporte">{{ $fitn->fitn_auxdetransporte }}</td>
                                        <td class="text-center vcenter td-total-devengado-con-auxilio-de-transporte cambiar-neto-a-pagar">{{ $fitn->fitn_totaldevengadoconauxiliodetransporte }}</td>
                                        <td class="text-center vcenter td-salud cambiar-total-deducciones">{{ $fitn->fitn_salud }}</td>
                                        <td class="text-center vcenter td-pension cambiar-total-deducciones">{{ $fitn->fitn_pension }}</td>
                                        @if (isset($tallerNomina->tano_deduccionuno) && $tallerNomina->tano_deduccionuno != "")
                                            <td class="text-center vcenter td-deduccionuno cambiar-total-deducciones">{{ $fitn->fitn_deduccionuno }}</td>
                                        @endif
                                        @if (isset($tallerNomina->tano_deducciondos) && $tallerNomina->tano_deducciondos != "")
                                            <td class="text-center vcenter td-deducciondos cambiar-total-deducciones">{{ $fitn->fitn_deducciondos }}</td>
                                        @endif
                                        @if (isset($tallerNomina->tano_deducciontres) && $tallerNomina->tano_deducciontres != "")
                                            <td class="text-center vcenter td-deducciontres cambiar-total-deducciones">{{ $fitn->fitn_deducciontres }}</td>
                                        @endif
                                        <td class="text-center vcenter td-total-deducciones cambiar-neto-a-pagar">{{ $fitn->fitn_totaldeducciones }}</td>
                                        <td class="text-center vcenter td-neto-a-pagar">{{ $fitn->fitn_netoapagar }}</td>
                                        <td class="text-center vcenter td-hora-extra-diurna-cantidad actualizar-horas-extras-y-valor-total numero">{{ $fitn->fitn_horaextradiurnacantidad }}</td>
                                        <td class="text-center vcenter td-hora-extra-diurna-valor">{{ $fitn->fitn_horaextradiurnavalor }}</td>
                                        <td class="text-center vcenter td-hora-extra-nocturna-cantidad actualizar-horas-extras-y-valor-total numero">{{ $fitn->fitn_horaextranocturnacantidad }}</td>
                                        <td class="text-center vcenter td-hora-extra-nocturna-valor">{{ $fitn->fitn_horaextranocturnavalor }}</td>
                                        <td class="text-center vcenter td-recargo-nocturno-cantidad actualizar-horas-extras-y-valor-total numero">{{ $fitn->fitn_recargonocturnocantidad }}</td>
                                        <td class="text-center vcenter td-recargo-nocturno-valor">{{ $fitn->fitn_recargonocturnovalor }}</td>
                                        <td class="text-center vcenter td-hora-festiva-diurna-cantidad actualizar-horas-extras-y-valor-total numero">{{ $fitn->fitn_horafestivadiurnacantidad }}</td>
                                        <td class="text-center vcenter td-hora-festiva-diurna-valor">{{ $fitn->fitn_horafestivadiurnavalor }}</td>
                                        <td class="text-center vcenter td-hora-festiva-nocturna-cantidad actualizar-horas-extras-y-valor-total numero">{{ $fitn->fitn_horafestivanocturnacantidad }}</td>
                                        <td class="text-center vcenter td-hora-festiva-nocturna-valor">{{ $fitn->fitn_horafestivanocturnavalor }}</td>
                                        <td class="text-center vcenter td-hora-extra-festiva-diurna-cantidad actualizar-horas-extras-y-valor-total numero">{{ $fitn->fitn_horaextrafestivadiurnacantidad }}</td>
                                        <td class="text-center vcenter td-hora-extra-festiva-diurna-valor">{{ $fitn->fitn_horaextrafestivadiurnavalor }}</td>
                                        <td class="text-center vcenter td-hora-extra-festiva-nocturna-cantidad actualizar-horas-extras-y-valor-total numero">{{ $fitn->fitn_horaextrafestivanocturnacantidad }}</td>
                                        <td class="text-center vcenter td-hora-extra-festiva-nocturna-valor">{{ $fitn->fitn_horaextrafestivanocturnavalor }}</td>
                                        <td class="text-center vcenter td-valor-total-de-horas-extras">{{ $fitn->fitn_valortotaldehorasextras }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="2" class="text-center vcenter td-total">TOTAL</td>
                                    <td class="text-center vcenter valor-total-td-dias-trabajados numero">{{ $respuestaTallerNomina->calcularTotalColumna('fitn_diastrabajados') }}</td>
                                    <td class="text-center vcenter valor-total-td-salario">{{ $respuestaTallerNomina->calcularTotalColumna('fitn_salario') }}</td>
                                    <td class="text-center vcenter valor-total-td-salario-basico">{{ $respuestaTallerNomina->calcularTotalColumna('fitn_salariobasico') }}</td>
                                    <td class="text-center vcenter valor-total-td-horas-extras-y-recargos">{{ $respuestaTallerNomina->calcularTotalColumna('fitn_horasextrasyrecargos') }}</td>
                                    <td class="text-center vcenter valor-total-td-comisiones">{{ $respuestaTallerNomina->calcularTotalColumna('fitn_comisiones') }}</td>
                                    <td class="text-center vcenter valor-total-td-bonificaciones">{{ $respuestaTallerNomina->calcularTotalColumna('fitn_bonificaciones') }}</td>
                                    <td class="text-center vcenter valor-total-td-total-devengado">{{ $respuestaTallerNomina->calcularTotalColumna('fitn_totaldevengado') }}</td>
                                    <td class="text-center vcenter valor-total-td-aux-de-transporte">{{ $respuestaTallerNomina->calcularTotalColumna('fitn_auxdetransporte') }}</td>
                                    <td class="text-center vcenter valor-total-td-total-devengado-con-auxilio-de-transporte">{{ $respuestaTallerNomina->calcularTotalColumna('fitn_totaldevengadoconauxiliodetransporte') }}</td>
                                    <td class="text-center vcenter valor-total-td-salud">{{ $respuestaTallerNomina->calcularTotalColumna('fitn_salud') }}</td>
                                    <td class="text-center vcenter valor-total-td-pension">{{ $respuestaTallerNomina->calcularTotalColumna('fitn_pension') }}</td>
                                    @if (isset($tallerNomina->tano_deduccionuno) && $tallerNomina->tano_deduccionuno != "")
                                        <td class="text-center vcenter valor-total-td-deduccionuno">{{ $respuestaTallerNomina->calcularTotalColumna('fitn_deduccionuno') }}</td>
                                    @endif
                                    @if (isset($tallerNomina->tano_deducciondos) && $tallerNomina->tano_deducciondos != "")
                                        <td class="text-center vcenter valor-total-td-deducciondos">{{ $respuestaTallerNomina->calcularTotalColumna('fitn_deducciondos') }}</td>
                                    @endif
                                    @if (isset($tallerNomina->tano_deducciontres) && $tallerNomina->tano_deducciontres != "")
                                        <td class="text-center vcenter valor-total-td-deducciontres">{{ $respuestaTallerNomina->calcularTotalColumna('fitn_deducciontres') }}</td>
                                    @endif
                                    <td class="text-center vcenter valor-total-td-total-deducciones">{{ $respuestaTallerNomina->calcularTotalColumna('fitn_totaldeducciones') }}</td>
                                    <td class="text-center vcenter valor-total-td-neto-a-pagar">{{ $respuestaTallerNomina->calcularTotalColumna('fitn_netoapagar') }}</td>
                                    <td class="text-center vcenter valor-total-td-hora-extra-diurna-cantidad numero">{{ $respuestaTallerNomina->calcularTotalColumna('fitn_horaextradiurnacantidad') }}</td>
                                    <td class="text-center vcenter valor-total-td-hora-extra-diurna-valor">{{ $respuestaTallerNomina->calcularTotalColumna('fitn_horaextradiurnavalor') }}</td>
                                    <td class="text-center vcenter valor-total-td-hora-extra-nocturna-cantidad numero">{{ $respuestaTallerNomina->calcularTotalColumna('fitn_horaextranocturnacantidad') }}</td>
                                    <td class="text-center vcenter valor-total-td-hora-extra-nocturna-valor">{{ $respuestaTallerNomina->calcularTotalColumna('fitn_horaextranocturnavalor') }}</td>
                                    <td class="text-center vcenter valor-total-td-recargo-nocturno-cantidad numero">{{ $respuestaTallerNomina->calcularTotalColumna('fitn_recargonocturnocantidad') }}</td>
                                    <td class="text-center vcenter valor-total-td-recargo-nocturno-valor">{{ $respuestaTallerNomina->calcularTotalColumna('fitn_recargonocturnovalor') }}</td>
                                    <td class="text-center vcenter valor-total-td-hora-festiva-diurna-cantidad numero">{{ $respuestaTallerNomina->calcularTotalColumna('fitn_horafestivadiurnacantidad') }}</td>
                                    <td class="text-center vcenter valor-total-td-hora-festiva-diurna-valor">{{ $respuestaTallerNomina->calcularTotalColumna('fitn_horafestivadiurnavalor') }}</td>
                                    <td class="text-center vcenter valor-total-td-hora-festiva-nocturna-cantidad numero">{{ $respuestaTallerNomina->calcularTotalColumna('fitn_horafestivanocturnacantidad') }}</td>
                                    <td class="text-center vcenter valor-total-td-hora-festiva-nocturna-valor">{{ $respuestaTallerNomina->calcularTotalColumna('fitn_horafestivanocturnavalor') }}</td>
                                    <td class="text-center vcenter valor-total-td-hora-extra-festiva-diurna-cantidad numero">{{ $respuestaTallerNomina->calcularTotalColumna('fitn_horaextrafestivadiurnacantidad') }}</td>
                                    <td class="text-center vcenter valor-total-td-hora-extra-festiva-diurna-valor">{{ $respuestaTallerNomina->calcularTotalColumna('fitn_horaextrafestivadiurnavalor') }}</td>
                                    <td class="text-center vcenter valor-total-td-hora-extra-festiva-nocturna-cantidad numero">{{ $respuestaTallerNomina->calcularTotalColumna('fitn_horaextrafestivanocturnacantidad') }}</td>
                                    <td class="text-center vcenter valor-total-td-hora-extra-festiva-nocturna-valor">{{ $respuestaTallerNomina->calcularTotalColumna('fitn_horaextrafestivanocturnavalor') }}</td>
                                    <td class="text-center vcenter valor-total-td-valor-total-de-horas-extras">{{ $respuestaTallerNomina->calcularTotalColumna('fitn_valortotaldehorasextras') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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
            $("#taller-nomina > tbody > tr > td").each(function(index, el) {
                if($(el).hasClass('numero')){
                    $(el).text(numeral($(el).text()).format('0'));
                }else if ($(el).hasClass('td-nombres-y-apellidos') || $(el).hasClass('td-documento') || $(el).hasClass('td-opcion') || $(el).hasClass('td-total')) {
                    return; //this is equivalent of 'continue' for jQuery loop
                }
                else{
                    $(el).text(numeral($(el).text()).format('$0,0'));
                }
            });

        });
    </script>
@endpush
