<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Services\VerificacionService;

class AuthController extends Controller
{
    protected $verificador;

    public function __construct(VerificacionService $verificador)
    {
        $this->verificador = $verificador;
    }

    // Paso 1: Mostrar formulario de registro
    public function showRegister()
    {
        return view('auth/register');
    }

    // Paso 2: Recibir datos y enviar código, guardar en sesión temporal
    public function register(Request $request)
    {
        $request->validate([
            'correo' => 'required|email|unique:usuario_natural,correo_electronico|unique:usuario_negocio,correo_electronico_negocios',
            'password' => 'required|min:6',
            'tipo_persona' => 'required|in:usuario,negocio',
            'terminos' => 'accepted',
        ]);

        // Generar código
        $codigo = $this->verificador->generarCodigo();

        // Guardar datos temporalmente (sin guardar en BD aún)
        $datosTemp = [
            'correo' => $request->correo,
            'password' => Hash::make($request->password),
            'tipo' => $request->tipo_persona,
            'codigo' => $codigo,
        ];

        session([
            'registro_temporal' => $datosTemp,
            'codigo_verificacion' => $codigo,
        ]);

        // Enviar código al correo
        $this->verificador->enviarCorreo($request->correo, $codigo);

        return redirect()->route('confirmacion_correo')
            ->with('success', 'Te hemos enviado un código de verificación a tu correo.');
    }

    // Paso 3: Mostrar formulario para introducir código
    public function showConfirmacionCorreo()
    {
        return view('auth/confirmacion_correo');
    }

    // Paso 4: Verificar código ingresado
    public function confirmarCodigo(Request $request)
    {
        $request->validate([
            'codigo' => 'required|digits:6',
        ]);

        $codigoIngresado = $request->codigo;
        $codigoGuardado = session('codigo_verificacion');
        $datos = session('registro_temporal');

        if (!$datos || !$codigoGuardado) {
            return redirect()->route('register')->withErrors('No hay registro temporal. Por favor regístrate de nuevo.');
        }

        if ($codigoIngresado == $codigoGuardado) {
            // Guardar usuario definitivamente
            if ($datos['tipo'] === 'usuario') {
                DB::table('usuario_natural')->insert([
                    'correo_electronico' => $datos['correo'],
                    'contraseña' => $datos['password'],
                    'tipo_de_cuenta' => 'usuario',
                    'codigo_de_confirmacion_correo_electronico' => $codigoIngresado,
                ]);
            } else {
                DB::table('usuario_negocio')->insert([
                    'correo_electronico_negocios' => $datos['correo'],
                    'contraseña_negocio' => $datos['password'],
                    'tipo_de_cuenta' => 'negocio',
                    'codigo_confirmacion_correo_negocio' => $codigoIngresado,
                ]);
            }

            session()->forget(['registro_temporal', 'codigo_verificacion']);

            return redirect()->route('login')->with('success', 'Cuenta confirmada, ahora puedes iniciar sesión.');
        }

        return back()->withErrors(['codigo' => 'Código incorrecto, intenta de nuevo.']);
    }
}
