"use strict";

$(function () {
    iniciarComponentes();
});

const iniciarComponentes = (form = '') => {
    window.listadoPuntos();
}

/**
 * Función que permite cargar el listado.
 */
window.listadoPuntos = () => {
    generalidades.refrescarSeccion(null, route('actas.puntos.listado', {acta: window.id_acta}), '.seccionPunto', function () {
        KTMenu.createInstances();
    }, false);
}
