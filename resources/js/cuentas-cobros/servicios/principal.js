"use strict";

$(function () {
    iniciarComponentes();
});

const iniciarComponentes = (form = "") => {
}

$(document).on('click', '.btnAccionesServicios .btnInactivar', function(){
    let id = $(this).attr('data-servicio');
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
            window.listadoServicios();
        }
        generalidades.ocultarCargando('body');
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
    }

    const error = (response) => {
        generalidades.ocultarCargando('body');
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
        generalidades.mostrarValidaciones('body', response.validaciones);
    }
    const rutaActualizar = route("cuentas-cobros.servicios.update", { "servicio": id });
    generalidades.edit(rutaActualizar, config, success, error);
    generalidades.mostrarCargando('body');
});

$(document).on('click', '.btnAccionesServicios .btnActivar', function(){
    let id = $(this).attr('data-servicio');
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
            window.listadoServicios();
        }
        generalidades.ocultarCargando('body');
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
    }

    const error = (response) => {
        generalidades.ocultarCargando('body');
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
        generalidades.mostrarValidaciones('body', response.validaciones);
    }
    const rutaActualizar = route("cuentas-cobros.servicios.update", { "servicio": id });
    generalidades.edit(rutaActualizar, config, success, error);
    generalidades.mostrarCargando('body');
});

$(document).on('click', '.btnAccionesServicios .btnEliminar', function(){
    let id = $(this).attr('data-servicio');
    Swal.fire({
        icon: "info",
        text: '¿Está seguro de que deseas eliminar el servicio?',
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
    let ruta = route('cuentas-cobros.servicios.delete', { 'servicio': id } );
    let config = {
        "headers": {
            "Accept": generalidades.CONTENT_TYPE_JSON,
            "Content-Type": generalidades.CONTENT_TYPE_JSON
        },
        "method": "DELETE",
        "body": {
            'servicio': id
        }
    }

    const success = (response) => {
        if (response.estado == 'success') {
            window.listadoServicios();
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
