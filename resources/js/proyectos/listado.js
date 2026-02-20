"use strict";

const seccionListadoProyectos = ".seccionListadoProyectos";
const btnPagina = ".btnPagina";
const rutaCargarListadoProyectos = "proyectos.listado";

$(function () {
    iniciarComponentes();
    cargarListado();
});

const iniciarComponentes = (form = '') => {
}

$(document).on("click", btnPagina, function () {
    let pagina = $(this).attr("data-pagina");
    if (pagina) {
        cargarListado(pagina);
    }
});

$(document).on("change", '#selectEstadosListados', function (e) {
    cargarListado();
});

const cargarListado = (pagina = 1) => {
    generalidades.mostrarCargando(seccionListadoProyectos);
    let datos = new FormData();
    datos = generalidades.formToJson(datos);
    datos.pagina = pagina;
    datos.estado = $('#selectEstadosListados').val() ?? 0;
    const ruta = route(rutaCargarListadoProyectos, datos);
    generalidades.refrescarSeccion(null, ruta, seccionListadoProyectos, function (response) {
        generalidades.ocultarCargando(seccionListadoProyectos);
        paginaActual = pagina;
    });
}