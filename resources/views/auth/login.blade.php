@extends('layouts.app')

@section('content')
<!--begin::Wrapper-->
<div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
    <!--begin::Content-->
    <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
        <!--begin::Wrapper-->
        <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">

            <!--begin::Form-->
            <form class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework" id="kt_sign_in_form"
                data-kt-redirect-url="{{route('login')}}" action="{{route('login')}}" method="POST">
                <!--begin::Heading-->
                <div class="text-center mb-11">
                    <!--begin::Title-->
                    <h1 class="text-primary-gijac fs-3x fw-bolder mb-3">
                        Inicio de sesión
                    </h1>
                    <!--end::Title-->

                    <!--begin::Subtitle-->
                    <div class="text-gray-500 fw-semibold fs-6">
                        Ingrese con tu correo y clave
                    </div>
                    <!--end::Subtitle--->
                </div>
                <!--begin::Heading-->

                <!--begin::Login options-->
                <div class="row g-3 mb-9">
                    <!--begin::Col-->
                    <div class="col-md-6">
                        <!--begin::Google link--->
                        <a href="{{ route('login-google') }}"
                            class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                            <img alt="Logo"
                                src="{{ asset('assets/media/svg/brand-logos/google-icon.svg') }}"
                                class="h-15px me-3">
                            Iniciar con Google
                        </a>
                        <!--end::Google link--->
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-md-6">
                        <!--begin::Google link--->
                        <a href="#"
                            class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                            <img alt="Logo"
                                src="{{asset('img/outlook.png')}}"
                                class="theme-light-show h-15px me-3">
                            <img alt="Logo"
                                src="{{asset('img/outlook.png')}}"
                                class="theme-dark-show h-15px me-3">
                            Iniciar con Outlook
                        </a>
                        <!--end::Google link--->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Login options-->

                <!--begin::Separator-->
                <div class="separator separator-content my-14">
                    <span class="w-125px text-gray-500 fw-semibold fs-7">O con email</span>
                </div>
                <!--end::Separator-->

                <!--begin::Input group--->
                <div class="fv-row mb-8 fv-plugins-icon-container">
                    <!--begin::Email-->
                    <input type="text" name="email" autocomplete="off" placeholder="Correo electrónico"
                        class="form-control bg-transparent">
                    <!--end::Email-->
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!--end::Input group--->
                <div class="fv-row mb-10 fv-plugins-icon-container" data-kt-password-meter="true">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-stack ">
                    </div>
                    <!--end::Wrapper-->

                    <!--begin::Input-->
                    <div class="position-relative mb-2">
                        <input class="form-control bg-transparent" type="password" name="password" autocomplete="off" placeholder="Contraseña">
                        <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                            <i class="far fa-eye fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>
                            <i class="far fa-eye-slash d-none fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                        </span>
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <!--end::Input-->
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
                <!--end::Input group--->

                <!--begin::Wrapper-->
                <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                    <div></div>

                    <!--begin::Link-->
                    <a href="{{route('password.request')}}"
                        class="link-primary-gijac">
                        ¿Olvidó su contraseña?
                    </a>
                    <!--end::Link-->
                </div>
                <!--end::Wrapper-->

                <!--begin::Submit button-->
                <div class="d-grid mb-10">
                    <button type="submit" id="kt_sign_in_submit" class="btn btn-primary-gijac">

                        <!--begin::Indicator label-->
                        <span class="indicator-label">
                            Iniciar sesión</span>
                        <!--end::Indicator label-->

                        <!--begin::Indicator progress-->
                        <span class="indicator-progress">
                            Cargando... <span
                                class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                        <!--end::Indicator progress--> </button>
                </div>
                <!--end::Submit button-->

                <!--begin::Sign up-->
                {{-- <div class="text-gray-500 text-center fw-semibold fs-6">
                    Registrarme

                    <a href="{{ route('register') }}"
                        class="link-primary">
                        Registro
                    </a>
                </div> --}}
                <!--end::Sign up-->
            </form>
            <!--end::Form-->

        </div>
        <!--end::Wrapper-->

        <!--begin::Footer-->
        <div class=" d-flex flex-stack">
            <!--begin::Languages-->
            <div class="me-10">
                <!--begin::Toggle-->
                <button
                    class="btn btn-flex btn-link btn-color-gray-700 btn-active-color-primary rotate fs-base"
                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start"
                    data-kt-menu-offset="0px, 0px">
                    <img data-kt-element="current-lang-flag" class="w-20px h-20px rounded me-3"
                        src="{{asset('assets/media/flags/spain.svg')}}" alt="">

                    <span data-kt-element="current-lang-name" class="me-1">Español</span>

                    <i class="ki-outline ki-down fs-5 text-muted rotate-180 m-0"></i> </button>
                <!--end::Toggle-->

                <!--begin::Menu-->
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-4 fs-7"
                    data-kt-menu="true" id="kt_auth_lang_menu">
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <a href="#" class="menu-link d-flex px-5" data-kt-lang="English">
                            <span class="symbol symbol-20px me-4">
                                <img data-kt-element="lang-flag" class="rounded-1"
                                    src="{{asset('assets/media/flags/united-states.svg')}}"
                                    alt="">
                            </span>
                            <span data-kt-element="lang-name">Ingles</span>
                        </a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <a href="#" class="menu-link d-flex px-5" data-kt-lang="Spanish">
                            <span class="symbol symbol-20px me-4">
                                <img data-kt-element="lang-flag" class="rounded-1"
                                    src="{{asset('assets/media/flags/spain.svg')}}"
                                    alt="">
                            </span>
                            <span data-kt-element="lang-name">Español</span>
                        </a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <a href="#" class="menu-link d-flex px-5" data-kt-lang="German">
                            <span class="symbol symbol-20px me-4">
                                <img data-kt-element="lang-flag" class="rounded-1"
                                    src="{{asset('assets/media/flags/germany.svg')}}"
                                    alt="">
                            </span>
                            <span data-kt-element="lang-name">Aleman</span>
                        </a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <a href="#" class="menu-link d-flex px-5" data-kt-lang="Japanese">
                            <span class="symbol symbol-20px me-4">
                                <img data-kt-element="lang-flag" class="rounded-1"
                                    src="{{asset('assets/media/flags/japan.svg')}}"
                                    alt="">
                            </span>
                            <span data-kt-element="lang-name">Japon</span>
                        </a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <a href="#" class="menu-link d-flex px-5" data-kt-lang="French">
                            <span class="symbol symbol-20px me-4">
                                <img data-kt-element="lang-flag" class="rounded-1"
                                    src="{{asset('assets/media/flags/france.svg')}}"
                                    alt="">
                            </span>
                            <span data-kt-element="lang-name">Frances</span>
                        </a>
                    </div>
                    <!--end::Menu item-->
                </div>
                <!--end::Menu-->
            </div>
            <!--end::Languages-->

            <!--begin::Links-->
            <div class="d-flex fw-semibold text-primary-gijac fs-base gap-5">
                <a href="/metronic8/demo52/pages/team.html" target="_blank">Terms</a>

                <a href="/metronic8/demo52/pages/pricing/column.html" target="_blank">Plans</a>

                <a href="/metronic8/demo52/pages/contact.html" target="_blank">Contact Us</a>
            </div>
            <!--end::Links-->
        </div>
        <!--end::Footer-->
    </div>
    <!--end::Content-->
</div>
<!--end::Wrapper-->
@endsection

@section('js')
    <script src="{{ asset('assets/js/custom/authentication/sign-in/general.js') }}"></script>
@endsection
