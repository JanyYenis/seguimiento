"use strict";

$(function () {
    iniciarComponentes();
});

const iniciarComponentes = (form = '') => {
    window.listadoServicios();
}

/**
 * Función que permite cargar el listado.
 */
window.listadoServicios = () => {
    generalidades.refrescarSeccion(null, route('cuentas-cobros.servicios.listado', {cuenta: window.id_cuenta}), '.seccionServicios', function () {
        KTMenu.createInstances();
        // Recargar el PDF después de 500ms (dar tiempo al servidor)
        setTimeout(function() {
            $('#pdf-viewer').attr('src', $('#pdf-viewer').attr('src') + '?t=' + new Date().getTime());
        }, 500);
    }, false);
}
