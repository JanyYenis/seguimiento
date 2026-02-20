@extends('layouts.index', ['titulo' => 'Proyectos', 'nombre_titulo' => 'Proyectos'])

@section('btns')
    @canany(['proyectos.crear'])
        <button type="button" class="btn btn-primary-gijac" data-bs-toggle="modal" data-bs-target="#modalCrearProyectos">
            Crear Nuevo Proyecto
        </button>
    @endcanany
@endsection

@section('content')
    <div class="d-flex flex-wrap flex-stack my-5" data-select2-id="select2-data-121-8xd9">
        <!--begin::Heading-->
        <h2 class="fs-2 fw-bold my-2">
            Listado de proyectos
            <span class="fs-6 text-gray-500 ms-1">por estado</span>
        </h2>
        <!--end::Heading-->

        <!--begin::Controls-->
        <div class="d-flex flex-wrap my-1" data-select2-id="select2-data-120-tj9x">
            <!--begin::Select wrapper-->
            <div class="m-0" data-select2-id="select2-data-119-gjyx">
                <!--begin::Select-->
                <select name="estado" data-control="select2" id="selectEstadosListados" data-hide-search="true"
                    class="form-select form-select-sm form-select-solid fw-bold w-125px">
                    <option value="0">Todos</option>
                    <option value="1">Activos</option>
                    <option value="2">En progresos</option>
                    <option value="3">Cancelados</option>
                    <option value="4">Completados</option>
                </select>
                <!--end::Select-->
            </div>
            <!--end::Select wrapper-->
        </div>
        <!--end::Controls-->
    </div>

    <div class="seccionListadoProyectos"></div>


@endsection

@section('modal')
    @component('proyectos.crear')
        @slot('responsables', $responsables)
        @slot('clientes', $clientes)
    @endcomponent
@endsection

@section('scripts')
    <script src="{{ mix('/js/proyectos/principal.js') }}" ></script>
@endsection
