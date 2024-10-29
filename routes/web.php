<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/', function () {
    return view('main');
});

Route::get('/foros', function () {
    return view('Foros');
});

Route::get('login', function () {
    return view('login');
});

Route::get('registro', function () {
    return view('VR2');
});

Route::get('registro/libros', function () {
    return view('RegistroLibros');
});

Route::get('registro/material', function () {
    return view('RegistroMaterial');
});

Route::get('registro/aulas', function () {
    return view('RegistroAulas');
});


