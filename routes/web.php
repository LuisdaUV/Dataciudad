<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EnrutadorController;
use App\Http\Controllers\SolicitudController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('role:ventanilla')->prefix('ventanilla')->name('ventanilla.')->group(function () {
        Route::get('/solicitudes/crear', [SolicitudController::class, 'create'])->name('solicitudes.create');
        Route::post('/solicitudes', [SolicitudController::class, 'store'])->name('solicitudes.store');
    });

    Route::middleware('role:enrutador')->prefix('enrutador')->name('enrutador.')->group(function () {
        Route::get('/bitacora', [EnrutadorController::class, 'bitacora'])->name('bitacora');
    });
});
