<?php

namespace App\Http\Controllers;

use App\Models\Timer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $user->load('children');

        $timers = [];

        if ($user->children->count() > 0) {
            $child = $user->children->first();
            $timers = Timer::where('child_id', $child->id)->get();
        }

        return view('temporizador', compact('user', 'timers'));
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'horas' => 'nullable|integer|min:0',
            'minutos' => 'nullable|integer|min:0',
            'segundos' => 'nullable|integer|min:0',
        ]);

        $user = Auth::user();
        $user->load('children');

        if ($user->children->count() == 0) {
            return back()->withErrors([
                'nombre' => 'No hay ningún hijo asociado.'
            ]);
        }

        $child = $user->children->first();

        $horas = (int) ($datos['horas'] ?? 0);
        $minutos = (int) ($datos['minutos'] ?? 0);
        $segundos = (int) ($datos['segundos'] ?? 0);

        $duracionTotal = ($horas * 3600) + ($minutos * 60) + $segundos;

        if ($duracionTotal <= 0) {
            return back()->withErrors([
                'nombre' => 'La duración tiene que ser mayor que 0.'
            ])->withInput();
        }

        Timer::create([
            'child_id' => $child->id,
            'nombre' => $datos['nombre'],
            'duracion_segundos' => $duracionTotal,
        ]);

        return redirect()->route('temporizador');
    }
}