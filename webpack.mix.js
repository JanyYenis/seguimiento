const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();

// JS
mix.js("resources/js/jquery-validator.init.js", "public/js/jquery-validator.init.js");
// mix.js("resources/js/home.js", "public/js/home.js");
mix.js("resources/js/usuarios/principal.js", "public/js/usuarios/principal.js");
mix.js("resources/js/perfil/principal.js", "public/js/perfil/principal.js");
mix.js("resources/js/perfil/firma.js", "public/js/perfil/firma.js");
mix.js("resources/js/proyectos/principal.js", "public/js/proyectos/principal.js");
mix.js("resources/js/proyectos/dashboard.js", "public/js/proyectos/dashboard.js");
mix.js("resources/js/proyectos/editar.js", "public/js/proyectos/editar.js");
mix.js("resources/js/google2fa/principal.js", "public/js/google2fa/principal.js");
mix.js("resources/js/sistema/notificaciones.js", "public/js/sistema/notificaciones.js");
mix.js("resources/js/chat/principal.js", "public/js/chat/principal.js");
mix.js("resources/js/calendario/principal.js", "public/js/calendario/principal.js");
mix.js("resources/js/mails/principal.js", "public/js/mails/principal.js");
mix.js("resources/js/actas/principal.js", "public/js/actas/principal.js");
mix.js("resources/js/actas/editar.js", "public/js/actas/editar.js");
mix.js("resources/js/cuentas-cobros/principal.js", "public/js/cuentas-cobros/principal.js");
mix.js("resources/js/cuentas-cobros/editar.js", "public/js/cuentas-cobros/editar.js");
mix.js("resources/js/tickets/principal.js", "public/js/tickets/principal.js");
mix.js("resources/js/tickets/editar.js", "public/js/tickets/editar.js");
mix.js("resources/js/comentarios/principal.js", "public/js/comentarios/principal.js");
// mix.js("resources/js/sistema/accesos.js", "public/js/sistema/accesos.js");
// mix.js("resources/js/chat/videoLlamada.js", "public/js/chat/videoLlamada.js");

// Drive
// mix.js("resources/js/drive/principal.js", "public/js/drive/principal.js");


// ----------------------------------------------------------------------------------------------------
// Carpetas
mix.copyDirectory('resources/img', 'public/img');

// --------------------------------------------------------------------------------------------------------------

// CSS
mix.styles(
    "resources/css/cel.css",
    "public/css/cel.css"
);

mix.styles(
    "resources/css/pdf.css",
    "public/css/pdf.css"
);

mix.styles(
    "resources/css/datatables.css",
    "public/css/datatables.css"
);

mix.styles(
    "resources/css/datatable-whatsking.css",
    "public/css/datatable-whatsking.css"
);
