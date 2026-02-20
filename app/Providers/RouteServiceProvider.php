<?php

namespace App\Providers;

use App\Models\Usuario;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });

        Route::prefix('proyectos')
                ->as("proyectos.")
                ->middleware(['web', 'auth', '2fa'])
                ->group(base_path('routes/web/proyectos/principal.php'));

        Route::prefix('fases')
            ->as("fases.")
            ->middleware(['web', 'auth', '2fa'])
            ->group(base_path('routes/web/fases/principal.php'));

        Route::prefix('actividades')
            ->as("actividades.")
            ->middleware(['web', 'auth', '2fa'])
            ->group(base_path('routes/web/actividades/principal.php'));

        Route::prefix('paises')
            ->as("paises.")
            ->middleware(['web', 'auth', '2fa'])
            ->group(base_path('routes/web/paises/principal.php'));

        Route::prefix('ciudades')
            ->as("ciudades.")
            ->middleware(['web', 'auth', '2fa'])
            ->group(base_path('routes/web/ciudades/principal.php'));

        Route::prefix('roles')
            ->as("roles.")
            ->middleware(['web', 'auth', '2fa'])
            ->group(base_path('routes/web/sistema/roles.php'));

        Route::prefix('notificaciones')
            ->as("notificaciones.")
            ->middleware(['web', 'auth'])
            ->group(base_path('routes/web/sistema/notificaciones.php'));

        Route::prefix('usuarios')
            ->as("usuarios.")
            ->middleware(['web', 'auth', '2fa'])
            ->group(base_path('routes/web/usuarios/principal.php'));

        Route::prefix('calendario')
            ->as("calendario.")
            ->middleware(['web', 'auth', '2fa'])
            ->group(base_path('routes/web/calendario/principal.php'));

        Route::prefix('tickets')
            ->as("tickets.")
            ->middleware(['web', 'auth', '2fa'])
            ->group(base_path('routes/web/tickets/principal.php'));

        Route::prefix('mails')
            ->as("mails.")
            ->middleware(['web', 'auth', '2fa'])
            ->group(base_path('routes/web/mails/principal.php'));

        Route::prefix('actas')
            ->as("actas.")
            ->middleware(['web', 'auth', '2fa'])
            ->group(base_path('routes/web/actas/principal.php'));

        Route::prefix('cuentas-cobros')
            ->as("cuentas-cobros.")
            ->middleware(['web', 'auth', '2fa'])
            ->group(base_path('routes/web/cuentas-cobros/principal.php'));

        Route::prefix('carnets')
            ->as("carnets.")
            ->middleware(['web'])
            ->group(base_path('routes/web/carnets/principal.php'));

        Route::prefix('comentarios')
            ->as("comentarios.")
            ->middleware(['web'])
            ->group(base_path('routes/web/comentarios/principal.php'));
    }
}
