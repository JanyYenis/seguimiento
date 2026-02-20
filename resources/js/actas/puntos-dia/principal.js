"use strict";

$(function () {
    iniciarComponentes();
});

const iniciarComponentes = (form = "") => {
}

$(document).on('click', '.btnAccionesPuntos .btnInactivar', function(){
    let id = $(this).attr('data-punto');
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
            window.listadoPuntos();
        }
        generalidades.ocultarCargando('body');
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
    }

    const error = (response) => {
        generalidades.ocultarCargando('body');
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
        generalidades.mostrarValidaciones('body', response.validaciones);
    }
    const rutaActualizar = route("actas.puntos.update", { "punto": id });
    generalidades.edit(rutaActualizar, config, success, error);
    generalidades.mostrarCargando('body');
});

$(document).on('click', '.btnAccionesPuntos .btnActivar', function(){
    let id = $(this).attr('data-punto');
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
            window.listadoPuntos();
        }
        generalidades.ocultarCargando('body');
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
    }

    const error = (response) => {
        generalidades.ocultarCargando('body');
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
        generalidades.mostrarValidaciones('body', response.validaciones);
    }
    const rutaActualizar = route("actas.puntos.update", { "punto": id });
    generalidades.edit(rutaActualizar, config, success, error);
    generalidades.mostrarCargando('body');
});

$(document).on('click', '.btnAccionesPuntos .btnEliminar', function(){
    let id = $(this).attr('data-punto');
    Swal.fire({
        icon: "info",
        text: '¿Está seguro de que deseas eliminar el punto?',
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
    let ruta = route('actas.puntos.delete', { 'punto': id } );
    let config = {
        "headers": {
            "Accept": generalidades.CONTENT_TYPE_JSON,
            "Content-Type": generalidades.CONTENT_TYPE_JSON
        },
        "method": "DELETE",
        "body": {
            'punto': id
        }
    }

    const success = (response) => {
        if (response.estado == 'success') {
            window.listadoPuntos();
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
