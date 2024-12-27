<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

Route::get('/', function () {
    return view('registrasi');
});

use App\Http\Controllers\ReportController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/dashboard', function () {
    return view('index');
})->middleware('auth');
Route::get('/admin/dashboard', function () {
    return view('dashboard_admin');
})->middleware('auth');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


Route::prefix('api/reports')->group(function () {
    Route::post('/', [ReportController::class, 'store']);
    Route::get('/', [ReportController::class, 'index']);
    Route::patch('/{id}', [ReportController::class, 'updateStatus']);
    Route::delete('/{id}/destroy', [ReportController::class, 'destroy'])->name('destroy');
    Route::get('/input', [ReportController::class, 'input'])->name('input');
    Route::get('/show', [ReportController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [ReportController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [ReportController::class, 'update'])->name('update');
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
