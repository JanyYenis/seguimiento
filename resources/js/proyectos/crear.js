"use strict";

const formCrearProyecto = '#formCrearProyecto';
const modalCrearProyectos = '#modalCrearProyectos';

$(function () {
    iniciarComponentes();
    generalidades.validarFormulario(formCrearProyecto, enviarDatos);
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

    miembros();
}

const enviarDatos = (form) => {
    let formData = new FormData(document.getElementById("formCrearProyecto"));
    formData.set('responsables', $('#selectResponsables').val());

    $('.tituloFase').each(function(index){
        formData.append('tituloFase['+ index +']', $(this).val());
    })

    $('.descFase').each(function(index){
        formData.append('descFase['+ index +']', $(this).val());
    });

    $('.valorFase').each(function(index){
        formData.append('valorFase['+ index +']', $(this).val().replace('$', ''));
    });

    const config = {
        'method': 'POST',
        'headers': {
            'Accept': generalidades.CONTENT_TYPE_JSON,
        },
        'body': formData
    }

    const success = (response) => {
        if (response.estado == 'success') {
            generalidades.ocultarValidaciones(formCrearProyecto);
            $('.btnCerrarModal').trigger('click');
            // window.listadoProyectos();
            location.href = route('proyectos.edit', { proyecto: response.id });
        }
        generalidades.ocultarCargando(formCrearProyecto);
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
    }

    const error = (response) => {
        generalidades.ocultarCargando(formCrearProyecto);
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
        generalidades.mostrarValidaciones(formCrearProyecto, response.validaciones);
    }
    const ruta = route("proyectos.store");
    generalidades.create(ruta, config, success, error);
    generalidades.mostrarCargando(formCrearProyecto);
}

$(document).on('hidden.bs.modal', modalCrearProyectos, function (e) {
    generalidades.resetValidate(formCrearProyecto);
});

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

$(document).on('click', '#btnProyectAgregarComp', function(e) {
    var newComponent = `
        <div class="row mb-7 new-component">
            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                    <span class="required">Titulo</span>
                    <span class="ms-1" data-bs-toggle="tooltip"
                        aria-label="Este titulo aparecera resaltado en la fase."
                        data-bs-original-title="Este titulo aparecera resaltado en la fase.">
                        <i class="fas fa-info-circle text-gray-500 fs-6">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                    </span>
                </label>
                <input type="text" class="form-control form-control-solid tituloFase" placeholder="Titulo del Fase"
                    name="tituloFase[]" id="tituloFase" required>
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                </div>
            </div>
            <div class="d-flex flex-stack mb-8">
                <label class="fs-6 fw-semibold mb-2">Presupuesto</label>
                <div class="position-relative w-md-600px" data-kt-dialer="true" data-kt-dialer-min="0"
                    data-kt-dialer-max="900000000" data-kt-dialer-step="10000" data-kt-dialer-prefix="$"
                    data-kt-dialer-decimals="0">
                    <button type="button"
                        class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0"
                        data-kt-dialer-control="decrease">
                        <i class="fas fa-minus fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </button>
                    <input type="text" class="form-control form-control-solid border-0 ps-12"
                        data-kt-dialer-control="input" placeholder="Amount" name="valor[]" value="">
                    <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0"
                        data-kt-dialer-control="increase">
                        <i class="fas fa-plus fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                    </button>
                </div>
            </div>
            <div class="d-flex flex-column mb-8">
                <label class="fs-6 fw-semibold mb-2 required">Descripción</label>
                <textarea class="form-control form-control-solid descFase" rows="3" name="descFase[]" id="descFase"
                    placeholder="Descripción de la Fase" required></textarea>
            </div>
            <button class="btn btn-danger btn-remove-component">Eliminar</button>
        </div>
    `;

    $('#componentContainer').append(newComponent);
    KTDialer.createInstances();
});

$(document).on('click', '.btn-remove-component', function(e) {
    $(this).closest('.new-component').remove();
});
