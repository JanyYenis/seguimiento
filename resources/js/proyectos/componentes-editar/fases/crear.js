$(document).ready(function() {

var csrfToken = $('meta[name="csrf-token"]').attr("content");

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': csrfToken
    }
});

$('#formCrearfase').on('submit', function(e){
    e.preventDefault(); // Evitar el envío tradicional del formulario

    let formData = new FormData(this);
    let id_proyecto = window.id_proyecto;

    formData.append('idProyecto', id_proyecto); // Añadir idProyecto al FormData
    formData.append('_token', csrfToken); // Añadir CSRF token al FormData

    $.ajax({
        url: route('fases.crearfase'),
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response){
            if (response.estado === 'succes') {
                toastr.success('Fase Creado');
                setTimeout(function() {
                    location.reload(); // Recargar la página después de 2 segundos
                }, 500); // Puedes ajustar el tiempo de espera según sea necesario
            } else {
                toastr.error('Error al crear la fase:\n', response);
            }
        },
        error: function(response){
            toastr.error('Error al crear la fase:\n', response.responseText);
        }
    });
});

});
