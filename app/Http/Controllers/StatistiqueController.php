<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visiteur;

class StatistiqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    
    $visiteurs = Visiteur::latest()->get();

    $total = $visiteurs->count();
    $presents = $visiteurs->whereNull('heure_depart')->count();
    $partis = $visiteurs->where('heure_depart')->count();
    $bannis = $visiteurs->where('statut', 'Banni')->count();

    return view('statistique.index', [
        'visiteurs' => $visiteurs,
        'total' => $total,
        'presents' => $presents,
        'partis' => $partis,
        'bannis' => $bannis,
    ]);
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
