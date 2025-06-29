<?php

namespace App\Http\Controllers;
use App\Models\Visiteur;
use App\Models\Locataire;
use Illuminate\Http\Request;
use App\Notifications\NouveauVisiteurNotification;

class VisiteurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $visiteurs= Visiteur::with(['user','locataire'])->get();
        return view('visiteurs.index',compact('visiteurs'));

        //
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
            'cni'=>'required',
            'nom'=>'required',
            'prenom'=>'required',
            'date'=>'required',
            'heure_arrive'=>'required',
            'motif'=>'required',
            'locataire_id'=>'required|exists:locataires,id',
        ]);
        $data ['user_id']=auth()->id();
        $data['heure_arrive'] = now()->format('H:i');
        
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
    public function update()
    {
        
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Visiteur $visiteur )
    {
        $visiteur->delete();
        return redirect()->route('visiteurs.filtre')->with('succes','visiteur supprimé avec succès');
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
    public function filtreVisiteurs(Request $request)
{
    $query = Visiteur::with(['locataire', 'user'])
                ->orderBy('date', 'desc')
                ->orderBy('heure_arrive', 'desc');

    // Filtre par statut
    if ($request->has('statut')) {
        if ($request->statut === 'present') {
            $query->whereNull('heure_depart');
        } elseif ($request->statut === 'parti') {
            $query->whereNotNull('heure_depart');
        }
    }

    $visiteurs = $query->paginate(10);

    return view('visiteurs.filtre', [
        'visiteurs' => $visiteurs,
        'statutSelectionne' => $request->statut ?? 'tous'
    ]);

    $visiteur = Visiteur::findOrFail($notification->data['visiteur_id']);

}

}
