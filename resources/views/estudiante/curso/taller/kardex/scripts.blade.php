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
            var botonPulsado = this;
            swal({
                title: '¿Está seguro de esta acción?',
                text: "Al enviar los datos para ser almacenados, las filas sin detalle serán omitidas y eliminadas de la tabla. Por favor confirme.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, enviar',
                cancelButtonText: 'No, cancelar'
            }).then(function (option) {
                if(option === true){
                    enviarDatosTallerKardex(botonPulsado);
                    return true;
                }else{
                    return false;
                }
            });
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
        function enviarDatosTallerKardex(elemento) {
            var botonPulsado = $(elemento);
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
        }
