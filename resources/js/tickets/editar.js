"use strict";

const formEditarTicket = '#formEditarTicket';
var divDescripcion;

$(function () {
    iniciarComponentes(formEditarTicket);
    generalidades.validarFormulario(formEditarTicket, enviarDatos);
});

const iniciarComponentes = (form = "") => {
    divDescripcion = new Quill('#divDescripcion', {
        modules: {
            toolbar: [
                [{
                    header: [1, 2, false]
                }],
                ['bold', 'italic', 'underline'],
                ['image', 'code-block']
            ]
        },
        placeholder: 'Ingresar el comentario...',
        theme: 'snow' // or 'bubble'
    });
}

const enviarDatos = (form) => {
    let formData = new FormData(document.getElementById("formEditarTicket"));
    formData.append('descripcion_comentario', $('#divDescripcion .ql-editor').html());

    const config = {
        'method': 'PUT',
        'headers': {
            'Accept': generalidades.CONTENT_TYPE_JSON,
        },
        'body': formData
    }

    const success = (response) => {
        if (response.estado == 'success') {
            generalidades.ocultarValidaciones(formEditarTicket);
            window.cargarListadoComentarios();
            divDescripcion.setContents([]); // Borra todo el contenido
        }
        generalidades.ocultarCargando(formEditarTicket);
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
    }

    const error = (response) => {
        generalidades.ocultarCargando(formEditarTicket);
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
        generalidades.mostrarValidaciones(formEditarTicket, response.validaciones);
    }
    const ruta = route("tickets.update", {'ticket': formData.get('id')});
    generalidades.edit(ruta, config, success, error);
    generalidades.mostrarCargando(formEditarTicket);
}
