<div class="row">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover taller-nomina" id="taller-nomina">
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
                @if ($tallerPractico->tallerNomina->respuestaTallerNominaUsuarioAutenticado() === null)
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
                        <td colspan="2" class="text-center vcenter td-total">TOTAL</td>
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
                @else
                    @foreach ($tallerPractico->tallerNomina->respuestaTallerNominaUsuarioAutenticado()->filasTallerNomina as $fitn)
                        <tr>
                            <td class="text-center vcenter td-nombres-y-apellidos" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">{{ $fitn->fitn_nombresyapellidos }}</td>
                            <td class="text-center vcenter td-documento" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">{{ $fitn->fitn_documento }}</td>
                            <td class="text-center vcenter td-dias-trabajados cambiar-salario-basico numero" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">{{ $fitn->fitn_diastrabajados }}</td>
                            <td class="text-center vcenter td-salario cambiar-salario-basico" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">{{ $fitn->fitn_salario }}</td>
                            <td class="text-center vcenter td-salario-basico cambiar-total-devengado">{{ $fitn->fitn_salariobasico }}</td>
                            <td class="text-center vcenter td-horas-extras-y-recargos cambiar-total-devengado">{{ $fitn->fitn_horasextrasyrecargos }}</td>
                            <td class="text-center vcenter td-comisiones cambiar-total-devengado" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">{{ $fitn->fitn_comisiones }}</td>
                            <td class="text-center vcenter td-bonificaciones cambiar-total-devengado" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">{{ $fitn->fitn_bonificaciones }}</td>
                            <td class="text-center vcenter td-total-devengado cambiar-total-devengado-con-auxilio-de-transporte">{{ $fitn->fitn_totaldevengado }}</td>
                            <td class="text-center vcenter td-aux-de-transporte cambiar-total-devengado-con-auxilio-de-transporte" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">{{ $fitn->fitn_auxdetransporte }}</td>
                            <td class="text-center vcenter td-total-devengado-con-auxilio-de-transporte cambiar-neto-a-pagar">{{ $fitn->fitn_totaldevengadoconauxiliodetransporte }}</td>
                            <td class="text-center vcenter td-salud cambiar-total-deducciones" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">{{ $fitn->fitn_salud }}</td>
                            <td class="text-center vcenter td-pension cambiar-total-deducciones" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">{{ $fitn->fitn_pension }}</td>
                            @if (isset($tallerPractico->tallerNomina->tano_deduccionuno) && $tallerPractico->tallerNomina->tano_deduccionuno != "")
                                <td class="text-center vcenter td-deduccionuno cambiar-total-deducciones" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">{{ $fitn->fitn_deduccionuno }}</td>
                            @endif
                            @if (isset($tallerPractico->tallerNomina->tano_deducciondos) && $tallerPractico->tallerNomina->tano_deducciondos != "")
                                <td class="text-center vcenter td-deducciondos cambiar-total-deducciones" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">{{ $fitn->fitn_deducciondos }}</td>
                            @endif
                            @if (isset($tallerPractico->tallerNomina->tano_deducciontres) && $tallerPractico->tallerNomina->tano_deducciontres != "")
                                <td class="text-center vcenter td-deducciontres cambiar-total-deducciones" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">{{ $fitn->fitn_deducciontres }}</td>
                            @endif
                            <td class="text-center vcenter td-total-deducciones cambiar-neto-a-pagar">{{ $fitn->fitn_totaldeducciones }}</td>
                            <td class="text-center vcenter td-neto-a-pagar">{{ $fitn->fitn_netoapagar }}</td>
                            <td class="text-center vcenter td-hora-extra-diurna-cantidad actualizar-horas-extras-y-valor-total numero" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">{{ $fitn->fitn_horaextradiurnacantidad }}</td>
                            <td class="text-center vcenter td-hora-extra-diurna-valor">{{ $fitn->fitn_horaextradiurnavalor }}</td>
                            <td class="text-center vcenter td-hora-extra-nocturna-cantidad actualizar-horas-extras-y-valor-total numero" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">{{ $fitn->fitn_horaextranocturnacantidad }}</td>
                            <td class="text-center vcenter td-hora-extra-nocturna-valor">{{ $fitn->fitn_horaextranocturnavalor }}</td>
                            <td class="text-center vcenter td-recargo-nocturno-cantidad actualizar-horas-extras-y-valor-total numero" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">{{ $fitn->fitn_recargonocturnocantidad }}</td>
                            <td class="text-center vcenter td-recargo-nocturno-valor">{{ $fitn->fitn_recargonocturnovalor }}</td>
                            <td class="text-center vcenter td-hora-festiva-diurna-cantidad actualizar-horas-extras-y-valor-total numero" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">{{ $fitn->fitn_horafestivadiurnacantidad }}</td>
                            <td class="text-center vcenter td-hora-festiva-diurna-valor">{{ $fitn->fitn_horafestivadiurnavalor }}</td>
                            <td class="text-center vcenter td-hora-festiva-nocturna-cantidad actualizar-horas-extras-y-valor-total numero" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">{{ $fitn->fitn_horafestivanocturnacantidad }}</td>
                            <td class="text-center vcenter td-hora-festiva-nocturna-valor">{{ $fitn->fitn_horafestivanocturnavalor }}</td>
                            <td class="text-center vcenter td-hora-extra-festiva-diurna-cantidad actualizar-horas-extras-y-valor-total numero" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">{{ $fitn->fitn_horaextrafestivadiurnacantidad }}</td>
                            <td class="text-center vcenter td-hora-extra-festiva-diurna-valor">{{ $fitn->fitn_horaextrafestivadiurnavalor }}</td>
                            <td class="text-center vcenter td-hora-extra-festiva-nocturna-cantidad actualizar-horas-extras-y-valor-total numero" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">{{ $fitn->fitn_horaextrafestivanocturnacantidad }}</td>
                            <td class="text-center vcenter td-hora-extra-festiva-nocturna-valor">{{ $fitn->fitn_horaextrafestivanocturnavalor }}</td>
                            <td class="text-center vcenter td-valor-total-de-horas-extras">{{ $fitn->fitn_valortotaldehorasextras }}</td>
                            <td class="text-center vcenter td-opcion"><button class="btn btn-xs btn-danger eliminar-fila" ><i class="glyphicon glyphicon-trash"></i> Eliminar</button></td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="2" class="text-center vcenter td-total">TOTAL</td>
                        <td class="text-center vcenter valor-total-td-dias-trabajados numero">{{ $tallerPractico->tallerNomina->respuestaTallerNominaUsuarioAutenticado()->calcularTotalColumna('fitn_diastrabajados') }}</td>
                        <td class="text-center vcenter valor-total-td-salario">{{ $tallerPractico->tallerNomina->respuestaTallerNominaUsuarioAutenticado()->calcularTotalColumna('fitn_salario') }}</td>
                        <td class="text-center vcenter valor-total-td-salario-basico">{{ $tallerPractico->tallerNomina->respuestaTallerNominaUsuarioAutenticado()->calcularTotalColumna('fitn_salariobasico') }}</td>
                        <td class="text-center vcenter valor-total-td-horas-extras-y-recargos">{{ $tallerPractico->tallerNomina->respuestaTallerNominaUsuarioAutenticado()->calcularTotalColumna('fitn_horasextrasyrecargos') }}</td>
                        <td class="text-center vcenter valor-total-td-comisiones">{{ $tallerPractico->tallerNomina->respuestaTallerNominaUsuarioAutenticado()->calcularTotalColumna('fitn_comisiones') }}</td>
                        <td class="text-center vcenter valor-total-td-bonificaciones">{{ $tallerPractico->tallerNomina->respuestaTallerNominaUsuarioAutenticado()->calcularTotalColumna('fitn_bonificaciones') }}</td>
                        <td class="text-center vcenter valor-total-td-total-devengado">{{ $tallerPractico->tallerNomina->respuestaTallerNominaUsuarioAutenticado()->calcularTotalColumna('fitn_totaldevengado') }}</td>
                        <td class="text-center vcenter valor-total-td-aux-de-transporte">{{ $tallerPractico->tallerNomina->respuestaTallerNominaUsuarioAutenticado()->calcularTotalColumna('fitn_auxdetransporte') }}</td>
                        <td class="text-center vcenter valor-total-td-total-devengado-con-auxilio-de-transporte">{{ $tallerPractico->tallerNomina->respuestaTallerNominaUsuarioAutenticado()->calcularTotalColumna('fitn_totaldevengadoconauxiliodetransporte') }}</td>
                        <td class="text-center vcenter valor-total-td-salud">{{ $tallerPractico->tallerNomina->respuestaTallerNominaUsuarioAutenticado()->calcularTotalColumna('fitn_salud') }}</td>
                        <td class="text-center vcenter valor-total-td-pension">{{ $tallerPractico->tallerNomina->respuestaTallerNominaUsuarioAutenticado()->calcularTotalColumna('fitn_pension') }}</td>
                        @if (isset($tallerPractico->tallerNomina->tano_deduccionuno) && $tallerPractico->tallerNomina->tano_deduccionuno != "")
                            <td class="text-center vcenter valor-total-td-deduccionuno">{{ $tallerPractico->tallerNomina->respuestaTallerNominaUsuarioAutenticado()->calcularTotalColumna('fitn_deduccionuno') }}</td>
                        @endif
                        @if (isset($tallerPractico->tallerNomina->tano_deducciondos) && $tallerPractico->tallerNomina->tano_deducciondos != "")
                            <td class="text-center vcenter valor-total-td-deducciondos">{{ $tallerPractico->tallerNomina->respuestaTallerNominaUsuarioAutenticado()->calcularTotalColumna('fitn_deducciondos') }}</td>
                        @endif
                        @if (isset($tallerPractico->tallerNomina->tano_deducciontres) && $tallerPractico->tallerNomina->tano_deducciontres != "")
                            <td class="text-center vcenter valor-total-td-deducciontres">{{ $tallerPractico->tallerNomina->respuestaTallerNominaUsuarioAutenticado()->calcularTotalColumna('fitn_deducciontres') }}</td>
                        @endif
                        <td class="text-center vcenter valor-total-td-total-deducciones">{{ $tallerPractico->tallerNomina->respuestaTallerNominaUsuarioAutenticado()->calcularTotalColumna('fitn_totaldeducciones') }}</td>
                        <td class="text-center vcenter valor-total-td-neto-a-pagar">{{ $tallerPractico->tallerNomina->respuestaTallerNominaUsuarioAutenticado()->calcularTotalColumna('fitn_netoapagar') }}</td>
                        <td class="text-center vcenter valor-total-td-hora-extra-diurna-cantidad numero">{{ $tallerPractico->tallerNomina->respuestaTallerNominaUsuarioAutenticado()->calcularTotalColumna('fitn_horaextradiurnacantidad') }}</td>
                        <td class="text-center vcenter valor-total-td-hora-extra-diurna-valor">{{ $tallerPractico->tallerNomina->respuestaTallerNominaUsuarioAutenticado()->calcularTotalColumna('fitn_horaextradiurnavalor') }}</td>
                        <td class="text-center vcenter valor-total-td-hora-extra-nocturna-cantidad numero">{{ $tallerPractico->tallerNomina->respuestaTallerNominaUsuarioAutenticado()->calcularTotalColumna('fitn_horaextranocturnacantidad') }}</td>
                        <td class="text-center vcenter valor-total-td-hora-extra-nocturna-valor">{{ $tallerPractico->tallerNomina->respuestaTallerNominaUsuarioAutenticado()->calcularTotalColumna('fitn_horaextranocturnavalor') }}</td>
                        <td class="text-center vcenter valor-total-td-recargo-nocturno-cantidad numero">{{ $tallerPractico->tallerNomina->respuestaTallerNominaUsuarioAutenticado()->calcularTotalColumna('fitn_recargonocturnocantidad') }}</td>
                        <td class="text-center vcenter valor-total-td-recargo-nocturno-valor">{{ $tallerPractico->tallerNomina->respuestaTallerNominaUsuarioAutenticado()->calcularTotalColumna('fitn_recargonocturnovalor') }}</td>
                        <td class="text-center vcenter valor-total-td-hora-festiva-diurna-cantidad numero">{{ $tallerPractico->tallerNomina->respuestaTallerNominaUsuarioAutenticado()->calcularTotalColumna('fitn_horafestivadiurnacantidad') }}</td>
                        <td class="text-center vcenter valor-total-td-hora-festiva-diurna-valor">{{ $tallerPractico->tallerNomina->respuestaTallerNominaUsuarioAutenticado()->calcularTotalColumna('fitn_horafestivadiurnavalor') }}</td>
                        <td class="text-center vcenter valor-total-td-hora-festiva-nocturna-cantidad numero">{{ $tallerPractico->tallerNomina->respuestaTallerNominaUsuarioAutenticado()->calcularTotalColumna('fitn_horafestivanocturnacantidad') }}</td>
                        <td class="text-center vcenter valor-total-td-hora-festiva-nocturna-valor">{{ $tallerPractico->tallerNomina->respuestaTallerNominaUsuarioAutenticado()->calcularTotalColumna('fitn_horafestivanocturnavalor') }}</td>
                        <td class="text-center vcenter valor-total-td-hora-extra-festiva-diurna-cantidad numero">{{ $tallerPractico->tallerNomina->respuestaTallerNominaUsuarioAutenticado()->calcularTotalColumna('fitn_horaextrafestivadiurnacantidad') }}</td>
                        <td class="text-center vcenter valor-total-td-hora-extra-festiva-diurna-valor">{{ $tallerPractico->tallerNomina->respuestaTallerNominaUsuarioAutenticado()->calcularTotalColumna('fitn_horaextrafestivadiurnavalor') }}</td>
                        <td class="text-center vcenter valor-total-td-hora-extra-festiva-nocturna-cantidad numero">{{ $tallerPractico->tallerNomina->respuestaTallerNominaUsuarioAutenticado()->calcularTotalColumna('fitn_horaextrafestivanocturnacantidad') }}</td>
                        <td class="text-center vcenter valor-total-td-hora-extra-festiva-nocturna-valor">{{ $tallerPractico->tallerNomina->respuestaTallerNominaUsuarioAutenticado()->calcularTotalColumna('fitn_horaextrafestivanocturnavalor') }}</td>
                        <td class="text-center vcenter valor-total-td-valor-total-de-horas-extras">{{ $tallerPractico->tallerNomina->respuestaTallerNominaUsuarioAutenticado()->calcularTotalColumna('fitn_valortotaldehorasextras') }}</td>
                        <td class="td-vacio"></td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12 text-center">
        <div class="form-group">
            <label for="archivo_taller_nomina" class="col-lg-2 control-label">Archivo</label>
            <div class="col-lg-10">
                <input type="file" class="form-control" placeholder="ruta del archivo" name="archivo_taller_nomina">
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        @if (isset($tallerPractico->tallerNomina->respuestaTallerNominaUsuarioAutenticado()->rear_id))
            <div class="alert alert-info" role="alert">
                <p>Usted ya ha cargado el siguiente archivo: <strong><a class="alert-link" target="_blank" href="{{ $tallerPractico->tallerNomina->respuestaTallerNominaUsuarioAutenticado()->respuestaArchivo->rear_rutaarchivo }}">{{ $tallerPractico->tallerNomina->respuestaTallerNominaUsuarioAutenticado()->respuestaArchivo->rear_nombre }}</a>.</strong> Si selecciona otro archivo, el archivo existente será reemplazado.</p>
            </div>
        @endif
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12 text-center">
        <button class="btn btn-default adicionar-fila-nomina" id="adicionar-fila-nomina">Adicionar fila</button>
        <button class="btn btn-primary solucionar-taller-nomina" id="solucionar-taller-nomina" data-ruta="{{ route('estudiante.curso.taller.solucionar.nomina.post', ['curs_id' => $curso->curs_id, 'tall_id' => $tallerPractico->tall_id]) }}">Guardar taller</button>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            /*
                --------------------------------------------------------------------------------
                Eventos para Taller Nomina
                --------------------------------------------------------------------------------
             */
            $('.tab-content:visible').find(".adicionar-fila-nomina").click(function(event) {
                event.preventDefault();
                var tabla = $(this).parents('div.tab-pane').find('table.taller-nomina');
                var filaTotal = tabla.find("tbody").children('tr').last();
                var primerFilaClonada = tabla.find("tbody").children().first().clone();
                var botonEliminarClonado =  tabla.find("tbody > tr > td > button.eliminar-fila").first().clone(true);
                primerFilaClonada.find('td').text('');
                primerFilaClonada.find('td').last().append(botonEliminarClonado);
                filaTotal.remove();
                tabla.find("tbody").append(primerFilaClonada);
                tabla.find("tbody").append(filaTotal);
                darFormatoACampos(filaTotal);
            });
            $('.tab-content:visible').find(".taller-nomina").on('blur', '.cambiar-salario-basico[contenteditable=true]', function(event) {
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
                        return calcularTotales(elemento);
                    });
            });
            $('.tab-content:visible').find(".taller-nomina").on('blur', '.cambiar-total-devengado[contenteditable=true]', function(event) {
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
                        return calcularTotales(elemento);
                    });
            });
            $('.tab-content:visible').find(".taller-nomina").on('blur', '.cambiar-total-devengado-con-auxilio-de-transporte[contenteditable=true]', function(event) {
                var elemento = this;
                cambiarTotalDevengadoConAuxilioDeTransporte(elemento)
                    .then(function () {
                        return cambiarNetoAPagar(elemento);
                    })
                    .then(function () {
                        return darFormatoACampos(elemento);
                    })
                    .then(function () {
                        return calcularTotales(elemento);
                    });
            });
            $('.tab-content:visible').find(".taller-nomina").on('blur', '.cambiar-total-deducciones[contenteditable=true]', function(event) {
                var elemento = this;
                cambiarTotalDeducciones(elemento)
                    .then(function () {
                        return cambiarNetoAPagar(elemento);
                    })
                    .then(function () {
                        return darFormatoACampos(elemento);
                    })
                    .then(function () {
                        return calcularTotales(elemento);
                    });
            });
            $('.tab-content:visible').find(".taller-nomina").on('blur', '.actualizar-horas-extras-y-valor-total', function(event) {
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
                        return calcularTotales(elemento);
                    });
            });
            $('.tab-content:visible').find(".solucionar-taller-nomina").click(function(event) {
                event.preventDefault();
                var botonPulsado = $(this);
                var tabPanelActivo = botonPulsado.parents('div.tab-pane');
                var tabla = tabPanelActivo.find('table.taller-nomina');
                var textoOriginal = botonPulsado.text();
                botonPulsado.attr('disabled', true).text('ENVIANDO DATOS...');
                botonPulsado.parents("div").find(".adicionar-fila-nomina").attr('disabled', true);
                var ruta = botonPulsado.data("ruta");
                var inputFileImage = tabPanelActivo.find('input[type=file]');
                var archivo = inputFileImage[0].files[0];
                var filas = [];
                var ultimaFila = tabla.find('tbody > tr:last');
                tabla.find('tbody > tr:not(:last)').each(function(index, el) {
                    var fila = new Object();
                    var tr = $(this);
                    $(el).find('td').each(function(index2, el2) {
                        var clase = $(el2).attr('class').split(' ')[2];
                        var valor = "0";
                        if(clase== undefined || clase == 'td-opcion'){
                            return;
                        }
                        else if (clase == 'td-nombres-y-apellidos' || clase == 'td-documento') {
                            valor = $(el2).text();
                            if(valor == "" && tabla.find('tbody > tr:not(:last)').length > 1){
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
                var data = new FormData();
                data.append('archivo_taller_nomina',archivo);
                data.append('filas',JSON.stringify(filas));
                var xhr =
                    $.ajax({
                        url: ruta,
                        type: 'POST',
                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                        dataType: 'JSON',
                        //necesario para subir archivos via ajax
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: data,
                        beforeSend: function () {
                        },
                        success: function(data) {
                            console.log(data);
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
                            if(data.archivo != null){
                                tabPanelActivo.find('.alert-link').attr('href', data.archivo.rear_rutaarchivo).text(data.archivo.rear_nombre);
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
                        calcularTotales(ultimaFila);
                        botonPulsado.attr('disabled', false).text(textoOriginal);
                        botonPulsado.parents("div").find(".adicionar-fila-nomina").attr('disabled', false);;
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
            function darFormatoACampos(elemento) {
                var tabla = $(elemento).parents("table");
                tabla.find("tbody > tr:not(:last-child) > td").each(function(index, el) {
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
            function calcularTotales(elemento) {
                var promise = new Promise(function (resolve, reject) {
                    var tabla = $(elemento).parents("table");
                    tabla.find("tbody > tr:first > td").each(function(index, el) {
                        if ($(el).hasClass('td-nombres-y-apellidos') || $(el).hasClass('td-documento') || $(el).hasClass('td-opcion')) {
                            return; //this is equivalent of 'continue' for jQuery loop
                        }
                        var clase = $(el).attr('class').split(' ')[2];
                        var suma = 0;
                        tabla.find("tbody > tr > td."+clase).each(function(index2, el2) {
                            suma += parseInt(numeral($(el2).text()).format('0'));
                        });
                        if($(el).hasClass('numero')){
                            tabla.find(".valor-total-"+clase).text(numeral(suma).format('0'));
                        }else{
                            tabla.find(".valor-total-"+clase).text(numeral(suma).format('$0,0'));
                        }
                    });
                });
                return promise;
            }
            darFomatoACamposTallerNomina();
            function darFomatoACamposTallerNomina() {
                $(".taller-nomina > tbody > tr > td").each(function(index, el) {
                    if ($(el).hasClass('td-nombres-y-apellidos') || $(el).hasClass('td-documento') || $(el).hasClass('td-opcion') || $(el).hasClass('td-total') || $(el).hasClass('td-vacio')) {
                        return; //this is equivalent of 'continue' for jQuery loop
                    }else if($(el).hasClass('numero')){
                        $(el).text(numeral($(el).text()).format('0'));
                    }
                    else{
                        $(el).text(numeral($(el).text()).format('$0,0'));
                    }
                });
            }
        });
    </script>
@endpush
