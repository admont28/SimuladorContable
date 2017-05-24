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
                        divTablas.append(data.estadoresultado);
                        divTablas.append(data.estadoSituacionFinanciera);
                        darFormatoACamposTablasNiif();
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

darFormatoACamposTablasNiif();
function darFormatoACamposTablasNiif() {
    $('.tab-content:visible').find(".tabla-niif > tbody > tr > td").each(function(index, el) {
        if ($(el).hasClass('formato_pesos')) {
            $(el).text(numeral($(el).text()).format('$0,0'));
        }
    });
}
