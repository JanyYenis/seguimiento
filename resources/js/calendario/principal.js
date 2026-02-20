"use strict";

const modalEditarEvento = '#modalEditarEvento';
const formEditarEvento = '#formEditarEvento';
const seccionEditar = '.seccionEditar';

$(function () {
    iniciarCalendario();
    generalidades.validarFormulario(formEditarEvento, enviarDatosEditar);
});

const iniciarFasesEditar = () => {
    $("#kt_datepicker_1Editar").flatpickr();
    $("#kt_datepicker_3Editar").flatpickr();
    $("#kt_datepicker_2Editar").flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
    });
    $("#kt_datepicker_4Editar").flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
    });
}

window.iniciarCalendario = () => {

    const config = {
        'method': 'GET',
        'headers': {
            'Accept': generalidades.CONTENT_TYPE_JSON,
        },
    }

    const success = (response) => {
        if (response.estado == 'success') {
            // console.log(response.fechas);
            var calendarEl = document.getElementById("kt_calendar");
            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: "prev,next today",
                    center: "title",
                    right: "dayGridMonth,timeGridWeek,timeGridDay"
                },
                initialDate: new Date(),
                navLinks: true, // can click day/week names to navigate views
                selectable: true,
                selectMirror: true,
                locale: 'es',

                // Create new event
                select: function (arg) {
                    $('#modalCrearEvento').modal('show');
                    $('#kt_datepicker_1').flatpickr().setDate(arg.startStr);
                    $('#kt_datepicker_3').flatpickr().setDate(arg.endStr);
                },

                // Delete event
                eventClick: function (arg) {
                    let id = arg?.event?.id ?? 0;
                    const ruta = route('calendario.edit', { calendario: id });
                    generalidades.mostrarCargando('body');
                    generalidades.ejecutar('GET', ruta, 'body', modalEditarEvento, seccionEditar, function(){
                        iniciarFasesEditar(formEditarEvento);
                    });
                },
                editable: true,
                dayMaxEvents: true, // allow "more" link when too many events
                events: response.fechas
            });

            calendar.render();
        }
        generalidades.ocultarCargando('body');
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
    }

    const error = (response) => {
        generalidades.ocultarCargando('body');
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
    }

    generalidades.mostrarCargando('body');
    generalidades.get(route('calendario.consultar'), config, success, error);
}


const enviarDatosEditar = (form) => {
    let formData = new FormData(document.querySelector('#formEditarEvento'));

    const config = {
        'method': 'PUT',
        'headers': {
            'Accept': generalidades.CONTENT_TYPE_JSON,
        },
        'body': formData
    }

    const success = (response) => {
        if (response.estado == 'success') {
            generalidades.ocultarValidaciones(formEditarEvento);
            window.iniciarCalendario();
            $('.btnCerrarModal').trigger('click');
        }
        generalidades.ocultarCargando(formEditarEvento);
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
    }

    const error = (response) => {
        generalidades.ocultarCargando(formEditarEvento);
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
        generalidades.mostrarValidaciones(formEditarEvento, response.validaciones);
    }
    const ruta = route("calendario.update", { calendario: formData.get('id') });
    generalidades.edit(ruta, config, success, error);
    generalidades.mostrarCargando(formEditarEvento);
}

$(document).on('click', '.btnBorrar', function(){
    let formData = new FormData(document.querySelector('#formEditarEvento'));
    let id = formData.get('id');
    Swal.fire({
        icon: "info",
        text: '¿Está seguro de que deseas eliminar el evento?',
        showCancelButton: true,
        buttonsStyling: false,
        confirmButtonText: "Si",
        cancelButtonText: "No",
        customClass: {
            confirmButton: "btn btn-primary",
            cancelButton: "btn btn-active-light"
        }
    }).then(function (result) {
        if (result.value) {
            eliminar(id);
        }
    });
});


const eliminar = (id) => {
    let ruta = route('calendario.delete', { 'calendario': id } );
    let config = {
        "headers": {
            "Accept": generalidades.CONTENT_TYPE_JSON,
            "Content-Type": generalidades.CONTENT_TYPE_JSON
        },
        "method": "DELETE",
        "body": {
            'calendario': id
        }
    }

    const success = (response) => {
        if (response.estado == 'success') {
            window.iniciarCalendario();
            $('.btnCerrarModal').trigger('click');
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

require('./crear');
