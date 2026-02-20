"use strict";

// rutas
const rutaEditar = "actas.asistentes.edit";

// id y clases
const formEditarAsistente = "#formEditarAsistente";
const seccionEditarAsistente = ".seccionEditarAsistente";
const modalEditar = "#modalEditarAsistente";

$(function () {
    generalidades.validarFormulario(formEditarAsistente, enviarDatos);
});

$(document).on("click", ".btnAccionesAsistentes .btnEditar", function () {
    let id = $(this).attr("data-asistente");
    if (id) {
        // id = JSON.parse(id);
        cargarDatos(id);
    }
});

const cargarDatos = (id) => {
    const ruta = route(rutaEditar, { "asistente": id });
    generalidades.mostrarCargando('body');
    generalidades.ejecutar('GET', ruta, 'body', modalEditar, seccionEditarAsistente, function(){
        iniciarComponentes(formEditarAsistente);
    });
}

const iniciarComponentes = (form = "") => {
}

const enviarDatos = (form) => {
    let formData = new FormData(document.getElementById("formEditarAsistente"));

    const config = {
        'method': 'PUT',
        'headers': {
            'Accept': generalidades.CONTENT_TYPE_JSON,
        },
        'body': formData
    }

    const success = (response) => {
        if (response.estado == 'success') {
            $('.btnCerrarModal').trigger('click');
            generalidades.ocultarValidaciones(formEditarAsistente);
            window.listadoAsistentes();
        }
        generalidades.ocultarCargando(formEditarAsistente);
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
    }

    const error = (response) => {
        generalidades.ocultarCargando(formEditarAsistente);
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
        generalidades.mostrarValidaciones(formEditarAsistente, response.validaciones);
    }
    const rutaActualizar = route("actas.asistentes.update", { "asistente": formData.get("id") });
    generalidades.edit(rutaActualizar, config, success, error);
    generalidades.mostrarCargando(formEditarAsistente);
}
