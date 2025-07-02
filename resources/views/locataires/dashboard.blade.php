@extends('layouts.locataire')

@section('title', 'Tableau de bord - Locataire')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">

    <!-- Bienvenue -->
    <div class=" flex justify-between mb-8">
        <h2 class="text-3xl font-bold text-indigo-700">Bienvenue, {{ Auth::user()->prenom }} </h2>
        <!-- <p class="text-gray-600 text-sm">Voici votre tableau de bord personnel  -->
            <div class="">
                <!-- {{now()->format('l, d F Y')}} -->
                {{mb_convert_case(\Carbon\Carbon::now()->locale('fr')->translatedFormat('l,d F Y'),MB_CASE_TITLE,'utf-8')}}

            </div>
    </div>

    <!-- Statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="bg-white p-6 rounded-xl shadow-lg flex items-center">
            <div class="p-3 rounded-full bg-indigo-100 text-indigo-700 mr-4">
                <i class="fas fa-user-friends"></i>
            </div>
            <div>
                <h3 class="text-sm text-gray-500">Visiteurs aujourd’hui</h3>
                <p class="text-2xl font-bold text-gray-800"></p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-lg flex items-center">
            <div class="p-3 rounded-full bg-emerald-100 text-emerald-700 mr-4">
                <i class="fas fa-calendar-week"></i>
            </div>
            <div>
                <h3 class="text-sm text-gray-500">Cette semaine</h3>
                <p class="text-2xl font-bold text-gray-800"></p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-lg flex items-center">
            <div class="p-3 rounded-full bg-amber-100 text-amber-700 mr-4">
                <i class="fas fa-users"></i>
            </div>
            <div>
                <h3 class="text-sm text-gray-500">Présents</h3>
                <p class="text-2xl font-bold text-gray-800"></p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-lg flex items-center">
            <div class="p-3 rounded-full bg-purple-100 text-purple-700 mr-4">
                <i class="fas fa-bell"></i>
            </div>
            <div>
                <h3 class="text-sm text-gray-500">Notifications</h3>
                <p class="text-2xl font-bold text-gray-800"></p>
            </div>
        </div>
    </div>

    <!-- Notifications -->
    <div class="bg-white rounded-xl shadow border p-6 mb-10">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Notifications</h3>
        <ul class="text-sm text-gray-700 space-y-2">
           
                <li class="flex items-center gap-2">
                    <i class="fas fa-circle text-indigo-500 text-xs"></i> 
                </li>
          
                <li class="text-gray-500 italic">Aucune notification pour le moment.</li>
            
        </ul>
    </div>

    <!-- Filtres -->
    <div class="bg-white rounded-xl shadow p-6 mb-6">
        <form method="GET" action="{{ route('locataires.visiteurs') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher un visiteur"
                   class="col-span-2 border border-gray-300 px-4 py-2 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">

            <select name="filtre" class="border border-gray-300 px-4 py-2 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                <option value="">-- Filtrer par --</option>
                <option value="jour" @selected(request('filtre') == 'jour')>Aujourd’hui</option>
                <option value="semaine" @selected(request('filtre') == 'semaine')>Cette semaine</option>
                <option value="mois" @selected(request('filtre') == 'mois')>Ce mois</option>
                <option value="annee" @selected(request('filtre') == 'annee')>Cette année</option>
            </select>

            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                Filtrer
            </button>
        </form>
    </div>

    <!-- Liste des visiteurs -->
    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Vos visiteurs</h3>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-gray-800 border border-gray-200">
                <thead class="bg-indigo-100 text-left">
                    <tr>
                        <th class="px-4 py-2 border">Nom</th>
                        <th class="px-4 py-2 border">Date</th>
                        <th class="px-4 py-2 border">Heure arrivée</th>
                        <th class="px-4 py-2 border">Heure départ</th>
                        <th class="px-4 py-2 border">Motif</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                   
                    
                        <!-- <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border"></td>
                            <td class="px-4 py-2 border"></td>
                            <td class="px-4 py-2 border"></td>
                            <td class="px-4 py-2 border"></td>
                            <td class="px-4 py-2 border"></td>
                        </tr> -->
                   
                        <tr>
                            <td colspan="5" class="px-4 py-4 text-center text-gray-500 italic">Aucun visiteur trouvé pour ce filtre.</td>
                        </tr>
                   
                  
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
