"use strict";

const modalEditarActividad = "#modalEditarActividad";
const modalListadoActividades = "#modalActividades";

$(document).on('click', '.btnEditarActividades', function(e){
    e.preventDefault();

    let id = $(this).attr('data-actividades');

    console.log('ID de actividad', id);
    if (id) {
        $.ajax({
            url: route('actividades.traerAct', {id: id}), // Ruta para obtener los datos de la actividad
            type: 'GET',
            success: function(response) {
                if (response.estado === 'success') {
                    let data = response.actividad;
                    console.log('DATA', data);
                    // Suponiendo que `data` contiene los datos de la actividad en formato JSON
                    $('#tituloActividad').val(data.titulo);
                    $('#fecha_inicioAct').val(data.fecha_inicio);
                    $('#fecha_finAct').val(data.fecha_fin);
                    $('#descripcionAct').val(data.descripcion);

                    $('#idActividad').val(id); // Si tienes un campo oculto para el ID
                    generalidades.modalActual(modalEditarActividad);
                    $(modalEditarActividad).modal('show');
                    window.listadoActividades()
                } else {
                    console.error('Error:', response.mensaje);
                    // Manejo del mensaje de error
                }
            },
            error: function(xhr, status, error) {
                console.error('Error al obtener los datos de la actividad:', error);
                // Manejo del error
            }
        });
    }

    "use strict";

    $(document).on('submit', '#formEditarActividad', function(e) {
        e.preventDefault();
    
        let formData = new FormData(this);
        let id = $('#idActividad').val();
        let fechaInicio = new Date($('#fecha_inicioAct').val());
        let fechaFin = new Date($('#fecha_finAct').val());
        formdata.set('valor', formdata.get('valor').replace('$', ''));
    
        if (fechaInicio < fechaFin) {
    
            $.ajax({
                url: route('actividades.editGuardar', {id: id}), // Asegúrate de que esta URL coincida con tu ruta en Laravel
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.estado == 'success') {
                        toastr.success('Actividad actualizada correctamente');
                        // Cierra el modal actual
                        $(modalEditarActividad).modal('hide');
                        // Abre el modal listado de actividades
                        generalidades.modalActual(modalListadoActividades);
                        $(modalListadoActividades).modal('show');
                    } else {
                        toastr.error('Error: actividad no actualizada');
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error('Error: actividad no actualizada', error);
                }
            });
        } else {
            toastr.error('La Fecha Fin no puede ser menor a la Fecha Inicio');
        }
        console.log('Enviado');
    });
    

});


$(document).on('click', '.btnInactivarActividad', function(e){
    let id = $(this).attr('data-actividades');

    if (id) {

        $.ajax({
            url: route('actividades.inactivarAct', {id: id}),
            type:'POST',

            success: function(response){
                console.log(response);
                if (response.estado = 'success') {
                    toastr.success(response.message);
                    window.listadoActividades();
                }else{
                    toastr.error('Error al inactivar la actividad')
                }
            },
            error: function(xhr,error,status){
                toastr.error('Error al inactivar la actividad')
            }
        })
    }
})
