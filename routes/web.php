<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\VisiteurController;
use App\Http\Controllers\LocataireController;
use App\Models\Visiteur;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Routes pour l'application de gestion des visiteurs
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Authentification
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function () {
    // Gestion des visiteurs
    // Route::resource('visiteurs', VisiteurController::class)->except(['show']);
    Route::get('/visiteurs/create',[VisiteurController::class,'create'])->name('visiteurs.create');
    Route::post('/visiteurs/create',[VisiteurController::class,'store'])->name('visiteurs.store');

    Route::get('/visiteurs/filtre', [VisiteurController::class, 'filtreVisiteurs']) ->name('visiteurs.filtre');  
    
    Route::get('/visiteurs/presents', [VisiteurController::class, 'presents'])->name('visiteurs.presents');
         
    // Enregistrement du départ d'un visiteur
    Route::post('/visiteurs/{visiteur}/depart', [VisiteurController::class, 'enregisterDepart'])
         ->name('visiteurs.depart');
    
    
});