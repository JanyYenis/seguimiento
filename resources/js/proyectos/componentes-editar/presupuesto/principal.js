"use strict";

$(function () {
    iniciarComponentes();
});

const iniciarComponentes = (form = "") => {
}

$(document).on('click', '.btnEliminarPresupuesto', function(){
    let id = $(this).attr('data-presupuesto');
    Swal.fire({
        icon: "info",
        text: '¿Está seguro de que deseas eliminar el presupuesto?',
        showCancelButton: true,
        buttonsStyling: false,
        confirmButtonText: "Si",
        cancelButtonText: "No",
        customClass: {
            confirmButton: "btn btn-iniciar",
            cancelButton: "btn btn-cancelar"
        }
    }).then(function (result) {
        if (result.value) {
            eliminar(id);
        }
    });
});

const eliminar = (id) => {
    let ruta = route('proyectos.presupuestos.delete', { 'presupuesto': id } );
    let config = {
        "headers": {
            "Accept": generalidades.CONTENT_TYPE_JSON,
            "Content-Type": generalidades.CONTENT_TYPE_JSON
        },
        "method": "DELETE",
        "body": {
            'usuario': id
        }
    }
    
    const success = (response) => {
        if (response.estado == 'success') {
            location.reload();
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
require('./editar');