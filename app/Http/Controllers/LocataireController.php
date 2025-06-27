<?php

namespace App\Http\Controllers;

use App\Models\Locataire;
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
        $data=$request->validate(
            [
                'nom'=>'required',
                'prenom'=>'required',
                'email'=>'required',
                'telephone'=>'required',
                'numero_etage'=>'required',
                'numero_chambre'=>'required',
                'photo'=>'required',
            ]
            );
        Locataire::create($data);
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
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Locataire $locataire)
    {
        $locataire->delete();
        return redirect()->route('locataires.index')->with('succes','Locataire supprimé avec succes');
        //
    }
}
