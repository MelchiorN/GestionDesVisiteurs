@extends('layouts.app')

@section('title', 'Modifier Locataire')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-xl shadow-md p-6 mt-10">
    <h1 class="text-2xl font-bold text-indigo-700 mb-6">Modifier le locataire</h1>

    <form method="POST" action="{{ route('locataires.update', $locataire->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Champ Nom -->
            <div>
                <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                <input type="text" name="nom" id="nom" value="{{ old('nom', $locataire->nom) }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                @error('nom') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Champ Prénom -->
            <div>
                <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom</label>
                <input type="text" name="prenom" id="prenom" value="{{ old('prenom', $locataire->prenom) }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                @error('prenom') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Champ Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $locataire->email) }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Champ Téléphone -->
            <div>
                <label for="telephone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                <input type="text" name="telephone" id="telephone" value="{{ old('telephone', $locataire->telephone) }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                @error('telephone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <!-- Champ Type de résident -->
    <div>
        <label for="type_resident" class="block text-sm font-semibold text-gray-700 mb-1">Type de résident</label>
        <div class="relative">
            <select name="type_resident" id="type_resident" required
                    class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-indigo-500 focus:outline-none">
                <option value="locataire" {{ old('type_resident') == 'locataire' ? 'selected' : '' }}>Locataire</option>
                <option value="proprietaire" {{ old('type_resident') == 'proprietaire' ? 'selected' : '' }}>Propriétaire</option>
            </select>
            <span class="absolute left-3 top-2.5 text-gray-400">
                <img src="https://cdn-icons-png.flaticon.com/512/565/565547.png" class="w-5 h-5">
            </span>
        </div>
        @error('type_resident') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

            <!-- Champ Numéro d'étage -->
            <div>
                <label for="numero_etage" class="block text-sm font-medium text-gray-700">Étage</label>
                <input type="text" name="numero_etage" id="numero_etage" value="{{ old('numero_etage', $locataire->numero_etage) }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                @error('numero_etage') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Champ Numéro de chambre -->
            <div>
                <label for="numero_chambre" class="block text-sm font-medium text-gray-700">Chambre</label>
                <input type="text" name="numero_chambre" id="numero_chambre" value="{{ old('numero_chambre', $locataire->numero_chambre) }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                @error('numero_chambre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Champ Photo - Nouveau champ ajouté -->
        <div class="mt-6">
            <label for="photo" class="block text-sm font-medium text-gray-700">Photo du locataire</label>
            
            <!-- Afficher la photo actuelle si elle existe -->
            @if($locataire->photo)
                <div class="mt-2 mb-4">
                    <img src="{{ asset('storage/' . $locataire->photo) }}" alt="Photo actuelle" class="h-20 w-20 rounded-full object-cover">
                    <p class="text-xs text-gray-500 mt-1">Photo actuelle</p>
                </div>
            @endif
            
            <input type="file" name="photo" id="photo" 
                   class="mt-1 block w-full text-sm text-gray-500
                          file:mr-4 file:py-2 file:px-4
                          file:rounded-md file:border-0
                          file:text-sm file:font-semibold
                          file:bg-indigo-50 file:text-indigo-700
                          hover:file:bg-indigo-100">
            @error('photo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            <p class="text-xs text-gray-500 mt-1">Formats acceptés: jpg, png, jpeg. Taille max: 2MB</p>
        </div>

        <div class="mt-8 flex justify-end">
            <a href="{{ route('locataires.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md mr-2 hover:bg-gray-600">
                Annuler
            </a>
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                Enregistrer les modifications
            </button>
        </div>
    </form>
</div>
@endsection