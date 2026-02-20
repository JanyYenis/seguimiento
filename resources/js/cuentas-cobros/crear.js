"use strict";

const formCrearCuentaCobro = '#formCrearCuentaCobro';
const modalCrearCuentaCobro = '#modalCrearCuentaCobro';

$(function () {
    iniciarComponentes(formCrearCuentaCobro);
    generalidades.validarFormulario(formCrearCuentaCobro, enviarDatos);
});

const iniciarComponentes = (form = "") => {
    $(`${form} #inputFechaCuenta`).flatpickr();
}

const enviarDatos = (form) => {
    let formData = new FormData(document.getElementById("formCrearCuentaCobro"));

    const config = {
        'method': 'POST',
        'headers': {
            'Accept': generalidades.CONTENT_TYPE_JSON,
        },
        'body': formData
    }

    const success = (response) => {
        if (response.estado == 'success') {
            generalidades.ocultarValidaciones(formCrearCuentaCobro);
            $('.btnCerrarModal').trigger('click');
            // window.location.href = route('cuentas-cobros', {cuenta: response.id});
            window.listadoCuentaCobros();
            generalidades.resetValidate(formCrearCuentaCobro);
        }
        generalidades.ocultarCargando(formCrearCuentaCobro);
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
    }

    const error = (response) => {
        generalidades.ocultarCargando(formCrearCuentaCobro);
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
        generalidades.mostrarValidaciones(formCrearCuentaCobro, response.validaciones);
    }
    const ruta = route("cuentas-cobros.store");
    generalidades.create(ruta, config, success, error);
    generalidades.mostrarCargando(formCrearCuentaCobro);
}
