<div class="row g-6 g-xl-9">
    @if (count($proyectos))
        @foreach ($proyectos as $proyecto)
            <!--begin::Col-->
            <div class="col-md-6 col-xl-4">
                <!--begin::Card-->
                @canany(['proyectos.editar', 'proyectos.eliminar', 'presupuestos.crear', 'presupuestos.listado', 'presupuestos.editar', 'presupuestos.eliminar'])
                    <a href="{{ route('proyectos.edit', ['proyecto' => $proyecto->id]) }}" class="card border-hover-primary h-100 ">
                @elsecanany(['proyectos.listado'])
                    <a href="#" class="card border-hover-primary h-100 ">
                @endcanany
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-9">
                        <!--begin::Card Title-->
                        <div class="card-title m-0">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-90px w-90px bg-light">
                                <img src="{{ asset($proyecto->logo) }}" alt="image"
                                    class="p-3">
                            </div>
                            <!--end::Avatar-->
                        </div>
                        <!--end::Car Title-->
                    </div>
                    <!--end:: Card header-->

                    <!--begin:: Card body-->
                    <div class="card-body p-9">
                        <!--begin::Name-->
                        <div class="fs-3 fw-normal text-negro">
                            {{$proyecto->nombre}} </div>
                        <!--end::Name-->

                        <!--begin::Description-->
                        <p class="text-negro fw-normal text-gris fs-4 mt-1 mb-7">
                            {!! substr(html_entity_decode($proyecto?->descripcion ?? '' , ENT_QUOTES, "UTF-8"), 0, 200) !!} </p>
                        <!--end::Description-->

                        <!--begin::Info-->
                        <div class="d-flex flex-column mb-5">
                            <!--begin::Due-->
                            <div class="border border-gray-300 border-1 rounded  mb-3 p-3">
                                <div class="fs-4 text-gris">Fecha entrega</div>
                                <div class="fs-3 fw-semibold text-gray-800 fw-bold">{{$proyecto->fecha_fin->format('d/m/Y')}}</div>

                            </div>
                            <!--end::Due-->

                            <!--begin::Finaciazión-->
                            <div class="border border-gray-300 border-1 rounded mb-3 p-3">
                                <div class="fs-4 text-gris">Financiación</div>
                                <div class="fs-3 fw-semibold text-gray-800 fw-bold">${{formatoMiles($proyecto?->presupuestoActivo?->valor) ?? 0}}</div>
                            </div>
                            <!--end::Finaciazión-->
                        </div>
                        <!--end::Info-->

                        <!--begin::Progress-->
                        <div class="fs-3 text-negro fw-bolder mb-3">Progreso del proyecto</div>

                        <div class="h-4px w-100 bg-light-bar mb-5" data-bs-toggle="tooltip"
                            aria-label="El proyecto va al {{$proyecto?->progreso}}% completado" data-bs-original-title="El proyecto va al {{$proyecto?->progreso}}% completado">
                            <div class="bg-{{$proyecto?->infoEstado?->color}} rounded h-4px" role="progressbar" style="width: {{$proyecto?->progreso}}%" aria-valuenow="{{$proyecto?->progreso}}"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <!--end::Progress-->

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
                    <!--end:: Card body-->
                </a>
                <!--end::Card-->
            </div>
            <!--end::Col-->
        @endforeach
    @else
        <div class="text-center m-5">
            <h1>No cuenta con proyectos disponibles.</h1>
        </div>
    @endif
</div>

@component("proyectos.paginado")
    @slot("catidadDatos", $proyectos)
    @slot("ultimaPagina", $ultimaPagina)
    @slot("paginaActual", $paginaActual)
@endcomponent
