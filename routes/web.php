<?php

use App\Http\Controllers\ClasseController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\EnseignPaiementController;
use App\Http\Controllers\EtudePaiementController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\EnseignantDashboardController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Clean, organized route structure for School Management System
| Grouped by functionality with proper naming conventions
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Language Switching Routes
|--------------------------------------------------------------------------
*/
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['fr', 'ar', 'en'])) {
        session(['locale' => $locale]);
        app()->setLocale($locale);
    }
    return redirect()->back();
})->name('lang.switch');

Route::get('/locale/{locale}', function ($locale) {
    if (in_array($locale, ['fr', 'ar', 'en'])) {
        session(['locale' => $locale]);
        app()->setLocale($locale);
    }
    return redirect()->back();
});

/*
|--------------------------------------------------------------------------
| Routes Publiques
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('accueil');

// Health check endpoint
Route::get('/health', function() {
    try {
        $dbStatus = DB::connection()->getPdo() ? 'connected' : 'disconnected';
    } catch (\Exception $e) {
        $dbStatus = 'error: ' . $e->getMessage();
    }
    
    return response()->json([
        'status' => 'OK',
        'timestamp' => now(),
        'app' => config('app.name'),
        'env' => config('app.env'),
        'database' => $dbStatus,
        'php_version' => PHP_VERSION,
    ]);
});

/*
|--------------------------------------------------------------------------
| Routes d'Authentification
|--------------------------------------------------------------------------
*/

// Routes d'authentification en français
Route::get('/connexion', [LoginController::class, 'showLoginForm'])->name('connexion');
Route::post('/connexion', [LoginController::class, 'login'])->name('connexion.submit');
Route::post('/deconnexion', [LogoutController::class, 'logout'])->name('deconnexion');

// Routes d'inscription
Route::get('/inscription', [RegisterController::class, 'showRegistrationForm'])->name('inscription');
Route::post('/inscription', [RegisterController::class, 'register'])->name('inscription.submit');

