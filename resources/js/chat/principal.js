"use strict";

const formMensaje = '#formMensaje';
const formCamara = '#formCamara';
const para = '';
const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const photo = document.getElementById('photo');
const captureButton = document.getElementById('capture');
var typingTimer;                // Timer identifier
var doneTypingInterval = 1000;  // Time in ms (1 second)

$(function () {
    if (Notification.permission !== 'granted') {
        Notification.requestPermission().then(permission => {
            if (permission === 'granted') {
                console.log('Permiso concedido para notificaciones.');
            } else {
                console.log('Permiso denegado para notificaciones.');
            }
        });
    }
    // generalidades.validarFormulario(formMensaje, enviarDatos);
});

$(document).on('click', '.btnIrChat', function () {
    let contacto = $(this).attr('data-contacto');
    marcarComoLeido(contacto);
    generalidades.refrescarSeccion(null, route('chats.contacto', contacto), '.seccionChat', function () {
        actualizarEstadoUsuario();
        generalidades.validarFormulario(formMensaje, enviarDatos);
        $("#espacioChat").scrollTop($("#espacioChat").prop("scrollHeight"));
        $(".textInput").emojiPicker();
        KTMenu.createInstances();
    }, false);
});

const enviarDatos = (form) => {
    let formData = new FormData(document.getElementById("formMensaje"));

    const config = {
        'method': 'POST',
        'headers': {
            'Accept': generalidades.CONTENT_TYPE_JSON,
        },
        'body': formData
    }

    const success = (response) => {
        if (response.estado == 'success') {
            $('.textInput').val('');
            $('#inputMensaje').val('');
            // generalidades.resetValidate(formMensaje);
            if (response.html != undefined && response.html != '') {
                $('.seccionchat').html(response.html);
                $("#espacioChat").scrollTop($("#espacioChat").prop("scrollHeight"));
                actualizarEstadoUsuario();
            }
        }
        // generalidades.ocultarCargando('body');
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
    }

    const error = (response) => {
        // generalidades.ocultarCargando('body');
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
    }
    const ruta = route("chats.store");
    generalidades.create(ruta, config, success, error);
    // generalidades.mostrarCargando('body');
}

$(document).on('shown.bs.modal', '#modalCapturarFoto', function () {
    // Solicitar acceso a la cámara
    $('#video').removeClass('d-none');
    photo.style.display = 'none';
    $('#captureOtra').addClass('d-none');
    $('#enviar').addClass('d-none');
    $('#capture').removeClass('d-none');
    $('#mensajeInput').addClass('d-none');
    iniciarCamara();
    generalidades.validarFormulario(formCamara, enviarDatosCamara);
});

$(document).on('hidden.bs.modal', '#modalCapturarFoto', function () {
    if (video.srcObject) {
        let tracks = video.srcObject.getTracks();
        tracks.forEach(track => track.stop());
        video.srcObject = null;
    }
});

// Capturar foto
$(document).on('click', '#capture', function () {
    $('#video').addClass('d-none');
    canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
    photo.src = canvas.toDataURL('image/png');
    photo.style.display = 'block';
    $('#captureOtra').removeClass('d-none');
    $('#enviar').removeClass('d-none');
    $('#mensajeInput').removeClass('d-none');
    $('#capture').addClass('d-none');
    if (video.srcObject) {
        let tracks = video.srcObject.getTracks();
        tracks.forEach(track => track.stop());
        video.srcObject = null;
    }
    // console.log(canvas.toDataURL());
});

$(document).on('click', '#captureOtra', function () {
    iniciarCamara();
    $('#video').removeClass('d-none');
    photo.style.display = 'none';
    $('#captureOtra').addClass('d-none');
    $('#enviar').addClass('d-none');
    $('#mensajeInput').addClass('d-none');
    $('#capture').removeClass('d-none');
});

const iniciarCamara = () => {
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(function (stream) {
            video.srcObject = stream;
        })
        .catch(function (err) {
            console.error("Error al acceder a la cámara: ", err);
        });
}

const enviarDatosCamara = (form) => {
    let formData = new FormData(document.getElementById("formCamara"));
    formData.append('id', parseInt($('#idContacto').val()));
    formData.append('imagen', canvas.toDataURL());

    const config = {
        'method': 'POST',
        'headers': {
            'Accept': generalidades.CONTENT_TYPE_JSON,
        },
        'body': formData
    }

    const success = (response) => {
        if (response.estado == 'success') {
            $('.textInput').val('');
            $('#modalCapturarFoto .btnClose').trigger('click');
            // generalidades.resetValidate(formMensaje);
            if (response.html != undefined && response.html != '') {
                $('.seccionchat').html(response.html);
                $("#espacioChat").scrollTop($("#espacioChat").prop("scrollHeight"));
                actualizarEstadoUsuario();
            }
        }
        // generalidades.ocultarCargando('body');
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
    }

    const error = (response) => {
        // generalidades.ocultarCargando('body');
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
    }
    const ruta = route("chats.store");
    generalidades.create(ruta, config, success, error);
    // generalidades.mostrarCargando('body');
}

$(document).on('click', '.btnGaleria', function () {
    $('#idArchivo').trigger('click');
});

