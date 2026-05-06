<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\TimerController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return redirect('/inicio');
});

// Solo inicio es pública
Route::get('/inicio', function () {
    return view('inicio');
})->name('inicio');

// Solo para NO logueados
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// Solo para logueados
Route::middleware('auth')->group(function () {
    Route::get('/perfil', [AuthController::class, 'perfil'])->name('perfil');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda');
    Route::post('/agenda', [AgendaController::class, 'store'])->name('agenda.store');
    Route::get('/api/agenda', [AgendaController::class, 'apiIndex'])->name('agenda.api.index');
    Route::post('/api/agenda/guardar', [AgendaController::class, 'apiGuardar'])->name('agenda.api.guardar');
    Route::delete('/api/agenda/limpiar', [AgendaController::class, 'apiLimpiar'])->name('agenda.api.limpiar');

    Route::get('/temporizador', [TimerController::class, 'index'])->name('temporizador');
    Route::post('/temporizador', [TimerController::class, 'store'])->name('temporizador.store');
    Route::delete('/temporizador/{id}', [TimerController::class, 'destroy'])->name('temporizador.destroy');

    Route::get('/notes', [NoteController::class, 'index'])->name('notes');
    Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');
    Route::put('/notes/{id}', [NoteController::class, 'update'])->name('notes.update');
    Route::delete('/notes/{id}', [NoteController::class, 'destroy'])->name('notes.destroy');

    Route::get('/informacion', function () {
        return view('informacion');
    })->name('informacion');

    Route::get('/contacto', [ContactController::class, 'index'])->name('contacto');
    Route::post('/contacto', [ContactController::class, 'store'])->name('contacto.store');
});