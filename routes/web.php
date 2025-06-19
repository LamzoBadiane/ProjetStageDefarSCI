<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProfileController,
    RedirectController,
    OfferController,
    ApplicationController,
    StudentProfileController,
    Auth\RegisteredCompanyController,
    Auth\CompanyAuthController,
    CompanyDashboardController,
    PublicCompanyController
};
use App\Http\Controllers\Company\{
    OfferController as CompanyOfferController,
    ApplicationController as CompanyApplicationController,
    StudentController,
    CompanyProfileController,
    HistoryController,
    InterviewController,
    StatisticsController,
    CompanyAccountController,
    VerificationController
};
use App\Http\Controllers\Student\{
    InterviewController as StudentInterviewController,
    AccountController
};

// 🌍 Page d'accueil
Route::get('/', fn () => view('welcome'));

// 🔐 Redirection selon rôle
Route::get('/dashboard', [RedirectController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// ====================================================
// 👨‍🎓 Espace Étudiant (authentifié)
// ====================================================
Route::middleware(['auth'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', fn () => view('student.dashboard'))->name('dashboard');
    Route::get('/profile', [StudentProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [StudentProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/create', [StudentProfileController::class, 'create'])->name('profile.create');
    Route::post('/profile/store', [StudentProfileController::class, 'store'])->name('profile.store');

    // Mon compte
    Route::get('/account', [AccountController::class, 'edit'])->name('account.edit');
    Route::put('/account', [AccountController::class, 'update'])->name('account.update');
    Route::put('/account/password', [AccountController::class, 'updatePassword'])->name('account.password');
    Route::delete('/account', [AccountController::class, 'destroy'])->name('account.delete');

    // Entretiens
    Route::prefix('interviews')->name('interviews.')->group(function () {
        Route::get('/', [StudentInterviewController::class, 'index'])->name('index');
        Route::delete('/{id}', [StudentInterviewController::class, 'destroy'])->name('destroy');
    });
});

// ====================================================
// 📢 Offres disponibles (publiques)
// ====================================================
Route::get('/offers', [OfferController::class, 'index'])->name('offers.index');
Route::get('/offers/{id}', [OfferController::class, 'show'])->name('offers.show');

// ====================================================
// 📄 Candidatures (auth:student)
// ====================================================
Route::middleware(['auth'])->group(function () {
    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::post('/applications/{offerId}', [ApplicationController::class, 'store'])->name('applications.store');
    Route::get('/applications/{id}', [ApplicationController::class, 'show'])->name('applications.show');
    Route::get('/applications/{id}/edit', [ApplicationController::class, 'edit'])->name('applications.edit');
    Route::put('/applications/{id}', [ApplicationController::class, 'update'])->name('applications.update');
    Route::delete('/applications/{id}', [ApplicationController::class, 'destroy'])->name('applications.destroy');
});

// ====================================================
// ⚙️ Profil utilisateur générique
// ====================================================
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ====================================================
// 🏢 Auth entreprise
// ====================================================
Route::get('/register/company', [RegisteredCompanyController::class, 'create'])->name('company.register');
Route::post('/register/company', [RegisteredCompanyController::class, 'store'])->name('company.register.store');
Route::get('/login/company', [CompanyAuthController::class, 'showLoginForm'])->name('company.login');
Route::post('/login/company', [CompanyAuthController::class, 'login'])->name('company.login.submit');
Route::post('/logout/company', [CompanyAuthController::class, 'logout'])->name('company.logout');

// ====================================================
// 🏢 Interface entreprise (auth:company)
// ====================================================
Route::prefix('company')->name('company.')->middleware(['auth:company'])->group(function () {

    // Vérification en attente
    Route::get('/verify', [VerificationController::class, 'show'])->name('verification');
    Route::post('/verify', [VerificationController::class, 'submit'])->name('verification.submit');

    // Si non validée
    Route::get('/en-attente', fn () => view('company.awaiting'))->name('awaiting');
});

// ✅ Toutes ces routes sont protégées par le middleware de validation
Route::prefix('company')->name('company.')->middleware(['auth:company', 'company.validated'])->group(function () {
    Route::get('/dashboard', [CompanyDashboardController::class, 'index'])->name('dashboard');

    // Offres
    Route::resource('offers', CompanyOfferController::class);
    Route::post('/offers/{offer}/status', [CompanyOfferController::class, 'updateStatus'])->name('offers.updateStatus');

    // Candidatures
    Route::get('/applications', [CompanyApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/{id}', [CompanyApplicationController::class, 'show'])->name('applications.show');
    Route::put('/applications/{id}/update-status', [CompanyApplicationController::class, 'updateStatus'])->name('applications.updateStatus');

    // Étudiants
    Route::get('/students/{id}/profile', [StudentController::class, 'show'])->name('students.profile');

    // Profil
    Route::get('/profile', [CompanyProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/show', [CompanyProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [CompanyProfileController::class, 'update'])->name('profile.update');

    // Historique
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
    Route::delete('/history', [HistoryController::class, 'destroyAll'])->name('history.destroyAll');

    // Compte entreprise
    Route::get('/account', [CompanyAccountController::class, 'edit'])->name('account.edit');
    Route::put('/account', [CompanyAccountController::class, 'update'])->name('account.update');
    Route::put('/account/password', [CompanyAccountController::class, 'updatePassword'])->name('account.password');
    Route::delete('/account', [CompanyAccountController::class, 'destroy'])->name('account.delete');

    // Statistiques
    Route::get('/statistics', [StatisticsController::class, 'index'])->name('statistics.index');

    // Entretiens
    Route::prefix('interviews')->name('interviews.')->group(function () {
        Route::get('/', [InterviewController::class, 'index'])->name('index');
        Route::get('/create', [InterviewController::class, 'create'])->name('create');
        Route::post('/', [InterviewController::class, 'store'])->name('store');
        Route::get('/{id}', [InterviewController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [InterviewController::class, 'edit'])->name('edit');
        Route::put('/{id}', [InterviewController::class, 'update'])->name('update');
        Route::delete('/{id}', [InterviewController::class, 'destroy'])->name('destroy');
    });
});

Route::post('/admin/companies/{id}/reject', [\App\Http\Controllers\Admin\CompanyController::class, 'refuseCompany'])
    ->name('admin.companies.reject');
Route::post('/admin/companies/{id}/validate', [\App\Http\Controllers\Admin\CompanyController::class, 'validateCompany'])
    ->name('admin.companies.validate');



// 🌐 Profil public entreprise (visiteurs/étudiants)
Route::get('/entreprises/{id}', [CompanyProfileController::class, 'showPublic'])->name('public.company.profile');

// ====================================================
// 🛠️ Administration
// ====================================================
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::get('/dashboard', fn () => view('admin.dashboard'))->name('dashboard');
    // À compléter avec routes admin...
});

// 📜 Auth par défaut (Jetstream / Breeze)
require __DIR__ . '/auth.php';
