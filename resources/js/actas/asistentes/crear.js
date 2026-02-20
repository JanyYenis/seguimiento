"use strict";

const formCrearAsistente = '#formCrearAsistente';
const modalCrearAsistente = '#modalCrearAsistente';

$(function () {
    iniciarComponentes(formCrearAsistente);
    generalidades.validarFormulario(formCrearAsistente, enviarDatos);
});

const iniciarComponentes = (form = "") => {
}

const enviarDatos = (form) => {
    let formData = new FormData(document.getElementById("formCrearAsistente"));

    const config = {
        'method': 'POST',
        'headers': {
            'Accept': generalidades.CONTENT_TYPE_JSON,
        },
        'body': formData
    }

    const success = (response) => {
        if (response.estado == 'success') {
            generalidades.ocultarValidaciones(formCrearAsistente);
            window.listadoAsistentes();
            $('.btnCerrarModal').trigger('click');
            generalidades.resetValidate(formCrearAsistente);
        }
        generalidades.ocultarCargando(formCrearAsistente);
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
    }

    const error = (response) => {
        generalidades.ocultarCargando(formCrearAsistente);
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
        generalidades.mostrarValidaciones(formCrearAsistente, response.validaciones);
    }
    const ruta = route("actas.asistentes.store");
    generalidades.create(ruta, config, success, error);
    generalidades.mostrarCargando(formCrearAsistente);
}
