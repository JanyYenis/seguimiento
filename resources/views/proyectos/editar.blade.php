@extends('layouts.index', ['titulo' => 'Proyecto', 'nombre_titulo' => 'Proyecto - '.$proyecto?->nombre])

@section('btns')
@endsection

@section('css')
    {{-- <link rel="Stylesheet" href="{{ asset('assets/gantt-dlhsoft/app.css') }}" type="text/css" /> --}}
    {{-- <link rel="Stylesheet" href="{{ asset('assets/gantt-dhtmlx/dhtmlxgantt.css') }}" type="text/css" /> --}}
    {{-- <link rel="Stylesheet" href="{{ asset('assets/gantt-dhtmlx/skins/dhtmlxgantt_meadow.css') }}" type="text/css" /> --}}
    {{-- <link rel="Stylesheet" href="{{ asset('assets/gantt-dhtmlx/skins/dhtmlxgantt_material.css') }}" type="text/css" /> --}}

    <style>
        .gantt-fullscreen {
			position: absolute;
			bottom: 20px;
			right: 20px;
			width: 30px;
			height: 30px;
			padding: 2px;
			font-size: 32px;
			background: transparent;
			cursor: pointer;
			opacity: 0.5;
			text-align: center;
			-webkit-transition: background-color 0.5s, opacity 0.5s;
			transition: background-color 0.5s, opacity 0.5s;
		}

		.gantt-fullscreen:hover {
			background: rgba(150, 150, 150, 0.5);
			opacity: 1;
		}
    </style>
@endsection

