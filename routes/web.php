<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\LibroVistaController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\AulaController;
use App\Http\Controllers\RentaLibroController;
use App\Http\Controllers\RentaAulaController;
use App\Http\Controllers\RentaMaterialController;
use App\Http\Controllers\Auth\LoginEmpleadoController;
use App\Http\Controllers\Auth\RegisterEmpleadoController;
use App\Http\Controllers\RentasPrincipalController;
use App\Http\Controllers\MembresiaController;

// Rutas para renta de libros desde la pantalla principal
Route::get('/rentas', [RentasPrincipalController::class, 'create'])->name('rentas.create'); // Formulario de renta
Route::post('/rentas', [RentasPrincipalController::class, 'store'])->name('rentas.store'); // Guardar renta

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
Route::get('/admin/rentas-libros', [RentaLibroController::class, 'index'])->name('rentasLibros.index');
Route::get('/admin/devolucion/libros', [RentaLibroController::class, 'createDevolucion'])->name('rentas_libros.devolucion.create');
Route::post('/admin/devolucion/libros', [RentaLibroController::class, 'storeDevolucion'])->name('rentas_libros.devolucion.store');
Route::get('/admin/devolucion-libros', [RentaLibroController::class, 'indexDevoluciones'])->name('rentas_libros.devolucion.index');

// Rutas para renta de materiales
Route::get('/admin/rentas/materiales', [RentaMaterialController::class, 'create'])->name('rentas_materiales.create');
Route::post('/admin/rentas/materiales', [RentaMaterialController::class, 'store'])->name('rentas_materiales.store');
Route::get('/admin/rentas-materiales', [RentaMaterialController::class, 'index'])->name('rentasMaterial.index');
// Rutas para devoluciones de materiales
Route::get('/admin/devolucion/material', [RentaMaterialController::class, 'createDevolucion'])->name('rentas_materiales.devolucion.create'); // Mostrar el formulario de devolución
Route::post('/admin/devolucion/material', [RentaMaterialController::class, 'storeDevolucion'])->name('rentas_materiales.devolucion.store'); // Guardar la devolución
Route::get('/admin/devoluciones/material', [RentaMaterialController::class, 'indexDevoluciones'])->name('rentas_materiales.devolucion.index'); // Listar las devoluciones

// Rutas para renta de aula
Route::get('/admin/rentas/aulas', [RentaAulaController::class, 'create'])->name('rentas_aulas.create');
Route::post('/admin/rentas/aulas', [RentaAulaController::class, 'store'])->name('rentas_aulas.store');
Route::post('/verificar-disponibilidad', [RentaAulaController::class, 'verificarDisponibilidad']);
Route::get('/admin/rentas-aulas', [RentaAulaController::class, 'index'])->name('rentasAula.index');

// Rutas de autenticación
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

// Rutas para el login y registro de empleados
Route::get('/login/empleado', [LoginEmpleadoController::class, 'showLoginForm'])->name('empleado.login');
Route::post('/login/empleado', [LoginEmpleadoController::class, 'login']);
Route::post('/logout/empleado', [LoginEmpleadoController::class, 'logout'])->name('empleado.logout');
Route::get('/register/empleado', [RegisterEmpleadoController::class, 'showRegistrationForm'])->name('empleado.register');
Route::post('/register/empleado', [RegisterEmpleadoController::class, 'register']);

// Rutas de vistas generales
Route::view('/', 'main')->name('home');
Route::view('/foros', 'Foros')->name('foros');
Route::view('/membresias', 'membresias')->name('membresias');
Route::view('/admin', 'VistaAdministrador')->name('admin.dashboard');
Route::view('/admin/rentas', 'VR3')->name('admin.rent');
Route::view('/admin/foros', 'VR4')->name('admin.foro');
Route::view('/admin/registro', 'VR2')->name('admin.register');
Route::view('contraseña', 'recuperaContraseña')->name('password.reset');
Route::view('/admin/devolucion', 'VR5')->name('admin.devolution');
Route::get('/', [LibroVistaController::class, 'index'])->name('main');
Route::get('libros/imagen/{id}', [LibroVistaController::class, 'getImagen'])->name('libros.imagen');
Route::get('/libros/{id}', [LibroVistaController::class, 'show'])->name('libros.show');
Route::post('/libros/{id}/ranking', [LibroVistaController::class, 'updateRanking'])->name('libros.updateRanking');
Route::post('/libros/{id}/calificacion', [LibroVistaController::class, 'addCalificacion'])->name('libros.addCalificacion');

Route::get('/membresia', [MembresiaController::class, 'index'])->name('membresia.index');