<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\AulaController;
use App\Http\Controllers\RentaLibroController;
use App\Http\Controllers\RentaAulaController;

// Rutas para registro aulas
Route::get('/admin/registro/aulas', [AulaController::class, 'create'])->name('aula.create'); 
Route::post('/admin/registro/aulas', [AulaController::class, 'store'])->name('aula.store');  

// Rutas para registro libros
Route::get('/check-isbn', [LibroController::class, 'checkIsbn'])->name('libros.checkIsbn');
Route::get('/admin/registro/libros', [LibroController::class, 'create'])->name('libros.create');
Route::post('/admin/libros', [LibroController::class, 'store'])->name('libros.store');
Route::get('/admin/libros', [LibroController::class, 'index'])->name('libros.index');

// Rutas para registro materiales
Route::get('/admin/registro/material', function () {
    return view('RegistroMaterial');
})->name('material.create');
Route::post('/admin/registro/material', [MaterialController::class, 'store'])->name('material.store');

// Rutas para rentas de libros
Route::get('/admin/rentas/libros', [RentaLibroController::class, 'create'])->name('rentas_libros.create');
Route::post('/admin/rentas/libros', [RentaLibroController::class, 'store'])->name('rentas_libros.store');

// Rutas para renta de aula
Route::get('/admin/rentas/aulas', [RentaAulaController::class, 'create'])->name('rentas_aulas.create');
Route::post('/admin/rentas/aulas', [RentaAulaController::class, 'store'])->name('rentas_aulas.store');

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
Route::view('/admin/rentas', 'VR3')->name('admin.rent');
Route::view('/admin/foros', 'VR4')->name('admin.foro');
Route::view('/admin/registro', 'VR2')->name('admin.register');
Route::view('contraseña', 'recuperaContraseña')->name('password.reset');