@section('content')
    <div class="card mb-6 mb-xl-9">
        <div class="card-body pt-9 pb-0">
            <!--begin::Details-->
            <div class="d-flex flex-wrap flex-sm-nowrap mb-6">
                <!--begin::Image-->
                <div
                    class="d-flex flex-center flex-shrink-0 bg-light rounded w-100px h-100px w-lg-150px h-lg-150px me-7 mb-4">
                    <img class="mw-50px mw-lg-75px" src="{{ asset($proyecto->logo) }}" alt="image">
                </div>
                <!--end::Image-->

                <!--begin::Wrapper-->
                <div class="flex-grow-1">
                    <!--begin::Head-->
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <!--begin::Details-->
                        <div class="d-flex flex-column">
                            <!--begin::Status-->
                            <div class="d-flex align-items-center mb-1">
                                <a href="#"
                                    class="text-negro f-titulo fs-2hx fw-bold me-3">{{ $proyecto?->nombre }}</a>
                                <span class="badge badge-light-{{$proyecto?->infoEstado?->color}} me-auto">{{$proyecto?->infoEstado?->nombre}}</span>
                            </div>
                            <!--end::Status-->

                            <!--begin::Description-->
                            <div class="d-flex flex-wrap fw-semibold mb-4 fs-5 text-gray-500">
                                {!! substr(html_entity_decode($proyecto?->descripcion ?? '', ENT_QUOTES, 'UTF-8'), 0, 200) !!}
                            </div>
                            <!--end::Description-->
                        </div>
                        <!--end::Details-->

                        @can('tareas.crear')
                            <!--begin::Actions-->
                            <div class="d-flex mb-4" style="display: none">
                                <a href="#" class="btn btn-sm btn-primary-gijac me-3 d-flex align-items-center" data-bs-toggle="modal" style="display: none;"
                                    data-bs-target="#modalCrearTarea"><i class="bi bi-plus-lg text-white me-2"></i> Nueva tarea</a>
                            </div>
                            <!--end::Actions-->
                        @endcan
                    </div>
                    <!--end::Head-->

                    <!--begin::Info-->
                    <div class="d-flex flex-wrap justify-content-start">
                        <!--begin::Stats-->
                        <div class="d-flex flex-wrap">
                            <!--begin::Stat-->
                            <div class="border border-gray-300 border-1 rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <!--begin::Number-->
                                <div class="fw-semibold fs-6 text-gray-500">Fecha entrega</div>


                                <div class="d-flex align-items-center">
                                    <div class="fs-4 fw-bold">{{ $proyecto->fecha_fin->format('d/m/Y') }}</div>
                                </div>
                                <!--end::Number-->

                                <!--begin::Label-->
                                <!--end::Label-->
                            </div>
                            <!--end::Stat-->

                            <!--begin::Stat-->
                            <div class="border border-gray-300 border-1 rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <!--begin::Number-->
                                <div class="fw-semibold fs-6 text-gray-500">Tareas abiertas</div>


                                <div class="d-flex align-items-center">
                                    <i class="fas {{count($proyecto?->tareasEnProgreso) <= count($proyecto?->tareasPendientes) ? 'fa-arrow-down text-danger' : 'fa-arrow-up text-success'}} fs-3 me-2"><span
                                            class="path1"></span><span class="path2"></span></i>
                                    <div class="fs-4 fw-bold" data-kt-countup="true" data-kt-countup-value="{{count($proyecto?->tareasEnProgreso)}}">0
                                    </div>
                                </div>
                                <!--end::Number-->

                                <!--begin::Label-->
                                <!--end::Label-->
                            </div>
                            <!--end::Stat-->

                            <!--begin::Stat-->
                            <div class="border border-gray-300 border-1 rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <!--begin::Number-->
                                <div class="fw-semibold fs-6 text-gray-500">Presupuesto gastado</div>


                                <div class="d-flex align-items-center">
                                    <i class="fas {{$proyecto?->presupuestoActivo?->valor_gastador > $proyecto?->presupuestoActivo?->valor ? 'fa-arrow-down text-danger' : 'fa-arrow-up text-success'}} fs-3 me-2"><span
                                            class="path1"></span><span class="path2"></span></i>
                                    <div class="fs-4 fw-bold text-{{$proyecto?->presupuestoActivo?->valor_gastador > $proyecto?->presupuestoActivo?->valor ? 'danger' : 'success'}}" data-kt-countup="true" data-kt-countup-value="{{$proyecto?->presupuestoActivo?->valor_gastador ?? 0}}"
                                        data-kt-countup-prefix="$">
                                        $0</div>
                                </div>
                                <!--end::Number-->

                                <!--begin::Label-->
                                <!--end::Label-->
                            </div>
                            <!--end::Stat-->
                        </div>
                        <!--end::Stats-->

                        <!--begin::Users-->
                        <div class="symbol-group symbol-hover mb-3">
                            @foreach ($proyecto->responsablesActivos as $responsable)
                                <!--begin::User-->
                                <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip"
                                    aria-label="{{ $responsable?->usuario?->nombre_completo }}"
                                    data-bs-original-title="{{ $responsable?->usuario?->nombre_completo }}">
                                    <img alt="Pic"
                                        src="{{ asset($responsable?->usuario?->foto ? $responsable?->usuario?->foto : 'assets/media/avatars/150-2.jpg') }}">
                                </div>
                                <!--begin::User-->
                            @endforeach
                        </div>
                        <!--end::Users-->
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Details-->

            <div class=""></div>

            <!--begin::Nav-->
            <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                <!--begin::Nav item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary py-5 me-6 active fs-3 btnTabMetricas" data-bs-toggle="tab" href="#tabMetricas">
                        Resumen </a>
                </li>
                <!--end::Nav item-->
                @canany(['fases.crear', 'fases.listado', 'fases.editar', 'fases.eliminar'])
                    <!--begin::Nav item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary py-5 me-6 fs-3" data-bs-toggle="tab" href="#tabFases">
                            Fases </a>
                    </li>
                    <!--end::Nav item-->
                @endcanany
                @canany(['tareas.crear', 'tareas.listado', 'tareas.editar', 'tareas.eliminar'])
                    <!--begin::Nav item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary py-5 me-6 fs-3 tabLinkTareas" data-bs-toggle="tab" href="#tabTareas">
                            Tareas </a>
                    </li>
                    <!--end::Nav item-->
                @endcanany
                @canany(['presupuestos.crear', 'presupuestos.listado', 'presupuestos.editar', 'presupuestos.eliminar'])
                    <!--begin::Nav item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary py-5 me-6 fs-3" data-bs-toggle="tab" href="#tabPresupuestos">
                            Presupuesto </a>
                    </li>
                    <!--end::Nav item-->
                @endcanany
                @canany(['proyectos.listado','proyectos.editar', 'proyectos.eliminar'])
                    <!--begin::Nav item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary py-5 me-6 fs-3" data-bs-toggle="tab" href="#tabConfiguraciones">
                            Configuraciones </a>
                    </li>
                    <!--end::Nav item-->
                @endcanany
                <!--begin::Nav item-->
                {{-- <li class="nav-item">
                    <a class="nav-link text-active-primary py-5 me-6 fs-3" id="tabChatProyectos" data-bs-toggle="tab" href="#tabChatProyecto">
                        Chat </a>
                </li> --}}
                <!--end::Nav item-->
                <!--begin::Nav item-->
                {{-- <li class="nav-item">
                    <a class="nav-link text-active-primary py-5 me-6 fs-3" id="btnGantt" data-bs-toggle="tab" href="#tabGantt">
                        Gantt </a>
                </li> --}}
                <!--end::Nav item-->
            </ul>
            <!--end::Nav-->
        </div>
    </div>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="tabMetricas" role="tabpanel">
            @component('proyectos.componentes-editar.metricas.index')
                @slot('proyecto', $proyecto)
                @slot('tareasAtrazadas', $tareasAtrazadas)
                @slot('cantidad_total', $cantidad_total)
                @slot('cantidad_pendientes', $cantidad_pendientes)
                @slot('cantidad_completados', $cantidad_completados)
                @slot('cantidad_ejecucion', $cantidad_ejecucion)
                @slot('daysOfWeek', $daysOfWeek)
                @slot('responsables', $responsables)
            @endcomponent
        </div>
        <div class="tab-pane fade" id="tabTareas" role="tabpanel">
            @component('proyectos.componentes-editar.tareas.index')
                @slot('proyecto', $proyecto)
            @endcomponent
        </div>
        <div class="tab-pane fade" id="tabFases" role="tabpanel">
            @component('proyectos.componentes-editar.fases.index')
                @slot('proyecto', $proyecto)
            @endcomponent
        </div>
        <div class="tab-pane fade" id="tabPresupuestos" role="tabpanel">
            @component('proyectos.componentes-editar.presupuestos.index')
                @slot('proyecto', $proyecto)
                @slot('presupuesto', $proyecto?->presupuestoActivo ?? null)
                @slot('total_tareas', count($proyecto?->tareasActivas) ?? 0)
            @endcomponent
        </div>
        <div class="tab-pane fade" id="tabConfiguraciones" role="tabpanel">
            @component('proyectos.componentes-editar.configuraciones.index')
                @slot('proyecto', $proyecto)
                @slot('responsables', $responsables)
                @slot('clientes', $clientes)
            @endcomponent
        </div>
        {{-- <div class="tab-pane fade" id="tabChatProyecto" role="tabpanel">
            @component('proyectos.componentes-editar.chat.index')
                    @slot('proyecto', $proyecto)
            @endcomponent
        </div> --}}
        {{-- <div class="tab-pane fade" id="tabGantt" role="tabpanel">
            @component('proyectos.componentes-editar.gantt.index')
            @endcomponent
        </div> --}}
    </div>
