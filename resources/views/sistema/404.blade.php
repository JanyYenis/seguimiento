<!DOCTYPE html>
<html lang="es" data-bs-theme="light"><!--begin::Head-->

<head>
    <title>Mix Proyect</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('assets/media/logos/favicon.ico')}}" />

    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"> <!--end::Fonts-->

	<link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking)
        if (window.top != window.self) {
            window.top.location.replace(window.self.location.href);
        }
    </script>
</head>
<!--end::Head-->

<!--begin::Body-->
<body id="kt_body" class="app-blank">
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

    <!--begin::Root-->
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <!--begin::Authentication - 404 Page-->
        <div class="d-flex flex-column flex-center flex-column-fluid p-10">
            <!--begin::Illustration-->
            <img src="{{ asset('assets/media/illustrations/404-hd.png') }}" alt=""
                class="mw-100 mb-10 h-lg-450px">
            <!--end::Illustration-->

            <!--begin::Message-->
            <h1 class="fw-semibold mb-10" style="color: #A3A3C7">Pagina no encontrada</h1>
            <!--end::Message-->

            <!--begin::Link-->
            <a href="{{ route('home') }}" class="btn btn-primary-gijac">ir al home</a>
            <!--end::Link-->
        </div>
        <!--end::Authentication - 404 Page-->
    </div>
    <!--end::Root-->

    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
	<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
</body><!--end::Body-->
</html>
