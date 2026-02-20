"use strict";

// rutas
const rutaEditar = "actas.puntos.edit";

// id y clases
const formEditarPunto = "#formEditarPunto";
const seccionEditarPunto = ".seccionEditarPunto";
const modalEditar = "#modalEditarPunto";

$(function () {
    generalidades.validarFormulario(formEditarPunto, enviarDatos);
});

$(document).on("click", ".btnAccionesPuntos .btnEditar", function () {
    let id = $(this).attr("data-punto");
    if (id) {
        // id = JSON.parse(id);
        cargarDatos(id);
    }
});

const cargarDatos = (id) => {
    const ruta = route(rutaEditar, { "punto": id });
    generalidades.mostrarCargando('body');
    generalidades.ejecutar('GET', ruta, 'body', modalEditar, seccionEditarPunto, function(){
        iniciarComponentes(formEditarPunto);
    });
}

const iniciarComponentes = (form = "") => {
}

const enviarDatos = (form) => {
    let formData = new FormData(document.getElementById("formEditarPunto"));

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
            generalidades.ocultarValidaciones(formEditarPunto);
            window.listadoPuntos();
        }
        generalidades.ocultarCargando(formEditarPunto);
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
    }

    const error = (response) => {
        generalidades.ocultarCargando(formEditarPunto);
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
        generalidades.mostrarValidaciones(formEditarPunto, response.validaciones);
    }
    const rutaActualizar = route("actas.puntos.update", { "punto": formData.get("id") });
    generalidades.edit(rutaActualizar, config, success, error);
    generalidades.mostrarCargando(formEditarPunto);
}
