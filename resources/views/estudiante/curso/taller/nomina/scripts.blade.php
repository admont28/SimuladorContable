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
