<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $datos = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($datos)) {
            return redirect('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Correo o contraseña incorrectos'
        ]);
    }

    public function register(Request $request)
    {
        $datos = $request->validate([
            'name' => 'required',
            'apellidos' => 'nullable',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',

            'child_nombre' => 'required',
            'child_apellidos' => 'nullable',
            'child_fecha_nacimiento' => 'nullable|date',
        ]);

        $user = new User();
        $user->name = $datos['name'];
        $user->apellidos = $datos['apellidos'] ?? null;
        $user->email = $datos['email'];
        $user->password = $datos['password'];
        $user->save();

        $child = new Child();
        $child->user_id = $user->id;
        $child->nombre = $datos['child_nombre'];
        $child->apellidos = $datos['child_apellidos'] ?? null;
        $child->fecha_nacimiento = $datos['child_fecha_nacimiento'] ?? null;
        $child->save();

        Auth::login($user);

        return redirect('/dashboard');
    }

    public function dashboard()
    {
        $user = Auth::user();

        return view('dashboard', compact('user'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}