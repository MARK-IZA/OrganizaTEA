<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $child = $user->children->first();

        $notes = [];

        if ($child) {
            $notes = Note::where('child_id', $child->id)->latest()->get();
        }

        return view('notes', compact('notes'));
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha' => 'nullable|date',
        ]);

        $child = Auth::user()->children->first();

        if (!$child) {
            return response()->json([
                'ok' => false,
                'mensaje' => 'No hay ningún hijo asociado.'
            ], 422);
        }

        $note = Note::create([
            'child_id' => $child->id,
            'titulo' => $datos['titulo'],
            'descripcion' => $datos['descripcion'] ?? null,
            'fecha' => $datos['fecha'] ?? null,
        ]);

        return response()->json([
            'ok' => true,
            'note' => $note
        ]);
    }

    public function update(Request $request, $id)
    {
        $datos = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha' => 'nullable|date',
        ]);

        $note = Note::findOrFail($id);

        $note->update([
            'titulo' => $datos['titulo'],
            'descripcion' => $datos['descripcion'] ?? null,
            'fecha' => $datos['fecha'] ?? null,
        ]);

        return response()->json([
            'ok' => true,
            'note' => $note
        ]);
    }

    public function destroy($id)
    {
        $note = Note::findOrFail($id);
        $note->delete();

        return response()->json([
            'ok' => true
        ]);
    }
}