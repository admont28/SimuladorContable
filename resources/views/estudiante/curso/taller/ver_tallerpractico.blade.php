@extends('estudiante.template.main')

@section('title-head', 'Ver talleres teóricos de un curso')

@section('title',' Curso: <strong>'.$curso->curs_nombre.'</strong>')

@section('active','#estudiante-curso')

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
                                <table class="table table-striped table-bordered table-hover" id="taller-asiento-contable">
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
                                            <tr>
                                                <td class="text-center" width="20%">
                                                    <select class="form-control selectpicker columna_codigo with-ajax" data-live-search="true">
                                                    </select>
                                                </td>
                                                <td class="text-center columna_cuentas" width="20%"></td>
                                                <td class="text-center columna_debito" contenteditable="true" width="25%" data-toggle="tooltip" title="Presiona clic para editar.">$ 0</td>
                                                <td class="text-center columna_credito" contenteditable="true" width="25%" data-toggle="tooltip" title="Presiona clic para editar.">$ 0</td>
                                                <td class="text-center" width="10%"><button class="btn btn-xs btn-danger eliminar-fila" ><i class="glyphicon glyphicon-trash"></i> Eliminar</button></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center" width="20%">
                                                    <select class="form-control selectpicker columna_codigo with-ajax" data-live-search="true">
                                                    </select>
                                                </td>
                                                <td class="text-center columna_cuentas" width="20%"></td>
                                                <td class="text-center columna_debito" contenteditable="true" width="25%" data-toggle="tooltip" title="Presiona clic para editar.">$ 0</td>
                                                <td class="text-center columna_credito" contenteditable="true" width="25%" data-toggle="tooltip" title="Presiona clic para editar.">$ 0</td>
                                                <td class="text-center" width="10%"><button class="btn btn-xs btn-danger eliminar-fila" ><i class="glyphicon glyphicon-trash"></i> Eliminar</button></td>
                                            </tr>
                                        @else
                                            @foreach ($tallerPractico->tallerAsientoContable->respuestasTallerAsientoContableUsuario() as $rtac)
                                                <tr>
                                                    <td class="text-center" width="20%">
                                                        <select class="form-control selectpicker columna_codigo with-ajax" data-live-search="true">
                                                            <option value="{{ $rtac->puc_id }}" data-subtext="{{ $rtac->puc->puc_nombre }}" selected="selected">{{ $rtac->puc->puc_codigo }}</option>
                                                        </select>
                                                    </td>
                                                    <td class="text-center columna_cuentas" width="20%">{{ $rtac->puc->puc_nombre }}</td>
                                                    <td class="text-center columna_debito" contenteditable="true" width="25%" data-toggle="tooltip" title="Presiona clic para editar.">{{ $rtac->rtac_valordebito }}</td>
                                                    <td class="text-center columna_credito" contenteditable="true" width="25%" data-toggle="tooltip" title="Presiona clic para editar.">{{ $rtac->rtac_valorcredito }}</td>
                                                    <td class="text-center" width="10%"><button class="btn btn-xs btn-danger eliminar-fila" ><i class="glyphicon glyphicon-trash"></i> Eliminar</button></td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        <tr id="sumas-iguales">
                                            <td colspan="2" class="text-center"><strong>SUMAS IGUALES</strong></td>
                                            <td class="text-center" id="total_debito">$ 0</td>
                                            <td class="text-center" id="total_credito">$ 0</td>
                                            <td class="text-center"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <button class="btn btn-default" id="adicionar-fila-asiento-contable">Adicionar fila</button>
                                    <button class="btn btn-primary" id="solucionar-taller-asiento-contable">Guardar taller</button>
                                </div>
                            </div>
                            @push('scripts')
                                <script type="text/javascript">
                                    $(document).ready(function() {
                                        $('#solucionar-taller-asiento-contable').click(function(event) {
                                            event.preventDefault();
                                            $("#solucionar-taller-asiento-contable").attr('disabled', true).text('ENVIANDO DATOS...');
                                            $("#adicionar-fila-asiento-contable").attr('disabled', true);
                                            if(xhr && xhr.readyState != 4) {
                                                xhr.abort();
                                                console.log("Abortando");
                                                swal({
                                                    title: '¡Error!',
                                                    text: 'Tus datos se están enviando al servidor, por favor espera a que sean almacenados.',
                                                    type: 'error'
                                                });
                                            }
                                            var filas = [];
                                            $('#taller-asiento-contable > tbody > tr ').each(function(index, el) {
                                                var codigo = $(this).find('.columna_codigo option:selected').val();
                                                var cuentas = $(this).find('.columna_cuentas').text();
                                                var debito = parseInt(numeral($(this).find('.columna_debito').text()).format('0'));
                                                var credito = parseInt(numeral($(this).find('.columna_credito').text()).format('0'));
                                                console.log(codigo);
                                                if((codigo === undefined || codigo == "" ) && $(this).attr('id') != "sumas-iguales"){
                                                    console.log($(this));
                                                    $(this).remove();
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
                                                "total_debito" : parseInt(numeral($('#total_debito').text()).format('0')),
                                                "total_credito" : parseInt(numeral($('#total_credito').text()).format('0'))
                                            }
                                            var datos = new Object();
                                            datos.filas = filas;
                                            datos.sumasIguales = sumasIguales;
                                            console.log(datos);
                                            console.log(JSON.stringify(filas));
                                            var xhr =
                                                $.ajax({
                                                    url: '{{ route('estudiante.curso.taller.solucionar.asientocontable.post', ['curs_id' => $curso->curs_id, 'tall_id' => $tallerPractico->tall_id]) }}',
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
                                                    $("#solucionar-taller-asiento-contable").attr('disabled', false).text('GUARDAR TALLER');
                                                    $("#adicionar-fila-asiento-contable").attr('disabled', false);
                                                });
                                        });
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
                                                    <td class="text-center vcenter" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar."></td>
                                                    <td class="text-center vcenter" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar."></td>
                                                    <td class="text-center vcenter" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar."></td>
                                                    <td class="text-center vcenter" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar."></td>
                                                    <td class="text-center vcenter"></td>
                                                    <td class="text-center vcenter"></td>
                                                    <td class="text-center vcenter" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar."></td>
                                                    <td class="text-center vcenter" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar."></td>
                                                    <td class="text-center vcenter"></td>
                                                    <td class="text-center vcenter" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar."></td>
                                                    <td class="text-center vcenter"></td>
                                                    <td class="text-center vcenter" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar."></td>
                                                    <td class="text-center vcenter" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar."></td>
                                                    @if (isset($tallerPractico->tallerNomina->tano_deduccionuno) && $tallerPractico->tallerNomina->tano_deduccionuno != "")
                                                        <td class="text-center vcenter vcenter" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar."></td>
                                                    @endif
                                                    @if (isset($tallerPractico->tallerNomina->tano_deducciondos) && $tallerPractico->tallerNomina->tano_deducciondos != "")
                                                        <td class="text-center vcenter vcenter" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar."></td>
                                                    @endif
                                                    @if (isset($tallerPractico->tallerNomina->tano_deducciontres) && $tallerPractico->tallerNomina->tano_deducciontres != "")
                                                        <td class="text-center vcenter vcenter" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar."</td>
                                                    @endif
                                                    <td class="text-center vcenter"></td>
                                                    <td class="text-center vcenter"></td>
                                                    <td class="text-center vcenter" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar."></td>
                                                    <td class="text-center vcenter" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar."></td>
                                                    <td class="text-center vcenter" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar."></td>
                                                    <td class="text-center vcenter" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar."></td>
                                                    <td class="text-center vcenter" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar."></td>
                                                    <td class="text-center vcenter" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar."></td>
                                                    <td class="text-center vcenter" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar."></td>
                                                    <td class="text-center vcenter" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar."></td>
                                                    <td class="text-center vcenter" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar."></td>
                                                    <td class="text-center vcenter" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar."></td>
                                                    <td class="text-center vcenter" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar."></td>
                                                    <td class="text-center vcenter" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar."></td>
                                                    <td class="text-center vcenter" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar."></td>
                                                    <td class="text-center vcenter" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar."></td>
                                                    <td class="text-center vcenter"></td>
                                                    <td class="text-center"><button class="btn btn-xs btn-danger eliminar-fila" ><i class="glyphicon glyphicon-trash"></i> Eliminar</button></td>
                                                </tr>
                                            @endfor
                                            <tr>
                                                <td colspan="2" class="text-center">TOTAL</td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
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
            // '$1,000.00'
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
                $(this).parents('tr').remove();
                $('.columna_debito[contenteditable=true]').trigger('blur');
                $('.columna_credito[contenteditable=true]').trigger('blur');
            });
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
            $('#taller-asiento-contable').on('change', 'select',function(event) {
                event.preventDefault();
                /* Act on the event */
                // Obtengo la fila en la que se modificó el select.
                var fila = $(this).data('fila');
                // Obtengo el nombre del puc, este se encuentra en el atributo data-subtext de la opción seleccionada por el usuario.
                var nombre = $(this).find('option:selected').data('subtext');
                // Cambio el nombre de la columna CUENTAS en la fila en que se modificó el select.
                $(this).parents('tr').find('td.columna_cuentas').text(nombre);
                console.log($(this).parents('tr'));

            });
            $('#taller-asiento-contable').on('blur', '.columna_debito[contenteditable=true]',function(event) {
                var valorTdActual = $(this).text();
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
                $('.columna_debito').each(function(index, el) {
                    var number = numeral($(el).text()).format('0');
                    var valorTd = parseInt(number);
                    if(!isNaN(valorTd)){
                        total_debito += valorTd;
                    }
                });
                valorTdActual = numeral(valorTdActual).format('$0,0');
                $(this).text(valorTdActual);
                $("#total_debito").text(numeral(total_debito).format('$0,0'));
            });
            $('#taller-asiento-contable').on('blur', '.columna_credito[contenteditable=true]',function(event) {
                var valorTdActual = $(this).text();
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
                $('.columna_credito').each(function(index, el) {
                    var number = numeral($(el).text()).format('0');
                    var valorTd = parseInt(number);
                    if(!isNaN(valorTd)){
                        total_credito += valorTd;
                    }
                });
                valorTdActual = numeral(valorTdActual).format('$0,0');
                $(this).text(valorTdActual);
                $("#total_credito").text(numeral(total_credito).format('$0,0'));
            });
            $("#adicionar-fila-asiento-contable").click(function(event) {
                event.preventDefault();
                var filaSumasIguales = $("#taller-asiento-contable > tbody").children().last();
                var primerFilaClonada = $("#taller-asiento-contable > tbody").children().first().clone(true);
                var botonEliminarClonado =  $("#taller-asiento-contable > tbody > tr > td > button.eliminar-fila").first().clone(true);
                primerFilaClonada.children('td').eq(0).text('');
                primerFilaClonada.children('td').eq(1).text('');
                primerFilaClonada.children('td').eq(2).text('$ 0');
                primerFilaClonada.children('td').eq(3).text('$ 0');
                primerFilaClonada.children('td').eq(0).append('<select class="form-control selectpicker columna_codigo with-ajax" data-live-search="true"></select>');
                filaSumasIguales.remove();
                $('#taller-asiento-contable > tbody:last-child').append(primerFilaClonada);
                $('#taller-asiento-contable > tbody:last-child').append(filaSumasIguales);
                $('.selectpicker').selectpicker('refresh');
                $('.selectpicker').selectpicker().filter('.with-ajax').ajaxSelectPicker(options);
            });
            $("#adicionar-fila-nomina").click(function(event) {
                event.preventDefault();
                var filaTotal = $("#taller-nomina > tbody").children().last();
                var primerFilaClonada = $("#taller-nomina > tbody").children().first().clone(true);
                var botonEliminarClonado =  $("#taller-nomina > tbody > tr > td > button.eliminar-fila").first().clone(true);
                primerFilaClonada.find('td').text('');
                primerFilaClonada.find('td').last().append(botonEliminarClonado);
                filaTotal.remove();
                $('#taller-nomina > tbody:last-child').append(primerFilaClonada);
                $('#taller-nomina > tbody:last-child').append(filaTotal);
            });
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