const marcarComoLeido = (de) => {
    const config = {
        'method': 'GET',
        'headers': {
            'Accept': generalidades.CONTENT_TYPE_JSON,
        },
    }

    const success = (response) => {
        if (response.estado == 'success') {
            generalidades.refrescarSeccion(null, route('chats.actualizarContactos'), '.seccionContactos', function () {
                if (de == parseInt($('#idContacto').val())) {
                    generalidades.refrescarSeccion(null, route('chats.contacto', {contacto: de}), '.seccionChat', function () {
                        generalidades.validarFormulario(formMensaje, enviarDatos);
                        $("#espacioChat").scrollTop($("#espacioChat").prop("scrollHeight"));
                        $(".textInput").emojiPicker();
                        actualizarEstadoUsuario();
                        KTMenu.createInstances();
                    }, false);
                }
            }, false);
        }
    }

    const error = (response) => {
    }

    generalidades.get(route('chats.macar-mensale-leido', {de: de, para: window.user}), config, success, error);
}


$(document).on('keyup', '#inputSearchContactos', function() {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(buscarContactos(this.value), doneTypingInterval);
});

// On keydown, clear the countdown 
$(document).on('keydown', '#inputSearchContactos', function() {
    clearTimeout(typingTimer);
});

const buscarContactos = (texto) => {
    generalidades.refrescarSeccion(null, route('chats.actualizarContactos', {valor: texto}), '.seccionContactos', function () {
    }, false);
}

// ----------------------------------------------------------------------------------------------
// Echo
Echo.join(`chat.${window.user}`).listen('MensajeSent', (e) => {
    generalidades.refrescarSeccion(null, route('chats.actualizarContactos'), '.seccionContactos', function () {
    }, false);
    if (Notification.permission === 'granted') {
        new Notification('KDrive', {
            body: (e?.mensaje?.de_u?.nombre_completo ?? 'N/A') + ': ' + (e?.mensaje?.contenido ?? 'Tienes un mensaje'),
            icon: e?.mensaje?.de_u?.foto ? '../../' + e?.mensaje?.de_u?.foto : '../../img/logos/k2.png' // opcional
        });
    }

    let contacto = e?.mensaje?.de ?? 0;
    if (contacto == parseInt($('#idContacto').val())) {
        generalidades.refrescarSeccion(null, route('chats.contacto', contacto), '.seccionChat', function () {
            marcarComoLeido(contacto);
            generalidades.validarFormulario(formMensaje, enviarDatos);
            $("#espacioChat").scrollTop($("#espacioChat").prop("scrollHeight"));
            $(".textInput").emojiPicker();
            actualizarEstadoUsuario();
            KTMenu.createInstances();
        }, false);
    }
}).joining(user => {
    // console.log('2: '+user);
    actualizarEstadoUsuario();
}).leaving(user => {
    // console.log('3: '+user);
    actualizarEstadoUsuario();
}).here(users => {
    // console.log(users, window.user);
    actualizarEstadoUsuario();
});

Echo.join(`chat.leido.${window.user}`).listen('MensajeLeido', (e) => {
    if (parseInt($('#idContacto').val())) {
        generalidades.refrescarSeccion(null, route('chats.contacto', {contacto: parseInt($('#idContacto').val())}), '.seccionChat', function () {
            generalidades.validarFormulario(formMensaje, enviarDatos);
            $("#espacioChat").scrollTop($("#espacioChat").prop("scrollHeight"));
            $(".textInput").emojiPicker();
            actualizarEstadoUsuario();
            KTMenu.createInstances();
        }, false);
    }
});

Echo.join(`online`)
    .here((users) => {
        window.userChats = users;
        // Haz algo con los usuarios que ya están en línea.
        // let result = users.filter(user => user.id != window.user && parseInt($('#idContacto').val()) == user.id);
        // if (result.length > 0) {
        //     $('.iconEstado').addClass('badge-success').removeClass('badge-danger');
        //     $('.textoEstado').text('Activo');
        // }
        actualizarEstadoUsuario();
    })
    .joining((user) => {
        // Haz algo cuando un usuario se conecta.
        // if (user.id != window.user && parseInt($('#idContacto').val()) == user.id) {
        //     $('.iconEstado').addClass('badge-success').removeClass('badge-danger');
        //     $('.textoEstado').text('Activo');
        // }

        // let result = window.userChats.filter(user => user.id != window.user && parseInt($('#idContacto').val()) == user.id);
        // if (result.length > 0) {
        //     $('.iconEstado').addClass('badge-success').removeClass('badge-danger');
        //     $('.textoEstado').text('Activo');
        // } else {
        //     $('.iconEstado').addClass('badge-danger').removeClass('badge-success');
        //     $('.textoEstado').text('Inactivo');
        // }
        window.userChats.push(user);
        actualizarEstadoUsuario();
    })
    .leaving((user) => {
        // Haz algo cuando un usuario se desconecta.
        // if (user.id != window.user && parseInt($('#idContacto').val()) == user.id) {
        //     $('.iconEstado').addClass('badge-danger').removeClass('badge-success');
        //     $('.textoEstado').text('Inactivo');
        // }

        // let result = window.userChats.filter(user => user.id != window.user && parseInt($('#idContacto').val()) == user.id);
        // if (result.length > 0) {
        //     $('.iconEstado').addClass('badge-success').removeClass('badge-danger');
        //     $('.textoEstado').text('Activo');
        // } else {
        //     $('.iconEstado').addClass('badge-danger').removeClass('badge-success');
        //     $('.textoEstado').text('Inactivo');
        // }
        window.userChats = window.userChats.filter(u => u.id !== user.id);
        actualizarEstadoUsuario();
    });

    const actualizarEstadoUsuario = () => {
        let result = window.userChats.filter(user => user.id != window.user && parseInt($('#idContacto').val()) == user.id);
        if (result.length > 0) {
            $('.iconEstado').addClass('badge-success').removeClass('badge-danger');
            $('.textoEstado').text('Activo');
        } else {
            $('.iconEstado').addClass('badge-danger').removeClass('badge-success');
            $('.textoEstado').text('Inactivo');
        }
    }