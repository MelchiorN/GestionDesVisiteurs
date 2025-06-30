@extends('layouts.app')

@section('title','Affichage des locataires')

@section('content')
<div class="max-w-6xl mx-auto mt-10 bg-white p-10 rounded-2xl shadow-xl">
    <h1 class="text-3xl font-bold text-indigo-700 mb-8 text-center">Liste des Résidents</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full border-separate border-spacing-y-2 text-sm">
            <thead>
                <tr class="text-gray-800 text-left font-semibold">
                    <th class="bg-indigo-100 px-4 py-3 rounded-l-xl">Photo</th>
                    <th class="bg-indigo-100 px-4 py-3">Nom</th>
                    <th class="bg-indigo-100 px-4 py-3">Prénom</th>
                    <th class="bg-indigo-100 px-4 py-3">Email</th>
                    <th class="bg-indigo-100 px-4 py-3">Téléphone</th>
                    <th class="bg-indigo-100 px-4 py-3">Personnalité</th>
                    <th class="bg-indigo-100 px-4 py-3">Étage</th>
                    <th class="bg-indigo-100 px-4 py-3">Chambre</th>
                    <th class="bg-indigo-100 px-4 py-3 text-center">Notifications</th>
                    <th class="bg-indigo-100 px-4 py-3 rounded-r-xl text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse($locataires as $locataire)
                    <tr class="hover:bg-gray-50 transition">
                        <!-- Colonne Photo -->
                        <td class="bg-white px-4 py-3 rounded-l-xl border border-gray-200">
                            <div class="flex justify-center">
                                @if($locataire->photo)
                                     <a href="{{ route('locataires.photo', $locataire->id) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $locataire->photo) }}"
                                         alt="Photo resident"
                                         class="w-10 h-10 rounded-full mx-auto object-cover hover:scale-105 transition duration-200">
                                        </a>
                                @else
                                    <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        </td>
                        
                        <!-- Colonnes existantes -->
                        <td class="bg-gray-50 px-4 py-3 border border-gray-200">{{ $locataire->nom }}</td>
                        <td class="bg-white px-4 py-3 border border-gray-200">{{ $locataire->prenom }}</td>
                        <td class="bg-gray-50 px-4 py-3 border border-gray-200">{{ $locataire->email }}</td>
                        <td class="bg-white px-4 py-3 border border-gray-200">{{ $locataire->telephone }}</td>
                        <td class="bg-white px-4 py-3 border border-gray-200">{{ $locataire->type_resident }}</td>
                        <td class="bg-gray-50 px-4 py-3 text-center border border-gray-200">{{ $locataire->numero_etage }}</td>
                        <td class="bg-white px-4 py-3 text-center border border-gray-200">{{ $locataire->numero_chambre }}</td>
                        
                        <!-- Notifications -->
                        <td class="bg-gray-50 px-4 py-3 text-center border border-gray-200">
                            <a href="{{ route('locataires.notifications', $locataire->id) }}" class="relative inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                </svg>
                                @if($locataire->unreadNotifications->count() > 0)
                                    <span class="absolute -top-1 -right-1 bg-red-600 text-white rounded-full text-xs px-1.5">
                                        {{ $locataire->unreadNotifications->count() }}
                                    </span>
                                @endif
                            </a>
                        </td>
                        
                        <!-- Actions -->
                        <td class="bg-white px-4 py-3 text-center rounded-r-xl border border-gray-200">
                            <div class="flex flex-col space-y-2 sm:flex-row sm:space-y-0 sm:space-x-2 justify-center">
                                <a href="{{ route('locataires.show', $locataire->id) }}"
                                   class="bg-indigo-600 text-white px-3 py-1 rounded hover:bg-indigo-700 transition text-sm">
                                    Voir
                                </a>
                                <a href="{{ route('locataires.edit', $locataire->id) }}" 
                                   class="bg-purple-400 text-white px-3 py-1 rounded hover:bg-purple-600 text-sm">
                                    Modifier
                                </a>
                                <form action="{{ route('locataires.destroy', $locataire->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-400 hover:text-red-600 text-sm"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce locataire ?')">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center py-4 text-gray-500 bg-gray-100 rounded">
                            Aucun locataire trouvé.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection