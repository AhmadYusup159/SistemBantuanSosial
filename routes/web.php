<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('index');
})->name('user.dashboard')->middleware('auth');

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth');
Route::get('/admin/statistikpelaporan', [AdminController::class, 'statistikpelaporan'])->name('admin.statistikpelaporan')->middleware('auth');
Route::get('/admin/statistikpenyaluran', [AdminController::class, 'statistikpenyaluran'])->name('admin.statistikpenyaluran')->middleware('auth');
Route::get('/admin/statistikpenerima', [AdminController::class, 'statistikpenerima'])->name('admin.statistikpenerima')->middleware('auth');
Route::patch('/reports/{id}/status', [AdminController::class, 'updateStatus'])->name('reports.updateStatus')->middleware('auth');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::prefix('reports')->middleware('auth')->group(function () {
    Route::get('/dashboard', [ReportController::class, 'dashboard'])->name('reports.dashboard');
    Route::get('/input', [ReportController::class, 'input'])->name('reports.input');
    Route::get('/show', [ReportController::class, 'show'])->name('reports.show');
    Route::post('/', [ReportController::class, 'store'])->name('reports.store');
    Route::get('/{id}/edit', [ReportController::class, 'edit'])->name('reports.edit');
    Route::patch('/{id}', [ReportController::class, 'update'])->name('reports.update');
    Route::delete('/{id}/destroy', [ReportController::class, 'destroy'])->name('reports.destroy');
});
Route::get('/api/provinces', function () {
    $response = Http::get('https://wilayah.id/api/provinces.json');
    return response($response->body(), $response->status());
});

Route::get('/api/regencies/{provinceCode}', function ($provinceCode) {
    $response = Http::get("https://wilayah.id/api/regencies/{$provinceCode}.json");
    return response($response->body(), $response->status());
});

Route::get('/api/districts/{regencyCode}', function ($regencyCode) {
    $response = Http::get("https://wilayah.id/api/districts/{$regencyCode}.json");
    return response($response->body(), $response->status());
});
