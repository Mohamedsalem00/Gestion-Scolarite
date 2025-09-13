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
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/






// // Show the login form
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Handle the login form submission
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// Logout the user
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    // Place all the routes that require authentication here

    // Evaluation legacy routes (keeping for compatibility)
    Route::get('/evaluation/spectacleDevoir1', [EvaluationController::class, 'show1'])->name('spectacleDevoir1');
    Route::get('/evaluation/spectacleDevoir2', [EvaluationController::class, 'show2'])->name('spectacleDevoir2');
    Route::get('/evaluation/spectacleDevoir3', [EvaluationController::class, 'show3'])->name('spectacleDevoir3');
    Route::get('/evaluation/spectacleExamen1', [EvaluationController::class, 'show4'])->name('spectacleExamen1');
    Route::get('/evaluation/spectacleExamen2', [EvaluationController::class, 'show5'])->name('spectacleExamen2');
    Route::get('/evaluation/spectacleExamen3', [EvaluationController::class, 'show6'])->name('spectacleExamen3');

    // Resource routes
    Route::resource('/etudiant', EtudiantController::class);
    Route::resource('/enseignant', EnseignantController::class);
    Route::resource('/classe', ClasseController::class);
    Route::resource('/cours', CoursController::class);
    Route::resource('/evaluation', EvaluationController::class);

    // Note routes
    Route::get('/note/noteDevoir1', [NoteController::class, 'showNoteDevoir1'])->name('noteDevoir1');
    Route::get('/note/noteDevoir2', [NoteController::class, 'showNoteDevoir2'])->name('noteDevoir2');
    Route::get('/note/noteDevoir3', [NoteController::class, 'showNoteDevoir3'])->name('noteDevoir3');
    Route::get('/note/noteExamen1', [NoteController::class, 'showNoteExamen1'])->name('noteExamen1');
    Route::get('/note/noteExamen2', [NoteController::class, 'showNoteExamen2'])->name('noteExamen2');
    Route::get('/note/noteExamen3', [NoteController::class, 'showNoteExamen3'])->name('noteExamen3');
    Route::get('/note/noteExamen3', [NoteController::class, 'showNoteExamen3'])->name('noteExamen3');
    Route::get('/note/releveNotes1', [NoteController::class, 'showreleveNotes1'])->name('releveNotes1');
    Route::get('/note/releveNotes2', [NoteController::class, 'showreleveNotes2'])->name('releveNotes2');
    Route::get('/note/releveNotes3', [NoteController::class, 'showreleveNotes3'])->name('releveNotes3');
    Route::get('/note/releveNotes1/spectacleT1/{id}/{trimestre}', [NoteController::class, 'spectacleT1'])->name('spectacleT1');
    Route::get('/note/releveNotes2/spectacleT2/{id}/{trimestre}', [NoteController::class, 'spectacleT2'])->name('spectacleT2');
    Route::get('/note/releveNotes3/spectacleT3{id}/{trimestre}', [NoteController::class, 'spectacleT3'])->name('spectacleT3');

    // Paiement routes
    Route::get('/paiement', function () {
        return view('paiement');
    });
    Route::resource('/paiement/enseignpaiement', EnseignPaiementController::class);
    Route::get('/paiement/enseignpaiement/create/{id}/{salaire}', [\App\Http\Controllers\EnseignPaiementController::class, 'create'])->name('enseignpaiement.create');
    Route::get('/paiement/enseignpaiement/edit/{id}/{salaire}', [\App\Http\Controllers\EnseignPaiementController::class, 'edit'])->name('enseignpaiement.edit');
    Route::resource('/paiement/etudepaiement', EtudePaiementController::class);
    Route::get('/paiement/etudepaiement/create/{id}/{frais}', [\App\Http\Controllers\EtudePaiementController::class, 'create'])->name('etudepaiement.create');
    Route::get('/paiement/etudepaiement/edit/{id}/{frais}', [\App\Http\Controllers\EtudePaiementController::class, 'edit'])->name('etudepaiement.edit');
    Route::resource('/note', \App\Http\Controllers\NoteController::class);
    Route::get('/note/create/{id}/{matiere}/{type}', [\App\Http\Controllers\NoteController::class, 'create'])->name('note.create');
    Route::get('/search', [SearchController::class, 'showResults'])->name('search');
    Route::get('/publication', function () {
        return view('publication');
    });
});

Route::get('/', function () {
    return view('Accueil.Accueil');
});
