"use strict";

const tablaActividades = '#tablaActividades';
const modalActividades = '#modalActividades';

$(function () {
    iniciarComponentes();
});

const iniciarComponentes = (form = "") => {
    // window.listadoActividades();
}

window.listadoActividades = (id = $('#idFase').val()) => {
    // console.log('listadoActividades');
    // console.log('id', id);

        if ($.fn.DataTable.isDataTable('#tablaActividades')) {
            $('#tablaActividades').DataTable().destroy();
        }

        var table = $('#tablaActividades').DataTable({
            paging: true,
            responsive: true,
            serverSide: false,
            scrollX: true,
            searchDelay: 500,


            ajax:{
                "url": route('actividades.listadoActividades', {id: window.id_fase}),
                "type": 'GET',
                "headers":{
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                data: function(data){
                    generalidades.mostrarCargando(tablaActividades);
                    data.idFase = id;
                    data = Object.assign(data);
                },
                dataSrc: function(json){
                    generalidades.ocultarCargando(tablaActividades);
                    return json.data;
                },
            },

            buttons: [
                {
                    extend: "excel",
                    text: '<i class="fa fa-download"></i> Excel',
                    className: "btn btn-light-success",
                    title: "Listado proyectos",
                    exportOptions: {
                        columns: ":not(.excluir)"
                    }
                },
                {
                    text: '<i class="fa fa-sync-alt"></i> Actualizar',
                    className: "btn btn-bg-secondary",
                    action: function(e,  dt, node, config){
                        dt.ajax.reload(null, false);
                    }
                }
            ],
            columnDefs: [
                {
                    targets: "all",
                    className: "text-center"
                },
                {
                    targets: "none",
                    className: "text-justify"
                }
            ],
            columns:[
                {
                    render: function (data, type, full, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    data: "titulo",
                    name: "titulo"
                },
                {
                    data: "descripcion",
                    name: "descripcion"
                },
                {
                    data: "valor",
                    name: "valor",
                    render: function (data, type, full, meta) {
                        return full?.valor ? '$'+parseInt(full.valor).toLocaleString('de-DE') : '$0';
                    }
                },
                {
                    data: "fecha_inicio",
                    name: "fecha inicio"
                },
                {
                    data: "fecha_fin",
                    name: "fecha fin"
                },
                {
                    data: "estado",
                    name: "estado"
                },
                {
                    data: "action",
                    name: "action",
                    typable: false,
                    searchable: false,
                }
            ],
            order: [
                [0, "asc"]
            ],
            lengthMenu: [
                [15, 20, 50, 100, -1],
                [15, 20, 50, 100, "Todos"]
            ],
            pageLength: 15,
            dom: `<'row d-flex align-items-center justify-content-between'
            <'col-md-6 col-sm-6 col-lg-6 d-flex align-items-center justify-content-start'<''l><'w-100'f>>
            <'col-md-6 col-sm-6 col-lg-6 d-flex align-items-center justify-content-end' <''B>>
            >
        <'table-responsive'tr>
        <'row'<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i><'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>>`,
    initComplete: function () {},
    drawCallback: function(settings) {
        KTMenu.createInstances();
    }
        });
}

$(document).on('click', '.btnVerActividades', function(){
    let id = $(this).attr('data-actividades');
    if (id) {
        $('#idFase').val(id);
        window.listadoActividades(id);
        $(modalActividades).modal('show');
    }
});

$(document).on('click', '.btnCargarArchivoActividad', function(){
    let id = $(this).attr('data-registro');
    let nombre = $(this).attr('data-registronombre');
    generalidades.modalActual('#modalCargarArchivoActividades');
    iniciarCarga(id, nombre);
});

const iniciarCarga  = (id, nombre) => {
    var myDropzone = new Dropzone("#cargarArchivoActividades", {
        acceptedFiles: null,
        url: route('drive.cargar'),
        paramName: "archivo", // The name that will be used to transfer the file
        uploadMultiple: true,
        maxFiles: 1,
        maxFilesize: 44.93, // MB
        autoProcessQueue: false, // Deshabilita el procesamiento automático de archivos
        parallelUploads: 1, // Cantidad máxima de archivos cargados simultáneamente
        addRemoveLinks: true,
        accept: function(file, done) {
            if (file.name == "wow.jpg") {
                done("Naha, you don't.");
            } else {
                done();
            }
        },
        init: function() {
            // Evento sending - se ejecuta antes de que se envíe un archivo
            this.on("sending", function(file, xhr, formData) {
                // Agrega el token CSRF al formulario de datos
                formData.append("_token", document.head.querySelector('meta[name="csrf-token"]').content);
                formData.append("carpeta", id);
                formData.append("carpeta_nombre", nombre);
            });
        }
    });

    $(document).on('click', '#enviarButtonActividades', function () {
        myDropzone.processQueue(); // Inicia el proceso de carga de los archivos en la cola de Dropzone
    });

    myDropzone.on("success", function(file, response) {
        if (response.estado == 'success') {
            generalidades.toastrGenerico(response?.estado, response?.mensaje);
            $('.btnCerrarModal').trigger('click');
            let html = `<div class="text-start">
                            <label>Se subio correctamente el archivo.</label>
                        </div>`;
            Swal.fire({
                icon: response.estado,
                title: 'Exito',
                html: html,
            });
            // window.cargarArchivos(response?.id_carpeta ?? null, response?.carpeta_nombre ?? 'N/A');
            // window.actualizarListaArchivos();
        }
        myDropzone.removeAllFiles();
    });

    myDropzone.on("error", function(file, errorMessage) {
        toastr.error("A ocurrido un error al intentar cargar el archivos. El archivo no puede superar los 44 MB", "¡Error!");
        myDropzone.removeAllFiles();
    });
}

require('./crear');
require('./editar');
