@extends('layouts.index', ['titulo' => 'Proyectos', 'nombre_titulo' => 'Proyectos'])

@section('btns')
    @canany(['tickets.crear'])
        <button type="button" class="btn btn-primary-gijac" data-bs-toggle="modal" data-bs-target="#modalCrearTickets">
            Crear Ticket
        </button>
    @endcanany
@endsection

@section('content')
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body">
            <!--begin::Layout-->
            <div class="d-flex flex-column flex-xl-row p-7">
                <!--begin::Content-->
                <div class="flex-lg-row-fluid me-xl-15 mb-20 mb-xl-0">
                    <!--begin::Tickets-->
                    <div class="mb-0">
                        <!--begin::Search form-->
                        <div class="mb-15">
                            <!--begin::Input wrapper-->
                            <div class="position-relative">
                                <i class="ki-outline ki-magnifier fs-1 text-primary position-absolute top-50 translate-middle ms-9"></i>
                                <input type="text" class="form-control form-control-lg form-control-solid ps-14"
                                    name="search" value="" placeholder="Buscar">
                            </div>
                            <!--end::Input wrapper-->
                        </div>
                        <!--end::Search form-->

                        <!--begin::Heading-->
                        <h1 class="text-gray-900 mb-10">Mis Tickets</h1>
                        <!--end::Heading-->

                        <!--begin::Tickets List-->
                        <div class="mb-10">
                            <div class="seccionListadoTickets"></div>
                        </div>
                        <!--end::Tickets List-->
                    </div>
                    <!--end::Tickets-->
                </div>
                <!--end::Content-->

                <!--begin::Sidebar-->
                @component('tickets.sider')
                @endcomponent
                <!--end::Sidebar-->
            </div>
            <!--end::Layout-->
        </div>
        <!--end::Card body-->
    </div>
@endsection

@section('modal')
    @component('tickets.modals.crear')
        @slot('proyectos', $proyectos)
        @slot('responsables', $responsables)
        @slot('estados', $estados)
        @slot('tipos', $tipos)
        @slot('prioridades', $prioridades)
    @endcomponent
@endsection

@section('scripts')
    <script src="{{ mix('js/tickets/principal.js') }}"></script>
@endsection
