<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index()
    {
        return view('contacto');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'comentario' => 'required|string|max:1000',
        ]);

        ContactMessage::create([
            'user_id' => Auth::id(),
            'nombre' => $datos['nombre'] ?? null,
            'email' => $datos['email'],
            'comentario' => $datos['comentario'],
        ]);

        return response()->json([
            'ok' => true,
            'mensaje' => 'Mensaje enviado correctamente.'
        ]);
    }
}