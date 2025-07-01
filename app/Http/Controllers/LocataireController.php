<?php

namespace App\Http\Controllers;

use App\Models\Locataire;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

use Illuminate\Http\Request;
// use Illuminate\Http\Controllers\Storage;
use Illuminate\Support\Facades\Storage;

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

    

}
