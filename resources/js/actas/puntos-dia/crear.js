"use strict";

const formCrearPunto = '#formCrearPunto';
const modalCrearPunto = '#modalCrearPunto';

$(function () {
    iniciarComponentes(formCrearPunto);
    generalidades.validarFormulario(formCrearPunto, enviarDatos);
});

const iniciarComponentes = (form = "") => {
}

const enviarDatos = (form) => {
    let formData = new FormData(document.getElementById("formCrearPunto"));

    const config = {
        'method': 'POST',
        'headers': {
            'Accept': generalidades.CONTENT_TYPE_JSON,
        },
        'body': formData
    }

    const success = (response) => {
        if (response.estado == 'success') {
            generalidades.ocultarValidaciones(formCrearPunto);
            window.listadoPuntos();
            $('.btnCerrarModal').trigger('click');
            generalidades.resetValidate(formCrearPunto);
        }
        generalidades.ocultarCargando(formCrearPunto);
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
    }

    const error = (response) => {
        generalidades.ocultarCargando(formCrearPunto);
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
        generalidades.mostrarValidaciones(formCrearPunto, response.validaciones);
    }
    const ruta = route("actas.puntos.store");
    generalidades.create(ruta, config, success, error);
    generalidades.mostrarCargando(formCrearPunto);
}
