<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Correo o contraseña incorrectos',
        ])->onlyInput('email');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'apellidos' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:6'],

            'child_nombre' => ['required', 'string', 'max:255'],
            'child_apellidos' => ['nullable', 'string', 'max:255'],
            'child_fecha_nacimiento' => ['nullable', 'date'],
        ]);

        DB::transaction(function () use ($data, &$user) {
            $user = User::create([
                'name' => $data['name'],
                'apellidos' => $data['apellidos'] ?? null,
                'email' => $data['email'],
                'password' => $data['password'],
            ]);

            Child::create([
                'user_id' => $user->id,
                'nombre' => $data['child_nombre'],
                'apellidos' => $data['child_apellidos'] ?? null,
                'fecha_nacimiento' => $data['child_fecha_nacimiento'] ?? null,
            ]);
        });

        Auth::login($user);
        $request->session()->regenerate();

        return redirect('/dashboard');
    }

    public function dashboard()
    {
        $user = Auth::user();

        if ($user) {
            $user->load('children');
        }

        return view('dashboard', compact('user'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
