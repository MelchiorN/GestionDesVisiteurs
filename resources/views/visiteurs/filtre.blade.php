@extends('layouts.app')

@section('title', 'Filtrage des visiteurs')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Liste des visiteurs</h1>

    <!-- Barre de recherche et filtres -->
    <div class="bg-white p-4 rounded-lg shadow mb-6">
        <form method="GET" action="{{ route('visiteurs.filtre') }}" class="flex flex-col md:flex-row items-start md:items-center space-y-4 md:space-y-0 md:space-x-4">
            <!-- Barre de recherche -->
            <div class="flex-1">
                <label for="search" class="block text-sm font-medium text-gray-700">Rechercher un visiteur :</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <input type="text" name="search" id="search" 
                           value="{{ request('search') }}"
                           placeholder="Nom ou prénom du visiteur"
                           class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-3 pr-12 py-2 sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>
            
            <!-- Filtre statut -->
            <div>
                <label for="statut" class="block text-sm font-medium text-gray-700">Statut :</label>
                <select name="statut" id="statut"
                        class="mt-1 block pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                    <option value="tous" {{ request('statut') === 'tous' ? 'selected' : '' }}>Tous les visiteurs</option>
                    <option value="present" {{ request('statut') === 'present' ? 'selected' : '' }}>Visiteurs présents</option>
                    <option value="parti" {{ request('statut') === 'parti' ? 'selected' : '' }}>Visiteurs partis</option>
                </select>
            </div>
            
            <div class="flex items-end space-x-2">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Filtrer
                </button>
                <a href="{{ route('visiteurs.filtre') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
                    Réinitialiser
                </a>
            </div>
        </form>
    </div>

    <!-- Tableau des visiteurs -->
    <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-center font-medium text-gray-500 uppercase">Visiteur</th>
                    <th class="px-6 py-3 text-left text-center font-medium text-gray-500 uppercase">Locataire</th>
                    <th class="px-6 py-3 text-left text-center font-medium text-gray-500 uppercase">Date</th>
                    <th class="px-6 py-3 text-left text-center font-medium text-gray-500 uppercase">Motif</th>
                    <th class="px-6 py-3 text-left text-center font-medium text-gray-500 uppercase">Arrivée</th>
                    <th class="px-6 py-3 text-left text-center font-medium text-gray-500 uppercase">Départ</th>
                    <th class="px-6 py-3 text-left text-center font-medium text-gray-500 uppercase">Statut</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($visiteurs as $visiteur)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-center">{{ $visiteur->nom }} {{ $visiteur->prenom }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">{{ $visiteur->locataire->nom }} {{ $visiteur->locataire->prenom }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">{{ $visiteur->date }}</td>
                        <td class="px-6 py-4 whitespace-wrap text-center ">{{ $visiteur->motif }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">{{ $visiteur->heure_arrive }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            {{ $visiteur->heure_depart ? $visiteur->heure_depart : '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $visiteur->heure_depart ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                {{ $visiteur->heure_depart ? 'Parti' : 'En entente' }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">Aucun visiteur trouvé</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $visiteurs->appends(request()->query())->links() }}
    </div>
</div>
@endsection