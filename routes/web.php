<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BeneficiaireController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RefuseeController; // Add this import
use Illuminate\Support\Facades\Auth;

// Routes publiques
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/postuler', [CandidatureController::class, 'create'])->name('candidature.create');
Route::post('/postuler', [CandidatureController::class, 'store'])->name('candidature.store');
Route::get('/merci', function() {
    return view('merci');
})->name('merci');

// Routes authentifiées
Route::middleware(['auth'])->group(function () {
    // Dashboard administrateur
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    
    // In routes/web.php
    Route::get('/admin/stats', [App\Http\Controllers\AdminController::class, 'getStats'])->name('admin.stats');

    // Gestion des candidatures
    Route::get('/admin/candidatures', [CandidatureController::class, 'index'])->name('candidature.index');
    
    // Important: Les routes statiques AVANT les routes avec des paramètres
    // Routes pour les vues de candidatures spécifiques (acceptées/refusées)
    Route::get('/admin/candidatures/acceptees', [CandidatureController::class, 'acceptees'])->name('candidature.acceptees');
    Route::get('/admin/candidatures/refusees', [CandidatureController::class, 'refusees'])->name('candidature.refusees');
    
    // Ajouter cette route pour afficher les détails d'une candidature refusée
    Route::get('/admin/refusees/{refusee}', [RefuseeController::class, 'show'])->name('refusee-show');
    
    // Routes avec des paramètres wildcard (doivent venir APRÈS les routes statiques)
    Route::get('/admin/candidatures/{candidature}', [CandidatureController::class, 'show'])->name('candidature.show');
    Route::post('/admin/candidatures/{candidature}/accepter', [CandidatureController::class, 'accepter'])->name('candidature.accepter');
    Route::post('/admin/candidatures/{candidature}/refuser', [CandidatureController::class, 'refuser'])->name('candidature.refuser');
    Route::get('/contrats/{candidature}', [CandidatureController::class, 'telechargerContrat'])
    ->name('contrats.telecharger')
    ->middleware('signed'); // Protection par signature URL
    // Gestion des bénéficiaires
    Route::get('/admin/beneficiaires', [BeneficiaireController::class, 'index'])->name('beneficiaire.index');
    Route::get('/admin/beneficiaires/{beneficiaire}', [BeneficiaireController::class, 'show'])->name('beneficiaire.show');
    
    // Calendar view for appointments
    Route::get('/admin/calendar', [BeneficiaireController::class, 'calendar'])->name('beneficiaire.calendar');
    
    // Routes pour les rendez-vous
    Route::get('/admin/beneficiaires/{beneficiaire}/rendez-vous', [BeneficiaireController::class, 'createAppointment'])->name('beneficiaire.appointment.create');
    Route::post('/admin/beneficiaires/{beneficiaire}/rendez-vous', [BeneficiaireController::class, 'storeAppointment'])->name('beneficiaire.appointment.store');
    Route::post('/admin/beneficiaires/{beneficiaire}/presence', [BeneficiaireController::class, 'confirmAttendance'])->name('beneficiaire.attendance.confirm');
    Route::post('/admin/beneficiaires/{beneficiaire}/absence', [BeneficiaireController::class, 'recordAbsence'])->name('beneficiaire.absence.record');
    
    // Route pour télécharger le document de rendez-vous
    Route::get('/rendez-vous/{beneficiaire}', [BeneficiaireController::class, 'downloadAppointment'])
        ->name('appointments.download')
        ->middleware('signed');
});

// Routes d'authentification générées par Laravel UI
Auth::routes();

// Redirection de /home vers /admin
Route::get('/home', function() {
    return redirect('/admin');
});

Route::post('/newsletter', [App\Http\Controllers\NewsletterController::class, 'store'])->name('newsletter.store');