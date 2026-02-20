"use strict";

// rutas 
const rutaEditar = "proyectos.presupuestos.edit";

// id y clases
const formEditarPresupuesto = "#formEditarPresupuesto";

$(function () {
    generalidades.validarFormulario(formEditarPresupuesto, enviarDatos);
});

const enviarDatos = (form) => {
    let formData = new FormData(document.getElementById("formEditarPresupuesto"));
    formData.append('valor', formData.get('valor').replace('$', ''));
    formData.append('email', $(`${formEditarPresupuesto} #email`).is(':checked') ? 1 : 0);
    formData.append('tel', $(`${formEditarPresupuesto} #tel`).is(':checked') ? 1 : 0);
    
    const config = {
        'method': 'PUT',
        'headers': {
            'Accept': generalidades.CONTENT_TYPE_JSON,
        },
        'body': formData
    }

    const success = (response) => {
        if (response.estado == 'success') {
            generalidades.ocultarValidaciones(formEditarPresupuesto);
        }
        generalidades.ocultarCargando(formEditarPresupuesto);
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
    }

    const error = (response) => {
        generalidades.ocultarCargando(formEditarPresupuesto);
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
        generalidades.mostrarValidaciones(formEditarPresupuesto, response.validaciones);
    }
    const rutaActualizar = route("proyectos.presupuestos.update", { "presupuesto": formData.get("id") });
    generalidades.edit(rutaActualizar, config, success, error);
    generalidades.mostrarCargando(formEditarPresupuesto);
}