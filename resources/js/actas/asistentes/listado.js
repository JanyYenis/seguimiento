"use strict";

$(function () {
    iniciarComponentes();
});

const iniciarComponentes = (form = '') => {
    window.listadoAsistentes();
}

/**
 * Función que permite cargar el listado.
 */
window.listadoAsistentes = () => {
    generalidades.refrescarSeccion(null, route('actas.asistentes.listado', {acta: window.id_acta}), '.seccionAsistente', function () {
        KTMenu.createInstances();
    }, false);
}
