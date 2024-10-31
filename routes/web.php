<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::get('/register', [RegisterController::class, 'create'])->name('register');

Route::get('/', function () {
    return view('main');
});

Route::get('/foros', function () {
    return view('Foros');
});

Route::get('/registro', function () {
    return view('VR2');
});

Route::get('/registro/libros', function () {
    return view('RegistroLibros');
});

Route::get('/registro/material', function () {
    return view('RegistroMaterial');
});

Route::get('/registro/aulas', function () {
    return view('RegistroAulas');
});

Route::get('contraseña', function () {
    return view('recuperaContraseña');
});