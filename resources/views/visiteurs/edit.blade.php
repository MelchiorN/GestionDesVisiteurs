@extends('layouts.app')

@section('title', 'Modifier le visiteur')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-lg p-10 mt-10 relative">

    <h1 class="text-3xl font-bold text-center text-indigo-700 mb-8">Modifier le visiteur</h1>

    @if ($errors->any())
        <div class="bg-red-100 p-4 rounded mb-6">
            <ul class="text-sm text-red-800 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('visiteurs.update', $visiteur) }}" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block">Nom</label>
            <input type="text" name="nom" value="{{ old('nom', $visiteur->nom) }}" class="w-full px-4 py-2 border rounded-lg" required>
        </div>

        <div>
            <label class="block">Prénom</label>
            <input type="text" name="prenom" value="{{ old('prenom', $visiteur->prenom) }}" class="w-full px-4 py-2 border rounded-lg" required>
        </div>

        <div class="md:col-span-2">
            <label class="block">Photo du visiteur (laisser vide si inchangé)</label>
            <input type="file" name="photo_visiteur" class="w-full px-4 py-2 border rounded-lg">
        </div>

        <div>
            <label class="block">Type de carte</label>
            <select name="type_carte" class="w-full px-4 py-2 border rounded-lg" required>
                <option value="CNI" {{ $visiteur->type_carte == 'CNI' ? 'selected' : '' }}>CNI</option>
                <option value="Passeport" {{ $visiteur->type_carte == 'Passeport' ? 'selected' : '' }}>Passeport</option>
                <option value="Biométrique" {{ $visiteur->type_carte == 'Biométrique' ? 'selected' : '' }}>Biométrique</option>
                <option value="Autre" {{ $visiteur->type_carte == 'Autre' ? 'selected' : '' }}>Autre</option>
            </select>
        </div>

        <div>
            <label class="block">Numéro de carte</label>
            <input type="text" name="numero_carte" value="{{ old('numero_carte', $visiteur->numero_carte) }}" class="w-full px-4 py-2 border rounded-lg" required>
        </div>

        <div class="md:col-span-2">
            <label class="block">Photo de la carte (laisser vide si inchangé)</label>
            <input type="file" name="photo_carte" class="w-full px-4 py-2 border rounded-lg">
        </div>

        <div>
            <label class="block">Date</label>
            <input type="date" name="date" value="{{ old('date', $visiteur->date) }}" class="w-full px-4 py-2 border rounded-lg" required>
        </div>

        <div>
            <label class="block">Heure d'arrivée</label>
            <input type="time" name="heure_arrive" value="{{ old('heure_arrive', $visiteur->heure_arrive) }}" class="w-full px-4 py-2 border rounded-lg" required>
        </div>

        <div>
            <label class="block">Motif</label>
            <input type="text" name="motif" value="{{ old('motif', $visiteur->motif) }}" class="w-full px-4 py-2 border rounded-lg" required>
        </div>

        <div>
            <label class="block">Locataire visité</label>
            <select name="locataire_id" class="w-full px-4 py-2 border rounded-lg" required>
                @foreach ($locataires as $locataire)
                    <option value="{{ $locataire->id }}" {{ $locataire->id == $visiteur->locataire_id ? 'selected' : '' }}>
                        {{ $locataire->nom }} {{ $locataire->prenom }} - Chambre {{ $locataire->numero_etage }}.{{ $locataire->numero_chambre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="md:col-span-2 text-right">
            <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded hover:bg-indigo-700">
                Mettre à jour
            </button>
        </div>
    </form>
</div>
@endsection
