<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\AuthController;

Route::get('/', [HomeController::class, 'index']); 
Route::get('/contact', [ContactController::class, 'index']);
Route::get('/players', [PlayerController::class, 'index'])->name('players');
Route::get('/players/{id}', [PlayerController::class, 'show'])->name('players.show');

Route::get('/home', function () {
    return view('pages.home');
});

Route::get('/about', function () {
    return view('pages.about');
});

// Admin Authentication Routes
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');

Route::middleware(['admin.auth'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    
    Route::get('/admin/players/report/pdf', [PlayerController::class, 'exportPdf'])->name('admin.players.pdf');
    
    Route::get('/admin/players', [PlayerController::class, 'adminIndex'])->name('admin.players.index');
    Route::resource('/admin/players', PlayerController::class)->names([
        'create' => 'admin.players.create',
        'store' => 'admin.players.store',
        'edit' => 'admin.players.edit',
        'update' => 'admin.players.update',
        'destroy' => 'admin.players.destroy',
    ])->except(['index', 'show']);
    
    Route::get('/admin/players/{id}', [PlayerController::class, 'adminShow'])->name('admin.players.show');
    
    Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');
});