<div class="row">
    <div class="form-horizontal">
        <div class="form-group">
            <label for="articulo_taller_kardex" class="col-lg-2 control-label">Artículo:</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" placeholder="Ingrese el artículo" name="articulo_taller_kardex" value="@if( $tallerPractico->tallerKardex->respuestaTallerKardexUsuarioAutenticado() !== null) {{ $tallerPractico->tallerKardex->respuestaTallerKardexUsuarioAutenticado()->retk_articulo }}  @endif"/>
            </div>
        </div>
        <div class="form-group">
            <label for="direccion_taller_kardex" class="col-lg-2 control-label">Dirección:</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" placeholder="Ingrese la dirección" name="direccion_taller_kardex" value="@if( $tallerPractico->tallerKardex->respuestaTallerKardexUsuarioAutenticado() !== null) {{ $tallerPractico->tallerKardex->respuestaTallerKardexUsuarioAutenticado()->retk_direccion }} @endif"/>
            </div>
        </div>
        <div class="form-group">
            <label for="proveedores_taller_kardex" class="col-lg-2 control-label">Proveedores:</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" placeholder="Ingrese los proveedores" name="proveedores_taller_kardex" value="@if( $tallerPractico->tallerKardex->respuestaTallerKardexUsuarioAutenticado() !== null) {{ $tallerPractico->tallerKardex->respuestaTallerKardexUsuarioAutenticado()->retk_proveedores }} @endif"/>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover taller-kardex">
            <thead>
                <tr>
                    <td colspan="13" class="text-center"><strong>PROMEDIO PONDERADO</strong></td>
                </tr>
                <tr>
                    <td colspan="3" class="text-center vcenter"><strong>FECHA</strong></td>
                    <td rowspan="2" class="text-center vcenter"><strong>DETALLE</strong></td>
                    <td rowspan="2" class="text-center vcenter"><strong>VALOR UNITARIO</strong></td>
                    <td colspan="2" class="text-center vcenter"><strong>ENTRADAS</strong></td>
                    <td colspan="2" class="text-center vcenter"><strong>SALIDAS</strong></td>
                    <td colspan="2" class="text-center vcenter"><strong>SALDO</strong></td>
                    <td rowspan="2" class="text-center vcenter"><strong>PROMEDIO</strong></td>
                    <td rowspan="2" class="text-center vcenter"><strong>OPCIÓN</strong></td>
                </tr>
                <tr>
                    <td class="text-center vcenter"><strong>DÍA</strong></td>
                    <td class="text-center vcenter"><strong>MES</strong></td>
                    <td class="text-center vcenter"><strong>AÑO</strong></td>
                    <td class="text-center vcenter"><strong>CANTIDAD</strong></td>
                    <td class="text-center vcenter"><strong>VALOR</strong></td>
                    <td class="text-center vcenter"><strong>CANTIDAD</strong></td>
                    <td class="text-center vcenter"><strong>VALOR</strong></td>
                    <td class="text-center vcenter"><strong>CANTIDAD</strong></td>
                    <td class="text-center vcenter"><strong>VALOR</strong></td>
                </tr>
            </thead>
            <tbody>
                @if ($tallerPractico->tallerKardex->respuestaTallerKardexUsuarioAutenticado() === null)
                    @for ($i = 0; $i < 2; $i++)
                        <tr>
                            <td class="text-center vcenter td-dia numero " contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">0</td>
                            <td class="text-center vcenter td-mes numero" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">0</td>
                            <td class="text-center vcenter td-ano numero" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">0</td>
                            <td class="text-center vcenter td-detalle" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar."></td>
                            <td class="text-center vcenter td-valor-unitario actualizar-entradas-y-salidas" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">$ 0</td>
                            <td class="text-center vcenter td-entradas-cantidad numero actualizar-entradas-y-salidas" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">0</td>
                            <td class="text-center vcenter td-entradas-valor">$ 0</td>
                            <td class="text-center vcenter td-salidas-cantidad numero actualizar-entradas-y-salidas" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">0</td>
                            <td class="text-center vcenter td-salidas-valor">$ 0</td>
                            <td class="text-center vcenter td-saldo-cantidad numero">0</td>
                            <td class="text-center vcenter td-saldo-valor">$ 0</td>
                            <td class="text-center vcenter td-promedio">$ 0</td>
                            <td class="text-center vcenter td-opcion"><button class="btn btn-xs btn-danger eliminar-fila" ><i class="glyphicon glyphicon-trash"></i> Eliminar</button></td>
                        </tr>
                    @endfor
                @else
                    @foreach ($tallerPractico->tallerKardex->respuestaTallerKardexUsuarioAutenticado()->filasTallerKardex as $fitk)
                        <tr>
                            <td class="text-center vcenter td-dia numero " contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">{{ $fitk->fitk_dia }}</td>
                            <td class="text-center vcenter td-mes numero" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">{{ $fitk->fitk_mes }}</td>
                            <td class="text-center vcenter td-ano numero" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">{{ $fitk->fitk_ano }}</td>
                            <td class="text-center vcenter td-detalle" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">{{ $fitk->fitk_detalle }}</td>
                            <td class="text-center vcenter td-valor-unitario actualizar-entradas-y-salidas" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">{{ $fitk->fitk_valorunitario }}</td>
                            <td class="text-center vcenter td-entradas-cantidad numero actualizar-entradas-y-salidas" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">{{ $fitk->fitk_entradascantidad }}</td>
                            <td class="text-center vcenter td-entradas-valor">{{ $fitk->fitk_entradasvalor }}</td>
                            <td class="text-center vcenter td-salidas-cantidad numero actualizar-entradas-y-salidas" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">{{ $fitk->fitk_salidascantidad }}</td>
                            <td class="text-center vcenter td-salidas-valor">{{ $fitk->fitk_salidasvalor }}</td>
                            <td class="text-center vcenter td-saldo-cantidad numero">{{ $fitk->fitk_saldocantidad }}</td>
                            <td class="text-center vcenter td-saldo-valor">{{ $fitk->fitk_saldovalor }}</td>
                            <td class="text-center vcenter td-promedio">{{ $fitk->fitk_promedio }}</td>
                            <td class="text-center vcenter td-opcion"><button class="btn btn-xs btn-danger eliminar-fila" ><i class="glyphicon glyphicon-trash"></i> Eliminar</button></td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12 text-center">
        <div class="form-group">
            <label for="archivo_taller_kardex" class="col-lg-2 control-label">Archivo</label>
            <div class="col-lg-10">
                <input type="file" class="form-control" placeholder="ruta del archivo" name="archivo_taller_kardex">
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        @if (isset($tallerPractico->tallerKardex->respuestaTallerKardexUsuarioAutenticado()->rear_id))
            <div class="alert alert-info" role="alert">
                <p>Usted ya ha cargado el siguiente archivo: <strong><a class="alert-link" target="_blank" href="{{ $tallerPractico->tallerKardex->respuestaTallerKardexUsuarioAutenticado()->respuestaArchivo->rear_rutaarchivo }}">{{ $tallerPractico->tallerKardex->respuestaTallerKardexUsuarioAutenticado()->respuestaArchivo->rear_nombre }}</a>.</strong> Si selecciona otro archivo, el archivo existente será reemplazado.</p>
            </div>
        @endif
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12 text-center">
        <button class="btn btn-default adicionar-fila-kardex">Adicionar fila</button>
        <button class="btn btn-primary solucionar-taller-kardex" data-ruta="{{ route('estudiante.curso.taller.solucionar.kardex.post', ['curs_id' => $curso->curs_id, 'tall_id' => $tallerPractico->tall_id]) }}">Guardar taller</button>
    </div>
