"use strict";

$(function () {
    consultarTareas();
});

window.consultarTareas = (id = null) => {
    generalidades.mostrarCargando("body");
    $.ajax({
        type: 'GET',
        url: route('proyectos.tareas.show', { proyecto: window.id_proyecto}),
        success: function(response) {
            let puedeCrear = response.puedeCrear || false;
            let puedeEditar = response.puedeEditar || false;
            let puedeEliminar = response.puedeEliminar || false;
            let pendientes = [];
            let en_ejecucion = [];
            let finalizadas = [];
            if (response?.tareasPendientes) {
                response?.tareasPendientes.forEach((tarea) => {
                    let divEtiquetas = '';
                    if (tarea?.etiquetas) {
                        // Convertir el string en un array
                        let etiquetas = JSON.parse(tarea?.etiquetas.replace(/\\/g, ''));

                        // Recorrer el etiquetas
                        etiquetas.forEach(function(item) {
                            divEtiquetas += `<div class="badge badge-warning">${item.value}</div>`;
                        });
                    }
                    let responsables = '';
                    if (tarea?.responsables_activos?.length) {
                        tarea?.responsables_activos.forEach(function(item) {
                            if (item?.responsable?.foto) {
                                responsables += `<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" aria-label="${item?.responsable?.nombre_completo}" title="${item?.responsable?.nombre_completo}" data-bs-original-title="${item?.responsable?.nombre_completo}">
                                                    <img alt="Pic" src="../../${item?.responsable?.foto}">
                                                </div>`;
                            } else {
                                responsables += `<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" aria-label="${item?.responsable?.nombre_completo}" title="${item?.responsable?.nombre_completo}" data-bs-original-title="${item?.responsable?.nombre_completo}">
                                                    <span class="symbol-label bg-primary text-inverse-primary fw-bold">${item?.responsable?.nombre_completo[0]}</span>
                                                </div>`;
                            }
                        });
                    }
                    pendientes.push({
                        'id': tarea.id,
                        'title': `<div class=" mb-6 mb-xl-9">
                    <div class="p-2">
                        <div class="d-flex flex-stack mb-3">
                            ${divEtiquetas}
                            <div>
                                <button type="button" class="btn btn-sm btn-icon btn-color-light-dark btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="fas fa-ellipsis-v fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                    </i>
                                </button>

                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3" data-kt-menu="true">
                                    <div class="menu-item px-3">
                                        <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">
                                            Acciones
                                        </div>
                                    </div>
                                    ${puedeEditar ? `<div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3 btnEditar" data-id="${tarea?.id}">
                                            <i class="fas fa-edit text-warning fs-4 m-2"></i>
                                            Editar
                                        </a>
                                    </div>` : ''}
                                    ${puedeEliminar ? `<div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3 btnEliminarTarea" data-id="${tarea?.id}">
                                            <i class="fas fa-trash text-danger fs-4 m-2"></i>
                                            Eliminar
                                        </a>
                                    </div>` : ''}
                                </div>
                            </div>
                        </div>

                        <div class="mb-2">
                            <a href="#" class="fs-2 fw-bold mb-1 text-gray-900 text-hover-primary">${tarea?.titulo ?? 'N/A'}</a>
                        </div>

                        <div class="fs-3 fw-semibold text-gray-600 mb-5">${tarea?.descripcion ?? 'N/A'}</div>

                        <div class="d-flex flex-stack flex-wrapr">
                            <div class="symbol-group symbol-hover my-1">
                                ${responsables}
                            </div>
                            <div class="d-flex my-1">
                            </div>
                        </div>
                    </div>
                </div>`});
                });
            }
            if (response?.tareasEnEjecucion) {
                response?.tareasEnEjecucion.forEach((tarea) => {
                    let divEtiquetas = '';
                    if (tarea?.etiquetas) {
                        // Convertir el string en un array
                        let etiquetas = JSON.parse(tarea?.etiquetas.replace(/\\/g, ''));

                        // Recorrer el etiquetas
                        etiquetas.forEach(function(item) {
                            divEtiquetas += `<div class="badge badge-primary">${item.value}</div>`;
                        });
                    }
                    let responsables = '';
                    if (tarea?.responsables_activos?.length) {
                        tarea?.responsables_activos.forEach(function(item) {
                            if (item?.responsable?.foto) {
                                responsables += `<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" aria-label="${item?.responsable?.nombre_completo}" title="${item?.responsable?.nombre_completo}" data-bs-original-title="${item?.responsable?.nombre_completo}">
                                                    <img alt="Pic" src="../../${item?.responsable?.foto}">
                                                </div>`;
                            } else {
                                responsables += `<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" aria-label="${item?.responsable?.nombre_completo}" title="${item?.responsable?.nombre_completo}" data-bs-original-title="${item?.responsable?.nombre_completo}">
                                                    <span class="symbol-label bg-primary text-inverse-primary fw-bold">${item?.responsable?.nombre_completo[0]}</span>
                                                </div>`;
                            }
                        });
                    }
                    en_ejecucion.push({
                        'id': tarea.id,
                        'title': `<div class=" mb-6 mb-xl-9">
                                    <div class="p-1">
                                        <div class="d-flex flex-stack mb-3">
                                            ${divEtiquetas}
                                            <div>
                                                <button type="button" class="btn btn-sm btn-icon btn-color-light-dark btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                    <i class="fas fa-ellipsis-v fs-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                        <span class="path4"></span>
                                                        <span class="path5"></span>
                                                    </i>
                                                </button>

                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3" data-kt-menu="true">
                                                    <div class="menu-item px-3">
                                                        <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">
                                                            Acciones
                                                        </div>
                                                    </div>
                                                    ${puedeEditar ? `<div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3 btnEditar" data-id="${tarea?.id}">
                                                            <i class="fas fa-edit text-warning fs-4 m-2"></i>
                                                            Editar
                                                        </a>
                                                    </div>` : ''}
                                                    ${puedeEliminar ? `<div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3 btnEliminarTarea" data-id="${tarea?.id}">
                                                            <i class="fas fa-trash text-danger fs-4 m-2"></i>
                                                            Eliminar
                                                        </a>
                                                    </div>` : ''}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-2">
                                            <a href="#" class="fs-2 fw-bold mb-1 text-gray-900 text-hover-primary">${tarea?.titulo ?? 'N/A'}</a>
                                        </div>

                                        <div class="fs-3 fw-semibold text-gray-600 mb-5">${tarea?.descripcion ?? 'N/A'}</div>

                                        <div class="d-flex flex-stack flex-wrapr">
                                            <div class="symbol-group symbol-hover my-1">
                                                ${responsables}
                                            </div>
                                            <div class="d-flex my-1">
                                            </div>
                                        </div>
                                    </div>
                                </div>`});
                });
            }
            if (response?.tareasFinalizadas) {
                response?.tareasFinalizadas.forEach((tarea) => {
                    let divEtiquetas = '';
                    if (tarea?.etiquetas) {
                        // Convertir el string en un array
                        let etiquetas = JSON.parse(tarea?.etiquetas.replace(/\\/g, ''));

                        // Recorrer el etiquetas
                        etiquetas.forEach(function(item) {
                            divEtiquetas += `<div class="badge badge-success">${item.value}</div>`;
                        });
                    }
                    let responsables = '';
                    if (tarea?.responsables_activos?.length) {
                        tarea?.responsables_activos.forEach(function(item) {
                            if (item?.responsable?.foto) {
                                responsables += `<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" aria-label="${item?.responsable?.nombre_completo}" title="${item?.responsable?.nombre_completo}" data-bs-original-title="${item?.responsable?.nombre_completo}">
                                                    <img alt="Pic" src="../../${item?.responsable?.foto}">
                                                </div>`;
                            } else {
                                responsables += `<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" aria-label="${item?.responsable?.nombre_completo}" title="${item?.responsable?.nombre_completo}" data-bs-original-title="${item?.responsable?.nombre_completo}">
                                                    <span class="symbol-label bg-primary text-inverse-primary fw-bold">${item?.responsable?.nombre_completo[0]}</span>
                                                </div>`;
                            }
                        });
                    }
                    finalizadas.push({
                        'id': tarea.id,
                        'title': `<div class=" mb-6 mb-xl-9">
                                    <div class="p-2">
                                        <div class="d-flex flex-stack mb-3">
                                            ${divEtiquetas}
                                        </div>

                                        <div class="mb-2">
                                            <a href="#" class="fs-4 fw-bold mb-1 text-gray-900 text-hover-primary">${tarea?.titulo ?? 'N/A'}</a>
                                        </div>

                                        <div class="fs-3 fw-semibold text-gray-600 mb-5">${tarea?.descripcion ?? 'N/A'}</div>

                                        <div class="d-flex flex-stack flex-wrapr">
                                            <div class="symbol-group symbol-hover my-1">
                                                ${responsables}
                                            </div>
                                            <div class="d-flex my-1">
                                            </div>
                                        </div>
                                    </div>
                                </div>`});
                });
            }
            let kanbanContainer = document.querySelector(".kanban-container");
            if (kanbanContainer) {
                kanbanContainer.remove();
            }
            var kanban = new jKanban({
                element: '#jkanbanDetalleCampana',
                gutter: '0',
                widthBoard: '32%',
                boards: [{
                    'id': '1',
                    'title': `<div class="mb-4">
                                <div class="d-flex flex-stack">
                                    <div class="fw-bold fs-2hx p-3">
                                        Pendientes <span class="fs-6 text-gray-500 ms-2">${pendientes?.length ?? 0}</span>
                                    </div>

                                    <div>
                                        ${puedeCrear ? `<button type="button" class="btn btn-sm btn-icon btn-color-light-dark btn-active-light-primary" data-bs-toggle="modal" data-bs-target="#modalCrearTarea">
                                            <i class="fas fa-plus fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                            </i>
                                        </button>` : ''}
                                    </div>
                                </div>
                                <div class="h-3px w-100 bg-warning"></div>
                            </div>`,
                    'item': pendientes
                }, {
                    'id': '2',
                    'title': `<div class="mb-4">
                                <div class="d-flex flex-stack">
                                    <div class="fw-bold fs-2hx p-3">
                                        En Ejecución <span class="fs-6 text-gray-500 ms-2">${en_ejecucion?.length ?? 0}</span>
                                    </div>
                                </div>
                                <div class="h-3px w-100 bg-primary"></div>
                            </div>`,
                    'item': en_ejecucion
                }, {
                    'id': '3',
                    'title': `<div class="mb-4">
                                <div class="d-flex flex-stack">
                                    <div class="fw-bold fs-2hx p-3">
                                        Finalizados <span class="fs-6 text-gray-500 ms-2">${finalizadas?.length ?? 0}</span>
                                    </div>
                                </div>
                                <div class="h-3px w-100 bg-success"></div>
                            </div>`,
                    'item': finalizadas
                }],
                dragendEl: function(el) {
                    // Obtener el ID del elemento que se ha movido
                    var idElemento = el.getAttribute('data-eid');

                    // Obtener el ID del tablero al que se ha movido el elemento
                    var idTablero = el.parentNode.parentNode.getAttribute('data-id');

                    // console.log('El elemento con ID ' + idElemento + ' se ha movido al tablero con ID ' + idTablero);
                    moverTarea(idElemento, parseInt(idTablero));
                }
            });

            KTMenu.createInstances();
            generalidades.ocultarCargando("body");
        }
    });
}

