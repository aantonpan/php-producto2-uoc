<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function showRegisterForm(Request $request)
    {
        $type = $request->query('type', 'particular');
        return view('auth.register', compact('type'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|confirmed',
            'type' => 'required|in:particular,hotel,vehiculo',
        ]);

        $hashed = Hash::make($request->password);

        $id = DB::table('usuarios')->insertGetId([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $hashed,
            'tipo' => $request->type,
            'creado_en' => now()
        ]);

        switch ($request->type) {
            case 'hotel':
                DB::table('transfer_hotel')->insert([
                    'usuario' => $id,
                    'password' => $hashed,
                    'nombre' => $request->username,
                    'direccion' => ''
                ]);
                break;

            case 'vehiculo':
                DB::table('transfer_vehiculo')->insert([
                    'email_conductor' => $request->email,
                    'password' => $hashed,
                    'descripcion' => $request->username
                ]);
                break;

            case 'particular':
            default:
                DB::table('transfer_viajeros')->insert([
                    'nombre' => $request->username,
                    'apellido1' => '',
                    'apellido2' => '',
                    'direccion' => '',
                    'codigoPostal' => '',
                    'ciudad' => '',
                    'pais' => '',
                    'password' => $hashed,
                    'id_usuario' => $id
                ]);
                break;
        }

        return redirect()->route('login.form', ['type' => $request->type])
                         ->with('success', 'Registro exitoso. Ya puedes iniciar sesión.');
    }

    public function showLoginForm(Request $request)
    {
        $type = $request->query('type', 'particular');
        return view('auth.login', compact('type'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'type' => 'required|in:particular,hotel,vehiculo,admin'
        ]);

        $user = DB::table('usuarios')->where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Credenciales incorrectas'])->withInput();
        }

        if ($user->tipo !== $request->type) {
            return back()->withErrors(['email' => 'No tienes permisos para este tipo de usuario'])->withInput();
        }

        Auth::loginUsingId($user->id);

        switch ($user->tipo) {
            case 'admin':
                return redirect()->route('dashboard.admin');
            case 'hotel':
                return redirect()->route('dashboard.hotel');
            case 'vehiculo':
                return redirect()->route('dashboard.vehiculo');
            case 'particular':
            default:
                return redirect()->route('dashboard.particular');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
