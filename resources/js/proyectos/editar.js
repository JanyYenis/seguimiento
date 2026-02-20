"use strict";

$(function () {
    //
});

const iniciarComponentes = (form = "") => {
}

var KTProjectList = {

    init: function () {
        var t = KTUtil.getCssVariableValue("--bs-primary")
            , e = KTUtil.getCssVariableValue("--bs-primary-light")
            , a = KTUtil.getCssVariableValue("--bs-success")
            , r = KTUtil.getCssVariableValue("--bs-success-light")
            , o = KTUtil.getCssVariableValue("--bs-gray-200")
            , n = KTUtil.getCssVariableValue("--bs-gray-500");
        var s, i;
        !function () {
            var t = document.getElementById("project_overview_chart");
            if (t) {
                var e = t.getContext("2d");
                chartTotaTareas(e);
            }
        }()
    }
};

KTUtil.onDOMContentLoaded((function () {
    KTProjectList.init();
}));

$(document).on('click', '.verTarea', function(){
    $('.tabLinkTareas').trigger('click');
});

const chartTotaTareas = (e) => {
    let ruta = route('proyectos.chartTotaTareas', {proyecto: window.id_proyecto});
    let config = {
        'method': 'GET',
        'headers': {
            'Accept': generalidades.CONTENT_TYPE_JSON,
        },
    }

    const success = (response) => {
        if (response.estado == 'success') {
            new Chart(e, {
                type: "doughnut",
                data: {
                    datasets: [{
                        data: response.data,
                        backgroundColor: ["#1B84FF", "#F6C000", "#20c997"]
                    }],
                    labels: ["Pendiente", "En proceso", "Completado"]
                },
                options: {
                    chart: {
                        fontFamily: "inherit"
                    },
                    borderWidth: 0,
                    cutout: "75%",
                    cutoutPercentage: 65,
                    responsive: !0,
                    maintainAspectRatio: !1,
                    title: {
                        display: !1
                    },
                    animation: {
                        animateScale: !0,
                        animateRotate: !0
                    },
                    stroke: {
                        width: 0
                    },
                    tooltips: {
                        enabled: !0,
                        intersect: !1,
                        mode: "nearest",
                        bodySpacing: 5,
                        yPadding: 10,
                        xPadding: 10,
                        caretPadding: 0,
                        displayColors: !1,
                        backgroundColor: "#20D489",
                        titleFontColor: "#ffffff",
                        cornerRadius: 4,
                        footerSpacing: 0,
                        titleSpacing: 0
                    },
                    plugins: {
                        legend: {
                            display: !1
                        }
                    }
                }
            })
        }
        generalidades.ocultarCargando('body');
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
    }
    const error = (response) => {
        generalidades.ocultarCargando('body');
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
    }
    generalidades.get(ruta, config, success, error);
    generalidades.mostrarCargando('body');
}

$(document).on('click', '.btnTabMetricas', function(){
    var t = document.getElementById("project_overview_chart");
    if (t) {
        var e = t.getContext("2d");
        chartTotaTareas(e);
    }
});

require('./componentes-editar/informacion-basica');
require('./componentes-editar/tareas/principal');
require('./componentes-editar/presupuesto/principal');
require('./componentes-editar/fases/principal');
// require('./componentes-editar/gantt/principal');
