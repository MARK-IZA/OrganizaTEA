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
            'titulo' => 'required',
            'descripcion' => 'nullable',
            'fecha' => 'nullable|date',
        ]);

        $child = Auth::user()->children->first();

        if (!$child) {
            return back()->withErrors([
                'titulo' => 'No hay ningún hijo asociado.'
            ]);
        }

        Note::create([
            'child_id' => $child->id,
            'titulo' => $datos['titulo'],
            'descripcion' => $datos['descripcion'] ?? null,
            'fecha' => $datos['fecha'] ?? null,
        ]);

        return redirect()->route('notes');
    }

    public function destroy($id)
    {
        $note = Note::findOrFail($id);
        $note->delete();

        return redirect()->route('notes');
    }
}