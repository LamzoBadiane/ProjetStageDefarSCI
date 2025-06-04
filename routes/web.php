<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\StudentProfileController;
use App\Http\Controllers\Auth\RegisteredCompanyController;
use App\Http\Controllers\Auth\CompanyAuthController;
use App\Http\Controllers\CompanyDashboardController;
use App\Http\Controllers\Company\OfferController as CompanyOfferController;
use App\Http\Controllers\Company\ApplicationController as CompanyApplicationController;
use App\Http\Controllers\Company\StudentController;

// 🌍 Page d'accueil
Route::get('/', fn () => view('welcome'));

// 🔐 Redirection selon rôle
Route::get('/dashboard', [RedirectController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// 👨‍🎓 Espace Étudiant
Route::middleware(['auth'])->group(function () {
    // Dashboard étudiant
    Route::get('/student/dashboard', fn () => view('student.dashboard'))->name('student.dashboard');

    // Profil Étudiant
    Route::get('/student/profile', [StudentProfileController::class, 'edit'])->name('student.profile.edit');
    Route::post('/student/profile', [StudentProfileController::class, 'update'])->name('student.profile.update');
    Route::get('/student/profile/create', [StudentProfileController::class, 'create'])->name('student.profile.create');
    Route::post('/student/profile/store', [StudentProfileController::class, 'store'])->name('student.profile.store');
});

// 📢 Offres disponibles (publiques)
Route::get('/offers', [OfferController::class, 'index'])->name('offers.index');
Route::get('/offers/{id}', [OfferController::class, 'show'])->name('offers.show');

// 📄 Candidatures (authentifiées)
Route::middleware(['auth'])->group(function () {
    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::post('/applications/{offerId}', [ApplicationController::class, 'store'])->name('applications.store');
    Route::get('/applications/{id}', [ApplicationController::class, 'show'])->name('applications.show');
    Route::get('/applications/{id}/edit', [ApplicationController::class, 'edit'])->name('applications.edit');
    Route::put('/applications/{id}', [ApplicationController::class, 'update'])->name('applications.update');
    Route::delete('/applications/{id}', [ApplicationController::class, 'destroy'])->name('applications.destroy');
    Route::patch('/company/applications/{id}/status', [ApplicationController::class, 'updateStatus'])->name('company.applications.updateStatus');
});

// ⚙️ Profil Utilisateur Authentifié
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 🏢 Authentification & Inscription Entreprise
Route::get('/register/company', [RegisteredCompanyController::class, 'create'])->name('company.register');
Route::post('/register/company', [RegisteredCompanyController::class, 'store'])->name('company.register.store');
Route::get('/login/company', [CompanyAuthController::class, 'showLoginForm'])->name('company.login');
Route::post('/login/company', [CompanyAuthController::class, 'login'])->name('company.login.submit');
Route::post('/logout/company', [CompanyAuthController::class, 'logout'])->name('company.logout');

// 🧑‍💼 Espace Entreprise
Route::prefix('company')->name('company.')->middleware(['auth:company'])->group(function () {

    // Dashboard entreprise
    Route::get('/dashboard', [CompanyDashboardController::class, 'index'])->name('dashboard');

    // Gestion des offres
    Route::resource('offers', CompanyOfferController::class);
    Route::post('/offers/{offer}/status', [CompanyOfferController::class, 'updateStatus'])->name('offers.updateStatus');

    // Gestion des candidatures reçues
    Route::get('/applications', [CompanyApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/{id}', [CompanyApplicationController::class, 'show'])->name('applications.show');
    Route::put('/applications/{id}/update-status', [CompanyApplicationController::class, 'updateStatus'])->name('applications.updateStatus');

    // Voir profil d’un étudiant
    Route::get('/students/{id}/profile', [StudentController::class, 'show'])->name('students.profile');
});

// 🛠️ Espace Admin
Route::get('/admin/dashboard', fn () => view('admin.dashboard'))
    ->middleware(['auth'])
    ->name('admin.dashboard');

// 📜 Auth routes (Jetstream/Breeze/etc.)
require __DIR__ . '/auth.php';
