"use strict";

const video = document.getElementById('localVideo');
const canvas = document.getElementById('localVideo');
const photo = document.getElementById('photo');
const captureButton = document.getElementById('capture');
var videoStream;

$(function () {
    iniciarCamara();
});

$(document).on('click', '#muteVideo', function() {
    iniciarCamara();
});

const iniciarCamara = () => {
    if (!videoStream) {
        navigator.mediaDevices.getUserMedia({ video: true, audio: true })
            .then(function(stream) {
                videoStream = stream;
                video.srcObject = stream;
            })
            .catch(function(err) {
                console.error("Error al acceder a la cámara: ", err);
            });
        $('#muteVideo').removeClass('btn-danger').addClass('btn-dark');
        $('#muteVideo i').removeClass('fa-video-slash').addClass('fa-video');
    } else {
        videoStream.getTracks().forEach(track => track.stop());
        video.srcObject = null;
        videoStream = null;
        $('#muteVideo').removeClass('btn-dark').addClass('btn-danger');
        $('#muteVideo i').removeClass('fa-video').addClass('fa-video-slash');
        
    }
}

// Echo
// Echo.join(`chat.${window.user}`).listen('MensajeSent', (e) => {
//     let contacto = e?.mensaje?.de ?? 0;
//     if (contacto == parseInt($('#idContacto').val())) {
//         generalidades.refrescarSeccion(null, route('chats.contacto', contacto), '.seccionChat', function(){
//             generalidades.validarFormulario(formMensaje, enviarDatos);
//             $("#espacioChat").scrollTop($("#espacioChat").prop("scrollHeight"));
//             $(".textInput").emojiPicker();
//             KTMenu.createInstances();
//         }, false);
//     }
// }).joining(user => {
//     console.log('2: '+user);
//     if (user.id != window.user) {
//         $('.iconEstado').addClass('badge-success').removeClass('badge-danger');
//         $('.textoEstado').text('Activo');
//     }
// }).leaving(user => {
//     console.log('3: '+user);
//     if (user.id != window.user) {
//         $('.iconEstado').addClass('badge-danger').removeClass('badge-success');
//         $('.textoEstado').text('Inactivo');
//     }
// }).here(users => {
//     console.log(users, window.user);
//     let result = users.filter(user => user.id != window.user);
//     if (result.length > 0) {
//         $('.iconEstado').addClass('badge-success').removeClass('badge-danger');
//         $('.textoEstado').text('Activo');
//     }
// });