const moverTarea = (id, estado = 1) => {
    let formData = new FormData();
    formData.append('estado', estado ?? 1);

    const config = {
        'method': 'PUT',
        'headers': {
            'Accept': generalidades.CONTENT_TYPE_JSON,
        },
        'body': formData
    }

    const success = (response) => {
        if (response.estado == 'success') {
            window.consultarTareas();
        }
        generalidades.ocultarCargando('body');
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
    }

    const error = (response) => {
        generalidades.ocultarCargando('body');
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
    }

    const rutaActualizar = route("proyectos.tareas.actualizarEstado", { tarea: id });
    generalidades.edit(rutaActualizar, config, success, error);
    generalidades.mostrarCargando('body');
}

$(document).on('click', '.btnEliminarTarea', function(){
    let id = $(this).attr('data-id');
    Swal.fire({
        icon: "info",
        text: '¿Está seguro de que deseas eliminar la tarea?',
        showCancelButton: true,
        buttonsStyling: false,
        confirmButtonText: "Si",
        cancelButtonText: "No",
        customClass: {
            confirmButton: "btn btn-primary",
            cancelButton: "btn btn-active-light"
        }
    }).then(function (result) {
        if (result.value) {
            eliminarTarea(id);
        }
    });
});

const eliminarTarea = (id) => {
    let ruta = route('proyectos.tareas.delete', { 'tarea': id } );
    let config = {
        "headers": {
            "Accept": generalidades.CONTENT_TYPE_JSON,
            "Content-Type": generalidades.CONTENT_TYPE_JSON
        },
        "method": "DELETE",
        "body": {
            'tarea': id
        }
    }

    const success = (response) => {
        if (response.estado == 'success') {
            window.consultarTareas();
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

$(document).on('click', '.btnSeleccionarOpcionSearch', function(){
    let id = $(this).attr('data-id');
    if (id) {
        window.consultarTareas(id);
    }
});

// $(document).on('click', '.btnComentario', function(){
//     console.log('Comentario');
// });

require('./crear');
require('./editar');
// require('./search');
