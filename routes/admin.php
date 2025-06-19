<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\CompanyController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('admin')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    });
});

Route::middleware(['auth:admin'])->prefix('admin')->as('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('students', StudentController::class)->only(['index', 'show', 'edit', 'update', 'destroy']);
    Route::resource('companies', CompanyController::class)->only(['index', 'show', 'destroy']);
    Route::get('/companies/{id}', [CompanyController::class, 'show'])->name('companies.show');
    Route::get('/{company}', [CompanyController::class, 'show'])->name('show');
    Route::put('companies/{id}/validate', [CompanyController::class, 'validateCompany'])->name('companies.validate');
    Route::put('companies/{id}/refuse', [CompanyController::class, 'refuseCompany'])->name('companies.refuse');
    Route::post('/{company}/validate', [CompanyController::class, 'validateCompany'])->name('validate');
    Route::post('/{company}/reject', [CompanyController::class, 'rejectCompany'])->name('reject');
});

// Vérification d'entreprise
Route::middleware(['auth:admin'])->prefix('verifications')->name('admin.verifications.')->group(function () {
    Route::get('/', [CompanyVerificationController::class, 'index'])->name('index');
    Route::get('/{id}', [CompanyVerificationController::class, 'show'])->name('show');
    Route::put('/{id}/approve', [CompanyVerificationController::class, 'approve'])->name('approve');
    Route::put('/{id}/reject', [CompanyVerificationController::class, 'reject'])->name('reject');
});
