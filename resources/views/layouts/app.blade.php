<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light"><!--begin::Head-->

<head>
    <title>GIJAC WEB</title>
    <meta charset="utf-8">
    <meta name="description" content="Plataforma de procesos de GIJAC WEB">
    <meta name="keywords"
        content="tailwind, tailwindcss, metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js,
        Node.js, Flask, Symfony &amp; Laravel starter kits, admin themes, web design, figma, web development, free templates,
        free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button,
        bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:locale" content="es_ES">
    <meta property="og:type" content="article">
    <meta property="og:title" content="GIJAC WEB - Te ayudamos a crecer">
    <meta property="og:url" content="https://seguimiento.gijac.co">
    <meta property="og:site_name" content="GIJAC WEB">
    <link rel="canonical"
        href="https://preview.keenthemes.com/metronic8/demo52/authentication/layouts/overlay/sign-in.html">
    <link rel="shortcut icon" href="{{ asset('img/logo_mini.png') }}">

    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"> <!--end::Fonts-->

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/pin-login/jquery.pinlogin.css')}}">

    <!--begin::Google tag-->
    {{-- <script type="text/javascript" async="" src="https://www.google-analytics.com/analytics.js"></script>
    <script type="text/javascript" async=""
        src="https://www.googletagmanager.com/gtag/js?id=G-L98VPZFG7E&amp;l=dataLayer&amp;cx=c"></script>
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-37564768-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-37564768-1');
    </script> --}}
    <!--end::Google tag-->
    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking)
        if (window.top != window.self) {
            window.top.location.replace(window.self.location.href);
        }
    </script>
</head>
<!--end::Head-->

<!--begin::Body-->

<body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center"
    cz-shortcut-listen="true">
    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
        var themeMode;

        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }

            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }

            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <!--end::Theme mode setup on page load-->
    {{-- <!--Begin::Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5FS8GGP" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!--End::Google Tag Manager (noscript) --> --}}

    <!--begin::Root-->
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <!--begin::Page bg image-->
        <style>
            body {
                background-image: url('{{ asset("assets/media/auth/bg4.jpg")}}');
            }

            [data-bs-theme="dark"] body {
                background-image: url('{{ asset("assets/media/auth/bg4.jpg")}}');
            }
        </style>
        <!--end::Page bg image-->

        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Aside-->
            <div class="d-flex flex-lg-row-fluid">
                <!--begin::Content-->
                <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                    <!--begin::Image-->
                    <img class="theme-light-show mx-auto mw-100 w-250px w-lg-300px mb-10 mb-lg-20"
                        src="{{ asset('img/logo.png')}}" alt="">
                    <img class="theme-dark-show mx-auto mw-100 w-250px w-lg-300px mb-10 mb-lg-20"
                        src="{{ asset('img/logo-dark.jpeg')}}" alt="">
                    <!--end::Image-->

                    <!--begin::Title-->
                    <h1 class="text-gray-100 fs-2qx fw-bold text-center mb-7">
                        Bienvenido a tu centro de seguimiento de proyectos. Aquí podrás:
                    </h1>
                    <!--end::Title-->

                    <!--begin::Text-->
                    <div class="text-gray-100 fs-base fw-semibold">
                        <ul>
                            <li>Ver el estado actualizado de tus proyectos en tiempo real.</li>
                            <li>Generar tickets para solicitar soporte o cambios.</li>
                            <li>Acceder a documentos clave como actas de reunión, requerimientos y entregas.</li>
                            <li>Gestionar facturas y cuentas de cobro de manera transparente.</li>
                        </ul>
                    </div>
                    <div class="text-gray-100 fs-base text-center fw-semibold">
                        Todo en un solo lugar, diseñado para optimizar tu experiencia y mantenerte informado.
                    </div>
                    <!--end::Text-->
                </div>
                <!--end::Content-->
            </div>
            <!--begin::Aside-->

            <!--begin::Body-->
            <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
                @yield('content')
            </div>
            <!--end::Body-->
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
    <!--end::Root-->

    <!--begin::Javascript-->
    <script>
        var hostUrl = "assets/";
    </script>

    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/pin-login/jquery.pinlogin.js') }}"></script>

    @section('js')
    @show
</body><!--end::Body-->

</html>
