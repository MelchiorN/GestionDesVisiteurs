<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

use App\Models\Visiteur;
use App\Models\Locataire;
use Illuminate\Http\Request;
use App\Notifications\NouveauVisiteurNotification;

class VisiteurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Visiteur::with(['locataire', 'user'])->orderBy('date', 'desc')->orderBy('heure_arrive', 'desc');
        // Filtre par statut
        if ($request->has('statut')) {
            if ($request->statut === 'present') {
                $query->whereNull('heure_depart');
            } elseif ($request->statut === 'parti') {
                $query->whereNotNull('heure_depart');
            }
        }
        $visiteurs = $query->paginate(10);
        return view('visiteurs.index', [
            'visiteurs' => $visiteurs,
            'statutSelectionne' => $request->statut ?? 'tous'
        ]);
        $visiteur = Visiteur::findOrFail($notification->data['visiteur_id']);

    }
    public function dashboard()
    {
        $visiteurs= Visiteur::with(['user','locataire'])->get();
        return view('visiteurs.filtre',compact('visiteurs')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $locataires=Locataire::all();
        return view('visiteurs.create',compact('locataires'));
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'type_carte'=>'required',
            'numero_carte'=>'required',
            'photo_carte'=>'required',
            'nom'=>'required',
            'prenom'=>'required',
            'photo_visiteur'=>'nullable|image',
            'date'=>'required',
            'heure_arrive'=>'required',
            'motif'=>'required',
            'locataire_id'=>'required|exists:locataires,id',
        ]);
        $data ['user_id']=auth()->id();
        $data['heure_arrive'] = now()->format('H:i');
        if($request->hasFile('photo_visiteur')){
            $photoPath=$request->file('photo_visiteur')->store('visiteurs','public');
            $data['photo_visiteur']=$photoPath;
        }else{
            $data['photo_visiteur']=null;
        }
        
        $visiteur=Visiteur::create($data);
        $locataire = \App\Models\Locataire::find($visiteur->locataire_id);
        $locataire->notify(new NouveauVisiteurNotification($visiteur));
        return redirect()->route('visiteurs.create')->with('success','Visiteur enrégistré avec succès');
         
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Visiteur $visiteur)
    {
        $locataires=Locataire::all();
        return view('visiteurs.edit',compact('visiteur','locataires'));
        
        //
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Visiteur $visiteur)
    {
        $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'type_carte' => 'required|string',
            'numero_carte' => 'required|string',
            'motif' => 'required|string',
            'date' => 'required|date',
            'heure_arrive' => 'required',
            'photo_carte' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'photo_visiteur' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'locataire_id' => 'required|exists:locataires,id',
        ]);

        if ($request->hasFile('photo_carte')) {
            $visiteur->photo_carte = $request->file('photo_carte')->store('cartes', 'public');
        }

        if ($request->hasFile('photo_visiteur')) {
            $visiteur->photo_visiteur = $request->file('photo_visiteur')->store('visiteurs', 'public');
        }

        $visiteur->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'type_carte' => $request->type_carte,
            'numero_carte' => $request->numero_carte,
            'motif' => $request->motif,
            'date' => $request->date,
            'heure_arrive' => $request->heure_arrive,
            'locataire_id' => $request->locataire_id,
            'user_id' => auth()->id(),
            'photo_carte' => $visiteur->photo_carte,
            'photo_visiteur' => $visiteur->photo_visiteur,
        ]);

        return redirect()->route('visiteurs.filtre')->with('success', 'Visiteur mis à jour avec succès.');
    }

    public function showPhoto(Visiteur $visiteur)
    {
        return view('visiteurs.photo', compact('visiteur'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Visiteur $visiteur )
    {
        $visiteur->delete();
        return redirect()->route('visiteurs.index')->with('succes','visiteur supprimé avec succès');
        //
    }

    
    public function presents()
    {
       $visiteurs = Visiteur::with(['locataire', 'user'])->whereNull('heure_depart')->latest()->get();
       return view('visiteurs.presents', compact('visiteurs'));    
    }

    public function enregisterDepart(Visiteur $visiteur)
    {
        $visiteur->update([
            'heure_depart'=>now()->format('H:i'),
        ]);
        return redirect()->route('visiteurs.presents')->with('succes','Heure de départ enrégitrée');

    }
    
    

}
