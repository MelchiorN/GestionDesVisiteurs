<?php

namespace App\Http\Controllers;

use App\Models\Locataire;
use Illuminate\Http\Request;

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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
