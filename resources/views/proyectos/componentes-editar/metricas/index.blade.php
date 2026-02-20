<div class="row gx-6 gx-xl-9">
    <!--begin::Col-->
    <div class="col-lg-6">
        <!--begin::Summary-->
        <div class="card card-flush h-lg-100">
            <!--begin::Card header-->
            <div class="card-header mt-6">
                <!--begin::Card title-->
                <div class="card-title flex-column">
                    <h3 class="fw-bold fs-2hx mb-1">Resumen de tareas</h3>

                    <div class="fs-6 fw-semibold text-gray-500">{{count($tareasAtrazadas) ?? 0}} tareas atrasadas</div>
                </div>
                <!--end::Card title-->

                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    {{-- <a type="button" href="#" class="btn btn-primary-gijac verTarea">Ver tareas</a> --}}
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body p-9 pt-5">
                <!--begin::Wrapper-->
                <div class="d-flex flex-wrap">
                    <!--begin::Chart-->
                    <div class="position-relative d-flex flex-center h-175px w-175px me-15 mb-7">
                        <div class="position-absolute translate-middle start-50 top-50 d-flex flex-column flex-center">
                            <span class="fs-2qx fw-bold">{{$cantidad_total ?? 0}}</span>
                            <span class="fs-6 fw-semibold text-gray-500">Total Tareas</span>
                        </div>

                        <canvas id="project_overview_chart"
                            style="display: block; box-sizing: border-box; height: 175px; width: 175px;" width="175"
                            height="175"></canvas>
                    </div>
                    <!--end::Chart-->

                    <!--begin::Labels-->
                    <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11 mb-5">
                        <!--begin::Label-->
                        <div class="d-flex fs-6 fw-semibold align-items-center mb-3">
                            <div class="bullet bg-primary me-3"></div>
                            <div class="text-gray-500">Pendiente</div>
                            <div class="ms-auto fw-bold text-gray-700">{{$cantidad_pendientes ?? 0}}</div>
                        </div>
                        <!--end::Label-->

                        <!--begin::Label-->
                        <div class="d-flex fs-6 fw-semibold align-items-center mb-3">
                            <div class="bullet bg-warning me-3"></div>
                            <div class="text-gray-500">En proceso</div>
                            <div class="ms-auto fw-bold text-gray-700">{{$cantidad_ejecucion ?? 0}}</div>
                        </div>
                        <!--end::Label-->

                        <!--begin::Label-->
                        <div class="d-flex fs-6 fw-semibold align-items-center mb-3">
                            <div class="bullet bg-success me-3"></div>
                            <div class="text-gray-500">Completado</div>
                            <div class="ms-auto fw-bold text-gray-700">{{$cantidad_completados ?? 0}}</div>
                        </div>
                        <!--end::Label-->
                    </div>
                    <!--end::Labels-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Summary-->
    </div>
    <!--end::Col-->

    <!--begin::Col-->
    <div class="col-lg-6">

        <!--begin::Tareas-->
        <div class="card card-flush h-lg-100">
            <!--begin::Card header-->
            <div class="card-header mt-6">
                <!--begin::Card title-->
                <div class="card-title flex-column">
                    <h3 class="fw-bold fs-2hx mb-1">Mis Tareas</h3>

                    <div class="fs-6 text-gray-500">Total {{count($tareasAtrazadas) ?? 0}} Tareas atrazadas</div>
                </div>
                <!--end::Card title-->

                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    {{-- <a href="#" class="btn btn-primary-gijac verTarea">Ver tareas</a> --}}
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body d-flex flex-column mb-9 p-9 pt-3">
                <!--begin::Item-->
                @php
                    $cantidadR = 0;
                @endphp
                @foreach ($tareasAtrazadas as $item)
                    @if ($cantidadR <= 5)
                        <div class="d-flex align-items-center position-relative mb-7">
                            <div class="position-absolute top-0 start-0 rounded h-100 bg-secondary w-4px"></div>
                            <div class="fw-semibold p-4">
                                <a href="#" class="fs-3 fw-normal text-negro ">{{$item?->titulo}}</a>
                                <div class="text-gray-500">
                                    Responsables
                                    @foreach ($item->responsablesActivos as $key => $responsable)
                                        @if ((count($item->responsablesActivos) - 1) > $key)
                                            <a href="#">{{$responsable?->responsable?->nombre_completo}}</a>,
                                        @else
                                            <a href="#">{{$responsable?->responsable?->nombre_completo}}</a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                    @php
                        $cantidadR++;
                    @endphp
                @endforeach
                <!--end::Item-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Tareas-->
    </div>
    <!--end::Col-->
</div>
