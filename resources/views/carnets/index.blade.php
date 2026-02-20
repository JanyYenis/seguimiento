<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carnet - GIJAC WEB</title>
    <meta name="description" content="Plataforma de procesos de GIJAC WEB">
    <meta name="keywords"
        content="
        tailwind, tailwindcss, metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js,
        Node.js, Flask, Symfony &amp; Laravel starter kits, admin themes, web design, figma, web development, free templates,
        free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button,
        bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon
    ">
    <meta property="og:locale" content="es_ES">
    <meta property="og:type" content="article">
    <meta property="og:title" content="GIJAC WEB - Te ayudamos a crecer">
    <meta property="og:url" content="https://seguimiento.gijac.co">
    <meta property="og:site_name" content="GIJAC WEB">
    <link rel="shortcut icon" href="{{ asset('img/logo_mini.png') }}">

    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"> <!--end::Fonts-->

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />

    <!--begin::Google tag-->
    <script type="text/javascript" async="" src="https://www.google-analytics.com/analytics.js"></script>
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
    </script>
    <!--end::Google tag-->
    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking)
        if (window.top != window.self) {
            window.top.location.replace(window.self.location.href);
        }
    </script>
    <style>
        .id-card {
            width: 350px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .id-card-header {
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .id-card-body {
            padding: 25px;
            background-color: white;
        }
        .profile-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid white;
            margin: -75px auto 20px;
            display: block;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .company-logo {
            height: 40px;
            margin-bottom: 15px;
        }
        .qr-code {
            width: 80px;
            height: 80px;
            margin: 20px auto;
            display: block;
            background-color: #f8f9fa;
            padding: 5px;
            border-radius: 5px;
        }
        .divider {
            border-top: 2px dashed #e9ecef;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="id-card mx-auto">
                    <!-- Encabezado con logo de la empresa -->
                    <div class="id-card-header">
                        <img src="{{ asset('img/logo_mini.png') }}" alt="GUAC WEB Logo" class="company-logo">
                    </div>

                    <!-- Cuerpo del carnet -->
                    <div class="id-card-body text-center">
                        <!-- Imagen de perfil (reemplaza la fuente) -->
                        <img src="{{ $usuario?->foto ? asset($usuario?->foto) : asset('img/logo_mini.png') }}" alt="Foto de perfil" class="profile-img">

                        <!-- Información personal -->
                        <h2 class="mb-1 fw-bold">{{initCap($usuario?->nombre_completo)}}</h2>
                        <p class="text-muted mb-4">Desarrollador Web</p>

                        <div class="divider"></div>

                        <!-- Descripción -->
                        <p class="mb-4">
                            En <strong>GIJAC WEB</strong>, desarrollo sistemas para automatizar procesos y mejorar la interacción con los usuarios.
                        </p>

                        <!-- Código QR -->
                        <img src="data:image/svg+xml;base64,{{ base64_encode($QrCode) }}" alt="Código QR" class="qr-code">

                        <!-- Footer opcional -->
                        <small class="text-muted">ID: WEB-2025-001</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6"></div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle con Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
