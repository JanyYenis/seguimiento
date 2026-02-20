"use strict";

const formEditarActa = '#formEditarActa';

$(function () {
    iniciarComponentes(formEditarActa);
    generalidades.validarFormulario(formEditarActa, enviarDatos);
});

const iniciarComponentes = (form = "") => {
    let element = document.querySelector("#kt_stepper_example_clickable");
    let stepper = new KTStepper(element);
    stepper.on("kt.stepper.click", function (stepper) {
        stepper.goTo(stepper.getClickedStepIndex()); // go to clicked step
    });
    stepper.on("kt.stepper.next", function (stepper) {
        stepper.goNext(); // go next step
    });
    stepper.on("kt.stepper.previous", function (stepper) {
        stepper.goPrevious(); // go previous step
    });

    $("#inputFecha").flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        locale: "es",
    });

    $("#inputFechaProxima").flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        locale: "es",
    });

    new Quill('#divAcuerdos', {
        modules: {
            toolbar: [
                [{
                    header: [1, 2, false]
                }],
                ['bold', 'italic', 'underline'],
                ['image', 'code-block']
            ]
        },
        placeholder: 'Ingrese los acuerdos...',
        theme: 'snow' // or 'bubble'
    });

    new Quill('#divConclusion', {
        modules: {
            toolbar: [
                [{
                    header: [1, 2, false]
                }],
                ['bold', 'italic', 'underline'],
                ['image', 'code-block']
            ]
        },
        placeholder: 'Ingrese la conclusión...',
        theme: 'snow' // or 'bubble'
    });
}

const enviarDatos = (form) => {
    let formData = new FormData(document.getElementById("formEditarActa"));
    formData.append('acuerdos', $('#divAcuerdos .ql-editor').html());
    formData.append('conclusion', $('#divConclusion .ql-editor').html());

    const config = {
        'method': 'PUT',
        'headers': {
            'Accept': generalidades.CONTENT_TYPE_JSON,
        },
        'body': formData
    }

    const success = (response) => {
        if (response.estado == 'success') {
            generalidades.ocultarValidaciones(formEditarActa);
            window.location.href = route('actas.index');
        }
        generalidades.ocultarCargando(formEditarActa);
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
    }

    const error = (response) => {
        generalidades.ocultarCargando(formEditarActa);
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
        generalidades.mostrarValidaciones(formEditarActa, response.validaciones);
    }
    const ruta = route("actas.update", {'acta': formData.get('id')});
    generalidades.edit(ruta, config, success, error);
    generalidades.mostrarCargando(formEditarActa);
}

require('./asistentes/principal');
require('./puntos-dia/principal');