@endsection

@section('modal')
    @component('proyectos.componentes-editar.tareas.modals.crear')
        @slot('proyecto', $proyecto)
    @endcomponent
    @component('proyectos.componentes-editar.tareas.modals.modal')
        @slot('proyecto', $proyecto)
    @endcomponent

    @component('proyectos.componentes-editar.chat.indexChatPro')
    @endcomponent

    @component('proyectos.componentes-editar.fases.crear')
    @endcomponent

    @component('proyectos.componentes-editar.fases.cargar')
    @endcomponent

    @component('proyectos.componentes-editar.fases.actividades.listadoActividades')
    @endcomponent

    @component('proyectos.componentes-editar.fases.actividades.editar')
    @endcomponent

    @component('proyectos.componentes-editar.fases.actividades.cargar')
    @endcomponent
@endsection

@section('scripts')
    <script>
        window.id_proyecto = {{$proyecto->id}};
        window.id_archivo = '{{$proyecto->id_carpeta}}';
        window.nombre_archivo = '{{$proyecto->nombre ?? 'N/A'}}';
    </script>
    <script src="{{ mix('/js/proyectos/editar.js') }}" ></script>
    {{-- <script src="{{ mix('js/drive/principal.js') }}"></script> --}}
    {{-- <script src="{{ mix('js/chat/principal.js') }}"></script> --}}

    {{-- <script src="{{ asset('assets/gantt-dlhsoft/Scripts/DlhSoft.ProjectData.GanttChart.HTML.Controls.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/gantt-dlhsoft/Scripts/DlhSoft.Data.HTML.Controls.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/gantt-dlhsoft/Scripts/DlhSoft.ProjectData.GanttChart.HTML.Controls.Extras.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/gantt-dlhsoft/Scripts/DlhSoft.ProjectData.PertChart.HTML.Controls.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/gantt-dlhsoft/themes.js') }}" type="text/javascript"></script> --}}

    {{-- <script src="{{ asset('assets/gantt-dhtmlx/dhtmlxgantt.js') }}"></script>
    <script src="https://export.dhtmlx.com/gantt/api.js"></script> --}}
@endsection
