<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visiteur;
use App\Models\Locataire;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function accueil(){
        return view('admin.acceuil');
    }
    public function afficheParametre(){
        return view('admin.reglage');
    }
     public function updateParametre(){

     }
    
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
        return view('admin.index', [
            'visiteurs' => $visiteurs,
            'statutSelectionne' => $request->statut ?? 'tous'
        ]);
        

    }
    public function infoResident(){
        $locataires=Locataire::all();
        return view('admin.infoResident',compact('locataires'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.creerResident');
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


        return redirect()->route('admin.create.resident')->with("succes",'Locataire enrégistrer avec succès');
        //
    }

    //Afficher formulaire cration agent
    public function formAgent(){
        return view('admin.agent.creerAgent');
    }
    //Valider les donnees et creer
    public function storeAgent(Request $request){
        $validated=$request->validate([
            'nom'=>'required|string',
            'prenom'=>'required|string',
            'email'=>'required|email',
            'telephone'=>'required',
            'password'=>'required',
            
        ]);
        User::create([
            'nom'=>$validated['nom'],
            'prenom'=>$validated['prenom'],
            'email'=>$validated['email'],
            'telephone'=>$validated['telephone'],
            'password'=>Hash::make($validated['password']),
            'role'=>'agent',
        ]);
        return redirect()->route('admin.form.agent')->with('succes','Agent enrégistrer avec succes');

    }
    //Aficher Liste des agents
    public function indexAgent(){
        $agents=User::where('role','agent')->get();
        return view('admin.agent.listeAgent',compact('agents'));
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
    public function stat(){
        return view('');
    }
}
