<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\SettingsController;



Route::redirect('/', '/dashboard')->middleware('auth');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'attempt'])->name('login.attempt');
});

Route::post('logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('patients', PatientController::class);
    Route::resource('appointments', AppointmentController::class);
    Route::get('appointments/today', [AppointmentController::class, 'today'])->name('appointments.today');
    Route::get('analytics', [AnalyticsController::class, 'index'])->name('analytics');
    Route::get('settings', [SettingsController::class, 'index'])->name('settings');
}); 