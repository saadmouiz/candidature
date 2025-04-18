<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BeneficiaireController;
use App\Http\Controllers\AdminController;
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
    Route::get('/admin/candidatures/{candidature}', [CandidatureController::class, 'show'])->name('candidature.show');
    Route::post('/admin/candidatures/{candidature}/accepter', [CandidatureController::class, 'accepter'])->name('candidature.accepter');
    Route::post('/admin/candidatures/{candidature}/refuser', [CandidatureController::class, 'refuser'])->name('candidature.refuser');
    
    // Gestion des bénéficiaires
    Route::get('/admin/beneficiaires', [BeneficiaireController::class, 'index'])->name('beneficiaire.index');
    Route::get('/admin/beneficiaires/{beneficiaire}', [BeneficiaireController::class, 'show'])->name('beneficiaire.show');
    

    
    // Éventuellement, ajoutez ces routes pour voir les candidatures acceptées et refusées
    Route::get('/admin/candidatures/acceptees', [CandidatureController::class, 'acceptees'])->name('candidature.acceptees');
   
    Route::get('/admin/candidatures/refusees', [CandidatureController::class, 'refusees'])->name('candidature.refusees');

});

// Routes d'authentification générées par Laravel UI
Auth::routes();

// Redirection de /home vers /admin
Route::get('/home', function() {
    return redirect('/admin');
});

Route::post('/newsletter', [App\Http\Controllers\NewsletterController::class, 'store'])->name('newsletter.store');