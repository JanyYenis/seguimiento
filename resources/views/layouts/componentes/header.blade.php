@php
    $usuario = auth()->user();
    $cantidad = $usuario->unreadNotifications->count() ?? 0;
@endphp
<div id="kt_app_header" class="app-header  d-flex flex-column flex-stack ">
    <!--begin::Header main-->
    <div class="d-flex flex-stack flex-grow-1" id="kt_app_header_wrapper">
        <div class="app-header-logo d-flex flex-stack ps-lg-13" id="kt_app_header_logo">
            <div class="d-flex align-items-center">

                <!--begin::Logo-->
                <a href="{{route('home')}}"
                    class="d-flex flex-center h-50px w-50px rounded-circle bg-gray-100 ms-lg-n1">
                    <img alt="Logo" src="{{ asset('img/logo_mini.png') }}"
                        class="h-40px theme-light-show">
                    <img alt="Logo" src="{{ asset('img/logo_mini.png') }}"
                        class="h-40px theme-dark-show">
                </a>
                <!--end::Logo-->
            </div>

            <!--begin::Sidebar mobile toggle-->
            <div class="btn btn-icon btn-active-color-primary w-35px h-35px ms-3 me-n3 d-flex d-lg-none"
                id="kt_app_sidebar_mobile_toggle">
                <i class="ki-outline ki-abstract-14 fs-2"></i>
            </div>
            <!--end::Sidebar mobile toggle-->
        </div>
        <!--begin::Navbar-->
        <div class="app-header-navbar d-flex flex-stack flex-wrap gap-5 flex-grow-1"
            id="kt_app_header_navbar" data-kt-swapper="true"
            data-kt-swapper-mode="{default: 'prepend', lg: 'append'}"
            data-kt-swapper-parent="{default: '#kt_app_content', lg: '#kt_app_header_wrapper'}">
            <!--begin::Categories-->
            <div class="d-flex align-items-center">
            </div>
            <!--end::Categories-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center gap-5 gap-lg-7 flex-wrap">
                <!--begin::Notifications-->
                <div class="seccionNotificacionesGeneral mt-1">
                    @component('layouts.componentes.notificaciones')
                        @slot('cantidad', $cantidad)
                        @slot('unreadNotifications', $usuario->unreadNotifications)
                        @slot('notifications', $usuario->notifications)
                    @endcomponent
                </div>
                <!--end::Notifications-->

                <div class="w-1px h-25px bg-gray-300 d-none d-sm-block"></div>

                <!--begin::Actions-->
                <div class="d-flex gap-3">
                    @yield('btns')
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Toolbar-->

            <div class="separator pt-2 mb-7 w-100 d-lg-none"></div>
        </div>
        <!--end::Navbar-->
    </div>
    <!--end::Header main-->

    <!--begin::Separator-->
    <div class="app-header-separator d-flex">
    </div>
    <!--end::Separator-->
</div>
