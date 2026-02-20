@extends('layouts.index')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="contenedor" id="kt_content_container">
        <div class="d-flex flex-column flex-lg-row">
            <div class="flex-column flex-lg-row-auto w-100 mb-10 mb-lg-0 h-100">
                <div class="card card-flush h-100">
                    <div class=" pt-3" id="kt_chat_contacts_header">
                    </div class="w-100">
                    <div class="card-body pt-5" id="kt_chat_contacts_body">
                        <!--begin::Stepper-->
                        <div class="stepper stepper-pills" id="kt_stepper_example_clickable">
                            <div class="stepper-nav flex-center flex-wrap mb-10">
                                <!--begin::Step 1-->
                                <div class="stepper-item mx-8 my-4 current" data-kt-stepper-element="nav" data-kt-stepper-action="step">
                                    <div class="stepper-wrapper d-flex align-items-center">
                                        <div class="stepper-icon w-40px h-40px">
                                            <i class="stepper-check fas fa-check"></i>
                                            <span class="stepper-number">1</span>
                                        </div>
                                        <div class="stepper-label">
                                            <h3 class="stepper-title">
                                                Información Basica
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="stepper-line h-40px"></div>
                                </div>
                                <!--end::Step 1-->
                                <!--begin::Step 2-->
                                <div class="stepper-item mx-8 my-4" data-kt-stepper-element="nav" data-kt-stepper-action="step">
                                    <div class="stepper-wrapper d-flex align-items-center">
                                        <div class="stepper-icon w-40px h-40px">
                                            <i class="stepper-check fas fa-check"></i>
                                            <span class="stepper-number">2</span>
                                        </div>
                                        <div class="stepper-label">
                                            <h3 class="stepper-title">
                                                Asistentes
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="stepper-line h-40px"></div>
                                </div>
                                <!--end::Step 2-->
                                <!--begin::Step 3-->
                                <div class="stepper-item mx-8 my-4" data-kt-stepper-element="nav" data-kt-stepper-action="step">
                                    <div class="stepper-wrapper d-flex align-items-center">
                                        <div class="stepper-icon w-40px h-40px">
                                            <i class="stepper-check fas fa-check"></i>
                                            <span class="stepper-number">3</span>
                                        </div>
                                        <div class="stepper-label">
                                            <h3 class="stepper-title">
                                                Puntos de la reunión
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="stepper-line h-40px"></div>
                                </div>
                                <!--end::Step 3-->
                                <!--begin::Step 4-->
                                <div class="stepper-item mx-8 my-4" data-kt-stepper-element="nav" data-kt-stepper-action="step">
                                    <div class="stepper-wrapper d-flex align-items-center">
                                        <div class="stepper-icon w-40px h-40px">
                                            <i class="stepper-check fas fa-check"></i>
                                            <span class="stepper-number">4</span>
                                        </div>
                                        <div class="stepper-label">
                                            <h3 class="stepper-title">
                                                Puntos finales de la reunión
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="stepper-line h-40px"></div>
                                </div>
                                <!--end::Step 4-->
                            </div>
                            <!--end::Nav-->
                            <form class="form w-lg-900px mx-auto" id="formEditarActa">
                                <input type="hidden" name="id" value="{{ $acta->id }}">
                                <div class="mb-5">
                                    <!--begin::Step 1-->
                                    <div class="flex-column current" data-kt-stepper-element="content">
                                        <div class="row mt-3">
                                            <div class="col-lg-6 col-md-6">
                                                <label class="form-label required">Nombre Reunión:</label>
                                                <input type="text" placeholder="Ingrese el nombre de la reunión" name="nombre_reunion"
                                                value="{{ $acta?->nombre_reunion ?? '' }}" class="form-control" required>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <label class="form-label required">Cliente:</label>
                                                <select name="cod_cliente" id="selectCliente" data-control="select2" data-placeholder="Seleccione el cliente" data-allow-clear="true" class="form-control" required data-dropdown-parent="body">
                                                    <option value=""></option>
                                                    @foreach ($clientes as $item)
                                                        <option value="{{$item->id}}" {{ $item->id == $acta->cod_cliente ? 'selected' : '' }}>{{$item->nombre_completo}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-lg-6 col-md-6">
                                                <label class="form-label required">Fecha Reunión:</label>
                                                <input type="text" placeholder="Ingrese la fecha de la reunión" name="fecha"
                                                value="{{ $acta?->fecha ?? '' }}" class="form-control" id="inputFecha" required>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <label class="form-label">Fecha Proxima Reunión:</label>
                                                <input type="text" placeholder="Ingrese la fecha de la proxima reunión" name="fecha_proxima_reunion"
                                                value="{{ $acta?->fecha_proxima_reunion ?? '' }}" id="inputFechaProxima" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <!--begin::Step 1-->

                                    <!--begin::Step 2-->
                                    <div class="flex-column" data-kt-stepper-element="content">
                                        <div class="row justify-content-end">
                                            <div class="col-lg-3 col-md-3">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrearAsistente">Crear Asistente</button>
                                            </div>
                                        </div>
                                        <div class="mb-3 seccionAsistente"></div>
                                    </div>
                                    <!--begin::Step 2-->
                                    <!--begin::Step 3-->
                                    <div class="flex-column" data-kt-stepper-element="content">
                                        <div class="row justify-content-end">
                                            <div class="col-lg-3 col-md-3">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrearPunto">Crear Puntos del día</button>
                                            </div>
                                        </div>
                                        <div class="mb-3 seccionPunto"></div>
                                    </div>
                                    <!--begin::Step 3-->

                                    <!--begin::Step 4-->
                                    <div class="flex-column" data-kt-stepper-element="content">
                                        <div class="row mt-3">
                                            <div class="col-lg-12 col-md-12">
                                                <label class="form-label">Acuerdos:</label>
                                                <div id="divAcuerdos" name="acuerdos" style="height: 150px;">{!! $acta->acuerdos !!}</div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-lg-12 col-md-12">
                                                <label class="form-label">Conclusión:</label>
                                                <div id="divConclusion" name="conclusion" style="height: 150px;">{!! $acta->conclusion !!}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--begin::Step 4-->
                                </div>

                                <!--begin::Actions-->
                                <div class="d-flex flex-stack">
                                    <div class="me-2">
                                        <button type="button" class="btn btn-light" data-kt-stepper-action="previous">
                                            Atras
                                        </button>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary" data-kt-stepper-action="submit">
                                            Actualizar
                                        </button>
                                        <button type="button" class="btn btn-primary" data-kt-stepper-action="next">
                                            Siguiente
                                        </button>
                                    </div>
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Stepper-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
    @component('actas.asistentes.modals.crear')
        @slot('acta', $acta)
    @endcomponent
    @component('actas.asistentes.modals.modals')
    @endcomponent
    @component('actas.puntos-dia.modals.crear')
        @slot('acta', $acta)
        @slot('responsables', $responsables)
    @endcomponent
    @component('actas.puntos-dia.modals.modals')
    @endcomponent
@endsection

@section('scripts')
    <script>window.id_acta = '{{$acta->id}}'</script>
    <script src="{{ mix('/js/actas/editar.js') }}" ></script>
@endsection
