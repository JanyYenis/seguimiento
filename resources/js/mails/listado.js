"use strict";

const tablaMails = "#tablaMails";

$(function () {
    iniciarComponentes();
});

const iniciarComponentes = (form = '') => {
    window.listadoMails();
}

/**
 * Función que permite cargar el listado.
 */
window.listadoMails = () => {
    if ($.fn.DataTable.isDataTable('#tablaMails')) {
        $('#tablaMails').DataTable().destroy();
    }

    var table = $("#tablaMails").DataTable({
        paging: true,
        responsive: true,
        serverSide: false,
        scrollX: true,
        searchDelay: 500,

        ajax: {
            "url": route("mails.listado"),
            "type": "GET",
            "headers": {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            },
            data: function (data) {
                generalidades.mostrarCargando(tablaMails);
                data = Object.assign(data);
            },
            dataSrc: function (json) {
                generalidades.ocultarCargando(tablaMails);
                return json.data
            },
        },
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
        columns: [
            {
                data: 'checkbox',
                orderable: false,
                searchable: false
            },
            {
                data: 'acciones',
                name: 'acciones',
                orderable: false,
                searchable: false
            },
            {
                data: 'autor',
                name: 'autor',
            },
            {
                data: 'asunto',
                name: 'asunto'
            },
            {
                data: 'fecha_envio',
                name: 'fecha_envio'
            },
        ],
        order: [
            [0, "asc"]
        ],
        lengthMenu: [
            [15, 20, 50, 100, -1],
            [15, 20, 50, 100, "Todos"]
        ],
        pageLength: 15,
        dom: `<'table-responsive'tr>
            <'row'<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i><'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>>`,
        initComplete: function () {},
        drawCallback: function(settings) {
            KTMenu.createInstances();
        }
    });
}
