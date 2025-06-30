@extends('layouts.app')

@section('title', 'Filtrage des visiteurs')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-indigo-700 mb-8 text-center">Liste des visiteurs</h1>

    <!-- Barre de recherche -->
    <div class="bg-indigo-50 p-6 rounded-lg shadow mb-6">
        <form method="GET" action="{{ route('visiteurs.filtre') }}" class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4">
            <div class="flex-1">
                <label for="search" class="block text-sm font-medium text-gray-700">Rechercher un visiteur :</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Nom ou prénom du visiteur"
                    class="mt-1 block w-full pl-3 pr-12 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <button type="submit" class="mt-6 md:mt-0 bg-indigo-600 text-white px-5 py-2 rounded hover:bg-indigo-700 transition shadow">
                Rechercher
            </button>
        </form>
    </div>

    <!-- Tableau des visiteurs -->
    <div class="bg-white rounded-xl shadow overflow-x-auto">
        <table class="min-w-full border border-gray-300 divide-y divide-gray-200 text-sm text-gray-700">
            <thead class="bg-indigo-100 text-indigo-700 text-center">
                <tr>
                    <th class="px-4 py-3 border">Photo</th>
                    <th class="px-4 py-3 border">Visiteur</th>
                    <th class="px-4 py-3 border">Locataire</th>
                    <th class="px-4 py-3 border">Date</th>
                    <th class="px-4 py-3 border">Motif</th>
                    <th class="px-4 py-3 border">Arrivée</th>
                    <th class="px-4 py-3 border">Départ</th>
                    <th class="px-4 py-3 border">Statut</th>
                    <th class="px-4 py-3 border">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-gray-50 text-center">
                @forelse ($visiteurs as $visiteur)
                    <tr class="hover:bg-gray-100 transition">
                        <!-- Photo -->
                        <td class="px-4 py-3 border">
                            @if($visiteur->photo_visiteur)
                                <a href="{{ route('visiteurs.photo', $visiteur->id) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $visiteur->photo_visiteur) }}"
                                         alt="Photo visiteur"
                                         class="w-10 h-10 rounded-full mx-auto object-cover hover:scale-105 transition duration-200">
                                </a>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>

                        <!-- Infos -->
                        <td class="px-4 py-3 border">{{ $visiteur->nom }} {{ $visiteur->prenom }}</td>
                        <td class="px-4 py-3 border">{{ $visiteur->locataire->nom }} {{ $visiteur->locataire->prenom }}</td>
                        <td class="px-4 py-3 border">{{ $visiteur->date }}</td>
                        <td class="px-4 py-3 border">{{ $visiteur->motif }}</td>
                        <td class="px-4 py-3 border">{{ $visiteur->heure_arrive }}</td>
                        <td class="px-4 py-3 border ">{{ $visiteur->heure_depart ?? '-' }}</td>
                        <td class="px-4 py-3 border"><span class="bg-gray-100 text-red-900">{{$visiteur->statut}}</span></td>
                                        <!-- Actions -->
                        <td class="px-4 py-3 border space-y-1">
                            <a href="{{ route('visiteurs.edit', $visiteur->id) }}"
                               class="inline-block bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500 transition text-xs">
                                ✏️ Modifier
                            </a>

                            <form action="{{ route('visiteurs.destroy', $visiteur->id) }}" method="POST"
                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce visiteur ?');" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition text-xs">
                                    🗑 Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-6 py-6 text-gray-500">Aucun visiteur trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $visiteurs->appends(request()->query())->links() }}
    </div>
</div>
@endsection
