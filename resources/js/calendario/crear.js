"use strict";

const formCrearEvento = '#formCrearEvento';

$(function () {
    iniciarFases();
    generalidades.validarFormulario(formCrearEvento, enviarDatos);
});

const iniciarFases = () => {
    $("#kt_datepicker_1").flatpickr();
    $("#kt_datepicker_3").flatpickr();
    $("#kt_datepicker_2").flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
    });
    $("#kt_datepicker_4").flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
    });
}

const enviarDatos = (form) => {
    let formData = new FormData(document.querySelector('#formCrearEvento'));

    const config = {
        'method': 'POST',
        'headers': {
            'Accept': generalidades.CONTENT_TYPE_JSON,
        },
        'body': formData
    }

    const success = (response) => {
        if (response.estado == 'success') {
            generalidades.ocultarValidaciones(formCrearEvento);
            window.iniciarCalendario();
            $('.btnCerrarModal').trigger('click');
            generalidades.resetValidate(formCrearEvento);
        }
        generalidades.ocultarCargando(formCrearEvento);
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
    }

    const error = (response) => {
        generalidades.ocultarCargando(formCrearEvento);
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
        generalidades.mostrarValidaciones(formCrearEvento, response.validaciones);
    }
    const ruta = route("calendario.store");
    generalidades.create(ruta, config, success, error);
    generalidades.mostrarCargando(formCrearEvento);
}
