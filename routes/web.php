<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EventoController;

// Ruta principal: registrar evento
Route::get('/', [EventoController::class, 'create'])->name('eventos.create');

// Guardar evento
Route::post('eventos', [EventoController::class, 'store'])->name('eventos.store');

// Listado de eventos guardados
Route::get('eventos/listado', [EventoController::class, 'index'])->name('eventos.index');

// Editar evento
Route::get('eventos/{evento}/edit', [EventoController::class, 'edit'])->name('eventos.edit');

// Actualizar evento
Route::put('eventos/{evento}', [EventoController::class, 'update'])->name('eventos.update');

// (Opcional) Mostrar detalle del evento si lo necesitas
Route::get('eventos/{evento}', [EventoController::class, 'show'])->name('eventos.show');

// Rutas del sistema (sin cambios)
Route::get('/confirmacion_contraseña', function () {
    return view('confirmacion_contraseña');
});
Route::get('/restablecer_contra', function () {
    return view('auth/restablecer_contra');
})->name('restablecer_contra');
Route::get('/confirmacion_rest_contra', function () {
    return view('auth/confirmacion_rest_contra');
})->name('confirmacion_rest_contra');
Route::get('/confirmacion_correo', [AuthController::class, 'showConfirmacionCorreo'])->name('confirmacion_correo');
Route::post('/confirmacion_correo', [AuthController::class, 'confirmarCodigo']);
Route::get('/vista_usuario', function () {
    return view('vista_usuario');
})->name('vista_usuario');
Route::get('/vista_empresa', function () {
    return view('vista_empresa');
})->name('vista_empresa');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
