<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\CompanyVerificationController;

Route::prefix('admin')->name('admin.')->group(function () {

    // Authentification
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware(['auth:admin'])->group(function () {

        // Déconnexion et tableau de bord
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Étudiants
        Route::resource('students', StudentController::class)->only(['index', 'show', 'edit', 'update', 'destroy']);

        // Entreprises
        Route::resource('companies', CompanyController::class)->only(['index', 'show', 'destroy']);
        Route::put('companies/{company}/status', [CompanyController::class, 'updateStatus'])->name('companies.updateStatus');
        Route::put('companies/{id}/validate', [CompanyController::class, 'validateCompany'])->name('companies.validate');
        Route::put('companies/{id}/refuse', [CompanyController::class, 'refuseCompany'])->name('companies.refuse');

        // Vérifications d'entreprises
        Route::prefix('verifications')->name('verifications.')->group(function () {
            Route::get('/', [CompanyVerificationController::class, 'index'])->name('index');
            Route::get('/{id}', [CompanyVerificationController::class, 'show'])->name('show');
            Route::put('/{id}/approve', [CompanyVerificationController::class, 'approve'])->name('approve');
            Route::put('/{id}/reject', [CompanyVerificationController::class, 'reject'])->name('reject');
        });
    });
});