// Routes de réinitialisation de mot de passe en français
Route::get('/mot-de-passe/reinitialiser', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('mot-de-passe.demande');
Route::post('/mot-de-passe/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('mot-de-passe.email');
Route::get('/mot-de-passe/reinitialiser/{token}', [ResetPasswordController::class, 'showResetForm'])->name('mot-de-passe.reinitialiser');
Route::post('/mot-de-passe/reinitialiser', [ResetPasswordController::class, 'reset'])->name('mot-de-passe.mise-a-jour');
Route::get('/mot-de-passe/confirmer', [ConfirmPasswordController::class, 'showConfirmForm'])->name('mot-de-passe.confirmer');
Route::post('/mot-de-passe/confirmer', [ConfirmPasswordController::class, 'confirm'])->name('mot-de-passe.confirmation');

// Routes de vérification d'email en français
Route::get('/email/verifier', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('/email/verifier/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify')->middleware(['signed']);
Route::post('/email/renvoyer-verification', [VerificationController::class, 'resend'])->name('verification.resend');

/*
|--------------------------------------------------------------------------
| Routes du Tableau de Bord
|--------------------------------------------------------------------------
*/
Route::get('/tableau-bord', [HomeController::class, 'index'])->name('tableau-bord')->middleware(['auth', 'role:admin']);

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
| All routes requiring authentication grouped by functionality
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    
    /*
    |--------------------------------------------------------------------------
    | Academic Management Routes
    |--------------------------------------------------------------------------
    | Full CRUD access for admins only
    */
    
    // Gestion des Classes - Routes ressource complètes
    Route::resource('classes', ClasseController::class)->parameters([
        'classes' => 'classe'
    ])->names([
        'index' => 'classes.index',
        'create' => 'classes.create',
        'store' => 'classes.store',
        'show' => 'classes.show',
        'edit' => 'classes.edit',
        'update' => 'classes.update',
        'destroy' => 'classes.destroy'
    ]);
    
    // Gestion des Étudiants - Routes ressource complètes
    Route::resource('etudiants', EtudiantController::class)->parameters([
        'etudiants' => 'etudiant'
    ])->names([
        'index' => 'etudiants.index',
        'create' => 'etudiants.create',
        'store' => 'etudiants.store',
        'show' => 'etudiants.show',
        'edit' => 'etudiants.edit',
        'update' => 'etudiants.update',
        'destroy' => 'etudiants.destroy'
    ]);
    
    // Gestion des Enseignants - Routes ressource complètes
    Route::resource('enseignants', EnseignantController::class)->parameters([
        'enseignants' => 'enseignant'
    ])->names([
        'index' => 'enseignants.index',
        'create' => 'enseignants.create',
        'store' => 'enseignants.store',
        'show' => 'enseignants.show',
        'edit' => 'enseignants.edit',
        'update' => 'enseignants.update',
        'destroy' => 'enseignants.destroy'
    ]);
    
    // Route spéciale pour l'emploi du temps des cours (must be before resource)
    Route::get('cours/spectacle', [CoursController::class, 'spectacle'])->name('cours.spectacle');
    
    // Gestion des Cours - Routes ressource complètes
    Route::resource('cours', CoursController::class)->parameters([
        'cours' => 'cour'
    ])->names([
        'index' => 'cours.index',
        'create' => 'cours.create',
        'store' => 'cours.store',
        'show' => 'cours.show',
        'edit' => 'cours.edit',
        'update' => 'cours.update',
        'destroy' => 'cours.destroy'
    ]);
    
    // Gestion des Évaluations - Routes ressource complètes
    Route::resource('evaluations', EvaluationController::class)->parameters([
        'evaluations' => 'evaluation'
    ])->names([
        'index' => 'evaluations.index',
        'create' => 'evaluations.create',
        'store' => 'evaluations.store',
        'show' => 'evaluations.show',
        'edit' => 'evaluations.edit',
        'update' => 'evaluations.update',
        'destroy' => 'evaluations.destroy'
    ]);
    
    // Gestion des Notes - Routes ressource complètes
    Route::resource('notes', NoteController::class)->parameters([
        'notes' => 'note'
    ])->names([
        'index' => 'notes.index',
        'create' => 'notes.create',
        'store' => 'notes.store',
        'show' => 'notes.show',
        'edit' => 'notes.edit',
        'update' => 'notes.update',
        'destroy' => 'notes.destroy'
    ]);

    /*
    |--------------------------------------------------------------------------
    | Gestion des Paiements (Admin seulement)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:admin'])->prefix('paiements')->name('paiements.')->group(function () {
        // Tableau de bord des paiements
        Route::get('/', function () {
            return view('payments.index');
        })->name('index');
        
        // Paiements des Étudiants
        Route::resource('etudiants', EtudePaiementController::class)->parameters([
            'etudiants' => 'etudePaiement'
        ])->names([
            'index' => 'etudiants.index',
            'create' => 'etudiants.create',
            'store' => 'etudiants.store',
            'show' => 'etudiants.show',
            'edit' => 'etudiants.edit',
            'update' => 'etudiants.update',
            'destroy' => 'etudiants.destroy'
        ]);
        
        // Paiements des Enseignants
        Route::resource('enseignants', EnseignPaiementController::class)->parameters([
            'enseignants' => 'enseignPaiement'
        ])->names([
            'index' => 'enseignants.index',
            'create' => 'enseignants.create',
            'store' => 'enseignants.store',
            'show' => 'enseignants.show',
            'edit' => 'enseignants.edit',
            'update' => 'enseignants.update',
            'destroy' => 'enseignants.destroy'
        ]);
    });

    /*
    |--------------------------------------------------------------------------
    | Rapports & Analyses
    |--------------------------------------------------------------------------
    */  
    Route::prefix('rapports')->name('rapports.')->group(function () {
        // Rapports de notes par type
        Route::get('notes/devoirs/{level}', [NoteController::class, 'homeworkReports'])->name('notes.devoirs');
        Route::get('notes/examens/{level}', [NoteController::class, 'examReports'])->name('notes.examens');
        
        // Relevés de notes - Admin index only (search is public)
        Route::get('notes/releves', [NoteController::class, 'transcriptIndex'])->name('notes.transcript-index');
        
        // Plannings d'évaluations
        Route::get('evaluations/{type}/{niveau}', [EvaluationController::class, 'schedule'])->name('evaluations.planning');
    });

    /*
    |--------------------------------------------------------------------------
    | Utilitaires
    |--------------------------------------------------------------------------
    */
    Route::get('recherche', [SearchController::class, 'index'])->name('recherche');
    Route::get('publications', function () {
        return view('publications.index');
    })->name('publications');




});

/*
|--------------------------------------------------------------------------
| Role-Based Dashboard Routes
|--------------------------------------------------------------------------
| Separate dashboards for different user roles with proper middleware
*/

// Admin-only routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Admin has access to all academic management
    // All the above routes are already accessible to admins
});

// Teacher (Enseignant) Dashboard Routes
Route::middleware(['auth', 'role:enseignant'])->prefix('enseignant')->name('enseignant.')->group(function () {
    Route::get('/tableau-bord', [EnseignantDashboardController::class, 'index'])->name('tableau-bord');
    Route::get('/mes-etudiants', [EnseignantDashboardController::class, 'mesEtudiants'])->name('mes-etudiants');
    Route::get('/mes-cours', [EnseignantDashboardController::class, 'mesCours'])->name('mes-cours');
    Route::get('/saisir-notes', [EnseignantDashboardController::class, 'saisirNotes'])->name('saisir-notes');
    
    // Teacher profile routes
    Route::get('/profil', [EnseignantDashboardController::class, 'profil'])->name('profil');
    Route::put('/profil', [EnseignantDashboardController::class, 'updateProfil'])->name('profil.update');
    
    // Teacher note management routes
    Route::get('/notes/create/{etudiant}/{evaluation}', [NoteController::class, 'create'])->name('notes.create');
    Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');
    Route::get('/notes/{note}/edit', [NoteController::class, 'edit'])->name('notes.edit');
    Route::put('/notes/{note}', [NoteController::class, 'update'])->name('notes.update');
    Route::delete('/notes/{note}', [NoteController::class, 'destroy'])->name('notes.destroy');
});

/*
|--------------------------------------------------------------------------
| Public Routes for Students (No Login Required)
|--------------------------------------------------------------------------
| Students don't have user accounts - they use public access with matricule
*/

// Public transcript search - no authentication required
Route::get('/rechercher-notes', [NoteController::class, 'publicTranscriptSearch'])->name('public.transcript.search');
Route::get('/mon-releve/{matricule}/{trimestre?}', [NoteController::class, 'publicTranscript'])->name('public.transcript.show');
