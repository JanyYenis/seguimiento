$(document).ready(function() {

    const tablaFases = '#tablaFases'

    window.listadoFases = (id = 0) => {
            if ($.fn.DataTable.isDataTable('#tablaFases')) {
                $('#tablaFases').DataTable().destroy();
            }

            var table = $('#tablaFases').DataTable({
                paging: true,
                responsive: true,
                serverSide: false,
                scrollX: true,
                searchDelay: 500,


                ajax:{
                    "url": route('fases.listadoFase'),
                    "type": 'GET',
                    "headers":{
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    data: function(data){
                        generalidades.mostrarCargando(tablaFases);
                        data.idProyecto = window.id_proyecto;
                        data = Object.assign(data);
                    },
                    dataSrc: function(json){
                        generalidades.ocultarCargando(tablaFases);
                        return json.data;
                    },
                },

                buttons: [
                    {
                        extend: "excel",
                        text: '<i class="fa fa-download"></i> Excel',
                        className: "btn btn-light-success",
                        title: "Listado proyectos",
                        exportOptions: {
                            columns: ":not(.excluir)"
                        }
                    },
                    {
                        text: '<i class="fa fa-sync-alt"></i> Actualizar',
                        className: "btn btn-bg-secondary",
                        action: function(e,  dt, node, config){
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
                columns:[
                    {
                        render: function (data, type, full, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: "titulo",
                        name: "titulo"
                    },
                    {
                        data: "descripcion",
                        name: "descripcion"
                    },
                    {
                        data: "valor",
                        name: "valor",
                        render: function (data, type, full, meta) {
                            return full?.valor ? '$'+parseInt(full.valor).toLocaleString('de-DE') : '$0';
                        }
                    },
                    {
                        data: "action",
                        name: "action",
                        typable: false,
                        searchable: false,
                    }
                ],
                order: [
                    [0, "asc"]
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


})

