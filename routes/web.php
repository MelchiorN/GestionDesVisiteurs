<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\VisiteurController;
use App\Http\Controllers\LocataireController;
use App\Models\Visiteur;
use App\Http\Controllers\NotificationController;

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
    //Route pure supprimer un visiteur
    Route::delete('/visiteurs/{visiteur}',[VisiteurController::class,'destroy'])->name('visiteurs.destroy');
         
    // Enregistrement du départ d'un visiteur
    Route::post('/visiteurs/{visiteur}/depart', [VisiteurController::class, 'enregisterDepart'])
         ->name('visiteurs.depart');

    //Enregistrement des locataires de l'immeuble
    Route::get('/locataires/index',[LocataireController::class,'index'])->name('locataires.index');
    Route::get('/locataires/create',[LocataireController::class,'create'])->name('locataires.create');
    Route::post('/locataires',[LocataireController::class,'store'])->name('locataires.store');
    //supprimer un locataire
    Route::delete('/locataires/{destroy}',[LocataireController::class,'destroy'])->name('locataires.destroy');
    // Modifier informations locataire
    // Route::resource('locataires', LocataireController::class)->except(['create', 'store']);
    // OU spécifiquement
    Route::get('/locataires/{locataire}/edit', [LocataireController::class, 'edit'])->name('locataires.edit');
    Route::put('/locataires/{locataire}', [LocataireController::class, 'update'])->name('locataires.update');


    // Affiche informations d'un locateurs 
    Route::get('/locataires/{locataire}',[LocataireController::class,'show'])->name('locataires.show');

    
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{notification}/action', [NotificationController::class, 'action'])->name('notifications.action');


    Route::get('/locataires/{locataire}/notifications', [NotificationController::class, 'index'])
         ->name('locataires.notifications');
         
    Route::post('/notifications/{notification}/action', [NotificationController::class, 'action'])
         ->name('notifications.action');
});
    
    

    
    
