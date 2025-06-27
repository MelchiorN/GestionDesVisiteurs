<!-- resources/views/locataires/edit.blade.php -->
@extends('layouts.app')

@section('title', 'Modifier Locataire')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-xl shadow-md p-6 mt-10">
    <h1 class="text-2xl font-bold text-indigo-700 mb-6">Modifier le locataire</h1>

    <form method="POST" action="{{ route('locataires.update', $locataire->id) }}">
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