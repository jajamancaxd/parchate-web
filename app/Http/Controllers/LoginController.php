<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('auth/login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'password' => 'required'
        ]);

        // Buscar primero en usuario_natural
        $usuario = DB::table('usuario_natural')
            ->where('correo_electronico', $request->correo)
            ->first();

        if ($usuario && Hash::check($request->password, $usuario->contraseña)) {
            Session::put('usuario_id', $usuario->id_usuario);
            Session::put('tipo_cuenta', 'natural');
            return redirect()->route('vista_usuario');
        }

        // Buscar en usuario_negocio si no se encontró en usuario_natural
        $negocio = DB::table('usuario_negocio')
            ->where('correo_electronico_negocios', $request->correo)
            ->first();

        if ($negocio && Hash::check($request->password, $negocio->contraseña_negocio)) {
            Session::put('usuario_id', $negocio->id_negocio);
            Session::put('tipo_cuenta', 'negocio');
            return redirect()->route('vista_empresa');
        }

        // Si no se encuentra en ninguna tabla
        return back()->withErrors(['correo' => 'Correo o contraseña incorrectos'])->withInput();
    }
}
