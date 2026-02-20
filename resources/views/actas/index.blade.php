@extends('layouts.index')

@section('btns')
    @can('actas.crear')
        <button type="button" class="btn btn-primary-gijac" data-bs-toggle="modal" data-bs-target="#modalCrearActa">
            Nueva Acta
        </button>
    @endcan
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
                                    <table class="table table-white" id="tablaActas">
                                        <thead>
                                            <tr>
                                                <th width="5%" class="text-center all">#</th>
                                                <th width="10%" class="text-center all">Reunión</th>
                                                <th width="10%" class="text-center all">Cliente</th>
                                                <th width="10%" class="text-center all">Fecha</th>
                                                <th width="10%" class="text-center all">Responsable</th>
                                                <th width="10%" class="text-center none">Fecha Proxima Reunión</th>
                                                <th width="10%" class="text-center none">Acuerdo</th>
                                                <th width="10%" class="text-center none">Conclusión</th>
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
    @component('actas.modals.crear')
        @slot('clientes', $clientes)
    @endcomponent
@endsection

@section('scripts')
    <script src="{{ mix('/js/actas/principal.js') }}" ></script>
@endsection
