<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PredictionController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AuthController;

// ================= AUTH =================
// PUBLIC HOMEPAGE
Route::get('/', function () {
    return view('homepage');
});

// Route::get('/', fn() => redirect()->route('login'));

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ================= PROTECTED AREA =================
Route::middleware('auth')->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // PATIENTS
    Route::resource('patients', PatientController::class);
    Route::get('/patients/search', [PatientController::class, 'search'])->name('patients.search');
    Route::get('/patients/{id}', [PatientController::class, 'show']);

    // PREDICTION
    Route::get('/upload', [PredictionController::class, 'uploadPage']);
    // Route::post('/predict', [PredictionController::class, 'predict']);
    Route::post('/predict', [PredictionController::class, 'predict'])
    ->name('predict');
    
    // HISTORY + REPORT
    Route::get('/history', [HistoryController::class, 'index']);
    Route::get('/report/{id}', [ReportController::class, 'show']);
    Route::get('/report/{id}/download', [ReportController::class, 'downloadPdf'])
    ->name('report.download');

});