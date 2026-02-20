<?php

use App\Http\Controllers\UsuarioController;
use App\Models\Sistema\Autenticacion;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Webklex\IMAP\Facades\Client;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return redirect(route('login'));
});

Auth::routes();

Route::middleware(['web', 'auth', '2fa'])->group(function () {
    Route::post('/2fa', function () {
      return redirect(route('home'));
    })->name('2fa');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['web', 'auth', '2fa']);
Route::post('/verify2FA', [UsuarioController::class, 'verify2FA'])->name('verify2FA');

// Route::get('google/login', [GoogleDriveController::class, 'googleLogin'])->name('google.login');
// Route::get('google-drive/file-upload', [GoogleDriveController::class, 'googleDriveFilePpload'])->name('google.drive.file.upload');

Route::get('/perfil', [UsuarioController::class, 'show'])->name('perfil')->middleware(['web', 'auth', '2fa']);
Route::post('/perfil/{usuario}/actualizar', [UsuarioController::class, 'update'])->name('perfil.update')->middleware(['web', 'auth', '2fa']);
Route::put('/perfil/{usuario}/actualizar/email', [UsuarioController::class, 'actualizarEmail'])->name('perfil.email')->middleware(['web', 'auth', '2fa']);
Route::put('/perfil/{usuario}/actualizar/contraseña', [UsuarioController::class, 'actualizarContrasena'])->name('perfil.contrasena')->middleware(['web', 'auth', '2fa']);

// Auth Redes
Route::get('/login-google', function () {
    return Socialite::driver('google')->redirect();
})->name('login-google');

Route::get('/google-callback', function () {
    $usuario = Socialite::driver('google')->user();

    $validarUsuario = Usuario::where([
        'email'  => $usuario?->email,
        'estado' => Usuario::ACTIVO,
    ])->first();

    if ($validarUsuario) {
        $validarAutenticaciones = Usuario::with('autenticacion')->where([
        'email'  => $usuario?->email,
        'estado' => Usuario::ACTIVO,
        ])
        ->whereHas('autenticacion', function($query) use($usuario) {
        $query->where([
            'external_id'   => $usuario?->id,
            'external_auth' => 'google'
        ]);
        })
        ->first();

        if (!$validarAutenticaciones) {
            Autenticacion::updateOrCreate([
                'cod_usuario' => $validarUsuario->id,
                'external_auth' => 'google',
            ], [
                'external_id' => $usuario->id,
            ]);
        }

        Auth::login($validarUsuario);

        return redirect(route('home'));
    } else {
        $validarUsuario = Usuario::create([
            'nombre' => $usuario?->user?->given_name ?? 'N/A',
            'apellido' => $usuario?->user?->family_name ?? 'N/A',
            'email' => $usuario?->email,
            'foto' => $usuario?->avatar,
            'demo' => 1,
            'external_id' => $usuario?->id,
        ]);
        Autenticacion::updateOrCreate([
            'cod_usuario' => $validarUsuario->id,
            'external_auth' => 'google',
        ], [
            'external_id' => $usuario->id,
        ]);

        Auth::login($validarUsuario);
    }

    return redirect(route('login'))->with('error', 'El usuario no se encuentra en nuestra base de datos.');
});

Route::get('pagina', function(){
  return view('layouts.pricipal');
});

Route::get('prueba', function(){
    $client = Client::account('default');
    $client->connect();

    $folders = $client->getFolders();
    foreach ($folders as $folder) {
        echo $folder->name; // Deberías ver "INBOX"
    }

    // $folder = $client->getFolder('INBOX');
    // $messages = $folder->messages()->all()->get();
    // foreach ($messages as $message) {
    //     // ID único del correo (según el servidor)
    //     $messageId = $message->getMessageId();

    //     // Remitente: nombre y correo
    //     $from = $message->getFrom(); // Devuelve una colección (Address object)
    //     $fromName = $from[0]->personal ?? 'Sin nombre';
    //     $fromEmail = $from[0]->mail ?? 'N/A';

    //     // Asunto
    //     $subject = $message->getSubject();

    //     // Etiquetas (flags): ejemplo: \Seen, \Flagged, etc.
    //     $flags = $message->getFlags()->toArray(); // array

    //     // Fecha de envío
    //     $date = $message->getDate(); // DateTime object
    //     $formattedDate = $date->get()->format('Y-m-d H:i:s');

    //     echo "ID: $messageId<br>";
    //     echo "De: $fromName - $fromEmail<br>";
    //     echo "Asunto: $subject<br>";
    //     echo "Etiquetas: " . implode(', ', $flags) . "<br>";
    //     echo "Fecha: $formattedDate<br>";
    //     echo "--------------------------<br>";
    // }
});
