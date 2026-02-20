"use strict";
$(document).ready(function() {

    var csrfToken = $('meta[name="csrf-token"]').attr("content");

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    });


    $('#formActividades').on('submit', function(e) {
        let idCompo = $('#idFase').val();
        let inputFechaInicio = $('#fecha_inicioCrear').val();
        let inputFechaFin = $('#fecha_finCrear').val();
        e.preventDefault(); // Evitar el envío tradicional del formulario

        // console.log('HOL SOI');
        // console.log('ID componenete', idCompo);
        let formdata = new FormData(this);
        formdata.append('idFase', idCompo);
        formdata.append('_token', csrfToken);
        formdata.set('valor', formdata.get('valor').replace('$', ''));

        if (inputFechaInicio < inputFechaFin) {

        $.ajax({
            url: route('actividades.crearActividades'),
            type: 'POST',
            contentType: false,
            processData: false, // Corrección de typo: proccesData a processData
            data: formdata,
            success: function(response) { // Corrección de typo: succes a success
                toastr.success('Actividad creada');
                generalidades.resetValidate($('#formActividades'));
                window.listadoActividades()
            },
            error: function(response) {
                toastr.error('Error al crear la fase');
            }
        });
    } else{
        toastr.error('Error la Fecha Fin no puede ser menor a la Fecha Inicio');
    }
    });

});
