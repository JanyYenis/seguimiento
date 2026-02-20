"use strict";

const formEditarProyecto = "#formEditarProyecto";

$(function () {
    generalidades.validarFormulario(formEditarProyecto, enviarDatos);
    iniciarComponentes();
});

const iniciarComponentes = (form = "") => {
    $("#fecha_inicio").flatpickr();
    $("#fecha_fin").flatpickr();
    $("#fecha_inicio_garantia").flatpickr();
    $("#fecha_fin_garantia").flatpickr();
    let configMultiSelectResponsables = {
        elemento: '#selectResponsables',
        selectableHeaderText: "Responsables Disponibles",
        selectionHeaderText: "Responsables Asignados",
        selectableHeaderPlaceholder: "Escribe el nombre del responsable",
        selectionHeaderPlaceholder: "Escribe el nombre del responsable"
    }
    generalidades.multiSelect(configMultiSelectResponsables);

    miembros(window.id_proyecto);
}

const enviarDatos = (form) => {
    let formData = new FormData(document.getElementById("formEditarProyecto"));
    formData.append('email', $(`${formEditarProyecto} #email`).is(':checked') ? 1 : 0);
    formData.append('tel', $(`${formEditarProyecto} #tel`).is(':checked') ? 1 : 0);
    formData.append('estado', $(`${formEditarProyecto} #status`).is(':checked') ? 1 : 0);
    formData.set('responsables', $('#selectResponsables').val());

    const config = {
        'method': 'POST',
        'headers': {
            'Accept': generalidades.CONTENT_TYPE_JSON,
        },
        'body': formData
    }

    const success = (response) => {
        if (response.estado == 'success') {
            generalidades.ocultarValidaciones(formEditarProyecto);
            location.reload();
        }
        generalidades.ocultarCargando(formEditarProyecto);
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
    }

    const error = (response) => {
        generalidades.ocultarCargando(formEditarProyecto);
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
        generalidades.mostrarValidaciones(formEditarProyecto, response.validaciones);
    }
    const ruta = route("proyectos.update", {proyecto: formData.get('id')});
    generalidades.create(ruta, config, success, error);
    generalidades.mostrarCargando(formEditarProyecto);
}

window.miembros = (id = '') => {
    const config = {
        "method": "POST",
        "body": {
            "proyecto": id
        },
        "headers": {
            "Content-Type": generalidades.CONTENT_TYPE_JSON,
            "Accept": generalidades.CONTENT_TYPE_JSON
        }
    };

    const success = (response) => {
        if (response.estado === "success") {
            $("#selectResponsables").multiSelect("deselect");
            $("#selectResponsables option").remove();
            $("#selectResponsables").multiSelect("refresh");
            let options = "";

            let seleccionados = [];
            // console.log(response);
            Object.entries(response.responsables).forEach(([id, responsable]) => {
                options = options + `<option value="${responsable.id}" ${responsable.seleccionado ? "selected" : ""}>${responsable.text}</option>`;
                if (responsable.seleccionado) {
                    seleccionados.push(responsable.id);
                }
            });

            $("#selectResponsables").append(options);
            $("#selectResponsables").val(seleccionados);
            $("#selectResponsables").multiSelect("refresh");
        }
    };
    const error = (response) => {
        generalidades.toastrGenerico(response.estado, response.mensaje);
    }

    generalidades.post(route('proyectos.buscarUsuarios'), config, success, error);
};

$(document).on('click', '.btnEliminarProyecto', function(){
    let id = $(this).attr('data-proyecto');
    Swal.fire({
        icon: "info",
        text: '¿Está seguro de que deseas eliminar el proyecto?',
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
    let ruta = route('proyectos.delete', { 'proyecto': id } );
    let config = {
        "headers": {
            "Accept": generalidades.CONTENT_TYPE_JSON,
            "Content-Type": generalidades.CONTENT_TYPE_JSON
        },
        "method": "DELETE",
        "body": {
            'proyecto': id
        }
    }

    const success = (response) => {
        if (response.estado == 'success') {
            location.href = route('proyectos.index');
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
