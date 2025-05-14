<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardClienteController;
use App\Http\Controllers\HotelAdminController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PerfilAdminController;
use App\Http\Controllers\PrecioAdminController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\ReservaAdminController;
use App\Http\Controllers\TipoReservaAdminController;
use App\Http\Controllers\UsuarioAdminController;
use App\Http\Controllers\VehiculoAdminController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\ZonaAdminController;
use App\Http\Controllers\HomeController;


Route::get('/', [HomeController::class, 'index'])->name('home');


// AUTH
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// DASHBOARDS
Route::get('/dashboard/admin', [DashboardAdminController::class, 'index'])->name('dashboard.admin');
Route::get('/dashboard/hotel', [DashboardController::class, 'hotel'])->name('dashboard.hotel');
Route::get('/dashboard/vehiculo', [DashboardController::class, 'vehiculo'])->name('dashboard.vehiculo');
Route::get('/dashboard/cliente', [DashboardClienteController::class, 'index'])->name('dashboard.particular');


// RESERVAS CLIENTE
Route::get('/reserva', [ReservaController::class, 'index'])->name('reserva.index');
Route::get('/reserva/create', [ReservaController::class, 'create'])->name('reserva.create');
Route::post('/reserva/store', [ReservaController::class, 'store'])->name('reserva.store');
Route::get('/reserva/edit/{id}', [ReservaController::class, 'edit'])->name('reserva.edit');
Route::post('/reserva/edit/{id}', [ReservaController::class, 'edit']); // para POST desde modal
Route::get('/reserva/delete/{id}', [ReservaController::class, 'delete'])->name('reserva.delete');


// RESERVAS ADMIN
Route::get('/admin/reserva', [ReservaAdminController::class, 'index'])->name('admin.reserva.index');
Route::get('/admin/reserva/create', [ReservaAdminController::class, 'create'])->name('admin.reserva.create');
Route::post('/admin/reserva/store', [ReservaAdminController::class, 'store'])->name('admin.reserva.store');
Route::get('/admin/reserva/edit/{id}', [ReservaAdminController::class, 'edit'])->name('admin.reserva.edit');
Route::post('/admin/reserva/update/{id}', [ReservaAdminController::class, 'update'])->name('admin.reserva.update');
Route::get('/admin/reserva/delete/{id}', [ReservaAdminController::class, 'destroy'])->name('admin.reserva.delete');


// PERFIL
Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil.index');
Route::post('/perfil/edit', [PerfilController::class, 'edit'])->name('perfil.edit');

// PERFIL ADMIN
Route::get('/admin/perfil', [PerfilAdminController::class, 'index'])->name('admin.perfil.index');
Route::post('/admin/perfil/edit', [PerfilAdminController::class, 'edit'])->name('admin.perfil.edit');


// USUARIOS ADMIN
Route::get('/admin/usuario', [UsuarioAdminController::class, 'index'])->name('admin.usuario.index');
Route::get('/admin/usuario/create', [UsuarioAdminController::class, 'create'])->name('admin.usuario.create');
Route::post('/admin/usuario/store', [UsuarioAdminController::class, 'store'])->name('admin.usuario.store');
Route::get('/admin/usuario/edit/{id}', [UsuarioAdminController::class, 'edit'])->name('admin.usuario.edit');
Route::post('/admin/usuario/update/{id}', [UsuarioAdminController::class, 'update'])->name('admin.usuario.update');
Route::get('/admin/usuario/delete/{id}', [UsuarioAdminController::class, 'delete'])->name('admin.usuario.delete');


// HOTEL ADMIN
Route::get('/admin/hotel', [HotelAdminController::class, 'index'])->name('admin.hotel.index');
Route::get('/admin/hotel/create', [HotelAdminController::class, 'create'])->name('admin.hotel.create');
Route::post('/admin/hotel/store', [HotelAdminController::class, 'store'])->name('admin.hotel.store');
Route::get('/admin/hotel/edit/{id}', [HotelAdminController::class, 'edit'])->name('admin.hotel.edit');
Route::post('/admin/hotel/update/{id}', [HotelAdminController::class, 'update'])->name('admin.hotel.update');
Route::get('/admin/hotel/delete/{id}', [HotelAdminController::class, 'delete'])->name('admin.hotel.delete');


// HOTELES (vista pública)
Route::get('/hotel', [HotelController::class, 'index'])->name('hotel.index');


// VEHICULO ADMIN
Route::get('/admin/vehiculo', [VehiculoAdminController::class, 'index'])->name('admin.vehiculo.index');
Route::get('/admin/vehiculo/create', [VehiculoAdminController::class, 'create'])->name('admin.vehiculo.create');
Route::post('/admin/vehiculo/store', [VehiculoAdminController::class, 'store'])->name('admin.vehiculo.store');
Route::get('/admin/vehiculo/edit/{id}', [VehiculoAdminController::class, 'edit'])->name('admin.vehiculo.edit');
Route::post('/admin/vehiculo/update/{id}', [VehiculoAdminController::class, 'update'])->name('admin.vehiculo.update');
Route::get('/admin/vehiculo/delete/{id}', [VehiculoAdminController::class, 'delete'])->name('admin.vehiculo.delete');

// VEHICULO PÚBLICO
Route::get('/vehiculo', [VehiculoController::class, 'index'])->name('vehiculo.index');


// PRECIOS ADMIN
Route::get('/admin/precio', [PrecioAdminController::class, 'index'])->name('admin.precio.index');
Route::get('/admin/precio/create', [PrecioAdminController::class, 'create'])->name('admin.precio.create');
Route::post('/admin/precio/store', [PrecioAdminController::class, 'store'])->name('admin.precio.store');
Route::get('/admin/precio/edit/{id}', [PrecioAdminController::class, 'edit'])->name('admin.precio.edit');
Route::post('/admin/precio/update/{id}', [PrecioAdminController::class, 'update'])->name('admin.precio.update');
Route::get('/admin/precio/delete/{id}', [PrecioAdminController::class, 'delete'])->name('admin.precio.delete');


// TIPO RESERVA ADMIN
Route::get('/admin/tipo-reserva', [TipoReservaAdminController::class, 'index'])->name('admin.tiporeserva.index');
Route::get('/admin/tipo-reserva/create', [TipoReservaAdminController::class, 'create'])->name('admin.tiporeserva.create');
Route::post('/admin/tipo-reserva/store', [TipoReservaAdminController::class, 'store'])->name('admin.tiporeserva.store');
Route::get('/admin/tipo-reserva/edit/{id}', [TipoReservaAdminController::class, 'edit'])->name('admin.tiporeserva.edit');
Route::post('/admin/tipo-reserva/update/{id}', [TipoReservaAdminController::class, 'update'])->name('admin.tiporeserva.update');
Route::get('/admin/tipo-reserva/delete/{id}', [TipoReservaAdminController::class, 'delete'])->name('admin.tiporeserva.delete');


// ZONAS ADMIN
Route::get('/admin/zona', [ZonaAdminController::class, 'index'])->name('admin.zona.index');
Route::get('/admin/zona/create', [ZonaAdminController::class, 'create'])->name('admin.zona.create');
Route::post('/admin/zona/store', [ZonaAdminController::class, 'store'])->name('admin.zona.store');
Route::get('/admin/zona/edit/{id}', [ZonaAdminController::class, 'edit'])->name('admin.zona.edit');
Route::post('/admin/zona/update/{id}', [ZonaAdminController::class, 'update'])->name('admin.zona.update');
Route::get('/admin/zona/delete/{id}', [ZonaAdminController::class, 'delete'])->name('admin.zona.delete');
