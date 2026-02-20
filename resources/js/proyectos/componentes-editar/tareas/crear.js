"use strict";

const formCrearTarea = '#formCrearTarea';

$(function () {
    iniciarComponentes();
    generalidades.validarFormulario(formCrearTarea, enviarDatos);
});

const iniciarComponentes = () => {
    $(".flatpickr-input").flatpickr();
    let configMultiSelectResponsables = {
        elemento: '#selectResponsablesTareas',
        selectableHeaderText: "Responsables Disponibles",
        selectionHeaderText: "Responsables Asignados",
        selectableHeaderPlaceholder: "Escribe el nombre del responsable",
        selectionHeaderPlaceholder: "Escribe el nombre del responsable"
    }
    generalidades.multiSelect(configMultiSelectResponsables);

    // Initialize Tagify components on the above inputs
    new Tagify(document.querySelector("#tagEtiquetas"));
}

const enviarDatos = (form) => {
    let formData = new FormData(document.querySelector('#formCrearTarea'));
    formData.append('cod_proyecto', window.id_proyecto);
    formData.set('responsables', $('#selectResponsablesTareas').val());
    formData.set('valor', formData.get('valor').replace('$', ''));

    const config = {
        'method': 'POST',
        'headers': {
            'Accept': generalidades.CONTENT_TYPE_JSON,
        },
        'body': formData
    }

    const success = (response) => {
        if (response.estado == 'success') {
            generalidades.ocultarValidaciones(formCrearTarea);
            window.consultarTareas();
            $('.btnCerrarModal').trigger('click');
            generalidades.resetValidate(formCrearTarea);
        }
        generalidades.ocultarCargando(formCrearTarea);
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
    }

    const error = (response) => {
        generalidades.ocultarCargando(formCrearTarea);
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
        generalidades.mostrarValidaciones(formCrearTarea, response.validaciones);
    }
    const ruta = route("proyectos.tareas.store");
    generalidades.create(ruta, config, success, error);
    generalidades.mostrarCargando(formCrearTarea);
}

const miembros = (id = '') => {
    const config = {
        "method": "POST",
        "body": {
            "tarea": id,
            "proyecto": window.id_proyecto,
        },
        "headers": {
            "Content-Type": generalidades.CONTENT_TYPE_JSON,
            "Accept": generalidades.CONTENT_TYPE_JSON
        }
    };

    const success = (response) => {
        if (response.estado === "success") {
            $("#selectResponsablesTareas").multiSelect("deselect");
            $("#selectResponsablesTareas option").remove();
            $("#selectResponsablesTareas").multiSelect("refresh");
            let options = "";

            let seleccionados = [];
            // console.log(response);
            Object.entries(response.responsables).forEach(([id, responsable]) => {
                options = options + `<option value="${responsable.id}" ${responsable.seleccionado ? "selected" : ""}>${responsable.text}</option>`;
                if (responsable.seleccionado) {
                    seleccionados.push(responsable.id);
                }
            });

            $("#selectResponsablesTareas").append(options);
            $("#selectResponsablesTareas").val(seleccionados);
            $("#selectResponsablesTareas").multiSelect("refresh");
        }
    };
    const error = (response) => {
        generalidades.toastrGenerico(response.estado, response.mensaje);
    }

    generalidades.post(route('proyectos.tareas.buscarUsuarios'), config, success, error);
};

const fasesActividades = () => {
    const config = {
        "method": "POST",
        "body": {
            "proyecto": window.id_proyecto,
        },
        "headers": {
            "Content-Type": generalidades.CONTENT_TYPE_JSON,
            "Accept": generalidades.CONTENT_TYPE_JSON
        }
    };

    const success = (response) => {
        if (response.estado === "success") {
            $("#selectActividad").empty().trigger('change');
            let options = "<option value=''></option>";

            let seleccionados = [];
            Object.entries(response.actividades).forEach(([id, actividad]) => {
                options = options + `<option value="${actividad.id}" ${actividad.seleccionado ? "selected" : ""}>${actividad.text} </option>`;
                if (actividad.seleccionado) {
                    seleccionados.push(actividad.id);
                }
            });

            $("#selectActividad").append(options);
            $("#selectActividad").select2();
        }
    };
    const error = (response) => {
        generalidades.toastrGenerico(response.estado, response.mensaje);
    }

    generalidades.post(route('proyectos.tareas.buscarFases'), config, success, error);
};

$('#modalCrearTarea').on('shown.bs.modal', function () {
    miembros();
    fasesActividades();
});
