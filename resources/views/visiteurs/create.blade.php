@extends('layouts.app')

@section('title', 'Ajouter un visiteur')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-lg p-10 mt-10 relative">
    
    <!-- Titre centré -->
    <div class="text-center mb-10">
        <img src="https://cdn-icons-png.flaticon.com/512/747/747376.png" alt="Icon" class="w-14 h-14 mx-auto mb-2">
        <h1 class="text-3xl font-bold text-indigo-700">Ajouter un visiteur</h1>
        <p class="text-sm text-gray-500">Formulaire d’enregistrement d’un nouveau visiteur</p>
    </div>

    <!-- Message d'erreurs -->
    @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg mb-6">
            <div class="flex">
                <img src="https://cdn-icons-png.flaticon.com/512/463/463612.png" alt="Erreur" class="w-5 h-5 mr-3 mt-1">
                <ul class="text-sm text-red-800 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Formulaire -->
    <form method="POST" action="{{ route('visiteurs.store') }}" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @csrf

        <div>
            <label for="cni" class="block text-sm font-semibold text-gray-700 mb-1">CNI</label>
            <div class="relative">
                <input type="text" name="cni" id="cni" required
                       class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-indigo-500 focus:outline-none"
                       value="{{ old('cni') }}">
                <span class="absolute left-3 top-2.5 text-gray-400">
                    <img src="https://cdn-icons-png.flaticon.com/512/3064/3064197.png" class="w-5 h-5">
                </span>
            </div>
        </div>

        <div>
            <label for="nom" class="block text-sm font-semibold text-gray-700 mb-1">Nom</label>
            <input type="text" name="nom" id="nom" required
                   class="w-full px-4 py-2 border rounded-lg focus:ring-indigo-500 focus:outline-none"
                   value="{{ old('nom') }}">
        </div>

        <div>
            <label for="prenom" class="block text-sm font-semibold text-gray-700 mb-1">Prénom</label>
            <input type="text" name="prenom" id="prenom" required
                   class="w-full px-4 py-2 border rounded-lg focus:ring-indigo-500 focus:outline-none"
                   value="{{ old('prenom') }}">
        </div>

        <div>
            <label for="date" class="block text-sm font-semibold text-gray-700 mb-1">Date</label>
            <input type="date" name="date" id="date" required
                   class="w-full px-4 py-2 border rounded-lg focus:ring-indigo-500 focus:outline-none"
                   value="{{ old('date') ?? now()->format('Y-m-d') }}">
        </div>

        <div>
            <label for="heure_arrive" class="block text-sm font-semibold text-gray-700 mb-1">Heure d'arrivée</label>
            <input type="time" name="heure_arrive" id="heure_arrive" required
                   class="w-full px-4 py-2 border rounded-lg focus:ring-indigo-500 focus:outline-none"
                   value="{{ old('heure_arrive') }}">
        </div>

        <div>
            <label for="motif" class="block text-sm font-semibold text-gray-700 mb-1">Motif de la visite</label>
            <input type="text" name="motif" id="motif" required
                   class="w-full px-4 py-2 border rounded-lg focus:ring-indigo-500 focus:outline-none"
                   value="{{ old('motif') }}">
        </div>
         <div class="md:col-span-2">
            <label for="fichier" class="block text-sm font-semibold text-gray-700 mb-1">Fichier (optionnel)</label>
            <input type="file" name="fichier" id="fichier"
                class="w-full px-4 py-2 border rounded-lg focus:ring-indigo-500 focus:outline-none">
        </div>

        <!-- Locataire avec datalist -->
        <div class="md:col-span-2">
            <label for="locataire_nom" class="block text-sm font-semibold text-gray-700 mb-1">Locataire visité</label>
            <input list="locataires" id="locataire_nom" name="locataire_nom"
                   class="w-full px-4 py-2 border rounded-lg focus:ring-indigo-500 focus:outline-none"
                   value="{{ old('locataire_nom') }}" required>

            <datalist id="locataires">
                @foreach ($locataires as $locataire)
                    <option data-id="{{ $locataire->id }}"
                            value="{{ $locataire->nom }} {{ $locataire->prenom }} - Chambre {{ $locataire->numero_etage }}.{{ $locataire->numero_chambre }}">
                @endforeach
            </datalist>

            <!-- Champ caché pour l'ID -->
            <input type="hidden" name="locataire_id" id="locataire_id" value="{{ old('locataire_id') }}">
        </div>

        <div class="md:col-span-2 flex justify-end mt-4">
            <button type="submit"
                    class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 shadow-lg transition duration-200">
                <img src="https://cdn-icons-png.flaticon.com/512/992/992651.png" alt="Enregistrer" class="w-5 h-5 inline mr-2 -mt-1">
                Enregistrer le visiteur
            </button>
        </div>
    </form>
</div>

<!-- Scripts -->
<script>
    window.addEventListener('DOMContentLoaded', () => {
        // Auto-remplir l’heure d’arrivée
        const now = new Date();
        const heures = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        document.getElementById('heure_arrive').value = `${heures}:${minutes}`;
    });

    // Correspondance nom → ID locataire
    const datalist = document.getElementById('locataires');
    const inputNom = document.getElementById('locataire_nom');
    const inputId = document.getElementById('locataire_id');

    inputNom.addEventListener('change', () => {
        const options = datalist.options;
        inputId.value = ''; // reset
        for (let i = 0; i < options.length; i++) {
            if (options[i].value === inputNom.value) {
                inputId.value = options[i].dataset.id;
                break;
            }
        }
    });
</script>
@endsection
