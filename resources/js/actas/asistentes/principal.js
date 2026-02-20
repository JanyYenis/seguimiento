"use strict";

$(function () {
    iniciarComponentes();
});

const iniciarComponentes = (form = "") => {
}

$(document).on('click', '.btnAccionesAsistentes .btnInactivar', function(){
    let id = $(this).attr('data-asistente');
    const config = {
        'method': 'PUT',
        'headers': {
            'Accept': generalidades.CONTENT_TYPE_JSON,
        },
        'body': {
            estado: 2
        }
    }

    const success = (response) => {
        if (response.estado == 'success') {
            window.listadoAsistentes();
        }
        generalidades.ocultarCargando('body');
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
    }

    const error = (response) => {
        generalidades.ocultarCargando('body');
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
        generalidades.mostrarValidaciones('body', response.validaciones);
    }
    const rutaActualizar = route("actas.asistentes.update", { "asistente": id });
    generalidades.edit(rutaActualizar, config, success, error);
    generalidades.mostrarCargando('body');
});

$(document).on('click', '.btnAccionesAsistentes .btnActivar', function(){
    let id = $(this).attr('data-asistente');
    const config = {
        'method': 'PUT',
        'headers': {
            'Accept': generalidades.CONTENT_TYPE_JSON,
        },
        'body': {
            estado: 1
        }
    }

    const success = (response) => {
        if (response.estado == 'success') {
            window.listadoAsistentes();
        }
        generalidades.ocultarCargando('body');
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
    }

    const error = (response) => {
        generalidades.ocultarCargando('body');
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
        generalidades.mostrarValidaciones('body', response.validaciones);
    }
    const rutaActualizar = route("actas.asistentes.update", { "asistente": id });
    generalidades.edit(rutaActualizar, config, success, error);
    generalidades.mostrarCargando('body');
});

$(document).on('click', '.btnAccionesAsistentes .btnEliminar', function(){
    let id = $(this).attr('data-asistente');
    Swal.fire({
        icon: "info",
        text: '¿Está seguro de que deseas eliminar el asistente?',
        showCancelButton: true,
        buttonsStyling: false,
        confirmButtonText: "Si",
        cancelButtonText: "No",
        customClass: {
            confirmButton: "btn btn-iniciar",
            cancelButton: "btn btn-cancelar"
        }
    }).then(function (result) {
        if (result.value) {
            eliminar(id);
        }
    });
});

const eliminar = (id) => {
    let ruta = route('actas.asistentes.delete', { 'asistente': id } );
    let config = {
        "headers": {
            "Accept": generalidades.CONTENT_TYPE_JSON,
            "Content-Type": generalidades.CONTENT_TYPE_JSON
        },
        "method": "DELETE",
        "body": {
            'asistente': id
        }
    }

    const success = (response) => {
        if (response.estado == 'success') {
            window.listadoAsistentes();
        }
        generalidades.ocultarCargando('body');
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
    }
    const error = (response) => {
        generalidades.ocultarCargando('body');
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
    }
    generalidades.delete(ruta, config, success, error);
    generalidades.mostrarCargando('body');
}

require('./listado');
require('./crear');
require('./editar');
