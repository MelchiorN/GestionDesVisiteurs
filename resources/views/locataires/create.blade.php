@extends('layouts.app')

@section('title', 'Ajouter un locataire')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-lg p-10 mt-10 relative">
    
    <!-- Titre centré -->
    <div class="text-center mb-10">
        <img src="https://cdn-icons-png.flaticon.com/512/987/987642.png" alt="Icon" class="w-14 h-14 mx-auto mb-2">
        <h1 class="text-3xl font-bold text-indigo-700">Ajouter un locataire</h1>
        <p class="text-sm text-gray-500">Formulaire d'enregistrement d'un nouveau locataire</p>
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
    <form method="POST" action="{{ route('locataires.store') }}" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @csrf

        <div>
            <label for="nom" class="block text-sm font-semibold text-gray-700 mb-1">Nom</label>
            <div class="relative">
                <input type="text" name="nom" id="nom" required
                    class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-indigo-500 focus:outline-none"
                    value="{{ old('nom') }}">
                <span class="absolute left-3 top-2.5 text-gray-400">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" class="w-5 h-5">
                </span>
            </div>
            @error('nom') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="prenom" class="block text-sm font-semibold text-gray-700 mb-1">Prénom</label>
            <div class="relative">
                <input type="text" name="prenom" id="prenom" required
                    class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-indigo-500 focus:outline-none"
                    value="{{ old('prenom') }}">
                <span class="absolute left-3 top-2.5 text-gray-400">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" class="w-5 h-5">
                </span>
            </div>
            @error('prenom') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
            <div class="relative">
                <input type="email" name="email" id="email" required
                    class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-indigo-500 focus:outline-none"
                    value="{{ old('email') }}">
                <span class="absolute left-3 top-2.5 text-gray-400">
                    <img src="https://cdn-icons-png.flaticon.com/512/3178/3178158.png" class="w-5 h-5">
                </span>
            </div>
            @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
         <div>
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Mot de passe</label>
            <div class="relative">
                <input type="password" name="password" id="password" required class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-indigo-500 focus:outline-none"
                    value="{{ old('password') }}">
            </div>
             @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <!-- Password Confirmation -->
        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1">Confirmer le mot de passe</label>
            <div class="relative">
                <input type="password" name="password_confirmation" id="password_confirmation" required  class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-indigo-500 focus:outline-none"
                    value="{{ old('password_confirmation') }}">
            </div>
             @error('password_confirmation') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="telephone" class="block text-sm font-semibold text-gray-700 mb-1">Téléphone</label>
            <div class="relative">
                <input type="text" name="telephone" id="telephone" required
                    class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-indigo-500 focus:outline-none"
                    value="{{ old('telephone') }}">
                <span class="absolute left-3 top-2.5 text-gray-400">
                    <img src="https://cdn-icons-png.flaticon.com/512/126/126341.png" class="w-5 h-5">
                </span>
            </div>
            @error('telephone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
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

        <div>
            <label for="numero_etage" class="block text-sm font-semibold text-gray-700 mb-1">Numéro d'étage</label>
            <div class="relative">
                <input type="text" name="numero_etage" id="numero_etage" required
                    class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-indigo-500 focus:outline-none"
                    value="{{ old('numero_etage') }}">
                <span class="absolute left-3 top-2.5 text-gray-400">
                    <img src="https://cdn-icons-png.flaticon.com/512/619/619032.png" class="w-5 h-5">
                </span>
            </div>
            @error('numero_etage') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="numero_chambre" class="block text-sm font-semibold text-gray-700 mb-1">Numéro de chambre</label>
            <div class="relative">
                <input type="text" name="numero_chambre" id="numero_chambre" required
                    class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-indigo-500 focus:outline-none"
                    value="{{ old('numero_chambre') }}">
                <span class="absolute left-3 top-2.5 text-gray-400">
                    <img src="https://cdn-icons-png.flaticon.com/512/619/619032.png" class="w-5 h-5">
                </span>
            </div>
            @error('numero_chambre') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <!-- Champ Photo -->
        <div class="md:col-span-2">
            <label for="photo" class="block text-sm font-semibold text-gray-700 mb-1">Photo du locataire</label>
            <div class="relative">
                <input type="file" name="photo" id="photo" accept="image/*"
                    class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-indigo-500 focus:outline-none file:bg-indigo-100 file:border-none file:rounded file:px-3 file:py-1">
                <span class="absolute left-3 top-2.5 text-gray-400">
                    <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" class="w-5 h-5">
                </span>
            </div>
            @error('photo') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            <p class="mt-1 text-xs text-gray-500">Formats acceptés: JPG, PNG, JPEG. Taille max: 2MB</p>
        </div>

        <div class="md:col-span-2 flex justify-end mt-4">
            <button type="submit"
                    class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 shadow-lg transition duration-200">
                <img src="https://cdn-icons-png.flaticon.com/512/992/992651.png" alt="Enregistrer" class="w-5 h-5 inline mr-2 -mt-1">
                Enregistrer le locataire
            </button>
        </div>
    </form>
</div>
@endsection