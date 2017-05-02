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
                                        <div class="fs-18"><span class="label label-default">{{ $tallerPractico->tall_tipo }}</span></div>
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
                                            <td colspan="4" class="text-center"><strong>CONTABILIZACIÓN DE LA PROVISIÓN</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center" width="20%"><strong>CÓDIGO</strong></td>
                                            <td class="text-center" width="20%"><strong>CUENTAS</strong></td>
                                            <td class="text-center" width="30%"><strong>DÉBITO</strong></td>
                                            <td class="text-center" width="30%"><strong>CRÉDITO</strong></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for ($i = 1; $i <= $tallerPractico->tallerAsientoContable->taac_cantidadfilas; $i++)
                                            <tr>
                                                <td class="text-center" width="20%">
                                                    <form class="form-inline">
                                                        <select class="form-control selectpicker columna_codigo with-ajax" data-live-search="true" data-fila="{{$i}}">
                                                        </select>
                                                    </form>
                                                </td>
                                                <td class="text-center columna_cuentas" width="20%"></td>
                                                <td class="text-center columna_debito" contenteditable="true" width="30%" data-toggle="tooltip" title="Presiona clic para editar.">$ 0</td>
                                                <td class="text-center columna_credito" contenteditable="true" width="30%" data-toggle="tooltip" title="Presiona clic para editar.">$ 0</td>
                                            </tr>
                                        @endfor
                                            <tr>
                                                <td colspan="2" class="text-center"><strong>SUMAS IGUALES</strong></td>
                                                <td class="text-center" id="total_debito">$ 0</td>
                                                <td class="text-center" id="total_credito">$ 0</td>
                                            </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <a href="#" class="btn btn-default" id="adicionar-fila-asiento-contable">Adicionar fila</a>
                                    <a href="{{ route('estudiante.curso.ver.talleres.ver.preguntas',['curs_id'=>$curso->curs_id,'tall_id'=>$tallerPractico->tall_id]) }}" class="btn btn-primary solucionar-taller">Guardar solución</a>
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
            $('.solucionar-taller').click(function(event) {
                event.preventDefault();
                //accedemos a la ruta del boton que se dio click
                var hrefBoton = $(this).attr('href');
                swal({
                    title: '¿Está seguro de esta acción?',
                    text: 'Si continúa a solucionar el taller se le contará como el primer intento de solución, usted posee 2 intentos como máximo. Por favor confirme.',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, continuar',
                    cancelButtonText: 'No, cancelar'
                }).then(function (option) {
                    if(option === true){
                        window.location.href = hrefBoton;
                        return true;
                    }else{
                        return false;
                    }
                })
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
                var sumasIguales = $("#taller-asiento-contable > tbody").children().last();
                sumasIguales.remove();
                var tr = '<tr><td class="text-center" width="20%">'+
                                '<form class="form-inline">'+
                                    '<select class="form-control selectpicker columna_codigo with-ajax" data-live-search="true" data-fila=""></select>'+
                                '</form>'+
                                '</td>'+
                                '<td class="text-center columna_cuentas" width="20%"></td>'+
                                '<td class="text-center columna_debito" contenteditable="true" width="30%" data-toggle="tooltip" title="Presiona clic para editar.">$ 0</td> '+
                                '<td class="text-center columna_credito" contenteditable="true" width="30%" data-toggle="tooltip" title="Presiona clic para editar.">$ 0</td>'+
                            '</tr>';
                $('#taller-asiento-contable > tbody:last-child').append(tr);
                $('#taller-asiento-contable > tbody:last-child').append(sumasIguales);
                $('.selectpicker').selectpicker('refresh');
                $('.selectpicker').selectpicker().filter('.with-ajax').ajaxSelectPicker(options);

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
