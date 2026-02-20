"use strict";

// rutas
const rutaEditar = "cuentas-cobros.servicios.edit";

// id y clases
const formEditarServicio = "#formEditarServicio";
const seccionEditarServicio = ".seccionEditarServicio";
const modalEditar = "#modalEditarServicio";

$(function () {
    generalidades.validarFormulario(formEditarServicio, enviarDatos);
});

$(document).on("click", ".btnAccionesServicios .btnEditar", function () {
    let id = $(this).attr("data-servicio");
    if (id) {
        // id = JSON.parse(id);
        cargarDatos(id);
    }
});

const cargarDatos = (id) => {
    const ruta = route(rutaEditar, { "servicio": id });
    generalidades.mostrarCargando('body');
    generalidades.ejecutar('GET', ruta, 'body', modalEditar, seccionEditarServicio, function(){
        iniciarComponentes(formEditarServicio);
        KTDialer.createInstances();
    });
}

const iniciarComponentes = (form = "") => {
}

const enviarDatos = (form) => {
    let formData = new FormData(document.getElementById("formEditarServicio"));
    formData.append('valor', formData.get('valor').replace('$', ''));

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
            generalidades.ocultarValidaciones(formEditarServicio);
            window.listadoServicios();
        }
        generalidades.ocultarCargando(formEditarServicio);
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
    }

    const error = (response) => {
        generalidades.ocultarCargando(formEditarServicio);
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
        generalidades.mostrarValidaciones(formEditarServicio, response.validaciones);
    }
    const rutaActualizar = route("cuentas-cobros.servicios.update", { "servicio": formData.get("id") });
    generalidades.edit(rutaActualizar, config, success, error);
    generalidades.mostrarCargando(formEditarServicio);
}
