"use strict";

const formCrearTickets = '#formCrearTickets';
const modalCrearTickets = '#modalCrearTickets';

$(function () {
    iniciarComponentes();
    generalidades.validarFormulario(formCrearTickets, enviarDatos);
});

const iniciarComponentes = (form = "") => {
    $("#fecha_hallazgo").flatpickr();
}

const enviarDatos = (form) => {
    let formData = new FormData(document.getElementById("formCrearTickets"));

    const config = {
        'method': 'POST',
        'headers': {
            'Accept': generalidades.CONTENT_TYPE_JSON,
        },
        'body': formData
    }

    const success = (response) => {
        if (response.estado == 'success') {
            generalidades.ocultarValidaciones(formCrearTickets);
            $('.btnCerrarModal').trigger('click');
            window.cargarListado();
        }
        generalidades.ocultarCargando(formCrearTickets);
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
    }

    const error = (response) => {
        generalidades.ocultarCargando(formCrearTickets);
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
        generalidades.mostrarValidaciones(formCrearTickets, response.validaciones);
    }
    const ruta = route("tickets.store");
    generalidades.create(ruta, config, success, error);
    generalidades.mostrarCargando(formCrearTickets);
}

$(document).on('hidden.bs.modal', modalCrearTickets, function (e) {
    generalidades.resetValidate(formCrearTickets);
});
