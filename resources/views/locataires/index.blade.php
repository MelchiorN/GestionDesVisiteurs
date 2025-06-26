@extends('layouts.app')

@section('title','Affichage des locataires')

@section('content')
<div class="max-w-6xl mx-auto mt-10 bg-white p-10 rounded-2xl shadow-xl">
    <h1 class="text-3xl font-bold text-indigo-700 mb-8 text-center">Liste des locataires</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full border-separate border-spacing-y-2 text-sm">
            <thead>
                <tr class="text-gray-800 text-left font-semibold">
                    <th class="bg-indigo-100 px-4 py-3 rounded-l-xl">Nom</th>
                    <th class="bg-indigo-100 px-4 py-3">Prénom</th>
                    <th class="bg-indigo-100 px-4 py-3">Email</th>
                    <th class="bg-indigo-100 px-4 py-3">Téléphone</th>
                    <th class="bg-indigo-100 px-4 py-3">Étage</th>
                    <th class="bg-indigo-100 px-4 py-3">Chambre</th>
                    <th class="bg-indigo-100 px-4 py-3 rounded-r-xl text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse($locataires as $locataire)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="bg-white px-4 py-3 rounded-l-xl border border-gray-200">{{ $locataire->nom }}</td>
                        <td class="bg-gray-50 px-4 py-3 border border-gray-200">{{ $locataire->prenom }}</td>
                        <td class="bg-white px-4 py-3 border border-gray-200">{{ $locataire->email }}</td>
                        <td class="bg-gray-50 px-4 py-3 border border-gray-200">{{ $locataire->telephone }}</td>
                        <td class="bg-white px-4 py-3 text-center border border-gray-200">{{ $locataire->numero_etage }}</td>
                        <td class="bg-gray-50 px-4 py-3 text-center border border-gray-200">{{ $locataire->numero_chambre }}</td>
                        <td class="bg-white px-4 py-3 text-center rounded-r-xl border border-gray-200">
                            <a href="{{ route('locataires.show', $locataire->id) }}"
                               class="bg-indigo-600 text-white px-3 py-1 rounded hover:bg-indigo-700 transition duration-200">
                                Voir
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-gray-500 bg-gray-100 rounded">
                            Aucun locataire trouvé.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
