"use strict";

// rutas
const rutaEditar = "proyectos.tareas.edit";

// id y clases
const formEditarTarea = "#formEditarTarea";
const seccionEditar = ".seccionEditar";
const modalEditar = "#modalEditarTarea";

$(function () {

});

const iniciarComponentes = (form = '') => {
    $(".flatpickr-input").flatpickr();

    // Initialize Tagify components on the above inputs
    new Tagify(document.querySelector("#tagEtiquetasEditar"));
    let configMultiSelectResponsables = {
        elemento: '#selectResponsablesTareasEdit',
        selectableHeaderText: "Responsables Disponibles",
        selectionHeaderText: "Responsables Asignados",
        selectableHeaderPlaceholder: "Escribe el nombre del responsable",
        selectionHeaderPlaceholder: "Escribe el nombre del responsable"
    }
    generalidades.multiSelect(configMultiSelectResponsables);

    miembrosEditar(window.id_proyecto);
}

$(document).on("click", ".btnEditar", function () {
    let id = $(this).attr("data-id");
    if (id) {
        cargarDatos(id);
    }
});

const cargarDatos = (id) => {
    const ruta = route(rutaEditar, { tarea: id });
    generalidades.mostrarCargando('body');
    generalidades.ejecutar('GET', ruta, 'body', modalEditar, seccionEditar, function(){
        iniciarComponentes(formEditarTarea);
        generalidades.validarFormulario(formEditarTarea, enviarDatos);
        fasesActividadesEditar(id);
    });
}

const enviarDatos = (form) => {
    let formData = new FormData(document.getElementById("formEditarTarea"));
    formData.append('cod_proyecto', window.id_proyecto);
    formData.set('responsables', $('#selectResponsablesTareasEdit').val());
    formData.set('valor', formData.get('valor').replace('$', ''));

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
            generalidades.ocultarValidaciones(formEditarTarea);
            window.consultarTareas();
        }
        generalidades.ocultarCargando(formEditarTarea);
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
    }

    const error = (response) => {
        generalidades.ocultarCargando(formEditarTarea);
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
        generalidades.mostrarValidaciones(formEditarTarea, response.validaciones);
    }
    const rutaActualizar = route("proyectos.tareas.update", { tarea: formData.get("id") });
    generalidades.edit(rutaActualizar, config, success, error);
    generalidades.mostrarCargando(formEditarTarea);
}

const miembrosEditar = (id = '') => {
    const config = {
        "method": "POST",
        "body": {
            "tarea": id
        },
        "headers": {
            "Content-Type": generalidades.CONTENT_TYPE_JSON,
            "Accept": generalidades.CONTENT_TYPE_JSON
        }
    };

    const success = (response) => {
        if (response.estado === "success") {
            $("#selectResponsablesTareasEdit").multiSelect("deselect");
            $("#selectResponsablesTareasEdit option").remove();
            $("#selectResponsablesTareasEdit").multiSelect("refresh");
            let options = "";

            let seleccionados = [];
            // console.log(response);
            Object.entries(response.responsables).forEach(([id, responsable]) => {
                options = options + `<option value="${responsable.id}" ${responsable.seleccionado ? "selected" : ""}>${responsable.text}</option>`;
                if (responsable.seleccionado) {
                    seleccionados.push(responsable.id);
                }
            });

            $("#selectResponsablesTareasEdit").append(options);
            $("#selectResponsablesTareasEdit").val(seleccionados);
            $("#selectResponsablesTareasEdit").multiSelect("refresh");
        }
    };
    const error = (response) => {
        generalidades.toastrGenerico(response.estado, response.mensaje);
    }

    generalidades.post(route('proyectos.tareas.buscarUsuarios'), config, success, error);
};

const fasesActividadesEditar = (id) => {
    const config = {
        "method": "POST",
        "body": {
            "proyecto": window.id_proyecto,
            "tarea": id,
        },
        "headers": {
            "Content-Type": generalidades.CONTENT_TYPE_JSON,
            "Accept": generalidades.CONTENT_TYPE_JSON
        }
    };

    const success = (response) => {
        if (response.estado === "success") {
            $("#selectActividadEditar").empty().trigger('change');
            let options = "<option value=''></option>";

            let seleccionados = [];
            Object.entries(response.actividades).forEach(([id, actividad]) => {
                options = options + `<option value="${actividad.id}" ${actividad.seleccionado ? "selected" : ""}>${actividad.text} </option>`;
                if (actividad.seleccionado) {
                    seleccionados.push(actividad.id);
                }
            });

            $("#selectActividadEditar").append(options);
            $("#selectActividadEditar").select2();
        }
    };
    const error = (response) => {
        generalidades.toastrGenerico(response.estado, response.mensaje);
    }

    generalidades.post(route('proyectos.tareas.buscarFases'), config, success, error);
};
