<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\AulaController;

// Rutas para aulas
Route::get('/admin/registro/aulas', [AulaController::class, 'create'])->name('aula.create'); // Formulario de registro
Route::post('/admin/registro/aulas', [AulaController::class, 'store'])->name('aula.store');  // Guardar el registro


// Rutas para libros
Route::get('/check-isbn', [LibroController::class, 'checkIsbn'])->name('libros.checkIsbn');
Route::get('/admin/registro/libros', [LibroController::class, 'create'])->name('libros.create');
Route::post('/admin/libros', [LibroController::class, 'store'])->name('libros.store');
Route::get('/admin/libros', [LibroController::class, 'index'])->name('libros.index');

// Rutas para materiales
Route::get('/admin/registro/material', function () {
    return view('RegistroMaterial');
})->name('material.create');
Route::post('/admin/registro/material', [MaterialController::class, 'store'])->name('material.store');

// Rutas de autenticación
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

// Rutas de vistas generales
Route::view('/', 'main')->name('home');
Route::view('/foros', 'Foros')->name('foros');
Route::view('/admin', 'VistaAdministrador')->name('admin.dashboard');
Route::view('/admin/registro', 'VR2')->name('admin.register');
Route::view('contraseña', 'recuperaContraseña')->name('password.reset');
