<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Dashboard route (accessible without authentication)
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

// Authentication Routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function () {
    // Login logic will be handled by Laravel's built-in authentication
    return redirect()->intended('/dashboard');
})->name('login.post');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', function () {
    // Registration logic will be handled by Laravel's built-in authentication
    return redirect('/dashboard');
})->name('register.post');

Route::get('/logout', function () {
    return view('auth.logout');
})->name('logout.confirm');

Route::post('/logout', function () {
    // Logout logic will be handled by Laravel's built-in authentication
    return redirect('/');
})->name('logout');

// All Routes (accessible without authentication)
Route::resource('users', App\Http\Controllers\UserController::class);
Route::resource('patients', App\Http\Controllers\PatientController::class);
Route::resource('doctors', App\Http\Controllers\DoctorController::class);
Route::resource('appointments', App\Http\Controllers\AppointmentController::class);
Route::resource('services', App\Http\Controllers\ServiceController::class);
Route::resource('treatments', App\Http\Controllers\TreatmentController::class);
Route::resource('payments', App\Http\Controllers\PaymentController::class);
Route::resource('prescriptions', App\Http\Controllers\PrescriptionController::class);
Route::resource('reports', App\Http\Controllers\ReportController::class);
Route::resource('roles', App\Http\Controllers\RoleController::class);

// API Routes for dynamic data
Route::get('/api/patient-balance/{patient}', [App\Http\Controllers\PaymentController::class, 'getPatientBalance'])->name('api.patient.balance');
Route::get('/api/patient-treatments/{patient}', [App\Http\Controllers\PaymentController::class, 'getPatientTreatmentCosts'])->name('api.patient.treatments');
Route::get('/api/remaining-treatments/{patient}/{amount}', [App\Http\Controllers\PaymentController::class, 'getRemainingTreatments'])->name('api.remaining.treatments');
