"use strict";

$(function () {
    iniciarComponentes();
});

const iniciarComponentes = (form = '') => {
    KTMenu.createInstances();
}

$(document).on('click', '#btnMarcarNotificaciones', function(){
    $('body').trigger('click');
    generalidades.refrescarSeccion($(this), route('notificaciones.marcarNotificaciones'), '.seccionNotificacionesGeneral', iniciarComponentes);
});

// Echo
Echo.join(`notificacion.${window.user}`).listen('UsuarioRolEvent', (e) => {
    generalidades.refrescarSeccion(null, route('notificaciones.index'), '.seccionNotificacionesGeneral', function(){
        iniciarComponentes();
    }, false);
});

Echo.join(`online`)
    .here((users) => {
        // Haz algo con los usuarios que ya están en línea.
        // $('#totalUsuariosActivos').text(users.length);
    })
    .joining((user) => {
        // Haz algo cuando un usuario se conecta.
        // let totalUser = parseInt($('#totalUsuariosActivos').text());
        // $('#totalUsuariosActivos').text(totalUser + 1);
    })
    .leaving((user) => {
        // Haz algo cuando un usuario se desconecta.
        // let totalUser = parseInt($('#totalUsuariosActivos').text());
        // $('#totalUsuariosActivos').text(totalUser - 1);

        // const config = {
        //     'method': 'GET',
        //     'headers': {
        //         'Accept': generalidades.CONTENT_TYPE_JSON,
        //     },
        // }
    
        // const success = (response) => {
        //     if (response.estado == 'success') {
        //     }
        //     generalidades.toastrGenerico(response?.estado, response?.mensaje);
        // }
    
        // const error = (response) => {
        //     generalidades.toastrGenerico(response?.estado, response?.mensaje);
        // }

        // generalidades.get(route('accesos.marca-salida', { usuario: user.id }), config, success, error);
    });