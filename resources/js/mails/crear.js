"use strict";

const formCrearMails = '#formCrearMails';
const modalCrearMails = '#modalCrearMails';

$(function () {
    iniciarComponentes(formCrearMails);
    generalidades.validarFormulario(formCrearMails, enviarDatos);
});

const iniciarComponentes = (form = "") => {
    var input1 = document.querySelector("#tagify_users_para");
    new Tagify(input1);
    var quill = new Quill('#kt_docs_quill_basic', {
        modules: {
            toolbar: [
                [{
                    header: [1, 2, false]
                }],
                ['bold', 'italic', 'underline'],
                ['image', 'code-block']
            ]
        },
        placeholder: 'Contenido del mensaje...',
        theme: 'snow' // or 'bubble'
    });
}

$(document).on('click', '#cc_button', function() {
    $('#cc_seccion').removeClass('d-none').addClass('d-flex');
    var input1 = document.querySelector("#inputCC");
    new Tagify(input1);
});

$(document).on('click', '#cco_button', function() {
    $('#cco_seccion').removeClass('d-none').addClass('d-flex');
    var input1 = document.querySelector("#inputCCO");
    new Tagify(input1);
});

$(document).on('click', '[data-kt-inbox-form="cc_close"]', function() {
    $('#cc_seccion').addClass('d-none').removeClass('d-flex');
});

$(document).on('click', '[data-kt-inbox-form="cco_close"]', function() {
    $('#cco_seccion').addClass('d-none').removeClass('d-flex');
});

const enviarDatos = (form) => {
    let formData = new FormData(document.getElementById("formCrearMails"));
    formData.append('descripcion', $('#kt_docs_quill_basic .ql-editor').html());

    const config = {
        'method': 'POST',
        'headers': {
            'Accept': generalidades.CONTENT_TYPE_JSON,
        },
        'body': formData
    }

    const success = (response) => {
        if (response.estado == 'success') {
            generalidades.ocultarValidaciones(formCrearMails);
            $('.btnCerrarModal').trigger('click');
        }
        generalidades.ocultarCargando(formCrearMails);
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
    }

    const error = (response) => {
        generalidades.ocultarCargando(formCrearMails);
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
        generalidades.mostrarValidaciones(formCrearMails, response.validaciones);
    }
    const ruta = route("mails.store");
    generalidades.create(ruta, config, success, error);
    generalidades.mostrarCargando(formCrearMails);
}

// $(document).on('hidden.bs.modal', modalCrearMails, function (e) {
//     generalidades.resetValidate(formCrearMails);
// });
