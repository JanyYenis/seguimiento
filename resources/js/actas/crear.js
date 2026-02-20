"use strict";

const formCrearActa = '#formCrearActa';
const modalCrearActa = '#modalCrearActa';

$(function () {
    iniciarComponentes(formCrearActa);
    generalidades.validarFormulario(formCrearActa, enviarDatos);
});

const iniciarComponentes = (form = "") => {
    $("#kt_datepicker_1").flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        locale: "es",
    });
}

const enviarDatos = (form) => {
    let formData = new FormData(document.getElementById("formCrearActa"));

    const config = {
        'method': 'POST',
        'headers': {
            'Accept': generalidades.CONTENT_TYPE_JSON,
        },
        'body': formData
    }

    const success = (response) => {
        if (response.estado == 'success') {
            generalidades.ocultarValidaciones(formCrearActa);
            window.listadoActas();
            $('.btnCerrarModal').trigger('click');
            generalidades.resetValidate(formCrearActa);
        }
        generalidades.ocultarCargando(formCrearActa);
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
    }

    const error = (response) => {
        generalidades.ocultarCargando(formCrearActa);
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
        generalidades.mostrarValidaciones(formCrearActa, response.validaciones);
    }
    const ruta = route("actas.store");
    generalidades.create(ruta, config, success, error);
    generalidades.mostrarCargando(formCrearActa);
}
