@extends('layouts.admin')

@section('title', 'Liste de tous visiteurs')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-indigo-700 mb-8 text-center">Liste des visiteurs</h1>

    <!-- Barre de recherche -->
    <div class="bg-indigo-50 p-6 rounded-lg shadow mb-6">
        <form method="GET" action="{{ route('visiteurs.index') }}" class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4">
            <!-- Sélecteur de statut -->
        <div>
            <label for="statut" class="block text-sm font-medium text-gray-700">Filtrer par statut :</label>
            <select name="statut" id="statut" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">Tous les visiteurs</option>
                <option value="present">Présents</option>
                <option value="vanni">Bannis</option>
                <option value="parti">Partis</option>
            </select>
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
                        <td class="px-4 py-3 border"> {{ $visiteur->nom }} {{ $visiteur->prenom }}</td>
                        <td class="px-4 py-3 border">{{ $visiteur->locataire->nom }} {{ $visiteur->locataire->prenom }}</td>
                        <td class="px-4 py-3 border">{{ $visiteur->date }}</td>
                        <td class="px-4 py-3 border">{{ $visiteur->motif }}</td>
                        <td class="px-4 py-3 border">{{ $visiteur->heure_arrive }}</td>
                        <td class="px-4 py-3 border ">{{ $visiteur->heure_depart ?? '-' }}</td>
                        <td class="px-4 py-3 border"><span class="bg-gray-100 text-red-900"> {{$visiteur->heure_depart ? $visiteur->statut : 'Présent'}}</span></td>
                                        <!-- Actions -->


                        <td class="px-4 py-3 border space-y-1">
                            <a href="{{ route('visiteurs.edit', $visiteur->id) }}"
                               class="inline-block bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500 transition text-xs">
                                <i class="fa fa-pencil" aria-hidden="true"></i> Modifier
                            </a>

                            <form action="{{ route('visiteurs.destroy', $visiteur->id) }}" method="POST"
                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce visiteur ?');" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition text-xs">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>Supprimer
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
