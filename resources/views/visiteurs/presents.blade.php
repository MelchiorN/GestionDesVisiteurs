@extends('layouts.app')
@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Visiteurs sur place</h1>
        <a href="{{ route('visiteurs.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Nouveau visiteur
        </a>
    </div>
    
    <div class="flex justify-end mb-4">
        <a href="{{ route('visiteurs.filtre') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Liste des visiteurs
        </a>
    </div> -->

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-bold uppercase ">Visiteur</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-bold uppercase ">Locataire visité</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-bold uppercase ">Localisation locataire</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-bold uppercase ">Heure arrivée</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-bold uppercase ">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($visiteurs as $visiteur)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="font-medium text-gray-900">{{ $visiteur->nom }} {{ $visiteur->prenom }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-gray-900">{{ $visiteur->locataire->nom }} {{ $visiteur->locataire->prenom }}</div>
                            <div class="text-gray-500 text-sm">{{ $visiteur->locataire->telephone }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                Étage {{ $visiteur->locataire->numero_etage }} - Ch. {{ $visiteur->locataire->numero_chambre }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ date('H:i', strtotime($visiteur->heure_arrive)) }}
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <form method="POST" action="{{ route('visiteurs.depart', $visiteur) }}" class="inline">
                                @csrf
                                <button type="submit" class="text-red-600 hover:text-red-900 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                    </svg>
                                    Départ
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                    
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection