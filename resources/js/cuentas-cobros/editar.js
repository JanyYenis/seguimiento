"use strict";

// rutas
const rutaEditar = "cuentas-cobros.edit";

// id y clases
const formEditarCuentaCobro = "#formEditarCuentaCobro";
const seccionEditar = ".seccionEditar";
const modalEditar = "#modalEditarCuentaCobro";

$(function () {
    generalidades.validarFormulario(formEditarCuentaCobro, enviarDatos);
    iniciarComponentes(formEditarCuentaCobro);
});

const iniciarComponentes = (form = "") => {
    $(`${form} #inputFechaCuenta`).flatpickr();
}

const enviarDatos = (form) => {
    let formData = new FormData(document.getElementById("formEditarCuentaCobro"));

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
            generalidades.ocultarValidaciones(formEditarCuentaCobro);
            window.location.href = route('cuentas-cobros.index');
        }
        generalidades.ocultarCargando(formEditarCuentaCobro);
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
    }

    const error = (response) => {
        generalidades.ocultarCargando(formEditarCuentaCobro);
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
        generalidades.mostrarValidaciones(formEditarCuentaCobro, response.validaciones);
    }
    const rutaActualizar = route("cuentas-cobros.update", { "cuenta": formData.get("id") });
    generalidades.edit(rutaActualizar, config, success, error);
    generalidades.mostrarCargando(formEditarCuentaCobro);
}

require('./servicios/principal');