</div>
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            /*
                --------------------------------------------------------------------------------
                Eventos para Taller Kardex
                --------------------------------------------------------------------------------
             */
            $('.tab-content:visible').find('.adicionar-fila-kardex').click(function(event) {
                event.preventDefault();
                var tabla = $(this).parents('div.tab-pane').find('table.taller-kardex');
                var primerFilaClonada = tabla.find("tbody").children().first().clone(true);
                var botonEliminarClonado = tabla.find("tbody > tr > td > button.eliminar-fila").first().clone(true);
                primerFilaClonada.find('td').text('');
                primerFilaClonada.find('td').last().append(botonEliminarClonado);
                tabla.find('tbody').append(primerFilaClonada);
                darFomatoACamposTallerKardex();
            });
            $('.tab-content:visible').find(".taller-kardex").on('blur', '.actualizar-entradas-y-salidas', function(event) {
                var elemento = this;
                actualizarEntradasSalidasSaldoYPromedio(elemento)
                    .then(function () {
                        return darFomatoACamposTallerKardex();
                    });
            });
            $('.tab-content:visible').find(".solucionar-taller-kardex").click(function(event) {
                event.preventDefault();
                var botonPulsado = $(this);
                var tabPanelActivo = botonPulsado.parents('div.tab-pane');
                var articulo = tabPanelActivo.find('input[name=articulo_taller_kardex]').val();
                var direccion = tabPanelActivo.find('input[name=direccion_taller_kardex]').val();
                var proveedores = tabPanelActivo.find('input[name=proveedores_taller_kardex]').val();
                if(articulo == undefined || articulo == ""){
                    tabPanelActivo.find('input[name=articulo_taller_kardex]').focus();
                    swal(
                        '¡Cuidado!',
                        'El campo artículo es requerido.',
                        'warning'
                    );
                    return;
                }else if (direccion == undefined || direccion == "") {
                    tabPanelActivo.find('input[name=direccion_taller_kardex]').focus();
                    swal(
                        '¡Cuidado!',
                        'El campo dirección es requerido.',
                        'warning'
                    );
                    return;
                }else if (proveedores == undefined || proveedores == "") {
                    tabPanelActivo.find('input[name=proveedores_taller_kardex]').focus();
                    swal(
                        '¡Cuidado!',
                        'El campo proveedores es requerido.',
                        'warning'
                    );
                    return;
                }else {
                    var tabla = tabPanelActivo.find('table.taller-kardex');
                    var textoOriginal = botonPulsado.text();
                    botonPulsado.attr('disabled', true).text('ENVIANDO DATOS...');
                    botonPulsado.parents("div").find(".adicionar-fila-kardex").attr('disabled', true);
                    var ruta = botonPulsado.data("ruta");
                    var inputFileImage = tabPanelActivo.find('input[type=file]');
                    var archivo = inputFileImage[0].files[0];
                    var filas = [];
                    tabla.find('tbody > tr').each(function(index, el) {
                        var fila = new Object();
                        var tr = $(this);
                        var dia = parseInt(numeral(tr.find('.td-dia').text()).format('0'));
                        var mes = parseInt(numeral(tr.find('.td-mes').text()).format('0'));
                        var ano = parseInt(numeral(tr.find('.td-ano').text()).format('0'));
                        var detalle = tr.find('.td-detalle').text();
                        var valorUnitario = parseInt(numeral(tr.find('.td-valor-unitario').text()).format('0'));
                        var entradasCantidad = parseInt(numeral(tr.find('.td-entradas-cantidad').text()).format('0'));
                        var entradasValor = parseInt(numeral(tr.find('.td-entradas-valor').text()).format('0'));
                        var salidasCantidad = parseInt(numeral(tr.find('.td-salidas-cantidad').text()).format('0'));
                        var salidasValor = parseInt(numeral(tr.find('.td-salidas-valor').text()).format('0'));
                        var saldoCantidad = parseInt(numeral(tr.find('.td-saldo-cantidad').text()).format('0'));
                        var saldoValor = parseInt(numeral(tr.find('.td-saldo-valor').text()).format('0'));
                        var promedio = parseInt(numeral(tr.find('.td-promedio').text()).format('0'));
                        if((detalle == undefined || detalle == "")){
                            if (tabla.find('tbody > tr').length > 1) {
                                tr.remove();
                            }
                            return;
                        }else{
                            var fila = {
                                "dia" : dia,
                                "mes" : mes,
                                "ano" : ano,
                                "detalle" : detalle,
                                "valorUnitario" : valorUnitario,
                                "entradasCantidad" : entradasCantidad,
                                "entradasValor" : entradasValor,
                                "salidasCantidad" : salidasCantidad,
                                "salidasValor" : salidasValor,
                                "saldoCantidad" : saldoCantidad,
                                "saldoValor" : saldoValor,
                                "promedio" : promedio
                            };
                            filas.push(fila);
                        }
                    });
                    var data = new FormData();
                    data.append('articulo',articulo);
                    data.append('direccion',direccion);
                    data.append('proveedores',proveedores);
                    data.append('archivo_taller_kardex',archivo);
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
                            botonPulsado.attr('disabled', false).text(textoOriginal);
                            botonPulsado.parents("div").find(".adicionar-fila-kardex").attr('disabled', false);;
                        });
                }
            });
            function actualizarEntradasSalidasSaldoYPromedio(elemento) {
                var promise = new Promise(function (resolve, reject) {
                    var filaActual       = $(elemento).parents('tr');
                    var tabla            = filaActual.parents('table.taller-kardex');
                    var indiceFila       = filaActual.index();
                    if (indiceFila > 0 && $(elemento).hasClass('td-valor-unitario') && filaActual.children('.td-salidas-cantidad').text() != '0') {
                        swal(
                            '¡Cuidado!',
                            'Está modificando el valor unitario de una salida, cuando este debe tomar el valor del promedio de la fila anterior.<br><br>Para poder modificar este valor, debe cambiar la cantidad en salidas a 0.',
                            'warning'
                        );
                        var filaAnterior = tabla.find('tbody > tr').eq(indiceFila - 1);
                        var promedioAnterior = filaAnterior.children('.td-promedio').text();
                        filaActual.children('.td-valor-unitario').text(promedioAnterior);
                        resolve(elemento);
                        return;
                    }
                    if (indiceFila > 0 && $(elemento).hasClass('td-entradas-cantidad') && filaActual.children('.td-salidas-cantidad').text() != '0') {
                        swal(
                            '¡Cuidado!',
                            'Está modificando la cantidad de entradas en una fila que tiene salidas, no pueden existir entradas y salidas en la misma fila.<br><br>Para poder modificar este valor, debe cambiar la cantidad en salidas a 0, ó bien, adicione una nueva fila para su entrada.',
                            'warning'
                        );
                        filaActual.children('.td-entradas-cantidad').text('0');
                        resolve(elemento);
                        return;
                    }
                    if ($(elemento).hasClass('td-salidas-cantidad') && filaActual.children('.td-entradas-cantidad').text() != '0') {
                        swal(
                            '¡Cuidado!',
                            'Está modificando la cantidad de salidas en una fila que tiene entradas, no pueden existir entradas y salidas en la misma fila.<br><br>Para poder modificar este valor, debe cambiar la cantidad en entradas a 0, ó bien, adicione una nueva fila para su salida.',
                            'warning'
                        );
                        filaActual.children('.td-salidas-cantidad').text('0');
                        resolve(elemento);
                        return;
                    }
                    // Ingresa una entrada negativa, en valor unitario debe tomar el promedio de la fila anterior
                    if(indiceFila > 0 && $(elemento).hasClass('td-entradas-cantidad') && parseInt(numeral($(elemento).text()).format('0')) < 0 ){
                        var filaAnterior = tabla.find('tbody > tr').eq(indiceFila - 1);
                        var promedioAnterior = filaAnterior.children('.td-promedio').text();
                        filaActual.children('.td-valor-unitario').text(promedioAnterior);
                    }
                    if(indiceFila > 0 && $(elemento).hasClass('td-salidas-cantidad') && $(elemento).text() != '0'){
                        var filaAnterior = tabla.find('tbody > tr').eq(indiceFila - 1);
                        var promedioAnterior = filaAnterior.children('.td-promedio').text();
                        filaActual.children('.td-valor-unitario').text(promedioAnterior);
                    }
                    var valorUnitario    = parseInt(numeral(filaActual.children('.td-valor-unitario').text()).format('0'));
                    var entradasCantidad = parseInt(numeral(filaActual.children('.td-entradas-cantidad').text()).format('0'));
                    var salidasCantidad  = parseInt(numeral(filaActual.children('.td-salidas-cantidad').text()).format('0'));

                    var entradasValor    = valorUnitario * entradasCantidad;
                    var salidasValor     = valorUnitario * salidasCantidad;
                    filaActual.children('.td-entradas-valor').text(entradasValor);
                    filaActual.children('.td-salidas-valor').text(salidasValor);
                    var saldoCantidad, saldoValor;
                    if(indiceFila == 0){
                        filaActual.children('.td-saldo-cantidad').text(entradasCantidad);
                        filaActual.children('.td-saldo-valor').text(entradasValor);
                        saldoCantidad = filaActual.children('.td-saldo-cantidad').text();
                        saldoValor    = filaActual.children('.td-saldo-valor').text();
                    }else{
                        var filaAnterior = tabla.find('tbody > tr').eq(indiceFila - 1);
                        var saldoCantidadFilaAnterior = parseInt(numeral(filaAnterior.children('.td-saldo-cantidad').text()).format('0'));
                        var saldoValorFilaAnterior    = parseInt(numeral(filaAnterior.children('.td-saldo-valor').text()).format('0'));
                        var saldoCantidad             = saldoCantidadFilaAnterior + entradasCantidad - salidasCantidad;
                        var saldoValor                = saldoValorFilaAnterior + entradasValor - salidasValor;
                    }
                    var promedio = saldoValor / saldoCantidad;
                    filaActual.children('.td-saldo-cantidad').text(saldoCantidad);
                    filaActual.children('.td-saldo-valor').text(saldoValor);
                    filaActual.children('.td-promedio').text(numeral(promedio).format('$0,0'));
                    resolve(elemento);
                });
                return promise;
            }
            darFomatoACamposTallerKardex();
            function darFomatoACamposTallerKardex() {
                $(".taller-kardex > tbody > tr > td").each(function(index, el) {
                    if ($(el).hasClass('td-detalle') || $(el).hasClass('td-opcion')) {
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
