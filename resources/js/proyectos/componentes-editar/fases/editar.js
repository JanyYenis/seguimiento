"use strict";

const modalEditarFase = "#modalEditarFase";

$(document).on('click', '.btnEditarFase', function(e){
    e.preventDefault();

    let id = $(this).attr('data-actividades');

    console.log('ID de actividad', id);
    if (id) {
        $.ajax({
            url: route('fases.traerEdit', {id: id}), // Ruta para obtener los datos de la actividad
            type: 'GET',
            success: function(response) {
                if (response.estado === 'success') {
                    let data = response.fase;

                    $('#tituloFase').val(data.titulo);
                    $('#descripcionFase').val(data.descripcion);

                    $('#idFase').val(id);
                    generalidades.modalActual(modalEditarFase);
                    $(modalEditarActividad).modal('show');
                } else {
                    console.error('Error:', response.mensaje);
                    // Manejo del mensaje de error
                }
            },
            error: function(xhr, status, error) {
                console.error('Error al obtener los datos de la fase:', error);
                // Manejo del error
            }
        });
    }

$(document).on('submit', '#formEditarFase', function(e) {
    e.preventDefault();

    let formData = new FormData(this);
    let id = $('#idFase').val();

    $.ajax({
        url: route('fases.editGuardar', {id: id}), // Asegúrate de que esta URL coincida con tu ruta en Laravel
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
            if (data.estado == 'success') {
                toastr.success('Fase actualizado correctamente');
                setTimeout(function() {
                    location.reload(); // Recargar la página después de 2 segundos
                }, 500);
            } else {
                toastr.error('Error: Fase no actualizado');
            }
        },
        error: function(xhr, status, error) {
            toastr.error('Error: Fase no actualizado', error);
        }
    });
});
});
