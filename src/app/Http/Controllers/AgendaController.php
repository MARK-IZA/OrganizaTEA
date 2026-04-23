<?php

namespace App\Http\Controllers;

use App\Models\AgendaCell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgendaController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user) {
            $user->load('children');
        }

        $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];

        $horas = [
            '06:00',
            '07:00',
            '08:00',
            '09:00',
            '10:00',
            '11:00',
            '12:00',
            '13:00',
            '14:00',
            '15:00',
            '16:00',
            '17:00',
            '18:00',
            '19:00',
            '20:00',
            '21:00',
            '22:00',
            '23:00',
            '00:00'
        ];
        $celdas = collect();

        if ($user && $user->children->count() > 0) {
            $child = $user->children->first();

            $celdas = AgendaCell::where('child_id', $child->id)->get();
        }

        return view('agenda', compact('user', 'dias', 'horas', 'celdas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dia' => 'required|string',
            'hora' => 'required',
            'contenido' => 'nullable|string',
            'color' => 'nullable|string',
            'fila_orden' => 'required|integer',
        ]);

        $user = Auth::user();

        if (!$user || $user->children->count() == 0) {
            return response()->json([
                'ok' => false,
                'mensaje' => 'No hay ningún hijo asociado.'
            ], 422);
        }

        $child = $user->children->first();

        AgendaCell::updateOrCreate(
            [
                'child_id' => $child->id,
                'dia_semana' => $request->dia,
                'hora_inicio' => $request->hora,
            ],
            [
                'fila_orden' => $request->fila_orden,
                'contenido' => $request->contenido,
                'color' => $request->color,
            ]
        );

        return response()->json([
            'ok' => true
        ]);
    }
    public function apiIndex()
    {
        $user = Auth::user();

        if (!$user || $user->children->count() == 0) {
            return response()->json([]);
        }

        $child = $user->children->first();

        $celdas = AgendaCell::where('child_id', $child->id)->get();

        return response()->json($celdas);
    }

    public function apiGuardar(Request $request)
    {
        $request->validate([
            'celdas' => 'required|array',
        ]);

        $user = Auth::user();

        if (!$user || $user->children->count() == 0) {
            return response()->json([
                'ok' => false,
                'mensaje' => 'No hay ningún hijo asociado.'
            ], 422);
        }

        $child = $user->children->first();

        foreach ($request->celdas as $celda) {
            AgendaCell::updateOrCreate(
                [
                    'child_id' => $child->id,
                    'dia_semana' => $celda['dia'],
                    'hora_inicio' => $celda['hora'],
                ],
                [
                    'fila_orden' => $celda['fila_orden'],
                    'contenido' => $celda['contenido'] ?? null,
                    'color' => $celda['color'] ?? null,
                ]
            );
        }

        return response()->json([
            'ok' => true,
            'mensaje' => 'Cambios guardados correctamente.'
        ]);
    }

    public function apiLimpiar(Request $request)
    {
        $request->validate([
            'dia' => 'required|string',
            'hora' => 'required',
        ]);

        $user = Auth::user();

        if (!$user || $user->children->count() == 0) {
            return response()->json([
                'ok' => false,
                'mensaje' => 'No hay ningún hijo asociado.'
            ], 422);
        }

        $child = $user->children->first();

        AgendaCell::where('child_id', $child->id)
            ->where('dia_semana', $request->dia)
            ->where('hora_inicio', $request->hora)
            ->delete();

        return response()->json([
            'ok' => true,
            'mensaje' => 'Celda limpiada correctamente.'
        ]);
    }
}
