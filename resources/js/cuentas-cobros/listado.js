"use strict";

const tablaCuentaCobro = "#tablaCuentaCobro";

$(function () {
    iniciarComponentes();
});

const iniciarComponentes = (form = '') => {
    window.listadoCuentaCobros();
}

/**
 * Función que permite cargar el listado.
 */
window.listadoCuentaCobros = () => {
    if ($.fn.DataTable.isDataTable('#tablaCuentaCobro')) {
        $('#tablaCuentaCobro').DataTable().destroy();
    }

    var table = $("#tablaCuentaCobro").DataTable({
        paging: true,
        responsive: true,
        serverSide: true,
        scrollX: true,
        searchDelay: 500,

        ajax: {
            "url": route("cuentas-cobros.listado"),
            "type": "GET",
            "headers": {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            },
            data: function (data) {
                generalidades.mostrarCargando(tablaCuentaCobro);
                data = Object.assign(data);
            },
            dataSrc: function (json) {
                generalidades.ocultarCargando(tablaCuentaCobro);
                return json.data
            },
        },
        buttons: [
            {
                extend: "excel",
                text: '<i class="fa fa-download"></i> Excel',
                className: "btn btn-light-success",
                title: "Listado Cuentas de Cobros.",
                exportOptions: {
                    columns: ":not(.excluir)"
                }
            },
            {
                text: '<i class="fa fa-sync-alt"></i> Actualizar',
                className: "btn btn-bg-secondary",
                action: function (e, dt, node, config) {
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
        columns: [
            {
                render: function (data, type, full, meta) {
                    return meta.row + 1;
                }
            },
            {
                data: 'fecha',
                name: 'fecha',
                render: function (data, type, full, meta) {
                    return full?.fecha ?? 'N/A';
                }
            },
            {
                data: 'nombre_cliente',
                name: 'nombre_cliente',
                render: function (data, type, full, meta) {
                    return full?.nombre_cliente ?? 'N/A';
                }
            },
            {
                data: 'nombre_remitente',
                name: 'nombre_remitente',
                render: function (data, type, full, meta) {
                    return full?.nombre_remitente ?? 'N/A';
                }
            },
            {
                data: 'valor',
                name: 'valor',
                render: function (data, type, full, meta) {
                    return full?.valor ?? 0;
                }
            },
            {
                data: 'estado',
                name: 'estado',
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ],
        order: [
            [1, "desc"]
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
