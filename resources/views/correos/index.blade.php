@extends('layouts.index', ['nombre_titulo' => 'Bandeja de entrada'])

@section('content')
    <div class="d-flex flex-column flex-lg-row">
        <!--begin::Sidebar-->
        <div class="d-none d-lg-flex flex-column flex-lg-row-auto w-100 w-lg-275px" data-kt-drawer="true"
            data-kt-drawer-name="inbox-aside" data-kt-drawer-activate="{default: true, lg: false}"
            data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start"
            data-kt-drawer-toggle="#kt_inbox_aside_toggle">

            <!--begin::Sticky aside-->
            <div class="card card-flush mb-0" data-kt-sticky="false" data-kt-sticky-name="inbox-aside-sticky"
                data-kt-sticky-offset="{default: false, xl: '100px'}" data-kt-sticky-width="{lg: '275px'}"
                data-kt-sticky-left="auto" data-kt-sticky-top="100px" data-kt-sticky-animation="false"
                data-kt-sticky-zindex="95">
                <!--begin::Aside content-->
                <div class="card-body">
                    <!--begin::Button-->
                    <button type="button" data-bs-toggle="modal" data-bs-target="#modalCrearMails" class="btn btn-primary fw-bold w-100 mb-8">Nuevo Mensaje</button>
                    <!--end::Button-->

                    <!--begin::Menu-->
                    <div class="menu menu-column menu-rounded menu-state-bg menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary mb-10">
                        <!--begin::Menu item-->
                        <div class="menu-item mb-3">
                            <!--begin::Inbox-->
                            <span class="menu-link active">
                                <span class="menu-icon"><i class="far fa-envelope fs-2 me-3"></i></span>
                                <span class="menu-title fw-bold">Bandeja de entrada</span>
                                @if ($no_leidos)
                                    <span class="badge badge-light-success">{{$no_leidos ?? 0}}</span>
                                @endif
                            </span>
                            <!--end::Inbox-->
                        </div>
                        <!--end::Menu item-->

                        <!--begin::Menu item-->
                        <div class="menu-item mb-3">
                            <!--begin::Marked-->
                            <span class="menu-link">
                                <span class="menu-icon"><i class="ki-outline ki-abstract-23 fs-2 me-3"></i></span>
                                <span class="menu-title fw-bold">Marcados</span>
                            </span>
                            <!--end::Marked-->
                        </div>
                        <!--end::Menu item-->

                        <!--begin::Menu item-->
                        <div class="menu-item mb-3">
                            <!--begin::Draft-->
                            <span class="menu-link">
                                <span class="menu-icon"><i class="far fa-file fs-2 me-3"></i></span>
                                <span class="menu-title fw-bold">Borradores</span>
                                <span class="badge badge-light-warning">0</span>
                            </span>
                            <!--end::Draft-->
                        </div>
                        <!--end::Menu item-->

                        <!--begin::Menu item-->
                        <div class="menu-item mb-3">
                            <!--begin::Sent-->
                            <span class="menu-link">
                                <span class="menu-icon"><i class="far fa-paper-plane fs-2 me-3"></i></span>
                                <span class="menu-title fw-bold">Enviados</span>
                            </span>
                            <!--end::Sent-->
                        </div>
                        <!--end::Menu item-->

                        <!--begin::Menu item-->
                        <div class="menu-item">
                            <!--begin::Trash-->
                            <span class="menu-link">
                                <span class="menu-icon"><i class="fas fa-trash fs-2 me-3"></i></span>
                                <span class="menu-title fw-bold">Basura</span>
                            </span>
                            <!--end::Trash-->
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::Menu-->

                    <!--begin::Menu-->
                    <div class="menu menu-column menu-rounded menu-state-bg menu-state-title-primary">
                        <!--begin::Menu item-->
                        <div class="menu-item mb-3">
                            <!--begin::Custom work-->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="ki-outline ki-abstract-8 fs-5 text-danger me-3 lh-0"></i> </span>
                                <span class="menu-title fw-semibold">Trabajo personalizado</span>
                                <span class="badge badge-light-danger">0</span>
                            </span>
                            <!--end::Custom work-->
                        </div>
                        <!--end::Menu item-->

                        <!--begin::Menu item-->
                        <div class="menu-item mb-3">
                            <!--begin::Partnership-->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="ki-outline ki-abstract-8 fs-5 text-success me-3 lh-0"></i> </span>
                                <span class="menu-title fw-semibold">Asociación</span>
                            </span>
                            <!--end::Partnership-->
                        </div>
                        <!--end::Menu item-->

                        <!--begin::Menu item-->
                        <div class="menu-item mb-3">
                            <!--begin::In progress-->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="ki-outline ki-abstract-8 fs-5 text-info me-3 lh-0"></i> </span>
                                <span class="menu-title fw-semibold">En curso</span>
                            </span>
                            <!--end::In progress-->
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::Menu-->
                </div>
                <!--end::Aside content-->
            </div>
            <!--end::Sticky aside-->
        </div>
        <!--end::Sidebar-->

        <!--begin::Content-->
        <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">

            <!--begin::Card-->
            <div class="card">
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <!--begin::Actions-->
                    <div class="d-flex flex-wrap gap-2">
                        <!--begin::Checkbox-->
                        <div class="form-check form-check-sm form-check-custom form-check-solid me-4 me-lg-7">
                            <input class="form-check-input" type="checkbox" data-kt-check="true"
                                data-kt-check-target="#kt_inbox_listing .form-check-input" value="1">
                        </div>
                        <!--end::Checkbox-->

                        <!--begin::Reload-->
                        <a href="#" class="btn btn-sm btn-icon btn-light btn-active-light-primary"
                            data-bs-toggle="tooltip" data-bs-dismiss="click" data-bs-placement="top" aria-label="Reload"
                            data-bs-original-title="Reload">
                            <i class="fas fa-undo-alt text-gray fs-2"></i> </a>
                        <!--end::Reload-->

                        <!--begin::Archive-->
                        <a href="#" class="btn btn-sm btn-icon btn-light btn-active-light-primary"
                            data-bs-toggle="tooltip" data-bs-dismiss="click" data-bs-placement="top" aria-label="Archive"
                            data-bs-original-title="Archive" >
                            <i class="far fa-envelope text-gray fs-2"></i> </a>
                        <!--end::Archive-->

                        <!--begin::Delete-->
                        <a href="#" class="btn btn-sm btn-icon btn-light btn-active-light-primary"
                            data-bs-toggle="tooltip" data-bs-dismiss="click" data-bs-placement="top" aria-label="Delete"
                            data-bs-original-title="Delete" >
                            <i class="fas fa-trash text-gray fs-2"></i> </a>
                        <!--end::Delete-->

                        <!--begin::Filter-->
                        <div>
                            <a href="#" class="btn btn-sm btn-icon btn-light btn-active-light-primary"
                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start">
                                <i class="fas fa-angle-down text-gray fs-2"></i> </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                data-kt-menu="true">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-kt-inbox-listing-filter="show_all">
                                        All
                                    </a>
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-kt-inbox-listing-filter="show_read">
                                        Read
                                    </a>
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-kt-inbox-listing-filter="show_unread">
                                        Unread
                                    </a>
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-kt-inbox-listing-filter="show_starred">
                                        Starred
                                    </a>
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3"
                                        data-kt-inbox-listing-filter="show_unstarred">
                                        Unstarred
                                    </a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                        </div>
                        <!--end::Filter-->

                        <!--begin::Sort-->
                        <span>
                            <a href="#" class="btn btn-sm btn-icon btn-light btn-active-light-primary"
                                data-bs-toggle="tooltip" data-bs-dismiss="click" data-bs-placement="top"
                                aria-label="Sort" data-bs-original-title="Sort" >
                                <i class="fas fa-ellipsis-h text-gray fs-3 m-0"></i> </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                data-kt-menu="true">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3"
                                        data-kt-inbox-listing-filter="filter_newest">
                                        Newest
                                    </a>
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3"
                                        data-kt-inbox-listing-filter="filter_oldest">
                                        Oldest
                                    </a>
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3"
                                        data-kt-inbox-listing-filter="filter_unread">
                                        Unread
                                    </a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                        </span>
                        <!--end::Sort-->
                    </div>
                    <!--end::Actions-->

                    <!--begin::Actions-->
                    <div class="d-flex align-items-center flex-wrap gap-2">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative">
                            <i class="fas fa-search fs-3 position-absolute ms-4"></i> <input type="text"
                                data-kt-inbox-listing-filter="search"
                                class="form-control form-control-sm form-control-solid mw-100 min-w-125px min-w-lg-150px min-w-xxl-200px ps-11"
                                placeholder="Buscar mensaje">
                        </div>
                        <!--end::Search-->

                        <!--begin::Toggle-->
                        <a href="#"
                            class="btn btn-sm btn-icon btn-color-primary btn-light btn-active-light-primary d-lg-none"
                            data-bs-toggle="tooltip" data-bs-dismiss="click" data-bs-placement="top"
                            id="kt_inbox_aside_toggle" aria-label="Toggle inbox menu"
                            data-bs-original-title="Toggle inbox menu" >
                            <i class="ki-outline ki-burger-menu-2 fs-3 m-0"></i> </a>
                        <!--end::Toggle-->
                    </div>
                    <!--end::Actions-->
                </div>

                <div class="card-body p-0">

                    <!--begin::Table-->
                    <div id="kt_inbox_listing_wrapper" class="container p-10">
                        <div class="table-responsive">
                            <table class="table table-hover table-row-dashed fs-6 gy-5 my-0 dataTable"
                                id="tablaMails" style="width: 100%;">
                                <colgroup>
                                    <col data-dt-column="0" style="width: 30.5938px;">
                                    <col data-dt-column="1" style="width: 95.6406px;">
                                    <col data-dt-column="2" style="width: 168.734px;">
                                    <col data-dt-column="3" style="width: 261.781px;">
                                    <col data-dt-column="4" style="width: 84.75px;">
                                </colgroup>
                                <thead class="d-none">
                                    <tr>
                                        <th data-dt-column="0" rowspan="1" colspan="1"
                                            class="dt-orderable-asc dt-orderable-desc">
                                            <div class="dt-column-header"><span
                                                    class="dt-column-title">Checkbox</span><span class="dt-column-order"
                                                    role="button" aria-label="Checkbox: Activate to sort"
                                                    tabindex="0"></span></div>
                                        </th>
                                        <th data-dt-column="1" rowspan="1" colspan="1"
                                            class="dt-orderable-asc dt-orderable-desc">
                                            <div class="dt-column-header"><span
                                                    class="dt-column-title">Actions</span><span class="dt-column-order"
                                                    role="button" aria-label="Actions: Activate to sort"
                                                    tabindex="0"></span></div>
                                        </th>
                                        <th data-dt-column="2" rowspan="1" colspan="1"
                                            class="dt-orderable-asc dt-orderable-desc">
                                            <div class="dt-column-header"><span class="dt-column-title">Author</span><span
                                                    class="dt-column-order" role="button"
                                                    aria-label="Author: Activate to sort" tabindex="0"></span></div>
                                        </th>
                                        <th data-dt-column="3" rowspan="1" colspan="1"
                                            class="dt-orderable-asc dt-orderable-desc">
                                            <div class="dt-column-header"><span class="dt-column-title">Title</span><span
                                                    class="dt-column-order" role="button"
                                                    aria-label="Title: Activate to sort" tabindex="0"></span></div>
                                        </th>
                                        <th data-dt-column="4" rowspan="1" colspan="1"
                                            class="dt-orderable-asc dt-orderable-desc">
                                            <div class="dt-column-header"><span class="dt-column-title">Date</span><span
                                                    class="dt-column-order" role="button"
                                                    aria-label="Date: Activate to sort" tabindex="0"></span></div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot></tfoot>
                            </table>
                        </div>
                    </div>
                    <!--end::Table-->
                </div>
            </div>
            <!--end::Card-->

        </div>
        <!--end::Content-->
    </div>
@endsection

@section('modal')
    @component('correos.modals.crear')
    @endcomponent
@endsection

@section('scripts')
    <script src="{{ mix('/js/mails/principal.js') }}"></script>
@endsection
