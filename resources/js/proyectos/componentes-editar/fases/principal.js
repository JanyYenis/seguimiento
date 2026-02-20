$(document).ready(function() {

"use strict";

$(function () {
    iniciarComponentes();
});

const iniciarComponentes = (form = "") => {
    window.listadoFases();
}
});

$(document).on('click', '.btnCargarArchivoFases', function(){
    let id = $(this).attr('data-registro');
    let nombre = $(this).attr('data-registronombre');
    $('#modalCargarArchivoFases').modal('show');
    iniciarCarga(id, nombre);
});

const iniciarCarga  = (id, nombre) => {
    var myDropzone = new Dropzone("#cargarArchivoFases", {
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

    $(document).on('click', '#enviarButtonFases', function () {
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
require('./listado');
require('./actividades/listado');
