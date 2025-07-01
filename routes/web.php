<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\VisiteurController;
use App\Http\Controllers\LocataireController;
use App\Models\Visiteur;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\DashboardController;

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
 
//Route Agent
Route::middleware(['auth', 'role:agent'])->group(function () {
     Route::get('/dashboard', function() { return view('dashboard.dashboard'); })->name('dashboard');     
   

     // Gestion des visiteurs
    Route::get('/visiteurs/create',[VisiteurController::class,'create'])->name('visiteurs.create');
    Route::post('/visiteurs/create',[VisiteurController::class,'store'])->name('visiteurs.store');
    Route::get('/visiteurs/index', [VisiteurController::class, 'index']) ->name('visiteurs.index');  
    Route::get('/visiteurs/presents', [VisiteurController::class, 'presents'])->name('visiteurs.presents');
    //Route pour supprimer un visiteur
    Route::delete('/visiteurs/{visiteur}',[VisiteurController::class,'destroy'])->name('visiteurs.destroy');
    //Mettre a jour les infos d'un visiteur 
    Route::get('/visiteurs/{visiteur}/edit', [VisiteurController::class, 'edit'])->name('visiteurs.edit');
    Route::put('/visiteurs/{visiteur}', [VisiteurController::class, 'update'])->name('visiteurs.update');
     //Route pour afficher photo du visiteur
     Route::get('/visiteurs/{visiteur}/photo', [VisiteurController::class, 'showPhoto'])->name('visiteurs.photo');
    // Enregistrement du départ d'un visiteur
    Route::post('/visiteurs/{visiteur}/depart', [VisiteurController::class, 'enregisterDepart'])->name('visiteurs.depart');
    //Enregistrement des locataires de l'immeuble
    Route::get('/locataires/create',[LocataireController::class,'create'])->name('locataires.create');
    Route::post('/locataires',[LocataireController::class,'store'])->name('locataires.store');
    // Route affichage des locataires
    Route::get('/locataires/index',[LocataireController::class,'index'])->name('locataires.index');
    //supprimer un locataire
    Route::delete('/locataires/{destroy}',[LocataireController::class,'destroy'])->name('locataires.destroy');
    // Modifier informations locataire
    Route::get('/locataires/{locataire}/edit', [LocataireController::class, 'edit'])->name('locataires.edit');
    Route::put('/locataires/{locataire}', [LocataireController::class, 'update'])->name('locataires.update');
//     Afficher photo resident
    Route::get('/locataires/{locataire}/photo', [LocataireController::class, 'showPhoto'])->name('locataires.photo');
    // Affiche informations d'un resident 
    Route::get('/locataires/{locataire}',[LocataireController::class,'show'])->name('locataires.show');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');


    
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/action', [NotificationController::class, 'action'])->name('notifications.action');
    Route::get('/locataires/{locataire}/notifications', [NotificationController::class, 'index'])->name('locataires.notifications');       
    Route::post('/notifications/{notification}/action', [NotificationController::class, 'action'])->name('notifications.action');
    Route::get('/statistiques', [App\Http\Controllers\StatistiqueController::class, 'index'])->name('statistiques.index');

});

Route::middleware(['auth', 'role:locataire'])->group(function () {
    Route::get('/locataire/dashboard', [LocataireController::class, 'dashboard'])->name('locataire.dashboard');
    Route::get('/locataire/visiteurs', [VisiteurController::class, 'index'])->name('locataires.visiteurs');
});

    

    
    
