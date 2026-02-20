"use strict";

const formCrearPresupuesto = '#formCrearPresupuesto';

$(function () {
    iniciarComponentes(formCrearPresupuesto);
    generalidades.validarFormulario(formCrearPresupuesto, enviarDatos);
});

const iniciarComponentes = (form = "") => {
}

const enviarDatos = (form) => {
    let formData = new FormData(document.getElementById("formCrearPresupuesto"));
    formData.append('valor', formData.get('valor').replace('$', ''));
    formData.append('email', $(`${formCrearPresupuesto} #email`).is(':checked') ? 1 : 0);
    formData.append('tel', $(`${formCrearPresupuesto} #tel`).is(':checked') ? 1 : 0);

    const config = {
        'method': 'POST',
        'headers': {
            'Accept': generalidades.CONTENT_TYPE_JSON,
        },
        'body': formData
    }

    const success = (response) => {
        if (response.estado == 'success') {
            generalidades.ocultarValidaciones(formCrearPresupuesto);
        }
        generalidades.ocultarCargando(formCrearPresupuesto);
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
    }

    const error = (response) => {
        generalidades.ocultarCargando(formCrearPresupuesto);
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
        generalidades.mostrarValidaciones(formCrearPresupuesto, response.validaciones);
    }
    const ruta = route("proyectos.presupuestos.store");
    generalidades.create(ruta, config, success, error);
    generalidades.mostrarCargando(formCrearPresupuesto);
}