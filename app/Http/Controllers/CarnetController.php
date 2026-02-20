<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CarnetController extends Controller
{
    public function index(Request $request, Usuario $usuario)
    {
        $QrCode = QrCode::size(500)
            ->color(255, 255, 255)
            ->backgroundColor(31, 59, 115)
            ->generate(route('perfil'));

        $info['usuario'] = $usuario;
        $info['QrCode'] = $QrCode;

        return view('carnets.index', $info);
    }
}
