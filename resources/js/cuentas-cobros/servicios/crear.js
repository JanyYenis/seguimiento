"use strict";

const formCrearServicio = '#formCrearServicio';
const modalCrearServicio = '#modalCrearServicio';

$(function () {
    iniciarComponentes(formCrearServicio);
    generalidades.validarFormulario(formCrearServicio, enviarDatos);
});

const iniciarComponentes = (form = "") => {
}

const enviarDatos = (form) => {
    let formData = new FormData(document.getElementById("formCrearServicio"));
    formData.append('valor', formData.get('valor').replace('$', ''));

    const config = {
        'method': 'POST',
        'headers': {
            'Accept': generalidades.CONTENT_TYPE_JSON,
        },
        'body': formData
    }

    const success = (response) => {
        if (response.estado == 'success') {
            generalidades.ocultarValidaciones(formCrearServicio);
            window.listadoServicios();
            $('.btnCerrarModal').trigger('click');
            generalidades.resetValidate(formCrearServicio);
        }
        generalidades.ocultarCargando(formCrearServicio);
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
    }

    const error = (response) => {
        generalidades.ocultarCargando(formCrearServicio);
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
        generalidades.mostrarValidaciones(formCrearServicio, response.validaciones);
    }
    const ruta = route("cuentas-cobros.servicios.store");
    generalidades.create(ruta, config, success, error);
    generalidades.mostrarCargando(formCrearServicio);
}

$(document).on('shown.bs.modal', modalCrearServicio, function () {
    let idProyecto = $(`#formEditarCuentaCobro #selectProyecto`).val();
    $.ajax({
        type: 'GET',
        url: route('cuentas-cobros.servicios.buscar-fases', {'proyecto': idProyecto}),
        success: function(response) {
            if (response.estado == 'success') {
                let fases = response?.fases ?? [];
                let selectServicios = $(`${formCrearServicio} #selectServicios`);
                selectServicios.empty();
                let opcion = new Option('', '', false, false);
                selectServicios.append(opcion);
                fases.forEach((fase) => {
                    let selected = false;
                    selectServicios.append(new Option(fase.text, fase.id, selected, selected));
                });
                $(`${formCrearServicio} #selectServicios`).attr('disabled', false);
            }
            generalidades.toastrGenerico(response?.estado, response?.mensaje);
        }
    });
});
