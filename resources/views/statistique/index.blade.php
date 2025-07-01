@extends('layouts.app')

@section('title', 'Statistiques des visites')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-6 text-center">Statistiques des visites</h1>

        
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <form method="GET" class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <label for="date" class="text-lg font-medium text-gray-700 flex-shrink-0">Filtrer par jour :</label>
                <input type="date" name="date" id="date"value="{{ $date ?? now()->toDateString() }}" 
                    class="block w-full sm:w-auto border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-base p-2.5">
                <button type="submit"class="w-full sm:w-auto bg-indigo-600 text-white px-6 py-2.5 rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200 text-base font-medium">
                    Filtrer
                </button>
            </form>
        </div>

       
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10"> {{-- Adjusted grid for 4 columns, increased gap --}}
            <div class="p-6 bg-blue-50 rounded-xl shadow-lg flex items-center space-x-4"> {{-- Added shadow-lg, flex, items-center, space-x-4 --}}
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-blue-700 uppercase">Total Visiteurs</h2> 
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ $total ?? 0 }}</p> 
                </div>
            </div>

            <div class="p-6 bg-emerald-50 rounded-xl shadow-lg flex items-center space-x-4"> 
                <div class="p-3 rounded-full bg-emerald-100 text-emerald-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-emerald-700 uppercase">Visites Actives</h2>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ $presents ?? 0 }}</p>
                </div>
            </div>

            <div class="p-6 bg-fuchsia-50 rounded-xl shadow-lg flex items-center space-x-4"> {{-- Changed to fuchsia, added icon --}}
                <div class="p-3 rounded-full bg-fuchsia-100 text-fuchsia-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-fuchsia-700 uppercase">Visites Terminées</h2>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ $partis ?? 0 }}</p>
                </div>
            </div>

            <div class="p-6 bg-rose-50 rounded-xl shadow-lg flex items-center space-x-4"> {{-- Changed to rose, added icon --}}
                <div class="p-3 rounded-full bg-rose-100 text-rose-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-rose-700 uppercase">Visiteurs Bannis</h2>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ $bannis ?? 0 }}</p>
                </div>
            </div>
        </div>

        ---

        {{-- Daily Visits Table --}}
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Détails des visites </h2> {{-- Display selected date --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Visiteur</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Locataire</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Motif</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Arrivée</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Départ</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($visiteurs as $visite) {{-- Loop through daily visits --}}
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $visite->nom }} {{ $visite->prenom }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $visite->locataire->nom }} {{ $visite->locataire->prenom }}</div>
                                    <div class="text-xs text-gray-500">{{ $visite->locataire->telephone  }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $visite->motif_visite ?? 'Non spécifié' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($visite->heure_arrive)->format('H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($visite->heure_depart)->format('H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="$visite->heure_depart? 'bg-purple-100' : ">{{$visite->heure_depart? $visite->statut : 'En cours'}}</span>
                                </td>
                            </tr>
                            
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection