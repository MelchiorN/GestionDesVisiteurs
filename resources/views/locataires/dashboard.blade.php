@extends('layouts.locataire')

@section('title', 'Tableau de bord - Locataire')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4">
    
    <!-- Message de bienvenue -->
    <div class="mb-6">
        <h2 class="text-3xl font-bold text-indigo-700">Bienvenue, {{ Auth::user()->prenom }} 👋</h2>
        <p class="text-gray-600 text-sm">Voici votre tableau de bord personnel.</p>
    </div>

    <!-- Informations et notifications -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Informations -->
        <div class="bg-white p-6 rounded-xl shadow border">
            <h3 class="text-lg font-bold text-gray-800 mb-3">Vos informations</h3>
            <p><strong>Nom :</strong> {{ Auth::user()->nom }} {{ Auth::user()->prenom }}</p>
            <p><strong>Email :</strong> {{ Auth::user()->email }}</p>
            <p><strong>Téléphone :</strong> {{ Auth::user()->telephone }}</p>
        </div>

        <!-- Notifications -->
        <div class="bg-white p-6 rounded-xl shadow border lg:col-span-2">
            <h3 class="text-lg font-bold text-gray-800 mb-3">Notifications</h3>
            <ul class="space-y-2 text-sm text-gray-700">
                <!-- Notifications à insérer ici -->
                <li class="text-gray-500 italic">Aucune notification pour le moment.</li>
            </ul>
        </div>
    </div>

    <!-- Filtres -->
    <div class="bg-white p-6 rounded-xl shadow border mb-6">
        <form method="GET" action="{{ route('locataires.visiteurs') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher un visiteur"
                class="col-span-2 border border-gray-300 px-4 py-2 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">

            <select name="filtre" class="border border-gray-300 px-4 py-2 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                <option value="">-- Filtrer par --</option>
                <option value="jour" @if(request('filtre') == 'jour') selected @endif>Aujourd’hui</option>
                <option value="semaine" @if(request('filtre') == 'semaine') selected @endif>Cette semaine</option>
                <option value="mois" @if(request('filtre') == 'mois') selected @endif>Ce mois</option>
                <option value="annee" @if(request('filtre') == 'annee') selected @endif>Cette année</option>
            </select>

            <button type="submit"
                class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">Filtrer</button>
        </form>
    </div>

    <!-- Liste des visiteurs -->
    <div class="bg-white rounded-xl shadow border p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Vos visiteurs</h3>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm text-gray-800">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left font-medium">Nom</th>
                        <th class="px-4 py-2 text-left font-medium">Date</th>
                        <th class="px-4 py-2 text-left font-medium">Heure d’arrivée</th>
                        <th class="px-4 py-2 text-left font-medium">Heure de départ</th>
                        <th class="px-4 py-2 text-left font-medium">Motif</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($visiteurs as $visiteur)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $visiteur->nom }} {{ $visiteur->prenom }}</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($visiteur->date)->format('d/m/Y') }}</td>
                            <td class="px-4 py-2">{{ $visiteur->heure_arrive }}</td>
                            <td class="px-4 py-2">{{ $visiteur->heure_depart ?? '-' }}</td>
                            <td class="px-4 py-2">{{ ucfirst($visiteur->motif) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-4 text-center text-gray-500 italic">Aucun visiteur trouvé pour ce filtre.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $visiteurs->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection
