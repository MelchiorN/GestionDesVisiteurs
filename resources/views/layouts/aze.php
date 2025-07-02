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

});

// Route gestion superadmin
Route::middleware(['auth','role: admin'])->group(function(){
    Route::get('/dashboard',[AdminController::class, 'accueil'])->name('accueil');
    

});