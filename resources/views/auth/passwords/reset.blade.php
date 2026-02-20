@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
        <!--begin::Wrapper-->
        <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
            <!--begin::Content-->
            <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                <!--begin::Wrapper-->
                <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">

                    <!--begin::Form-->
                    <form class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework"
                        data-kt-redirect-url="{{ route('password.email') }}" action="{{ route('password.email') }}" method="POST"
                        id="kt_password_reset_form">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <!--begin::Heading-->
                        <div class="text-center mb-10">
                            <!--begin::Title-->
                            <h1 class="text-primary-gijac fs-3x fw-bolder mb-3">
                                Nueva contraseña
                            </h1>
                            <!--end::Title-->

                            <!--begin::Link-->
                            <div class="text-gray-500 fw-semibold fs-6">
                                ¿Ya has restablecido tu contraseña?

                                <a href="{{ route('login') }}"
                                    class="link-primary fw-bold">
                                    Login
                                </a>
                            </div>
                            <!--end::Link-->
                        </div>
                        <!--begin::Heading-->

                        <div class="fv-row mb-10 fv-plugins-icon-container">
                            <input class="form-control bg-transparent" type="email" value="{{ $email ?? old('email') }}"
                                required readonly placeholder="Correo electronico" name="email">
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                        <!--begin::Input group-->
                        <div class="fv-row mb-8 fv-plugins-icon-container" data-kt-password-meter="true">
                            <!--begin::Wrapper-->
                            <div class="mb-1">
                                <!--begin::Input wrapper-->
                                <div class="position-relative mb-3">
                                    <input class="form-control bg-transparent" type="password" placeholder="Contraseña"
                                        name="password" autocomplete="off">

                                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                        data-kt-password-meter-control="visibility">
                                        <i class="ki-outline ki-eye-slash fs-2"></i> <i
                                            class="ki-outline ki-eye fs-2 d-none"></i> </span>
                                </div>
                                <!--end::Input wrapper-->

                                <!--begin::Meter-->
                                <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                </div>
                                <!--end::Meter-->
                            </div>
                            <!--end::Wrapper-->

                            <!--begin::Hint-->
                            <div class="text-muted">
                                Utilice 8 o más caracteres con una combinación de letras, números y caracteres. símbolos.
                            </div>
                            <!--end::Hint-->
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>
                        <!--end::Input group--->

                        <!--end::Input group--->
                        <div class="fv-row mb-8 fv-plugins-icon-container">
                            <!--begin::Repeat Password-->
                            <input type="password" placeholder="Confirmar contraseña" name="password_confirmation" autocomplete="off"
                                class="form-control bg-transparent">
                            <!--end::Repeat Password-->
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>
                        <!--end::Input group--->

                        <!--begin::Input group--->
                        <div class="fv-row mb-8 fv-plugins-icon-container">
                            <label class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="toc" value="1">

                                <span class="form-check-label fw-semibold text-gray-700 fs-6 ms-1">
                                    Acepto los &amp;
                                    <a href="#" class="ms-1 link-primary-gijac">Terminos y Condiciones</a>.
                                </span>
                            </label>
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>
                        <!--end::Input group--->

                        <!--begin::Action-->
                        <div class="d-grid mb-10">
                            <button type="button" id="kt_new_password_submit" class="btn btn-primary-gijac">
                                <!--begin::Indicator label-->
                                <span class="indicator-label">
                                    Actualizar</span>
                                <!--end::Indicator label-->

                                <!--begin::Indicator progress-->
                                <span class="indicator-progress">
                                    Cargando... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                                <!--end::Indicator progress--> </button>
                        </div>
                        <!--end::Action-->
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
    </div>
@endsection
