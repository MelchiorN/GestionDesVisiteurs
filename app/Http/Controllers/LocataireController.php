<?php

namespace App\Http\Controllers;

use App\Models\Locataire;
use App\Models\Visiteur;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Http\Request;
// use Illuminate\Http\Controllers\Storage;
use Illuminate\Support\Facades\Storage;
use App\Models\Notification as NotificationModel;
use Illuminate\Support\Facades\DB;

class LocataireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locataires=Locataire::all();
        return view('locataires.index', compact('locataires'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('locataires.create');
        
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)

    {
        $validated=$request->validate(
            [
                'nom'=>'required',
                'prenom'=>'required',
                'email'=>'required|email',
                'type_resident'=>'required',
                'telephone'=>'required',
                'numero_etage'=>'required',
                'numero_chambre'=>'required',
                'photo'=>'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'password'=>'required|string|min:8|confirmed',      
            ] );
        //Traitement de la photo
        if($request->hasFile('photo')){
            $photoPath=$request->file('photo')->store('locataires','public');
            $validated['photo']=$photoPath;
        }else{
            $validated['photo']=null;
        }
           
        // Locataire::create($data);
        $locataire = Locataire::create([
        'nom' => $validated['nom'],
        'prenom' => $validated['prenom'],
        'telephone' => $validated['telephone'],
        'email' => $validated['email'],
        'type_resident' => $validated['type_resident'],
        'numero_etage' => $validated['numero_etage'],
        'numero_chambre' => $validated['numero_chambre'],
        'photo' => $validated['photo'],
        ]);
         
        User::create([
        'nom' => $validated['nom'],
        'prenom' => $validated['prenom'],
        'telephone' => $validated['telephone'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'role' => 'locataire',
    ]);


        return redirect()->route('locataires.create')->with("succes",'Locataire enrégistrer avec succès');
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $locataire=Locataire::with('visiteurs')->findOrFail($id);
        // dd($locataire);
        return view('locataires.show',compact('locataire'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $locataire = Locataire::findOrFail($id);
        return view('locataires.edit', ['locataire' => $locataire]);
        //
        // return view('locataires.edit');
    }

    /**
     * Update the specified resource in storage.
     */
   

public function update(Request $request, Locataire $locataire)
{
    $validated = $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'email' => 'required|email|unique:locataires,email,'.$locataire->id,
        'telephone' => 'required|string|max:20',
        'type_resident' => 'required',
        'numero_etage' => 'required|string|max:10',
        'numero_chambre' => 'required|string|max:10',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Gestion de la photo
    if ($request->hasFile('photo')) {
        // Supprimer l'ancienne photo si elle existe
        if ($locataire->photo && Storage::exists('public/'.$locataire->photo)) {
            Storage::delete('public/'.$locataire->photo);
        }
        
        // Enregistrer la nouvelle photo
        $path = $request->file('photo')->store('locataires', 'public');
        $validated['photo'] = $path;
    } else {
        // Conserver l'ancienne photo si aucune nouvelle n'est uploadée
        $validated['photo'] = $locataire->photo;
    }

    $locataire->update($validated);

    return redirect()->route('locataires.index')
        ->with('success', 'Locataire mis à jour avec succès');
}

    public function showPhoto(Locataire $locataire)
        {
            return view('locataires.photoresident', compact('locataire'));
        }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Locataire $locataire)
    {
        $locataire->delete();
        return redirect()->route('locataires.index')->with('succes','Locataire supprimé avec succes');
        //
    }

    public function dashboard()
{
    $user = auth()->user();

    // visiteurs du locataire connecté
    $visiteurs = \App\Models\Visiteur::where('locataire_id', $user->id)
        ->when(request('search'), fn($q) =>
            $q->where(function($query){
                $query->where('nom', 'like', '%' . request('search') . '%')
                      ->orWhere('prenom', 'like', '%' . request('search') . '%');
            })
        )
        ->when(request('filtre'), function ($q) {
            $filtre = request('filtre');
            if ($filtre == 'jour') {
                $q->whereDate('date', now());
            } elseif ($filtre == 'semaine') {
                $q->whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()]);
            } elseif ($filtre == 'mois') {
                $q->whereMonth('date', now()->month);
            } elseif ($filtre == 'annee') {
                $q->whereYear('date', now()->year);
            }
        })
        ->latest()
        ->paginate(10);

    // notifications (si tu en as)
    // $notifications = \App\Models\Notification::where('user_id', $user->id)->latest()->take(5)->get();

    return view('locataires.dashboard', compact('visiteurs'));
}

    public function infoProfil(){
        $user = Auth::user();

    // Récupérer le locataire lié à l'utilisateur connecté via l'email (si pas de user_id)
    $locataire = Locataire::where('email', $user->email)->first();

    if (!$locataire) {
        // Par exemple, rediriger ou afficher message si aucun locataire trouvé
        return redirect()->route('home')->withErrors('Locataire non trouvé.');
    }

    return view('locataires.profil', compact('user', 'locataire'));
    }
    public function infoVisite(){
        $user= Auth::user();
        $locataire=Locataire::where('email',$user->email)->first();
        $visiteur=$locataire->visiteurs()->get();
        return view('locataires.visite',compact('locataire','visiteur'));
    }
    public function infoNotif(){
        $user=Auth::user();
        $locataire=Locataire::where('email',$user->email)->first();
        $visiteur=$locataire->visiteurs()->get();
        $notifications = $locataire->unreadNotifications()->latest()->paginate(10);
        return view('locataires.notif',compact('locataire','visiteur','notifications','user'));
    }
    public function reponse(Request $request, $notificationId,){
        $user=Auth::user();
        $locataire=Locataire::where('email',$user->email)->first();
        $notification = NotificationModel::findOrFail($notificationId);

    // Convertir en tableau pour manipuler plus facilement
    $data = is_array($notification->data) ? $notification->data : json_decode($notification->data, true);

    // Récupérer le visiteur via le tableau $data
    $visiteur = Visiteur::findOrFail($data['visiteur_id']);

    DB::transaction(function () use ($request, $notification, $visiteur, $data) {
        // Marquer la notification comme lue
        $notification->read_at = now();
        $notification->save();

        // Mettre à jour les données
        $data['action'] = $request->action;
        $data['message'] = $request->message;
        $data['processed_at'] = now()->toDateTimeString();

        $notification->data = $data;
        $notification->save();

        // Mettre à jour le statut du visiteur selon l'action
        if ($request->action === 'accept') {
            $visiteur->statut = 'Présent';
        } elseif ($request->action === 'refuse') {
            $visiteur->statut = 'Parti';
            $visiteur->heure_depart=now()->format('H:i');
        } else {
            $visiteur->statut = 'Banni';
            $visiteur->heure_depart=now()->format('H:i');
        }
        $visiteur->save();
    });

    return redirect()->back()->with('success', 'Action enregistrée avec succès');

    }
    public function editer(Locataire $locataire)
    {
        $user=Auth::user();
        $locataire=Locataire::where('email',$user-> email)-> first();
      
        return view('locataires.modif', ['locataire' => $locataire]);
        //
        // return view('locataires.edit');
    }
    public function miseAjour(Request $request){
        $user=Auth::user();
        $locataire=Locataire::where('email',$user->email)->first();
         $validated = $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'email' => 'required|email|unique:locataires,email,'.$locataire->id,
        'telephone' => 'required|string|max:20',
        'type_resident' => 'required',
        'numero_etage' => 'required|string|max:10',
        'numero_chambre' => 'required|string|max:10',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Gestion de la photo
    if ($request->hasFile('photo')) {
        // Supprimer l'ancienne photo si elle existe
        if ($locataire->photo && Storage::exists('public/'.$locataire->photo)) {
            Storage::delete('public/'.$locataire->photo);
        }
        
        // Enregistrer la nouvelle photo
        $path = $request->file('photo')->store('locataires', 'public');
        $validated['photo'] = $path;
    } else {
        // Conserver l'ancienne photo si aucune nouvelle n'est uploadée
        $validated['photo'] = $locataire->photo;
    }
    dd($validated);

    $locataire->update($validated);
    
    // //Mise a jour du user
    // $user->update([
    //     'nom' => $validated['nom'],
    //     'prenom' => $validated['prenom'],
    //     'email' => $validated['email'],
    //     'telephone' => $validated['telephone'],
    // ]);

    return redirect()->route('profil')
        ->with('success', 'Profilmis à jour avec succès');;
        
    }





    

    

}
