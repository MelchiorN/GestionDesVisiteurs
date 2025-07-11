<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\VisiteurController;
use App\Http\Controllers\LocataireController;
use App\Models\Visiteur;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;

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
     Route::get('/agent/dashboard', function() { return view('dashboard.dashboard'); })->name('agent.dashboard');     
   

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
    
    


    
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/action', [NotificationController::class, 'action'])->name('notifications.action');
    Route::get('/locataires/{locataire}/notifications', [NotificationController::class, 'index'])->name('locataires.notifications');       
    Route::get('/statistiques', [App\Http\Controllers\StatistiqueController::class, 'index'])->name('statistiques.index');

});

Route::middleware(['auth', 'role:locataire'])->group(function () {
    Route::get('/locataire/dashboard', [LocataireController::class, 'dashboard'])->name('locataire.dashboard');
    Route::get('/locataire/visiteurs', [VisiteurController::class, 'index'])->name('locataires.visiteurs');
    //Profil
    Route::get('resident/profil',[LocataireController::class,'infoProfil'])->name('profil');
    //Visiteur 
    Route::get('/visites',[LocataireController::class,'infoVisite'])->name('visite');
    //Notif each resident
    Route::get('/notification',[LocataireController::class,'infoNotif'])->name('notif.perso');
    //Confirmation de la notifiacation
    Route::post('/confirm/{notificationId}',[LocataireController::class,'reponse'])->name('notif.reponse');
    //Modif un resident
    Route::get('/profil/modifier',[LocataireController::class,'editer' ])->name('modif.resident');
    Route::put('/profil/modifier', [LocataireController::class, 'miseAjour'])->name('resident.update');

});

// Route gestion superadmin
Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::get('/admin/dash',[AdminController::class, 'accueil'])->name('admin.accueil');   
    Route::get('/admin/parametre',[AdminController::class,'afficheParametre'])->name('admin.parametre');
     // la mise à jour des paramètres de l'immeuble
    Route::put('/admin/parametre', [AdminController::class, 'updateParametre'])->name('admin.parametre.update');
    //Gestion Visiteurs
    Route::get('/admin/visiteurs',[AdminController::class,'index'])->name('admin.visiteurs');
    // Formulaire locataire
    Route::get('/admin/resident/form',[AdminController::class,'create'])->name('admin.create.resident');
    //Creer des locataires
    Route::post('/admin/store',[AdminController::class,'store'])->name('admin.store.resident');

    //Gestion Locataires
    Route::get('/admin/resident',[AdminController::class,'infoResident'])->name('admin.resident');
    //Statistique
    Route::get('/admin/stats',[AdminController::class,'stat'])->name('admin.statistique');
    //Créer un agent 
    Route::get('/admin/create',[AdminController::class,'formAgent'])->name('admin.form.agent');
    Route::post('/admin/create',[AdminController::class,'storeAgent'])->name('admin.store.agent');
    //Afficher tous les agents
    Route::get('/admin/liste/agent',[AdminController::class,'indexAgent'])->name('admin.liste.agent');
});


    

    
    
