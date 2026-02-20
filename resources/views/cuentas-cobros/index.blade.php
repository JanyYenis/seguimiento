@extends('layouts.index', ['titulo' => 'Cuenta de Cobro', 'nombre_titulo' => 'Cuenta de Cobro'])

@section('btns')
    @canany(['cuentas-cobros.crear'])
        <button type="button" class="btn btn-primary-gijac" data-bs-toggle="modal" data-bs-target="#modalCrearCuentaCobro">
            Crear Cuenta de Cobro
        </button>
    @endcanany
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="contenedor" id="kt_content_container">
            <div class="d-flex flex-column flex-lg-row">
                <div class="flex-column flex-lg-row-auto w-100 mb-10 mb-lg-0 h-100">
                    <div class="card card-flush h-100">
                        <div class=" pt-3" id="kt_chat_contacts_header">
                        </div class="w-100">
                        <div class="card-body pt-5" id="kt_chat_contacts_body">
                            <div class="scroll-y me-n5 pe-5 h-200px h-lg-auto tablasScroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_header, #kt_toolbar, #kt_footer, #kt_chat_contacts_header" data-kt-scroll-wrappers="#kt_content, #kt_chat_contacts_body" data-kt-scroll-offset="5px" style="max-height: 410px;">
                                <div class="table-responsive">
                                    <table class="table table-white" id="tablaCuentaCobro">
                                        <thead>
                                            <tr>
                                                <th width="5%" class="text-center all">#</th>
                                                <th width="10%" class="text-center all">Fecha</th>
                                                <th width="10%" class="text-center all">Cliente</th>
                                                <th width="10%" class="text-center all">Remitente</th>
                                                <th width="10%" class="text-center all">Total</th>
                                                <th width="10%" class="text-center all space-b">Estado</th>
                                                <th width="10%" class="text-center all">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @component('cuentas-cobros.modals.crear')
        @slot('proyectos', $proyectos)
        @slot('remitentes', $remitentes)
    @endcomponent
@endsection

@section('scripts')
    <script src="{{ mix('/js/cuentas-cobros/principal.js') }}" ></script>
@endsection
