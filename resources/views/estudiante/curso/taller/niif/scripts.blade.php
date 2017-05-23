/*
    --------------------------------------------------------------------------------
    Eventos para Taller NIIF
    --------------------------------------------------------------------------------
 */
$('.tab-content:visible').find('.generar-tablas-niif').click(function(event) {
    event.preventDefault();
    var botonPulsado = this;
    swal({
        title: '¿Está seguro de esta acción?',
        text: "Al generar las tablas del taller niif se reemplazaran las tablas actuales. Por favor confirme.",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, enviar',
        cancelButtonText: 'No, cancelar'
    }).then(function (option) {
        if(option === true){
            generarTablasNiif(botonPulsado);
            return true;
        }else{
            return false;
        }
    });
});
function generarTablasNiif(elemento) {
    var promise = new Promise(function (resolve, reject) {
        var botonPulsado = $(elemento);
        var divTablas = botonPulsado.parents('div.tab-pane').find('div.tablas-niif');
        var ruta = botonPulsado.data("ruta");
        var xhr =
            $.ajax({
                url: ruta,
                type: 'GET',
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                dataType: 'JSON',
                data: {},
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
                        divTablas.html('');
                        divTablas.append(data.balanceprueba);
                        calcularTotalesBalancePrueba(divTablas).then(function () {
                            return darFormatoACamposTablasNiif();
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
            });
        resolve(elemento);
    });
    return promise;
}

function darFormatoACamposTablasNiif() {
    $('.tab-content:visible').find(".taller-balance-prueba > tbody > tr > td").each(function(index, el) {
        if($(el).hasClass('columna_opcion') || $(el).hasClass('columna_codigo') || $(el).hasClass('columna_cuentas')){
            return;
        }
        else if ($(el).hasClass('columna_debito') || $(el).hasClass('columna_credito') || $(el).hasClass('total_debito') || $(el).hasClass('total_credito')) {
            $(el).text(numeral($(el).text()).format('$0,0'));
        }
    });
}

function calcularTotalesBalancePrueba(elemento) {
    var promise = new Promise(function (resolve, reject) {
        var total_credito = 0;
        var total_debito = 0;
        var tablaBalancePrueba = $(elemento).find('.taller-balance-prueba');
        tablaBalancePrueba.find('.columna_credito').each(function(index, el) {
            var number = numeral($(el).text()).format('0');
            var valorTd = parseInt(number);
            if(!isNaN(valorTd)){
                total_credito += valorTd;
            }
        });
        tablaBalancePrueba.find('.columna_debito').each(function(index, el) {
            var number = numeral($(el).text()).format('0');
            var valorTd = parseInt(number);
            if(!isNaN(valorTd)){
                total_debito += valorTd;
            }
        });
        tablaBalancePrueba.find(".total_credito").text(numeral(total_credito).format('$0,0'));
        tablaBalancePrueba.find(".total_debito").text(numeral(total_debito).format('$0,0'));
        resolve(elemento);
    });
    return promise;
}
