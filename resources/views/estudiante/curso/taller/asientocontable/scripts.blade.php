<script type="text/javascript">
    $(document).ready(function() {
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
        $('.tab-content:visible').find('.taller-asiento-contable').on('change', 'select',function(event) {
            event.preventDefault();
            // Obtengo la fila en la que se modificó el select.
            var fila = $(this).data('fila');
            // Obtengo el nombre del puc, este se encuentra en el atributo data-subtext de la opción seleccionada por el usuario.
            var nombre = $(this).find('option:selected').data('subtext');
            // Cambio el nombre de la columna CUENTAS en la fila en que se modificó el select.
            $(this).parents('tr').find('td.columna_cuentas').text(nombre);
        });
        $('.tab-content:visible').find('.taller-asiento-contable').on('blur', '.columna_debito[contenteditable=true]',function(event) {
            calcularColumnaDebito(this);
        });
        $('.tab-content:visible').find('.taller-asiento-contable').on('blur', '.columna_credito[contenteditable=true]',function(event) {
            calcularColumnaCredito(this);
        });
        $('.tab-content:visible').find('.adicionar-fila-asiento-contable').click(function(event) {
            event.preventDefault();
            var iteracion = $(this).data('iteracion');
            var tabla = $(this).parents('div.tab-pane').find('table#taller-asiento-contable-'+iteracion);
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
            var botonPulsado = this;
            swal({
                title: '¿Está seguro de esta acción?',
                text: "Al enviar los datos para ser almacenados, las filas sin código PUC serán omitidas y eliminadas de la tabla. Por favor confirme.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, enviar',
                cancelButtonText: 'No, cancelar'
            }).then(function (option) {
                if(option === true){
                    enviarDatosTallerAsientoContable(botonPulsado);
                    return true;
                }else{
                    return false;
                }
            });
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
        darFormatoACamposTallerAsientoContable();
        function darFormatoACamposTallerAsientoContable() {
            $(".taller-asiento-contable > tbody > tr > td").each(function(index, el) {
                if($(el).hasClass('columna_opcion')){
                    return;
                }
                else if ($(el).hasClass('columna_debito') || $(el).hasClass('columna_credito') || $(el).hasClass('total_debito') || $(el).hasClass('total_credito')) {
                    $(el).text(numeral($(el).text()).format('$0,0'));
                }
            });
        }
        function enviarDatosTallerAsientoContable(elemento) {
            var botonPulsado = $(elemento);
            var tabla = botonPulsado.parents('div.tab-pane').find('table.taller-asiento-contable');
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
        }
    });
</script>
