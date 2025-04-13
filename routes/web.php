<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BeneficiaireController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;

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
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/candidatures', [CandidatureController::class, 'index'])->name('candidature.index');
    Route::get('/admin/candidatures/{candidature}', [CandidatureController::class, 'show'])->name('candidature.show');
    Route::get('/admin/beneficiaires', [BeneficiaireController::class, 'index'])->name('beneficiaire.index');
    Route::get('/admin/beneficiaires/{beneficiaire}', [BeneficiaireController::class, 'show'])->name('beneficiaire.show');    Route::post('/admin/candidatures/{candidature}/accepter', [CandidatureController::class, 'accepter'])->name('candidature.accepter');
    Route::post('/admin/candidatures/{candidature}/refuser', [CandidatureController::class, 'refuser'])->name('candidature.refuser');
});

// Routes d'authentification générées par Laravel UI
Auth::routes();

// Redirection de /home vers /admin
Route::get('/home', function() {
    return redirect('/admin');
});