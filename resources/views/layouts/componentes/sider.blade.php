@php
    $usuario = auth()->user();
    $cantidad = $usuario->unreadNotifications->count() ?? 0;
@endphp
<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true"
    data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}"
    data-kt-drawer-overlay="true" data-kt-drawer-width="auto" data-kt-drawer-direction="start"
    data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">

    <!--begin::Sidebar menu-->
    <div class="hover-scroll-y flex-column-fluid mx-6 pt-5 pt-lg-0 mt-lg-n12" data-kt-scroll="true"
        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
        data-kt-scroll-dependencies="#kt_app_header, #kt_app_footer, #kt_app_sidebar_footer"
        data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px"
        style="height: 411px;">

        <div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false"
            class="app-sidebar-menu menu menu-column menu-rounded menu-state-primary menu-active-bg menu-title-gray-700 mb-5">
            <!--begin:Menu item-->
            <a href="{{ route('home') }}" class="menu-item {{request()->is('home') ? 'here show' : ''}} py-2">
                <!--begin:Menu link-->
                <span class="menu-link menu-center">
                    <span class="menu-icon me-0">
                        <i class="fas fa-home fs-1"></i>
                    </span>
                </span><!--end:Menu link--><!--begin:Menu sub-->
            </a><!--end:Menu item--><!--begin:Menu item-->
            @canany(['usuarios.listado', 'usuarios.crear', 'usuarios.editar', 'usuarios.eliminar', 'usuarios.agregar-rol', 'usuarios.agregar-permiso'])
                <a href="{{ route('calendario.index') }}" class="menu-item py-2 {{request()->is('calendario') ? 'here show' : ''}}">
                    <!--begin:Menu link-->
                    <span class="menu-link menu-center">
                        <span class="menu-icon me-0">
                            <i class="far fa-calendar-alt fs-1"></i>
                        </span>
                    </span><!--end:Menu link--><!--begin:Menu sub-->
                </a><!--end:Menu item-->
            @endcanany
            <a href="{{ route('proyectos.index') }}" class="menu-item py-2 {{request()->is('proyectos') || request()->is('proyectos/*/editar') || request()->is('proyectos/dashboard') ? 'here show' : ''}}">
                <!--begin:Menu link-->
                <span class="menu-link menu-center">
                    <span class="menu-icon me-0">
                        <i class="fas fa-project-diagram fs-1"></i>
                    </span>
                </span><!--end:Menu link--><!--begin:Menu sub-->
            </a>
            <a href="{{route('actas.index')}}" class="menu-item py-2 {{ request()->is('actas') || request()->is('actas/*/editar') ? 'here show' : '' }}">
                <!--begin:Menu link-->
                <span class="menu-link menu-center">
                    <span class="menu-icon me-0">
                        <i class="fas fa-file-signature fs-1"></i>
                    </span>
                </span><!--end:Menu link--><!--begin:Menu sub-->
            </a><!--end:Menu item-->
            <a href="{{route('cuentas-cobros.index')}}" class="menu-item py-2 {{ request()->is('cuentas-cobros') || request()->is('cuentas-cobros/*/editar') ? 'here show' : '' }}">
                <!--begin:Menu link-->
                <span class="menu-link menu-center">
                    <span class="menu-icon me-0">
                        <i class="fas fa-file-invoice-dollar fs-1"></i>
                    </span>
                </span><!--end:Menu link--><!--begin:Menu sub-->
            </a><!--end:Menu item-->
            @canany(['usuarios.listado', 'usuarios.crear', 'usuarios.editar', 'usuarios.eliminar', 'usuarios.agregar-rol', 'usuarios.agregar-permiso'])
                <a href="{{route('usuarios.index')}}" class="menu-item py-2 {{ request()->is('usuarios') ? 'here show' : '' }}">
                    <!--begin:Menu link-->
                    <span class="menu-link menu-center">
                        <span class="menu-icon me-0">
                            <i class="fas fa-users fs-1"></i>
                        </span>
                    </span><!--end:Menu link--><!--begin:Menu sub-->
                </a><!--end:Menu item-->
                {{-- <a href="{{route('mails.index')}}" class="menu-item py-2 {{ request()->is('mails') ? 'here show' : '' }}">
                    <!--begin:Menu link-->
                    <span class="menu-link menu-center">
                        <span class="menu-icon me-0">
                            <i class="far fa-envelope fs-1"></i>
                        </span>
                    </span><!--end:Menu link--><!--begin:Menu sub-->
                </a><!--end:Menu item--> --}}
            @endcanany
            @canany(['tickets.crear', 'tickets.listado', 'tickets.editar', 'tickets.eliminar'])
                <a href="{{route('tickets.index')}}" class="menu-item py-2 {{ request()->is('tickets') || request()->is('tickets/editar/*') ? 'here show' : '' }}">
                    <!--begin:Menu link-->
                    <span class="menu-link menu-center">
                        <span class="menu-icon me-0">
                            <i class="fas fa-ticket-alt fs-1"></i>
                        </span>
                    </span><!--end:Menu link--><!--begin:Menu sub-->
                </a><!--end:Menu item-->
            @endcanany
        </div>
    </div>
    <!--end::Sidebar menu-->

    <!--begin::Sidebar footer-->
    <div class="app-sidebar-footer d-flex flex-column flex-column-auto flex-center pt-5 pb-5 pb-lg-7"
        id="kt_app_sidebar_footer">
        <!--begin::User menu-->
        <div class="mb-5">
            <!--begin::Menu wrapper-->
            <div class="cursor-pointer symbol symbol-circle symbol-40px"
                data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-overflow="true"
                data-kt-menu-placement="top-start">
                <img src="{{$usuario->foto ? asset($usuario->foto) : asset('assets/media/avatars/150-2.jpg') }}" alt="image">
            </div>


            <!--begin::User account menu-->
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                data-kt-menu="true">
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <div class="menu-content d-flex align-items-center px-3">
                        <!--begin::Avatar-->
                        <div class="symbol symbol-50px me-5">
                            <img alt="Logo"
                                src="{{$usuario->foto ? asset($usuario->foto) : asset('assets/media/avatars/150-2.jpg') }}">
                        </div>
                        <!--end::Avatar-->

                        <!--begin::Username-->
                        <div class="d-flex flex-column">
                            <div class="fw-bold d-flex align-items-center fs-5">
                                {{$usuario->nombre_completo}} <span
                                    class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">Pro</span>
                            </div>

                            <a href="#"
                                class="fw-semibold text-muted text-hover-primary fs-7">
                                {{$usuario->email}} </a>
                        </div>
                        <!--end::Username-->
                    </div>
                </div>
                <!--end::Menu item-->

                <!--begin::Menu separator-->
                <div class="separator my-2"></div>
                <!--end::Menu separator-->

                <!--begin::Menu item-->
                <div class="menu-item px-5">
                    <a href="{{ route('perfil') }}" class="menu-link px-5">
                        Mi Perfil
                    </a>
                </div>
                <!--end::Menu item-->

                <!--begin::Menu item-->
                <div class="menu-item px-5">
                    <a href="{{ route('proyectos.index') }}" class="menu-link px-5">
                        <span class="menu-text">Mis Proyectos</span>
                        <span class="menu-badge">
                            <span class="badge badge-light-danger badge-circle fw-bold fs-7">3</span>
                        </span>
                    </a>
                </div>
                <!--end::Menu item-->

                <!--begin::Menu separator-->
                <div class="separator my-2"></div>
                <!--end::Menu separator-->

                <!--begin::Menu item-->
                <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                    data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
                    <a href="#" class="menu-link px-5">
                        <span class="menu-title position-relative">
                            Mode
                            <span class="ms-5 position-absolute translate-middle-y top-50 end-0">
                                <i class="las la-sun theme-light-show fs-2"></i>
                                <i class="far fa-moon theme-dark-show fs-2"></i>
                            </span>
                        </span>
                    </a>

                    <!--begin::Menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px"
                        data-kt-menu="true" data-kt-element="theme-mode-menu">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2 active"
                                data-kt-element="mode" data-kt-value="light">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="las la-sun fs-2"></i> </span>
                                <span class="menu-title">
                                    Light
                                </span>
                            </a>
                        </div>
                        <!--end::Menu item-->

                        <!--begin::Menu item-->
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                data-kt-value="dark">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="far fa-moon fs-2"></i> </span>
                                <span class="menu-title">
                                    Dark
                                </span>
                            </a>
                        </div>
                        <!--end::Menu item-->

                        <!--begin::Menu item-->
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                data-kt-value="system">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="far fa-window-maximize fs-2"></i> </span>
                                <span class="menu-title">
                                    System
                                </span>
                            </a>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::Menu-->

                </div>
                <!--end::Menu item-->

                <!--begin::Menu item-->
                <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                    data-kt-menu-placement="right-end" data-kt-menu-offset="-15px, 0">
                    <a href="#" class="menu-link px-5">
                        <span class="menu-title position-relative">
                            Idioma

                            <span
                                class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">
                                Español <img class="w-15px h-15px rounded-1 ms-2"
                                    src="{{asset('assets/media/flags/spain.svg')}}"
                                    alt="">
                            </span>
                        </span>
                    </a>

                    <!--begin::Menu sub-->
                    <div class="menu-sub menu-sub-dropdown w-175px py-4">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="#"
                                class="menu-link d-flex px-5 active">
                                <span class="symbol symbol-20px me-4">
                                    <img class="rounded-1"
                                        src="{{asset('assets/media/flags/spain.svg')}}"
                                        alt="">
                                </span>
                                Español
                            </a>
                        </div>
                        <!--end::Menu item-->

                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="#"
                                class="menu-link d-flex px-5">
                                <span class="symbol symbol-20px me-4">
                                    <img class="rounded-1"
                                        src="{{asset('assets/media/flags/united-states.svg')}}"
                                        alt="">
                                </span>
                                Ingles
                            </a>
                        </div>
                        <!--end::Menu item-->

                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="#"
                                class="menu-link d-flex px-5">
                                <span class="symbol symbol-20px me-4">
                                    <img class="rounded-1"
                                        src="{{asset('assets/media/flags/germany.svg')}}"
                                        alt="">
                                </span>
                                Aleman
                            </a>
                        </div>
                        <!--end::Menu item-->

                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="#"
                                class="menu-link d-flex px-5">
                                <span class="symbol symbol-20px me-4">
                                    <img class="rounded-1"
                                        src="{{asset('assets/media/flags/japan.svg')}}"
                                        alt="">
                                </span>
                                Japones
                            </a>
                        </div>
                        <!--end::Menu item-->

                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="#"
                                class="menu-link d-flex px-5">
                                <span class="symbol symbol-20px me-4">
                                    <img class="rounded-1"
                                        src="{{asset('assets/media/flags/france.svg')}}"
                                        alt="">
                                </span>
                                Frances
                            </a>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::Menu sub-->
                </div>
                <!--end::Menu item-->
            </div>
            <!--end::User account menu-->
            <!--end::Menu wrapper-->
        </div>
        <!--end::User menu-->

        <!--begin::Logout-->
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            class="btn btn-icon btn-active-color-primary">
            <i class="fas fa-sign-out-alt fs-2x"></i>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </a>
        <!--end::Logout-->
    </div>
    <!--end::Sidebar footer-->
</div>
