@extends('layouts.app')

@section('title', 'Détails du locataire')

@section('content')
<div class="max-w-5xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden mt-10">
    <!-- En-tête -->
    <div class="bg-indigo-700 px-6 py-4 flex items-center justify-between">
        <h1 class="text-3xl font-bold text-white">Détails du résident</h1>
        <a href="{{ route('locataires.index') }}"
           class="text-sm bg-white text-indigo-700 px-4 py-2 rounded hover:bg-gray-100 transition">
            Retour à la liste
        </a>
    </div>

    <!-- Corps -->
    <div class="p-6 space-y-10">
        <!-- Informations personnelles -->
        <section>
            <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-1">🧑 Informations personnelles</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="text-gray-700 space-y-2">
                    <p><span class="font-semibold">Nom :</span> {{ $locataire->nom }}</p>
                    <p><span class="font-semibold">Prénom :</span> {{ $locataire->prenom }}</p>
                    <p>
                        <span class="font-semibold">Email :</span>
                        <a href="mailto:{{ $locataire->email }}" class="text-indigo-600 hover:underline">
                            {{ $locataire->email }}
                        </a>
                    </p>
                    <p>
                        <span class="font-semibold">Téléphone :</span>
                        <a href="tel:{{ $locataire->telephone }}" class="text-indigo-600 hover:underline">
                            {{ $locataire->telephone }}
                        </a>
                    </p>
                </div>
                <div class="text-gray-700 space-y-2">
                    <h2 class="text-lg font-semibold mb-3">🏠 Informations logement</h2>
                    <p><span class="font-semibold">Chambre :</span> Étage {{ $locataire->numero_etage }} - Chambre {{ $locataire->numero_chambre }}</p>
                    <!-- Ajoutez ici d'autres infos si besoin -->
                </div>
            </div>
        </section>

        <!-- Liste des visiteurs -->
        <section>
            <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-1">👥 Visiteurs enregistrés</h2>
            @if($locataire->visiteurs->isEmpty())
                <div class="bg-blue-100 text-blue-800 px-4 py-3 rounded shadow-sm">
                    Aucun visiteur enregistré pour ce locataire.
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left font-semibold text-gray-600 uppercase">Nom</th>
                                <th class="px-6 py-3 text-left font-semibold text-gray-600 uppercase">Prénom</th>
                                <th class="px-6 py-3 text-left font-semibold text-gray-600 uppercase">Date</th>
                                <th class="px-6 py-3 text-left font-semibold text-gray-600 uppercase">Motif</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach($locataire->visiteurs as $visiteur)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">{{ $visiteur->nom }}</td>
                                <td class="px-6 py-4">{{ $visiteur->prenom }}</td>
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($visiteur->date)->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4">{{ $visiteur->motif }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>
    </div>
</div>
@endsection
